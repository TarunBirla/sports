<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\StatValue;
use App\Models\StatField;
use App\Models\StatCategory;
use App\Models\AttendanceRecord;
use App\Models\Course;
use App\Models\StudentFitness;
use App\Models\StudentPerformance;
use App\Models\StudentAttendance;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'total_matches',
        'runs',
        'wickets',
        'strike_rate',
        'batting_average',
        'high_score',
        'age',
        'batting',
        'trainer_id',
        'bowling',
        'academy'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

     public function statValues(): HasMany
    {
        return $this->hasMany(StatValue::class, 'user_id');
    }

    public function performance()
    {
        return $this->hasMany(StudentPerformance::class, 'user_id');
    }

    public function fitness()
    {
        return $this->hasMany(StudentFitness::class, 'user_id');
    }

    public function attendance()
    {
        return $this->hasMany(StudentAttendance::class, 'user_id');
    }


    public function recordedStats(): HasMany
    {
        return $this->hasMany(StatValue::class, 'trainer_id');
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'trainer_id');
    }

    public function attendanceRecords(): HasMany
    {
        return $this->hasMany(AttendanceRecord::class, 'user_id');
    }
 
    /**
     * Get all attendance records recorded by this trainer
     */
    public function recordedAttendance(): HasMany
    {
        return $this->hasMany(AttendanceRecord::class, 'trainer_id');
    }
}
