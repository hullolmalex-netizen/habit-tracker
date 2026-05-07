<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'color',
        'icon',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /** Category belongs to a user */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** Category has many habits */
    public function habits()
    {
        return $this->hasMany(Habit::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /** Count of active habits in this category */
    public function activeHabitsCount(): int
    {
        return $this->habits()->where('is_active', true)->count();
    }
}
