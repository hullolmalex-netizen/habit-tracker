<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatController extends Controller
{
    // Built in STEP 6
    public function index()
    {
        return view('stats.index');
    }
}
