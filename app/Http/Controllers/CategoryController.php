<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Auth::user()->categories()
            ->withCount('habits')
            ->orderBy('name')
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'color' => 'required|string|size:7',
            'icon'  => 'required|string|max:10',
        ]);

        $data['user_id'] = Auth::id();

        Category::create($data);

        return redirect()->route('categories.index')
            ->with('success', 'Category created! 🎉');
    }

    public function edit(Category $category)
    {
        $this->authorize($category);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $this->authorize($category);

        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'color' => 'required|string|size:7',
            'icon'  => 'required|string|max:10',
        ]);

        $category->update($data);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated!');
    }

    public function destroy(Category $category)
    {
        $this->authorize($category);
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted.');
    }

    private function authorize(Category $category): void
    {
        abort_if($category->user_id !== Auth::id(), 403);
    }
}
