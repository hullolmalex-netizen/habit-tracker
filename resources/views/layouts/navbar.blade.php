<header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-10">
    <div class="flex items-center justify-between px-6 h-16">

        {{-- Page title --}}
        <h1 class="text-lg font-semibold text-gray-900 dark:text-white">
            {{ $header ?? 'Dashboard' }}
        </h1>

        <div class="flex items-center gap-3">

            {{-- Date --}}
            <span class="hidden sm:block text-sm text-gray-400 dark:text-gray-500">
                {{ now()->format('l, F j') }}
            </span>

            {{-- Dark mode toggle --}}
            <button id="theme-toggle"
                    class="p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                    aria-label="Toggle dark mode">
                <svg class="w-5 h-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <svg class="w-5 h-5 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
            </button>

            {{-- Logout --}}
            @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="text-sm px-3 py-1.5 rounded-lg text-gray-600 dark:text-gray-300
                               hover:bg-red-50 hover:text-red-600 dark:hover:bg-red-900/20 dark:hover:text-red-400
                               transition-colors border border-gray-200 dark:border-gray-600">
                    Logout
                </button>
            </form>
            @endauth
        </div>
    </div>
</header>
