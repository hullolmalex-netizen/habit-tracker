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
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('habits', HabitController::class);

    Route::post('/habits/{habit}/log', [HabitLogController::class, 'toggle'])
        ->name('habits.log.toggle');

    Route::resource('categories', CategoryController::class);

    Route::get('/stats', [StatController::class, 'index'])
        ->name('stats.index');

    Route::get('/calendar', [CalendarController::class, 'index'])
        ->name('calendar.index');
    Route::get('/calendar/{year}/{month}', [CalendarController::class, 'show'])
        ->name('calendar.show');
});
