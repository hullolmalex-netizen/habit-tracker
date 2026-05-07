<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Habit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HabitController extends Controller
{
    /** List all active habits */
    public function index()
    {
        $habits = Auth::user()->habits()
            ->with('category')
            ->active()
            ->latest()
            ->get();

        return view('habits.index', compact('habits'));
    }

    /** Show create form */
    public function create()
    {
        $categories = Auth::user()->categories()->orderBy('name')->get();
        return view('habits.create', compact('categories'));
    }

    /** Store new habit */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'category_id' => 'nullable|exists:categories,id',
            'color'       => 'required|string|size:7',
            'icon'        => 'required|string|max:10',
            'frequency'   => 'required|in:daily,weekly',
        ]);

        $data['user_id'] = Auth::id();

        Habit::create($data);

        return redirect()->route('habits.index')
            ->with('success', 'Habit created successfully! 🎉');
    }

    /** Show edit form */
    public function edit(Habit $habit)
    {
        $this->authorize($habit);
        $categories = Auth::user()->categories()->orderBy('name')->get();
        return view('habits.edit', compact('habit', 'categories'));
    }

    /** Update habit */
    public function update(Request $request, Habit $habit)
    {
        $this->authorize($habit);

        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'category_id' => 'nullable|exists:categories,id',
            'color'       => 'required|string|size:7',
            'icon'        => 'required|string|max:10',
            'frequency'   => 'required|in:daily,weekly',
            'is_active'   => 'boolean',
        ]);

        $habit->update($data);

        return redirect()->route('habits.index')
            ->with('success', 'Habit updated successfully!');
    }

    /** Soft delete habit */
    public function destroy(Habit $habit)
    {
        $this->authorize($habit);
        $habit->delete();

        return redirect()->route('habits.index')
            ->with('success', 'Habit deleted.');
    }

    /** Ensure habit belongs to current user */
    private function authorize(Habit $habit): void
    {
        abort_if($habit->user_id !== Auth::id(), 403);
    }
}
