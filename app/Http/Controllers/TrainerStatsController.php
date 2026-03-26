<?php

namespace App\Http\Controllers;

use App\Models\StatValue;
use App\Models\StatField;
use App\Models\StatCategory;
use App\Models\AttendanceRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TrainerStatsController extends Controller
{
    /**
     * Show the form to enter athlete stats
     * 
     * @param int $categoryId
     * @param int $userId
     * @return \Illuminate\View\View
     */
    public function create($categoryId, $userId = null)
    {
        try {
            // Get category with all active fields
            $category = StatCategory::with(['fields' => function ($query) {
                $query->where('is_active', true)->ordered();
            }])->findOrFail($categoryId);

            // Get fields
            $fields = $category->fields;

            if ($fields->isEmpty()) {
                return back()->with('warning', 'No fields available for this category.');
            }

            // Get the user (athlete) if provided
            $user = $userId ? User::findOrFail($userId) : null;

            // Verify trainer access
      

            $trainerId = session('vendor_id') ?? $user->trainer_id;
       

            Log::info('Stats form accessed', [
                'trainer_id' => $trainerId,
                'category_id' => $categoryId,
                'user_id' => $userId,
                'field_count' => $fields->count()
            ]);

            return view('trainer.stats.create', compact('category', 'fields', 'categoryId', 'user'));

        } catch (\Exception $e) {
            Log::error('Error loading stats form', [
                'category_id' => $categoryId,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Unable to load the form.');
        }
    }

    /**
     * Store the stats in database
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $trainerId = session('vendor_id') ?? auth()->id();
            $userId = $request->user_id;
            $categoryId = $request->category_id;

            // Verify user exists
            $user = User::findOrFail($userId);

            // Verify trainer has access to this user
            if ($user->trainer_id != $trainerId) {
                return back()->with('error', 'Unauthorized access to this athlete.');
            }

            // Validate input
            $validated = $this->validateStatsInput($request, $categoryId);

            DB::beginTransaction();

            $savedCount = 0;
            $failedFields = [];

            // Save fitness tracking stats
            if (!empty($validated['fitness'])) {
                $saved = $this->saveFitnessStats(
                    $validated['fitness'],
                    $userId,
                    $trainerId,
                    $categoryId
                );
                $savedCount += $saved;
            }

            // Save attendance records
            if (!empty($validated['attendance'])) {
                $saved = $this->saveAttendanceRecords(
                    $validated['attendance'],
                    $userId,
                    $trainerId
                );
                $savedCount += $saved;
            }

            // Save dynamic field values
            if (!empty($validated['fields'])) {
                $saved = $this->saveDynamicFieldValues(
                    $validated['fields'],
                    $userId,
                    $trainerId,
                    $categoryId
                );
                $savedCount += $saved;
            }

            DB::commit();

            Log::info('Stats saved successfully', [
                'user_id' => $userId,
                'trainer_id' => $trainerId,
                'category_id' => $categoryId,
                'total_saved' => $savedCount
            ]);

            return back()->with('success', "✅ {$savedCount} stats saved successfully!");

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors($e->errors());

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error saving stats', [
                'error' => $e->getMessage(),
                'user_id' => $request->user_id ?? 'unknown',
                'category_id' => $request->category_id ?? 'unknown',
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'An error occurred while saving stats: ' . $e->getMessage());
        }
    }

    /**
     * Validate all input data
     * 
     * @param Request $request
     * @param int $categoryId
     * @return array
     */
    private function validateStatsInput(Request $request, $categoryId): array
    {
        // Validate basic fields
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'category_id' => 'required|integer|exists:stat_categories,id',
        ]);

        // Build validation rules for dynamic fields
        $rules = [
            'fields' => 'nullable|array',
        ];

        $fields = StatField::where('category_id', $categoryId)
            ->where('is_active', true)
            ->get();

        foreach ($fields as $field) {
            $fieldRules = 'nullable|numeric';

            if ($field->min_value !== null) {
                $fieldRules .= '|min:' . $field->min_value;
            }

            if ($field->max_value !== null) {
                $fieldRules .= '|max:' . $field->max_value;
            }

            $rules["fields.{$field->id}"] = $fieldRules;
        }

        // Fitness tracking rules
        $fitnessFields = ['speed', 'stamina', 'strength', 'agility', 'flexibility', 'endurance'];
        foreach ($fitnessFields as $field) {
            $rules["fitness.{$field}"] = 'nullable|numeric|min:0|max:100';
        }

        // Attendance rules
        for ($i = 1; $i <= 8; $i++) {
            $rules["attendance.W{$i}"] = 'nullable|integer|min:0|max:20';
        }

        // Validate all inputs
        return $request->validate($rules, [
            '*.numeric' => 'The :attribute must be a valid number.',
            '*.integer' => 'The :attribute must be a whole number.',
            '*.min' => 'The :attribute cannot be less than :min.',
            '*.max' => 'The :attribute cannot exceed :max.',
        ]);
    }

    /**
     * Save fitness tracking stats to database
     * 
     * @param array $fitnessData
     * @param int $userId
     * @param int $trainerId
     * @param int $categoryId
     * @return int Count of saved records
     */
    private function saveFitnessStats($fitnessData, $userId, $trainerId, $categoryId): int
    {
        $count = 0;
        $fitnessFields = ['speed', 'stamina', 'strength', 'agility', 'flexibility', 'endurance'];

        // Get or create fitness field mappings
        foreach ($fitnessFields as $fieldName) {
            if (empty($fitnessData[$fieldName])) {
                continue;
            }

            try {
                // Find or create the field
                $field = StatField::firstOrCreate(
                    [
                        'category_id' => $categoryId,
                        'name' => ucfirst($fieldName),
                    ],
                    [
                        'slug' => $fieldName,
                        'type' => 'numeric',
                        'unit' => 'points',
                        'min_value' => 0,
                        'max_value' => 100,
                        'decimal_places' => 2,
                        'is_active' => true,
                    ]
                );

                // Create or update stat value
                StatValue::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'field_id' => $field->id,
                        'category_id' => $categoryId,
                        'recorded_at' => now()->startOfDay(),
                    ],
                    [
                        'trainer_id' => $trainerId,
                        'value' => $fitnessData[$fieldName],
                    ]
                );

                $count++;

                Log::info("Fitness stat saved: {$fieldName}", [
                    'user_id' => $userId,
                    'value' => $fitnessData[$fieldName]
                ]);

            } catch (\Exception $e) {
                Log::warning("Failed to save fitness stat: {$fieldName}", [
                    'error' => $e->getMessage()
                ]);
            }
        }

        return $count;
    }

    /**
     * Save attendance records to database
     * 
     * @param array $attendanceData
     * @param int $userId
     * @param int $trainerId
     * @return int Count of saved records
     */
    private function saveAttendanceRecords($attendanceData, $userId, $trainerId): int
    {
        $count = 0;

        foreach ($attendanceData as $week => $attendanceCount) {
            if ($attendanceCount === null || $attendanceCount === '') {
                continue;
            }

            try {
                // Create or update attendance record
                AttendanceRecord::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'week' => $week,
                    ],
                    [
                        'trainer_id' => $trainerId,
                        'attendance_count' => $attendanceCount,
                        'total_sessions' => 5, // Default: 5 sessions per week
                        'attendance_percentage' => ($attendanceCount / 5) * 100,
                        'recorded_at' => now(),
                    ]
                );

                $count++;

                Log::info("Attendance saved for {$week}", [
                    'user_id' => $userId,
                    'attendance_count' => $attendanceCount
                ]);

            } catch (\Exception $e) {
                Log::warning("Failed to save attendance for {$week}", [
                    'error' => $e->getMessage()
                ]);
            }
        }

        return $count;
    }

    /**
     * Save dynamic field values to database
     * 
     * @param array $fieldsData
     * @param int $userId
     * @param int $trainerId
     * @param int $categoryId
     * @return int Count of saved records
     */
    private function saveDynamicFieldValues($fieldsData, $userId, $trainerId, $categoryId): int
    {
        $count = 0;

        foreach ($fieldsData as $fieldId => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            try {
                // Verify field exists
                $field = StatField::findOrFail($fieldId);

                // Create or update stat value
                StatValue::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'field_id' => $fieldId,
                        'category_id' => $categoryId,
                        'recorded_at' => now()->startOfDay(),
                    ],
                    [
                        'trainer_id' => $trainerId,
                        'value' => $value,
                    ]
                );

                $count++;

                Log::info("Field stat saved: {$field->name}", [
                    'user_id' => $userId,
                    'field_id' => $fieldId,
                    'value' => $value
                ]);

            } catch (\Exception $e) {
                Log::warning("Failed to save field stat: {$fieldId}", [
                    'error' => $e->getMessage()
                ]);
            }
        }

        return $count;
    }

    /**
     * Get stats for an athlete (for viewing/analysis)
     * 
     * @param int $userId
     * @param int $categoryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStats($userId, $categoryId)
    {
        try {
            $trainerId = session('vendor_id') ?? auth()->id();

            // Get all stats for this user and category
            $stats = StatValue::with('field')
                ->where('user_id', $userId)
                ->where('category_id', $categoryId)
                ->where('trainer_id', $trainerId)
                ->orderBy('recorded_at', 'desc')
                ->get()
                ->groupBy('field.name')
                ->map(function ($values) {
                    return [
                        'latest_value' => $values->first()->value,
                        'average' => $values->avg('value'),
                        'min' => $values->min('value'),
                        'max' => $values->max('value'),
                        'count' => $values->count(),
                        'history' => $values->map(fn($v) => [
                            'value' => $v->value,
                            'date' => $v->recorded_at->format('Y-m-d'),
                        ])->toArray(),
                    ];
                });

            // Get attendance records
            $attendance = AttendanceRecord::where('user_id', $userId)
                ->where('trainer_id', $trainerId)
                ->orderBy('week', 'asc')
                ->get();

            return response()->json([
                'stats' => $stats,
                'attendance' => $attendance,
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching stats', [
                'error' => $e->getMessage()
            ]);

            return response()->json(['error' => 'Failed to fetch stats'], 500);
        }
    }

    /**
     * List all stats for a trainer
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $trainerId = session('vendor_id') ?? auth()->id();

        $stats = StatValue::with(['user', 'field', 'category'])
            ->where('trainer_id', $trainerId)
            ->orderBy('recorded_at', 'desc')
            ->paginate(20);

        $attendance = AttendanceRecord::with('user')
            ->where('trainer_id', $trainerId)
            ->orderBy('recorded_at', 'desc')
            ->paginate(20);

        return view('trainer.stats.index', compact('stats', 'attendance'));
    }

    /**
     * Delete a stat entry
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $trainerId = session('vendor_id') ?? auth()->id();

            $stat = StatValue::where('id', $id)
                ->where('trainer_id', $trainerId)
                ->firstOrFail();

            $fieldName = $stat->field->name;
            $stat->delete();

            Log::info('Stat deleted', ['stat_id' => $id]);

            return back()->with('success', "'{$fieldName}' deleted successfully!");

        } catch (\Exception $e) {
            Log::error('Error deleting stat', ['error' => $e->getMessage()]);
            return back()->with('error', 'Failed to delete stat.');
        }
    }

    /**
     * Export stats to CSV
     * 
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function export()
    {
        $trainerId = session('vendor_id') ?? auth()->id();

        $stats = StatValue::with(['user', 'field', 'category'])
            ->where('trainer_id', $trainerId)
            ->orderBy('recorded_at', 'desc')
            ->get();

        $filename = 'stats_export_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($stats) {
            $file = fopen('php://output', 'w');

            // CSV Header
            fputcsv($file, [
                'Athlete Name',
                'Category',
                'Field Name',
                'Value',
                'Unit',
                'Recorded Date',
                'Notes'
            ]);

            // CSV Data
            foreach ($stats as $stat) {
                fputcsv($file, [
                    $stat->user->name ?? 'Unknown',
                    $stat->category->name ?? 'Unknown',
                    $stat->field->name ?? 'Unknown',
                    $stat->value,
                    $stat->field->unit ?? '',
                    $stat->recorded_at->format('Y-m-d H:i:s'),
                    $stat->notes ?? '',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}