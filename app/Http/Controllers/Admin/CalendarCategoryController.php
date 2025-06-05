<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalendarCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CalendarCategoryController extends Controller
{
    public function index()
    {
        $categories = CalendarCategory::orderBy('name')->get();
        return view('admin.calendar.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.calendar.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:7',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        CalendarCategory::create($validated);

        return redirect()
            ->route('admin.calendar-categories.index')
            ->with('success', 'Category has been created successfully.');
    }

    public function edit(CalendarCategory $category)
    {
        return view('admin.calendar.categories.edit', compact('category'));
    }

    public function update(Request $request, CalendarCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:7',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()
            ->route('admin.calendar-categories.index')
            ->with('success', 'Category has been updated successfully.');
    }

    public function destroy(CalendarCategory $category)
    {
        $category->delete();

        return redirect()
            ->route('admin.calendar-categories.index')
            ->with('success', 'Category has been deleted successfully.');
    }
} 