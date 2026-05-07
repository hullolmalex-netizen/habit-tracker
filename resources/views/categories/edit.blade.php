@extends('layouts.app-component')
@section('header', 'Edit Category')

@section('content')
<div class="max-w-md mx-auto">
    <div class="card">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Edit Category</h2>
        <form method="POST" action="{{ route('categories.update', $category) }}" class="space-y-5">
            @csrf @method('PUT')
            <div>
                <label class="form-label">Name *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-input" required>
                @error('name')<p class="form-error">{{ $message }}</p>@enderror
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Icon (emoji)</label>
                    <input type="text" name="icon" value="{{ old('icon', $category->icon) }}" class="form-input" maxlength="10">
                </div>
                <div>
                    <label class="form-label">Color</label>
                    <input type="color" name="color" value="{{ old('color', $category->color) }}"
                           class="h-10 w-full rounded-xl border border-gray-300 dark:border-gray-600 cursor-pointer">
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">Save Changes</button>
                <a href="{{ route('categories.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
