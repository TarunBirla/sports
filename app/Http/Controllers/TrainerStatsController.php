<?php

namespace App\Http\Controllers;

use App\Models\StatValue;
use App\Models\StatField;
use App\Models\StatCategory;
use App\Models\AttendanceRecord;
use App\Models\Course;
use App\Models\User;
use App\Models\StudentFitness;

use App\Models\Performance;
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
    public function create($categoryId, $userId = null, $courseId = null)
    {
        try {

            if($categoryId == 8){

                $categoryId = 5;
                
            }elseif($categoryId == 9){
                
                $categoryId = 6;
            
            }elseif($categoryId == 10){
            
                $categoryId = 3;
           
            }elseif($categoryId == 11){
            
                $categoryId = 4;
            
            }
            $category = StatCategory::with([
                'fields' => function ($query) {
                    $query->where('is_active', true)->ordered();
                }
            ])->findOrFail($categoryId);

            // Get fields
            $fields = $category->fields;
            if ($fields->isEmpty()) {
                return back()->with('warning', 'No fields available for this category.');
            }

            // Get the user (athlete) if provided
            $user = $userId ? User::findOrFail($userId) : null;
            $course = $courseId ? Course::findOrFail($courseId) : null;
            

            $trainerId = session('vendor_id') ?? $user->trainer_id;


            Log::info('Stats form accessed', [
                'trainer_id' => $trainerId,
                'category_id' => $categoryId,
                'user_id' => $userId,
                'field_count' => $fields->count(),
                'user' => $user,
                'course' => $course
            ]);

            return view('trainer.stats.create', compact('category', 'fields', 'categoryId', 'user', 'course'));

        } catch (\Exception $e) {
            Log::error('Error loading stats form', [
                'category_id' => $categoryId,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Unable to load the form.');
        }
    }

    public function store(Request $request)
    {
        try {
            Log::info('REQUEST DATA', $request->all());
            $trainerId = session('vendor_id') ?? auth()->id();
            $userId = $request->user_id;
            $categoryId = $request->category_id;

            // Verify user exists
            $user = User::findOrFail($userId);

            // Validate input
            $validated = $this->validateStatsInput($request, $categoryId);

            DB::beginTransaction();

            $savedCount = 0;
            $failedFields = [];

            // Save fitness tracking stats
            // if (!empty($validated['fitness'])) {
            // Save fitness tracking stats
            if (
                $request->has('fitness') &&
                collect($request->fitness)->filter(function ($v) {
                    return $v !== null && $v !== '';
                })->count() > 0
            ) {
                $saved = $this->saveFitnessStats(
                    $request->fitness, // ✅ FIX
                    $userId,
                    $trainerId,
                    $categoryId,
                    $request->course_id
                );
                $savedCount += $saved;
            }
            Log::info('Performance Raw Data', $request->performance ?? []);

            // Save Performance Data
            if ($request->has('performance')) {

                $hasData = collect($request->performance)->filter(function ($v) {
                    return $v !== null && $v !== '';
                })->count();

                if ($hasData > 0) {
                    $this->savePerformance(
                        $request->performance,
                        $userId,
                        $trainerId,
                        $categoryId,
                        $request->course_id
                    );
                }
            }
            // Save attendance records
            if (!empty($validated['attendance'])) {
                $saved = $this->saveAttendanceRecords(
                    $validated['attendance'],
                    $userId,
                    $trainerId,
                    $request->course_id
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
        $attributes = [];

        foreach ($fields as $field) {
            $attributes["fields.{$field->id}"] = $field->name;
        }

        foreach (['speed','stamina','strength','agility','flexibility','endurance'] as $f) {
            $attributes["fitness.$f"] = ucfirst($f);
        }

        for ($i = 1; $i <= 8; $i++) {
            $attributes["attendance.W{$i}"] = "Week {$i}";
        }

        return $request->validate($rules, [
            '*.numeric' => 'The :attribute must be a valid number.',
            '*.integer' => 'The :attribute must be a whole number.',
            '*.min' => 'The :attribute must be at least :min.',
            '*.max' => 'The :attribute must not be greater than :max.',
        ], $attributes);
    }

    private function saveFitnessStats($fitnessData, $userId, $trainerId, $categoryId, $courseId): int
    {
        try {

            if (collect($fitnessData)->filter()->count() == 0) {
                return 0;
            }

            StudentFitness::updateOrCreate(
                [
                    'user_id' => $userId,
                    'course_id' => $courseId,
                ],
                [
                    'trainer_id' => $trainerId,
                    'category_id' => $categoryId,

                    'speed' => $fitnessData['speed'] ?? null,
                    'stamina' => $fitnessData['stamina'] ?? null,
                    'strength' => $fitnessData['strength'] ?? null,
                    'agility' => $fitnessData['agility'] ?? null,
                    'flexibility' => $fitnessData['flexibility'] ?? null,
                    'endurance' => $fitnessData['endurance'] ?? null,
                ]
            );

            return 1;

        } catch (\Exception $e) {
            Log::error('Fitness Save Error: ' . $e->getMessage());
            return 0;
        }
    }

   private function saveAttendanceRecords($attendanceData, $userId, $trainerId, $courseId = 1): int
    {
        \Log::info('Saving attendance records', ['course_id' => $courseId]);

        $count = 0;

        // ✅ Fix trainer_id issue
        if (!\App\Models\User::where('id', $trainerId)->exists()) {
            \Log::warning('Invalid trainer_id', ['trainer_id' => $trainerId]);
            $trainerId = null;
        }

        foreach ($attendanceData as $week => $attendanceCount) {

            if ($attendanceCount === null || $attendanceCount === '') {
                continue;
            }

            try {

                AttendanceRecord::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'week' => $week,
                        'trainer_id' => $trainerId,
                    ],
                    [
                        'course_id' => $courseId,
                        'attendance_count' => $attendanceCount,
                        'total_sessions' => 5,
                        'attendance_percentage' => ($attendanceCount / 5) * 100,
                        'recorded_at' => now(),
                    ]
                );

                $count++;

                \Log::info("Attendance saved for {$week}", [
                    'user_id' => $userId,
                    'attendance_count' => $attendanceCount
                ]);

            } catch (\Exception $e) {
                \Log::warning("Failed to save attendance for {$week}", [
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
    private function savePerformance($data, $userId, $trainerId, $categoryId, $courseId)
    {
        try {

            // ✅ FIX: proper filter (0 ko allow karo)
            $hasData = collect($data)->filter(function ($v) {
                return $v !== null && $v !== '';
            })->count();

            if ($hasData == 0) {
                Log::info('Performance skipped: no valid data', $data);
                return;
            }

            Performance::updateOrCreate(
                [
                    'user_id' => $userId,
                    'course_id' => $courseId,
                ],
                [
                    'trainer_id' => $trainerId,
                    'category_id' => $categoryId,

                    'runs' => $data['runs'] ?? null,
                    'wickets' => $data['wickets'] ?? null,
                    'strick_rate' => $data['strick_rate'] ?? null,
                    'ecconomy' => $data['ecconomy'] ?? null,
                    'total_matches' => $data['total_matches'] ?? null,
                    'batting_average' => $data['batting_average'] ?? null,
                    'high_score' => $data['high_score'] ?? null,
                    'centuries' => $data['centuries'] ?? null,
                    'half_centuries' => $data['half_centuries'] ?? null,
                    'catches' => $data['catches'] ?? null,
                    'best_bowlingfigures' => $data['best_bowlingfigures'] ?? null,
                    'age' => $data['age'] ?? null,
                    'batting' => $data['batting'] ?? null,
                    'bowling' => $data['bowling'] ?? null,
                    'accadmy' => $data['accadmy'] ?? null,
                ]
            );

            Log::info('Performance saved', $data);

        } catch (\Exception $e) {
            Log::error('Performance Save Error: ' . $e->getMessage());
        }
    }
}