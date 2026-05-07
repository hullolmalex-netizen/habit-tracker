<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Habit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'color',
        'icon',
        'frequency',   // daily | weekly
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /** Habit belongs to one user */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** Habit belongs to one category (optional) */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /** Habit has many daily log entries */
    public function logs()
    {
        return $this->hasMany(HabitLog::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /** Only active habits */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /** Habits belonging to the authenticated user */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
