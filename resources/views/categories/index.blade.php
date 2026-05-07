@extends('layouts.app-component')
@section('header', 'Categories')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $categories->count() }} category(s)</p>
        <a href="{{ route('categories.create') }}" class="btn-primary">+ New Category</a>
    </div>

    @if($categories->isEmpty())
        <div class="card text-center py-16">
            <p class="text-5xl mb-4">🏷️</p>
            <p class="text-gray-500 dark:text-gray-400 mb-4">No categories yet.</p>
            <a href="{{ route('categories.create') }}" class="btn-primary">Create one</a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($categories as $cat)
            <div class="card hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl shrink-0"
                         style="background: {{ $cat->color }}22">
                        {{ $cat->icon }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $cat->name }}</p>
                        <p class="text-xs text-gray-400">{{ $cat->habits_count }} habit(s)</p>
                    </div>
                    <div class="w-4 h-4 rounded-full shrink-0" style="background:{{ $cat->color }}"></div>
                </div>

                <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700 flex gap-2 justify-end">
                    <a href="{{ route('categories.edit', $cat) }}"
                       class="text-xs px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 transition-colors">
                        Edit
                    </a>
                    <form method="POST" action="{{ route('categories.destroy', $cat) }}"
                          onsubmit="return confirm('Delete this category? Habits will keep their data.')">
                        @csrf @method('DELETE')
                        <button type="submit"
                            class="text-xs px-3 py-1.5 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 hover:bg-red-100 transition-colors">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
