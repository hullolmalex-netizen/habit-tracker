<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HabitController extends Controller
{
    // Full CRUD will be built in STEP 4
    public function index()   { return view('habits.index'); }
    public function create()  { return view('habits.create'); }
    public function store(Request $request) { /* STEP 4 */ }
    public function show($id) { /* STEP 4 */ }
    public function edit($id) { return view('habits.edit'); }
    public function update(Request $request, $id) { /* STEP 4 */ }
    public function destroy($id) { /* STEP 4 */ }
}
