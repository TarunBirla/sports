<?php 
namespace App\Http\Controllers;

use App\Models\StatValue;
use App\Models\StatField;
use App\Models\StatCategory;
use App\Models\AttendanceRecord;
use App\Models\Course;
use App\Models\User;
use App\Models\StudentFitness;
use App\Models\StudentPerformance;
use App\Models\StudentAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;



class StudentStatsController extends Controller
{


    public function dashboard()
    {
        $userId = auth()->id();

        // ✅ LATEST PERFORMANCE
        $performance = StudentPerformance::where('user_id', $userId)
            ->latest()
            ->first();
            

        // ✅ LATEST FITNESS
        $fitness = StudentFitness::where('user_id', $userId)
            ->latest()
            ->first();

        // ✅ LAST 8 PERFORMANCE RECORDS (FOR GRAPH)
        $performances = StudentPerformance::where('user_id', $userId)
            ->latest()
            ->take(8)
            ->get()
            ->reverse();

        // ✅ LAST 8 ATTENDANCE
        $attendance = StudentAttendance::where('user_id', $userId)
            ->latest()
            ->take(8)
            ->get()
            ->reverse();

        // =========================
        // GRAPH DATA
        // =========================

        $labels = [];
        $runsData = [];
        $strikeRateData = [];
        $wicketsData = [];
        $economyData = [];

        foreach ($performances as $index => $p) {
             $labels[] = \Carbon\Carbon::parse($p->created_at)->format('M');

            $runsData[] = $p->runs ?? 0;
            $strikeRateData[] = $p->strike_rate ?? 0;

            $wicketsData[] = $p->wickets ?? 0;
            $economyData[] = $p->economy ?? 0;
        }

        // =========================
        // FITNESS DATA
        // =========================
        $fitnessData = [
            $fitness->speed ?? 0,
            $fitness->stamina ?? 0,
            $fitness->strength ?? 0,
            $fitness->agility ?? 0,
            $fitness->flexibility ?? 0,
            $fitness->endurance ?? 0,
        ];

        // =========================
        // ATTENDANCE DATA
        // =========================
        $attendanceLabels = [];
        $attendanceData = [];

        foreach ($attendance as $a) {
            $attendanceLabels[] = 'M' . $a->month;
            $attendanceData[] = $a->sessions_attended ?? 0;
        }

        return view('dashboard.index', compact(
            'performance',
            'labels',
            'runsData',
            'strikeRateData',
            'wicketsData',
            'economyData',
            'fitnessData',
            'attendanceLabels',
            'attendanceData'
        ));
    }

    // SHOW FORM WITH DATA
    public function index($userId)
    {
        $user = User::findOrFail($userId);
        $dob = $user->dob;
        $age = Carbon::parse($dob)->age ?? null;
        $performance = StudentPerformance::where('user_id', $userId)->first();
        $fitness = StudentFitness::where('user_id', $userId)->first();
        $attendance = StudentAttendance::where('user_id', $userId)->get()->keyBy('month');

        return view('trainer.stats.form', compact('performance','fitness','attendance','userId','age'));
    }

    public function list()
    {
        $records = \App\Models\StudentPerformance::with('user')
                    ->latest()
                    ->get();

        return view('trainer.stats.list', compact('records'));
    }
    // SAVE / UPDATE
    // public function save(Request $request, $userId)
    // {
    //     // PERFORMANCE
    //     StudentPerformance::Insert(
    //         $request->only([
    //             'runs','economy','wickets','total_matches',
    //             'strike_rate','batting_average','high_score',
    //             'centuries','half_centuries','catches',
    //             'best_bowling','age','batting_style',
    //             'bowling_style','academy','user_id'
    //         ])
    //     );

    //     // FITNESS
    //     StudentFitness::updateOrCreate(
    //         ['user_id' => $userId],
    //         $request->only([
    //             'speed','stamina','strength',
    //             'agility','flexibility','endurance'
    //         ])
    //     );

