<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
         // NEW PROFILE FIELDS
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

     public function statValues(): HasMany
    {
        return $this->hasMany(StatValue::class, 'user_id');
    }
 
    /**
     * Get all stats recorded by this trainer
     */
    public function recordedStats(): HasMany
    {
        return $this->hasMany(StatValue::class, 'trainer_id');
    }
 
    /**
     * Get all attendance records for this user
     */
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
