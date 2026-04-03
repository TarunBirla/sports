<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    protected $table = 'matches';

    protected $fillable = [
        'match_date',
        'opponent_team',
        'venue',
        'match_type',
        'video_url',
        'created_by',
        'status'
    ];

    // 🔗 Vendor who created the match
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'created_by');
    }

    // 🔗 Users assigned to this match
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_matches', 'match_id', 'user_id')
                    ->withPivot('assigned_by')
                    ->withTimestamps();
    }
}