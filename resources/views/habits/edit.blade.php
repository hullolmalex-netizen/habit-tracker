@extends('layouts.app-component')
@section('header', 'Edit Habit')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="card">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Edit Habit</h2>

        <form method="POST" action="{{ route('habits.update', $habit) }}" class="space-y-5">
            @csrf @method('PUT')

            {{-- Name --}}
            <div>
                <label class="form-label">Habit Name *</label>
                <input type="text" name="name" value="{{ old('name', $habit->name) }}"
                       class="form-input" required>
                @error('name')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            {{-- Description --}}
            <div>
                <label class="form-label">Description (optional)</label>
                <textarea name="description" rows="2" class="form-input resize-none">{{ old('description', $habit->description) }}</textarea>
                @error('description')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            {{-- Category --}}
            <div>
                <label class="form-label">Category</label>
                <select name="category_id" class="form-input">
                    <option value="">-- No category --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $habit->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->icon }} {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Icon & Color --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Icon (emoji)</label>
                    <input type="text" name="icon" value="{{ old('icon', $habit->icon) }}"
                           class="form-input" maxlength="10">
                    @error('icon')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="form-label">Color</label>
                    <div class="flex items-center gap-2">
                        <input type="color" name="color" value="{{ old('color', $habit->color) }}"
                               class="h-10 w-16 rounded-lg border border-gray-300 dark:border-gray-600 cursor-pointer">
                        <span class="text-sm text-gray-400">Pick a color</span>
                    </div>
                </div>
            </div>

            {{-- Frequency --}}
            <div>
                <label class="form-label">Frequency</label>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="frequency" value="daily"
                               {{ old('frequency', $habit->frequency) === 'daily' ? 'checked' : '' }}
                               class="text-brand-600">
                        <span class="text-sm text-gray-700 dark:text-gray-300">📅 Daily</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="frequency" value="weekly"
                               {{ old('frequency', $habit->frequency) === 'weekly' ? 'checked' : '' }}
                               class="text-brand-600">
                        <span class="text-sm text-gray-700 dark:text-gray-300">🗓️ Weekly</span>
                    </label>
                </div>
            </div>

            {{-- Active toggle --}}
            <div class="flex items-center gap-3">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" id="is_active"
                       {{ old('is_active', $habit->is_active) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-brand-600">
                <label for="is_active" class="text-sm text-gray-700 dark:text-gray-300">Active habit</label>
            </div>

            {{-- Buttons --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="btn-primary">Save Changes</button>
                <a href="{{ route('habits.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
