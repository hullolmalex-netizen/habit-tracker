<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\HabitLogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\CalendarController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('dashboard');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (provided by Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Protected Routes (require login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Habits CRUD
    Route::resource('habits', HabitController::class);

    // Mark habit as done / undo for today
    Route::post('/habits/{habit}/log', [HabitLogController::class, 'toggle'])
        ->name('habits.log.toggle');

    // Categories CRUD
    Route::resource('categories', CategoryController::class);

    // Statistics
    Route::get('/stats', [StatController::class, 'index'])
        ->name('stats.index');

    // Calendar
    Route::get('/calendar', [CalendarController::class, 'index'])
        ->name('calendar.index');
    Route::get('/calendar/{year}/{month}', [CalendarController::class, 'show'])
        ->name('calendar.show');
});
