<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function habits()
    {
        return $this->hasMany(Habit::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function habitLogs()
    {
        return $this->hasMany(HabitLog::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /** How many of user's active habits were completed today */
    public function completedTodayCount(): int
    {
        return $this->habitLogs()
            ->whereDate('completed_at', Carbon::today())
            ->count();
    }

    /** Total active habits count */
    public function activeHabitsCount(): int
    {
        return $this->habits()->active()->count();
    }
}
