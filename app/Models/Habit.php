<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

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
        'frequency',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

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

    /** Habits for a specific user */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /** Was this habit completed today? */
    public function isCompletedToday(): bool
    {
        return $this->logs()
            ->whereDate('completed_at', Carbon::today())
            ->exists();
    }

    /** Was this habit completed on a specific date? */
    public function isCompletedOn(Carbon $date): bool
    {
        return $this->logs()
            ->whereDate('completed_at', $date)
            ->exists();
    }

    /** Total number of completions */
    public function totalCompletions(): int
    {
        return $this->logs()->count();
    }
}
