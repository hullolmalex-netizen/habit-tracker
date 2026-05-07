<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    // Built in STEP 7
    public function index()
    {
        return redirect()->route('calendar.show', [
            now()->year,
            now()->month,
        ]);
    }

    public function show($year, $month)
    {
        return view('calendar.show', compact('year', 'month'));
    }
}
