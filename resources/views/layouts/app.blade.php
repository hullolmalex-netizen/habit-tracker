<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Habit Tracker') }} — {{ $title ?? 'Dashboard' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Tailwind + App CSS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js" defer></script>

    @stack('styles')
</head>

<body class="h-full bg-gray-50 dark:bg-gray-900 transition-colors duration-300">

    <div class="min-h-screen flex">

        {{-- ── Sidebar ──────────────────────────────────────────────────── --}}
        @include('layouts.sidebar')

        {{-- ── Main Content ─────────────────────────────────────────────── --}}
        <div class="flex-1 flex flex-col min-w-0">

            {{-- Top Navigation Bar --}}
            @include('layouts.navbar')

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto p-6">

                {{-- Flash messages --}}
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200
                                dark:border-green-700 rounded-xl text-green-800 dark:text-green-200
                                text-sm flex items-center gap-2 animate-fade-in">
                        <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200
                                dark:border-red-700 rounded-xl text-red-800 dark:text-red-200
                                text-sm flex items-center gap-2 animate-fade-in">
                        <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Slot for page content --}}
                {{ $slot }}

            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
