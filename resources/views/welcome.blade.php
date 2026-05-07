<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HabitTracker &mdash; Build Better Habits</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gray-50 dark:bg-gray-900">

<div class="min-h-screen flex flex-col items-center justify-center px-6">

    {{-- Logo --}}
    <div class="w-16 h-16 bg-brand-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
        <svg class="w-9 h-9 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
    </div>

    <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-3 text-center">
        Build Better Habits
    </h1>
    <p class="text-gray-500 dark:text-gray-400 text-lg text-center max-w-md mb-10">
        Track your daily habits, visualize your streaks, and become the best version of yourself.
    </p>

    {{-- Feature pills --}}
    <div class="flex flex-wrap justify-center gap-3 mb-10">
        @foreach(['📊 Statistics', '📅 Calendar View', '🔥 Streaks', '🌙 Dark Mode', '📱 Mobile Ready'] as $f)
            <span class="px-4 py-2 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                         text-sm text-gray-700 dark:text-gray-300 shadow-sm">{{ $f }}</span>
        @endforeach
    </div>

    {{-- CTA buttons --}}
    <div class="flex flex-col sm:flex-row gap-3">
        @auth
            <a href="{{ route('dashboard') }}" class="btn-primary px-8 py-3 text-base">Go to Dashboard →</a>
        @else
            <a href="{{ route('register') }}" class="btn-primary px-8 py-3 text-base">Get Started Free</a>
            <a href="{{ route('login') }}" class="btn-secondary px-8 py-3 text-base">Sign In</a>
        @endauth
    </div>
</div>

</body>
</html>
