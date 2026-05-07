@extends('layouts.app-component')
@section('header', 'New Habit')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="card">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Create a New Habit</h2>

        <form method="POST" action="{{ route('habits.store') }}" class="space-y-5">
            @csrf

            {{-- Name --}}
            <div>
                <label class="form-label">Habit Name *</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="form-input" placeholder="e.g. Drink 8 glasses of water" required>
                @error('name')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            {{-- Description --}}
            <div>
                <label class="form-label">Description (optional)</label>
                <textarea name="description" rows="2" class="form-input resize-none"
                          placeholder="Why is this habit important to you?">{{ old('description') }}</textarea>
                @error('description')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            {{-- Category --}}
            <div>
                <label class="form-label">Category</label>
                <select name="category_id" class="form-input">
                    <option value="">-- No category --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->icon }} {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            {{-- Icon & Color row --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Icon (emoji)</label>
                    <input type="text" name="icon" value="{{ old('icon', '✅') }}"
                           class="form-input" maxlength="10" placeholder="✅">
                    @error('icon')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="form-label">Color</label>
                    <div class="flex items-center gap-2">
                        <input type="color" name="color" value="{{ old('color', '#22c55e') }}"
                               class="h-10 w-16 rounded-lg border border-gray-300 dark:border-gray-600 cursor-pointer">
                        <span class="text-sm text-gray-400">Pick a color</span>
                    </div>
                    @error('color')<p class="form-error">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Frequency --}}
            <div>
                <label class="form-label">Frequency</label>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="frequency" value="daily"
                               {{ old('frequency', 'daily') === 'daily' ? 'checked' : '' }}
                               class="text-brand-600">
                        <span class="text-sm text-gray-700 dark:text-gray-300">📅 Daily</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="frequency" value="weekly"
                               {{ old('frequency') === 'weekly' ? 'checked' : '' }}
                               class="text-brand-600">
                        <span class="text-sm text-gray-700 dark:text-gray-300">🗓️ Weekly</span>
                    </label>
                </div>
                @error('frequency')<p class="form-error">{{ $message }}</p>@enderror
            </div>

            {{-- Buttons --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="btn-primary">Create Habit</button>
                <a href="{{ route('habits.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
