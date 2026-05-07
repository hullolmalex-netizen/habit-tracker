<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\HabitLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HabitLogController extends Controller
{
    /** Toggle today's completion for a habit */
    public function toggle(Habit $habit)
    {
        abort_if($habit->user_id !== Auth::id(), 403);

        $today = Carbon::today()->toDateString();

        $log = HabitLog::where('habit_id', $habit->id)
            ->where('completed_at', $today)
            ->first();

        if ($log) {
            $log->delete(); // undo
        } else {
            HabitLog::create([
                'habit_id'     => $habit->id,
                'user_id'      => Auth::id(),
                'completed_at' => $today,
            ]);
        }

        return back();
    }
}
