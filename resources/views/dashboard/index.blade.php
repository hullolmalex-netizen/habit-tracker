<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <div class="space-y-6 animate-slide-up">

        {{-- Welcome Banner --}}
        <div class="rounded-2xl bg-gradient-to-r from-brand-500 to-brand-700 p-6 text-white shadow">
            <h2 class="text-2xl font-bold">👋 Welcome back, {{ auth()->user()->name }}!</h2>
            <p class="mt-1 text-brand-100 text-sm">{{ now()->format('l, F j, Y') }} — Let's build great habits today.</p>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <div class="stat-card">
                <span class="text-2xl">📋</span>
                <p class="stat-value">{{ $totalHabits }}</p>
                <p class="stat-label">Total Habits</p>
            </div>

            <div class="stat-card">
                <span class="text-2xl">✅</span>
                <p class="stat-value">{{ $completedToday }}</p>
                <p class="stat-label">Completed Today</p>
            </div>

            <div class="stat-card">
                <span class="text-2xl">📈</span>
                <p class="stat-value">{{ $completionRate }}%</p>
                <p class="stat-label">Today's Rate</p>
            </div>

            <div class="stat-card">
                <span class="text-2xl">🔥</span>
                <p class="stat-value">{{ $totalHabits - $completedToday }}</p>
                <p class="stat-label">Remaining Today</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Today's Habits List --}}
            <div class="lg:col-span-2 card">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Today's Habits</h3>
                    <a href="{{ route('habits.create') }}" class="btn-primary text-xs px-3 py-1.5">
                        + New Habit
                    </a>
                </div>

                @if($habits->isEmpty())
                    <div class="text-center py-10">
                        <p class="text-4xl mb-3">🌱</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">No habits yet.</p>
                        <a href="{{ route('habits.create') }}" class="btn-primary mt-4 inline-flex">
                            Create your first habit
                        </a>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($habits as $habit)
                            @php $done = $habit->logs->isNotEmpty(); @endphp
                            <div class="flex items-center gap-4 p-3 rounded-xl border
                                        {{ $done
                                            ? 'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-700'
                                            : 'bg-gray-50 dark:bg-gray-700/30 border-gray-200 dark:border-gray-600' }}
                                        transition-all">

                                {{-- Completion toggle --}}
                                <form method="POST" action="{{ route('habits.log.toggle', $habit) }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-7 h-7 rounded-full border-2 flex items-center justify-center shrink-0 transition-all
                                                   {{ $done
                                                       ? 'bg-green-500 border-green-500 text-white'
                                                       : 'border-gray-300 dark:border-gray-500 hover:border-brand-400' }}">
                                        @if($done)
                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        @endif
                                    </button>
                                </form>

                                {{-- Icon & Name --}}
                                <div class="flex items-center gap-3 flex-1 min-w-0">
                                    <span class="text-xl">{{ $habit->icon }}</span>
                                    <div class="min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate
                                                  {{ $done ? 'line-through text-gray-400 dark:text-gray-500' : '' }}">
                                            {{ $habit->name }}
                                        </p>
                                        @if($habit->category)
                                            <span class="text-xs text-gray-400">{{ $habit->category->icon }} {{ $habit->category->name }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Status badge --}}
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

    @push('scripts')
    <script>
        const ctx = document.getElementById('weeklyChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($weekLabels),
                datasets: [{
                    label: 'Completions',
                    data: @json($weeklyData),
                    backgroundColor: 'rgba(34,197,94,0.7)',
                    borderColor: 'rgba(34,197,94,1)',
                    borderWidth: 2,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                }
            }
        });
    </script>
    @endpush

</x-app-layout>
