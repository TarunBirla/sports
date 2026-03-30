<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentFitness extends Model
{
    protected $table = 'student_fitness';

    protected $fillable = [
        'user_id','speed','stamina','strength',
        'agility','flexibility','endurance'
    ];
}
//     protected $table = 'student_fitness';

//     protected $fillable = [
//         'trainer_id',
//         'user_id',
//         'course_id',
//         'category_id',
//         'speed',
//         'stamina',
//         'strength',
//         'agility',
//         'flexibility',
//         'endurance'
//     ];