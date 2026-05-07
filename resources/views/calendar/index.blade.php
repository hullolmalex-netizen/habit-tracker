@extends('layouts.app-component')
@section('header', 'Calendar')

@section('content')
<div class="space-y-6">

    {{-- Month navigation --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('calendar.show', [$prev->year, $prev->month]) }}"
           class="btn-secondary">&larr; {{ $prev->format('M Y') }}</a>

        <h2 class="text-lg font-bold text-gray-900 dark:text-white">{{ $date->format('F Y') }}</h2>

        <a href="{{ route('calendar.show', [$next->year, $next->month]) }}"
           class="btn-secondary">{{ $next->format('M Y') }} &rarr;</a>
    </div>

    {{-- Calendar grid --}}
    <div class="card overflow-hidden p-0">

        {{-- Day headers --}}
        <div class="grid grid-cols-7 border-b border-gray-100 dark:border-gray-700">
            @foreach(['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $d)
                <div class="py-3 text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">
                    {{ $d }}
                </div>
            @endforeach
        </div>

        {{-- Weeks --}}
        @foreach($weeks as $week)
        <div class="grid grid-cols-7 border-b border-gray-50 dark:border-gray-800 last:border-0">
            @foreach($week as $cell)
            @php
                $bg = '';
                if ($cell['isCurrentMonth']) {
                    if ($cell['rate'] >= 80)      $bg = 'bg-green-500';
                    elseif ($cell['rate'] >= 50)  $bg = 'bg-green-300';
                    elseif ($cell['rate'] >= 20)  $bg = 'bg-green-100 dark:bg-green-900/30';
                    elseif ($cell['completed'] > 0) $bg = 'bg-green-50 dark:bg-green-900/10';
                }
            @endphp
            <div class="min-h-[72px] p-2 border-r border-gray-50 dark:border-gray-800 last:border-0
                        {{ ! $cell['isCurrentMonth'] ? 'opacity-30' : '' }}
                        {{ $cell['isToday'] ? 'ring-2 ring-inset ring-brand-400' : '' }}">
                <div class="flex items-start justify-between">
                    <span class="text-xs font-medium
                                {{ $cell['isToday'] ? 'text-brand-600 dark:text-brand-400 font-bold' : 'text-gray-600 dark:text-gray-400' }}">
                        {{ $cell['day'] }}
                    </span>
                    @if($cell['completed'] > 0 && $cell['isCurrentMonth'])
                        <span class="inline-flex items-center justify-center w-5 h-5 rounded-full text-white text-xs font-bold {{ $bg }}">
                            {{ $cell['completed'] }}
                        </span>
                    @endif
                </div>
                @if($cell['rate'] > 0 && $cell['isCurrentMonth'])
                    <div class="mt-2 w-full bg-gray-100 dark:bg-gray-700 rounded-full h-1">
                        <div class="h-1 rounded-full bg-green-500" style="width:{{ $cell['rate'] }}%"></div>
                    </div>
                @endif
            </div>
            @endforeach
        </div>
        @endforeach
    </div>

    {{-- Legend --}}
    <div class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400">
        <span class="font-medium">Completion:</span>
        <span class="flex items-center gap-1"><span class="w-3 h-3 rounded bg-green-100"></span> 1–19%</span>
        <span class="flex items-center gap-1"><span class="w-3 h-3 rounded bg-green-300"></span> 50–79%</span>
        <span class="flex items-center gap-1"><span class="w-3 h-3 rounded bg-green-500"></span> 80–100%</span>
    </div>
</div>
@endsection
