<?php
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
 
class StatField extends Model
{
    protected $table = 'stat_fields';
 
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'type',
        'description',
        'unit',
        'min_value',
        'max_value',
        'decimal_places',
        'order',
        'is_active',
    ];
 
    protected $casts = [
        'min_value' => 'decimal:2',
        'max_value' => 'decimal:2',
        'is_active' => 'boolean',
    ];
 
    /**
     * Get the category this field belongs to
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(StatCategory::class, 'category_id');
    }
 
    /**
     * Get all stat values for this field
     */
    public function statValues(): HasMany
    {
        return $this->hasMany(StatValue::class, 'field_id');
    }
 
    /**
     * Scope to get active fields
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
 
    /**
     * Scope to get fields ordered
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
 