@extends('layouts.app-component')
@section('header', 'My Habits')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <p class="text-gray-500 dark:text-gray-400 text-sm">{{ $habits->count() }} active habit(s)</p>
        <a href="{{ route('habits.create') }}" class="btn-primary">+ New Habit</a>
    </div>

    @if($habits->isEmpty())
        <div class="card text-center py-16">
            <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            <p class="text-gray-500 dark:text-gray-400 mb-4">You have no habits yet.</p>
            <a href="{{ route('habits.create') }}" class="btn-primary">Create your first habit</a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($habits as $habit)
            <div class="card hover:shadow-md transition-shadow">
                <div class="h-1.5 rounded-full mb-4" style="background:{{ $habit->color }}"></div>
                <div class="flex items-start justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0" style="background:{{ $habit->color }}22">
                            <svg class="w-5 h-5" style="color:{{ $habit->color }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $habit->name }}</p>
                            @if($habit->category)
                                <span class="text-xs text-gray-400">{{ $habit->category->name }}</span>
                            @endif
                        </div>
                    </div>
                    <span class="text-xs px-2 py-1 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 shrink-0 capitalize">{{ $habit->frequency }}</span>
                </div>
                @if($habit->description)
                    <p class="mt-3 text-sm text-gray-500 dark:text-gray-400 line-clamp-2">{{ $habit->description }}</p>
                @endif
                <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <span class="text-xs text-gray-400">{{ $habit->totalCompletions() }} completions</span>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('habits.edit', $habit) }}" class="text-xs px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 transition-colors">Edit</a>
                        <form method="POST" action="{{ route('habits.destroy', $habit) }}" onsubmit="return confirm('Delete this habit?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs px-3 py-1.5 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 hover:bg-red-100 transition-colors">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
