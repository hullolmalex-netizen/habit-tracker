<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\HabitLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StatController extends Controller
{
    public function index()
    {
        $user   = Auth::user();
        $habits = $user->habits()->with('category')->active()->get();

        // --- Overall stats ---
        $totalLogs     = $user->habitLogs()->count();
        $totalHabits   = $habits->count();
        $completedToday = $user->completedTodayCount();

        // --- Per-habit stats (last 30 days) ---
        $since = Carbon::today()->subDays(29);
        $habitStats = $habits->map(function ($habit) use ($since) {
            $logs      = $habit->logs()->whereDate('completed_at', '>=', $since)->count();
            $possible  = 30;
            $rate      = $possible > 0 ? round(($logs / $possible) * 100) : 0;
            return [
                'name'  => $habit->name,
                'icon'  => $habit->icon,
                'color' => $habit->color,
                'logs'  => $logs,
                'rate'  => $rate,
            ];
        })->sortByDesc('rate')->values();

        // --- Last 30 days daily totals (for line chart) ---
        $dailyLabels = [];
        $dailyData   = [];
        for ($i = 29; $i >= 0; $i--) {
            $date          = Carbon::today()->subDays($i);
            $dailyLabels[] = $date->format('M j');
            $dailyData[]   = HabitLog::where('user_id', $user->id)
                ->whereDate('completed_at', $date)
                ->count();
        }

        // --- Best streak per habit ---
        $bestStreak = 0;
        foreach ($habits as $habit) {
            $dates = $habit->logs()
                ->orderBy('completed_at')
                ->pluck('completed_at')
                ->map(fn($d) => Carbon::parse($d)->toDateString())
                ->toArray();

            $streak = $max = 1;
            for ($i = 1; $i < count($dates); $i++) {
                $diff = Carbon::parse($dates[$i])->diffInDays(Carbon::parse($dates[$i - 1]));
                $streak = $diff === 1 ? $streak + 1 : 1;
                $max = max($max, $streak);
            }
            $bestStreak = max($bestStreak, count($dates) > 0 ? $max : 0);
        }

        return view('stats.index', compact(
            'habitStats', 'totalLogs', 'totalHabits',
            'completedToday', 'dailyLabels', 'dailyData', 'bestStreak'
        ));
    }
}
