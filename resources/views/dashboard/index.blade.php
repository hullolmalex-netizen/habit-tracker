<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <div class="space-y-6 animate-slide-up">

        {{-- Welcome banner --}}
        <div class="card bg-gradient-to-r from-brand-500 to-brand-700 text-white border-0">
            <h2 class="text-2xl font-bold">
                👋 Welcome back, {{ auth()->user()->name }}!
            </h2>
            <p class="mt-1 text-brand-100">
                {{ now()->format('l, F j, Y') }} — Let's build great habits today.
            </p>
        </div>

        {{-- Stat Cards placeholder (filled in STEP 5 & 6) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <div class="stat-card">
                <span class="text-3xl">📋</span>
                <p class="stat-value">0</p>
                <p class="stat-label">Total Habits</p>
            </div>

            <div class="stat-card">
                <span class="text-3xl">✅</span>
                <p class="stat-value">0</p>
                <p class="stat-label">Completed Today</p>
            </div>

            <div class="stat-card">
                <span class="text-3xl">🔥</span>
                <p class="stat-value">0</p>
                <p class="stat-label">Best Streak</p>
            </div>

            <div class="stat-card">
                <span class="text-3xl">📈</span>
                <p class="stat-value">0%</p>
                <p class="stat-label">Weekly Completion</p>
            </div>
        </div>

        {{-- Habits list placeholder --}}
        <div class="card">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Today's Habits</h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm">
                No habits yet. <a href="{{ route('habits.create') }}"
                   class="text-brand-600 hover:underline font-medium">Create your first habit →</a>
            </p>
        </div>

    </div>
</x-app-layout>
