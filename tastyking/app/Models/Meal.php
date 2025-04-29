<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meal extends Model
{
    protected $table = 'meal';
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'order_count',
    ];

    /**
     * Get the category that this meal belongs to
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the reviews for this meal
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
