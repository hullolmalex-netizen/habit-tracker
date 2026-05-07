@extends('layouts.app-component')
@section('header', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Welcome Banner --}}
    <div class="rounded-2xl bg-gradient-to-r from-brand-500 to-brand-700 p-6 text-white shadow">
        <h2 class="text-2xl font-bold">Welcome back, {{ auth()->user()->name }}!</h2>
        <p class="mt-1 text-brand-100 text-sm">{{ now()->format('l, F j, Y') }} &mdash; Let's build great habits today.</p>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="stat-card">
            <svg class="w-7 h-7 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            <p class="stat-value">{{ $totalHabits }}</p>
            <p class="stat-label">Total Habits</p>
        </div>
        <div class="stat-card">
            <svg class="w-7 h-7 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="stat-value">{{ $completedToday }}</p>
            <p class="stat-label">Completed Today</p>
        </div>
        <div class="stat-card">
            <svg class="w-7 h-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            <p class="stat-value">{{ $completionRate }}%</p>
            <p class="stat-label">Today's Rate</p>
        </div>
        <div class="stat-card">
            <svg class="w-7 h-7 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="stat-value">{{ $totalHabits - $completedToday }}</p>
            <p class="stat-label">Remaining Today</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Today's Habits --}}
        <div class="lg:col-span-2 card">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-base font-semibold text-gray-900 dark:text-white">Today's Habits</h3>
                <a href="{{ route('habits.create') }}" class="btn-primary text-xs px-3 py-1.5">+ New Habit</a>
            </div>

            @if($habits->isEmpty())
                <div class="text-center py-10">
                    <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">No habits yet.</p>
                    <a href="{{ route('habits.create') }}" class="btn-primary mt-4 inline-flex">Create your first habit</a>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($habits as $habit)
                        @php $done = $habit->logs->isNotEmpty(); @endphp
                        <div class="flex items-center gap-4 p-3 rounded-xl border
                            {{ $done ? 'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-700' : 'bg-gray-50 dark:bg-gray-700/30 border-gray-200 dark:border-gray-600' }}
                            transition-all">
                            <form method="POST" action="{{ route('habits.log.toggle', $habit) }}">
                                @csrf
                                <button type="submit"
                                    class="w-7 h-7 rounded-full border-2 flex items-center justify-center shrink-0 transition-all
                                    {{ $done ? 'bg-green-500 border-green-500 text-white' : 'border-gray-300 dark:border-gray-500 hover:border-brand-400' }}">
                                    @if($done)
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                    @endif
                                </button>
                            </form>
                            <div class="flex items-center gap-3 flex-1 min-w-0">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0" style="background: {{ $habit->color }}22">
                                    <div class="w-3 h-3 rounded-full" style="background: {{ $habit->color }}"></div>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate {{ $done ? 'line-through text-gray-400' : '' }}">
                                        {{ $habit->name }}
                                    </p>
                                    @if($habit->category)
                                        <span class="text-xs text-gray-400">{{ $habit->category->name }}</span>
                                    @endif
                                </div>
                            </div>
                            @if($done)
                                <span class="badge-green text-xs shrink-0">Done</span>
                            @else
                                <span class="badge-yellow text-xs shrink-0">Pending</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Weekly Chart --}}
        <div class="card">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Weekly Progress</h3>
            <canvas id="weeklyChart" height="220"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('weeklyChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($weekLabels),
            datasets: [{ label: 'Completions', data: @json($weeklyData), backgroundColor: 'rgba(34,197,94,0.7)', borderColor: 'rgba(34,197,94,1)', borderWidth: 2, borderRadius: 6 }]
        },
        options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
    });
</script>
@endpush
