<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class StudentAttendance extends Model
{
    protected $table = 'student_attendance';
    
    protected $fillable = [
        'user_id','month','sessions_attended'
    ];
}

//     protected $table = 'student_attendance'; // ✅ correct

//     protected $fillable = [
//         'trainer_id',
//         'user_id',
//         'course_id',
//         'week',
//         'attendance'
//     ];
