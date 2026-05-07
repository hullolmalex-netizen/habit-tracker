@extends('layouts.app-component')
@section('header', 'Statistics')

@section('content')
<div class="space-y-6">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="stat-card">
            <svg class="w-7 h-7 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            <p class="stat-value">{{ $totalHabits }}</p>
            <p class="stat-label">Active Habits</p>
        </div>
        <div class="stat-card">
            <svg class="w-7 h-7 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="stat-value">{{ $totalLogs }}</p>
            <p class="stat-label">Total Completions</p>
        </div>
        <div class="stat-card">
            <svg class="w-7 h-7 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"/></svg>
            <p class="stat-value">{{ $bestStreak }}</p>
            <p class="stat-label">Best Streak</p>
        </div>
        <div class="stat-card">
            <svg class="w-7 h-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <p class="stat-value">{{ $completedToday }}</p>
            <p class="stat-label">Done Today</p>
        </div>
    </div>

    <div class="card">
        <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Last 30 Days &mdash; Daily Completions</h3>
        <canvas id="lineChart" height="100"></canvas>
    </div>

    <div class="card">
        <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-5">Habit Completion Rate (Last 30 Days)</h3>
        @if($habitStats->isEmpty())
            <p class="text-gray-400 text-sm text-center py-8">No habits yet.</p>
        @else
            <div class="space-y-4">
                @foreach($habitStats as $stat)
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $stat['name'] }}</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ $stat['rate'] }}%
                            <span class="text-xs text-gray-400 font-normal">({{ $stat['logs'] }}/30)</span>
                        </span>
                    </div>
                    <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2.5">
                        <div class="h-2.5 rounded-full transition-all duration-500" style="width:{{ $stat['rate'] }}%; background:{{ $stat['color'] }}"></div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('lineChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($dailyLabels),
            datasets: [{ label: 'Completions', data: @json($dailyData), fill: true, backgroundColor: 'rgba(34,197,94,0.1)', borderColor: 'rgba(34,197,94,1)', borderWidth: 2, pointRadius: 3, tension: 0.4 }]
        },
        options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
    });
</script>
@endpush
