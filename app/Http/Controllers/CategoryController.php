<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Full CRUD built in STEP 4
    public function index()   { return view('categories.index'); }
    public function create()  { return view('categories.create'); }
    public function store(Request $request) { /* STEP 4 */ }
    public function edit($id) { return view('categories.edit'); }
    public function update(Request $request, $id) { /* STEP 4 */ }
    public function destroy($id) { /* STEP 4 */ }
}
