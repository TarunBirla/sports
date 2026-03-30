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
use Illuminate\Http\Request;



class StudentStatsController extends Controller
{
    // SHOW FORM WITH DATA
    public function index($userId)
    {
        $performance = StudentPerformance::where('user_id', $userId)->first();
        $fitness = StudentFitness::where('user_id', $userId)->first();
        $attendance = StudentAttendance::where('user_id', $userId)->get()->keyBy('month');

        return view('trainer.stats.form', compact('performance','fitness','attendance','userId'));
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
}