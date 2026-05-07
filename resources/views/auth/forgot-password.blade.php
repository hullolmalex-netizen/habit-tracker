<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password — Habit Tracker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gray-50 dark:bg-gray-900 flex items-center justify-center">
<div class="w-full max-w-md px-6">
    <div class="card">
        <h1 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Forgot Password</h1>
        <p class="text-sm text-gray-500 mb-5">Enter your email and we'll send a reset link.</p>
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">{{ session('status') }}</div>
        @endif
        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="form-input">
                @error('email')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="btn-primary w-full justify-center">Send Reset Link</button>
        </form>
        <p class="mt-4 text-center text-sm">
            <a href="{{ route('login') }}" class="text-brand-600 hover:underline">Back to login</a>
        </p>
    </div>
</div>
</body>
</html>
