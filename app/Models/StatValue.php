<?php
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
 
class StatValue extends Model
{
    protected $table = 'stat_values';
 
    protected $fillable = [
        'user_id',
        'trainer_id',
        'category_id',
        'field_id',
        'value',
        'notes',
        'recorded_at',
    ];
 
    protected $casts = [
        'value' => 'decimal:2',
        'recorded_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
 
    /**
     * Get the user (athlete) this stat belongs to
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
 
    /**
     * Get the trainer who recorded this stat
     */
    public function trainer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }
 
    /**
     * Get the category this stat belongs to
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(StatCategory::class, 'category_id');
    }
 
    /**
     * Get the field this stat is for
     */
    public function field(): BelongsTo
    {
        return $this->belongsTo(StatField::class, 'field_id');
    }
 
    /**
     * Scope to get stats for a specific user and category
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
 
    /**
     * Scope to get stats for a specific category
     */
    public function scopeForCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
 
    /**
     * Scope to get stats recorded by a trainer
     */
    public function scopeByTrainer($query, $trainerId)
    {
        return $query->where('trainer_id', $trainerId);
    }
 
    /**
     * Scope to get recent stats
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('recorded_at', '>=', now()->subDays($days));
    }
}