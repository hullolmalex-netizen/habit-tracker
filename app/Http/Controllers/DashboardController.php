<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the main dashboard.
     * Stats and habits will be injected in later steps.
     */
    public function index()
    {
        return view('dashboard.index');
    }
}
