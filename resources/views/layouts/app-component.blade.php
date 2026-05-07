@props(['header' => null])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Habit Tracker') }} — {{ $header ?? 'Dashboard' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js" defer></script>
    @stack('styles')
</head>
<body class="h-full bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
<div class="min-h-screen flex">
    @include('layouts.sidebar')
    <div class="flex-1 flex flex-col min-w-0">
        @include('layouts.navbar', ['header' => $header])
        <main class="flex-1 overflow-y-auto p-6">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 rounded-xl text-green-800 dark:text-green-200 text-sm flex items-center gap-2 animate-fade-in">
                    ✅ {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 rounded-xl text-red-800 dark:text-red-200 text-sm flex items-center gap-2 animate-fade-in">
                    ❌ {{ session('error') }}
                </div>
            @endif
            {{ $slot }}
        </main>
    </div>
</div>
@stack('scripts')
</body>
</html>
