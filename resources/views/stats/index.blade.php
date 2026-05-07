@extends('layouts.app-component')
@section('header', 'Statistics')

@section('content')
<div class="space-y-6">

    {{-- Summary cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="stat-card">
            <span class="text-2xl">📋</span>
            <p class="stat-value">{{ $totalHabits }}</p>
            <p class="stat-label">Active Habits</p>
        </div>
        <div class="stat-card">
            <span class="text-2xl">✅</span>
            <p class="stat-value">{{ $totalLogs }}</p>
            <p class="stat-label">Total Completions</p>
        </div>
        <div class="stat-card">
            <span class="text-2xl">🔥</span>
            <p class="stat-value">{{ $bestStreak }}</p>
            <p class="stat-label">Best Streak</p>
        </div>
        <div class="stat-card">
            <span class="text-2xl">📅</span>
            <p class="stat-value">{{ $completedToday }}</p>
            <p class="stat-label">Done Today</p>
        </div>
    </div>

    {{-- 30-day line chart --}}
    <div class="card">
        <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Last 30 Days — Daily Completions</h3>
        <canvas id="lineChart" height="100"></canvas>
    </div>

    {{-- Per-habit breakdown --}}
    <div class="card">
        <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-5">Habit Completion Rate (Last 30 Days)</h3>

        @if($habitStats->isEmpty())
            <p class="text-gray-400 text-sm text-center py-8">No habits yet.</p>
        @else
            <div class="space-y-4">
                @foreach($habitStats as $stat)
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ $stat['icon'] }} {{ $stat['name'] }}
                        </span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ $stat['rate'] }}%
                            <span class="text-xs text-gray-400 font-normal">({{ $stat['logs'] }}/30 days)</span>
                        </span>
                    </div>
                    <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2.5">
                        <div class="h-2.5 rounded-full transition-all duration-500"
                             style="width: {{ $stat['rate'] }}%; background: {{ $stat['color'] }}"></div>
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
            datasets: [{
                label: 'Completions',
                data: @json($dailyData),
                fill: true,
                backgroundColor: 'rgba(34,197,94,0.1)',
                borderColor: 'rgba(34,197,94,1)',
                borderWidth: 2,
                pointRadius: 3,
                tension: 0.4,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });
</script>
@endpush
