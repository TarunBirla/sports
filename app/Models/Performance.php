<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $table = 'performance';

    protected $fillable = [
        'trainer_id',
        'user_id',
        'course_id',
        'category_id',
        'runs',
        'wickets',
        'strick_rate',
        'ecconomy',
        'total_matches',
        'batting_average',
        'high_score',
        'centuries',
        'catches',
        'half_centuries',
        'best_bowlingfigures',
        'age',
        'batting',//Right-handed//
        'bowling',//Right-arm Medium//
        'accadmy',//Elite Cricket Academy//

        
       
        
    ];
}