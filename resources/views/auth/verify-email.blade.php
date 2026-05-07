<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify Email — Habit Tracker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gray-50 dark:bg-gray-900 flex items-center justify-center">
<div class="w-full max-w-md px-6">
    <div class="card text-center">
        <h1 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Verify your email</h1>
        <p class="text-sm text-gray-500 mb-5">Please check your email for a verification link.</p>
        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-sm text-green-600">A new link has been sent to your email.</div>
        @endif
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-primary">Resend Verification Email</button>
        </form>
        <form method="POST" action="{{ route('logout') }}" class="mt-3">
            @csrf
            <button type="submit" class="text-sm text-gray-500 hover:text-red-500">Logout</button>
        </form>
    </div>
</div>
</body>
</html>
