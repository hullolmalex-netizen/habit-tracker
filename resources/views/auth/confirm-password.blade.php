<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm Password — Habit Tracker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gray-50 dark:bg-gray-900 flex items-center justify-center">
<div class="w-full max-w-md px-6">
    <div class="card">
        <h1 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Confirm Password</h1>
        <p class="text-sm text-gray-500 mb-5">Please confirm your password to continue.</p>
        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                <input type="password" name="password" required class="form-input">
                @error('password')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="btn-primary w-full justify-center">Confirm</button>
        </form>
    </div>
</div>
</body>
</html>
