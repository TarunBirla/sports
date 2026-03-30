<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPerformance extends Model
{
    protected $fillable = [
        'user_id','runs','economy','wickets','total_matches',
        'strike_rate','batting_average','high_score',
        'centuries','half_centuries','catches',
        'best_bowling','age','batting_style',
        'bowling_style','academy'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}