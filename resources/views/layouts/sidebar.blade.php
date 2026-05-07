{{-- ── Sidebar Navigation ─────────────────────────────────────────────────── --}}
<aside class="hidden md:flex md:flex-col w-64 bg-white dark:bg-gray-800
              border-r border-gray-200 dark:border-gray-700 shrink-0">

    {{-- Brand --}}
    <div class="flex items-center gap-3 px-6 py-5 border-b border-gray-200 dark:border-gray-700">
        <div class="w-8 h-8 bg-brand-500 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <span class="text-lg font-bold text-gray-900 dark:text-white">HabitTracker</span>
    </div>

    {{-- Navigation Links --}}
    <nav class="flex-1 px-4 py-6 space-y-1">

        {{-- Helper macro: active link detection --}}
        @php
            $links = [
                ['route' => 'dashboard',      'icon' => 'home',     'label' => 'Dashboard'],
                ['route' => 'habits.index',   'icon' => 'check',    'label' => 'My Habits'],
                ['route' => 'categories.index','icon' => 'tag',     'label' => 'Categories'],
                ['route' => 'stats.index',    'icon' => 'chart',    'label' => 'Statistics'],
                ['route' => 'calendar.index', 'icon' => 'calendar', 'label' => 'Calendar'],
            ];
        @endphp

        @foreach ($links as $link)
            @php
                $isActive = request()->routeIs($link['route']) || request()->routeIs($link['route'].'*');
                $base  = 'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 ';
                $style = $isActive
                    ? $base.'bg-brand-50 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300'
                    : $base.'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white';
            @endphp
            <a href="{{ route($link['route']) }}" class="{{ $style }}">
                @include('layouts.icons.'.$link['icon'])
                {{ $link['label'] }}
            </a>
        @endforeach
    </nav>

    {{-- User info at bottom --}}
    @auth
    <div class="px-4 py-4 border-t border-gray-200 dark:border-gray-700">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-brand-100 dark:bg-brand-800 rounded-full
                        flex items-center justify-center shrink-0">
                <span class="text-brand-700 dark:text-brand-200 text-xs font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                    {{ auth()->user()->email }}
                </p>
            </div>
        </div>
    </div>
    @endauth
</aside>
