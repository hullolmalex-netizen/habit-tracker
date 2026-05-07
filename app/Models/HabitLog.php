<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HabitLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'habit_id',
        'user_id',
        'completed_at',  // date only (Y-m-d)
        'notes',
    ];

    protected $casts = [
        'completed_at' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /** Log belongs to a habit */
    public function habit()
    {
        return $this->belongsTo(Habit::class);
    }

    /** Log belongs to a user */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