    //     // ATTENDANCE (MONTH WISE)
    //     if ($request->attendance) {
    //         foreach ($request->attendance as $month => $value) {
    //             StudentAttendance::updateOrCreate(
    //                 ['user_id' => $userId, 'month' => $month],
    //                 ['sessions_attended' => $value]
    //             );
    //         }
    //     }

    //     return back()->with('success', 'Data Saved Successfully');
    // }
    public function save(Request $request, $userId)
    {
        // PERFORMANCE (MULTIPLE RECORDS ✅)
        StudentPerformance::create([
            'user_id' => $userId,
            'runs' => $request->runs,
            'economy' => $request->economy,
            'wickets' => $request->wickets,
            'total_matches' => $request->total_matches,
            'strike_rate' => $request->strike_rate,
            'batting_average' => $request->batting_average,
            'high_score' => $request->high_score,
            'centuries' => $request->centuries,
            'half_centuries' => $request->half_centuries,
            'catches' => $request->catches,
            'best_bowling' => $request->best_bowling,
            'age' => $request->age,
            'batting_style' => $request->batting_style,
            'bowling_style' => $request->bowling_style,
            'academy' => $request->academy,
            'balls_faced' => $request->balls_faced,
            'overs_bowled' => $request->overs_bowled,
            'runs_conceded' => $request->runs_conceded,
        ]);

        // FITNESS (MULTIPLE RECORDS)
        StudentFitness::create([
            'user_id' => $userId,
            'speed' => $request->speed,
            'stamina' => $request->stamina,
            'strength' => $request->strength,
            'agility' => $request->agility,
            'flexibility' => $request->flexibility,
            'endurance' => $request->endurance,
        ]);

        // ATTENDANCE (MULTIPLE RECORDS)
        if ($request->attendance) {
            foreach ($request->attendance as $month => $value) {
                StudentAttendance::create([
                    'user_id' => $userId,
                    'month' => $month,
                    'sessions_attended' => $value
                ]);
            }
        }

        return back()->with('success', 'Data Saved Successfully');
    }


    // =========================
    // EDIT PAGE
    // =========================
    public function edit($userId)
    {
        $performance = StudentPerformance::where('user_id', $userId)->first();
        $fitness = StudentFitness::where('user_id', $userId)->first();
        $attendance = StudentAttendance::where('user_id', $userId)
                        ->get()
                        ->keyBy('month');

        return view('trainer.stats.edit-stats', compact('performance', 'fitness', 'attendance', 'userId'));
    }

    // =========================
    // UPDATE DATA
    // =========================
    public function update(Request $request, $userId)
    {
        // -----------------------
        // PERFORMANCE
        // -----------------------
        StudentPerformance::updateOrCreate(
            ['user_id' => $userId],
            [
                'runs' => $request->runs,
                'economy' => $request->economy,
                'wickets' => $request->wickets,
                'total_matches' => $request->total_matches,
                'strike_rate' => $request->strike_rate,
                'batting_average' => $request->batting_average,
                'high_score' => $request->high_score,
                'centuries' => $request->centuries,
                'half_centuries' => $request->half_centuries,
                'catches' => $request->catches,
                'best_bowling' => $request->best_bowling,
                'age' => $request->age,
                'batting_style' => $request->batting_style,
                'bowling_style' => $request->bowling_style,
                'academy' => $request->academy,

                'balls_faced' => $request->balls_faced,
                'overs_bowled' => $request->overs_bowled,
                'runs_conceded' => $request->runs_conceded,
            ]
        );

        // -----------------------
        // FITNESS
        // -----------------------
        StudentFitness::updateOrCreate(
            ['user_id' => $userId],
            [
                'speed' => $request->speed,
                'stamina' => $request->stamina,
                'strength' => $request->strength,
                'agility' => $request->agility,
                'flexibility' => $request->flexibility,
                'endurance' => $request->endurance,
            ]
        );

        // -----------------------
        // ATTENDANCE
        // -----------------------
        if ($request->attendance) {
            foreach ($request->attendance as $month => $value) {

                StudentAttendance::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'month' => $month,
                    ],
                    [
                        'sessions_attended' => $value
                    ]
                );
            }
        }

        return back()->with('success', 'Data Updated Successfully');
    }
}