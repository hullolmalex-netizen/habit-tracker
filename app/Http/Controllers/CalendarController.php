<?php

namespace App\Http\Controllers;

use App\Models\HabitLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        return $this->show(now()->year, now()->month);
    }

    public function show($year, $month)
    {
        $user  = Auth::user();
        $date  = Carbon::createFromDate($year, $month, 1);
        $prev  = $date->copy()->subMonth();
        $next  = $date->copy()->addMonth();

        // All log dates for this month
        $logDates = HabitLog::where('user_id', $user->id)
            ->whereYear('completed_at', $year)
            ->whereMonth('completed_at', $month)
            ->selectRaw('DATE(completed_at) as day, COUNT(*) as total')
            ->groupBy('day')
            ->pluck('total', 'day')
            ->toArray();

        $totalHabits = $user->habits()->active()->count();

        // Build calendar grid
        $startOfMonth = $date->copy()->startOfMonth();
        $startOfGrid  = $startOfMonth->copy()->startOfWeek(Carbon::SUNDAY);
        $endOfMonth   = $date->copy()->endOfMonth();
        $endOfGrid    = $endOfMonth->copy()->endOfWeek(Carbon::SATURDAY);

        $weeks = [];
        $day   = $startOfGrid->copy();
        while ($day <= $endOfGrid) {
            $week = [];
            for ($i = 0; $i < 7; $i++) {
                $dateStr   = $day->toDateString();
                $completed = $logDates[$dateStr] ?? 0;
                $week[] = [
                    'date'         => $day->copy(),
                    'day'          => $day->day,
                    'isCurrentMonth' => $day->month === (int)$month,
                    'isToday'      => $day->isToday(),
                    'completed'    => $completed,
                    'rate'         => $totalHabits > 0 ? round(($completed / $totalHabits) * 100) : 0,
                ];
                $day->addDay();
            }
            $weeks[] = $week;
        }

        return view('calendar.index', compact(
            'weeks', 'date', 'prev', 'next', 'totalHabits'
        ));
    }
}
