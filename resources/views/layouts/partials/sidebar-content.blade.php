{{-- Brand --}}
<div class="flex items-center gap-3 px-5 py-5 border-b border-gray-200 dark:border-gray-700">
    <div class="w-9 h-9 bg-brand-500 rounded-xl flex items-center justify-center shrink-0">
        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
    </div>
    <span class="text-lg font-bold text-gray-900 dark:text-white tracking-tight">HabitTracker</span>
</div>

{{-- Nav links --}}
<nav class="flex-1 px-3 py-5 space-y-1">
    @php
        $navItems = [
            ['route' => 'dashboard',        'label' => 'Dashboard',   'icon' => 'home'],
            ['route' => 'habits.index',     'label' => 'My Habits',   'icon' => 'check-circle'],
            ['route' => 'categories.index', 'label' => 'Categories',  'icon' => 'tag'],
            ['route' => 'stats.index',      'label' => 'Statistics',  'icon' => 'chart-bar'],
            ['route' => 'calendar.index',   'label' => 'Calendar',    'icon' => 'calendar'],
        ];
    @endphp

    @foreach($navItems as $item)
        @php
            $active = request()->routeIs($item['route']) || request()->routeIs($item['route'].'*');
            $cls = $active
                ? 'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold bg-brand-50 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300'
                : 'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white transition-all';
        @endphp
        <a href="{{ route($item['route']) }}" class="{{ $cls }}">
            @include('layouts.partials.icon', ['name' => $item['icon'], 'active' => $active])
            {{ $item['label'] }}
        </a>
    @endforeach
</nav>

{{-- User panel --}}
@auth
<div class="px-3 pb-4 border-t border-gray-200 dark:border-gray-700 pt-4">
    <div class="flex items-center gap-3 px-3 py-2 rounded-xl bg-gray-50 dark:bg-gray-700/50">
        <div class="w-9 h-9 rounded-xl bg-brand-100 dark:bg-brand-800 flex items-center justify-center shrink-0">
            <span class="text-brand-700 dark:text-brand-200 text-sm font-bold">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </span>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</p>
            <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email }}</p>
        </div>
    </div>
</div>
@endauth
