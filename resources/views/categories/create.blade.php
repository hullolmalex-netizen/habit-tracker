@extends('layouts.app-component')
@section('header', 'New Category')

@section('content')
<div class="max-w-md mx-auto">
    <div class="card">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Create Category</h2>
        <form method="POST" action="{{ route('categories.store') }}" class="space-y-5">
            @csrf
            <div>
                <label class="form-label">Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-input" required placeholder="e.g. Health">
                @error('name')<p class="form-error">{{ $message }}</p>@enderror
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Icon (emoji)</label>
                    <input type="text" name="icon" value="{{ old('icon', '⭐') }}" class="form-input" maxlength="10">
                    @error('icon')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="form-label">Color</label>
                    <input type="color" name="color" value="{{ old('color', '#22c55e') }}"
                           class="h-10 w-full rounded-xl border border-gray-300 dark:border-gray-600 cursor-pointer">
                    @error('color')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">Create</button>
                <a href="{{ route('categories.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
