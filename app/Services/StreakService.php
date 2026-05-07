<?php

namespace App\Services;

use App\Models\Habit;
use Carbon\Carbon;

/**
 * StreakService
 * ─────────────────────────────────────────────────────────────────────────
 * Handles all streak-related calculations.
 * Kept in its own class so controllers stay clean and logic is testable.
 */
class StreakService
{
    /**
     * Calculate the current streak for a given habit.
     * A streak = consecutive days ending today (or yesterday) where a log exists.
     *
     * @param  Habit  $habit
     * @return int  number of consecutive days
     */
    public function currentStreak(Habit $habit): int
    {
        // Will be implemented in STEP 5
        return 0;
    }

    /**
     * Calculate the longest ever streak for a given habit.
     *
     * @param  Habit  $habit
     * @return int
     */
    public function longestStreak(Habit $habit): int
    {
        // Will be implemented in STEP 5
        return 0;
    }

    /**
     * Check if a habit was completed on a specific date.
     *
     * @param  Habit   $habit
     * @param  Carbon  $date
     * @return bool
     */
    public function completedOn(Habit $habit, Carbon $date): bool
    {
        // Will be implemented in STEP 5
        return false;
    }
}
