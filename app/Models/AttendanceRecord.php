<?php
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
 
class AttendanceRecord extends Model
{
    protected $table = 'attendance_records';
 
    protected $fillable = [
        'user_id',
        'trainer_id',
        'week',
        'attendance_count',
        'total_sessions',
        'attendance_percentage',
        'week_start_date',
        'week_end_date',
        'notes',
        'recorded_at',
    ];
 
    protected $casts = [
        'week_start_date' => 'date',
        'week_end_date' => 'date',
        'recorded_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
 
    /**
     * Get the user (athlete) this attendance belongs to
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
 
    /**
     * Get the trainer who recorded this attendance
     */
    public function trainer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }
 
    /**
     * Calculate attendance percentage
     */
    public function calculatePercentage(): float
    {
        if ($this->total_sessions == 0) {
            return 0;
        }
 
        return ($this->attendance_count / $this->total_sessions) * 100;
    }
 
    /**
     * Scope to get attendance for a specific user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
 
    /**
     * Scope to get attendance recorded by a trainer
     */
    public function scopeByTrainer($query, $trainerId)
    {
        return $query->where('trainer_id', $trainerId);
    }
 
    /**
     * Scope to get attendance for a specific week
     */
    public function scopeForWeek($query, $week)
    {
        return $query->where('week', $week);
    }
}