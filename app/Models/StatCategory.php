<?php
 
// ========== StatCategory.php ==========
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
 
class StatCategory extends Model
{
    protected $table = 'stat_categories';
 
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];
 
    /**
     * Get all fields in this category
     */
    public function fields(): HasMany
    {
        return $this->hasMany(StatField::class, 'category_id');
    }
 
    /**
     * Get all stat values in this category
     */
    public function statValues(): HasMany
    {
        return $this->hasMany(StatValue::class, 'category_id');
    }
 
    /**
     * Scope to get active categories
     */
    public function scopeActive($query)
    {
        return $query->whereHas('fields', function ($q) {
            $q->where('is_active', true);
        });
    }
}
 