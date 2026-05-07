<?php

namespace App\Http\Controllers;

use App\Models\HabitLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Load active habits with their category and today's logs
        $habits = $user->habits()
            ->with(['category', 'logs' => function ($q) {
                $q->whereDate('completed_at', Carbon::today());
            }])
            ->active()
            ->latest()
            ->get();

        // Stats for the header cards
        $totalHabits      = $habits->count();
        $completedToday   = $habits->filter(fn($h) => $h->logs->isNotEmpty())->count();
        $completionRate   = $totalHabits > 0
            ? round(($completedToday / $totalHabits) * 100)
            : 0;

        // Weekly completion data for chart (last 7 days)
        $weeklyData = [];
        $weekLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $weekLabels[] = $date->format('D'); // Mon, Tue...
            $weeklyData[] = HabitLog::where('user_id', $user->id)
                ->whereDate('completed_at', $date)
                ->count();
        }

        return view('dashboard.index', compact(
            'habits',
            'totalHabits',
            'completedToday',
            'completionRate',
            'weeklyData',
            'weekLabels'
        ));
    }
}
