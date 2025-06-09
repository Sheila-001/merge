<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalendarCampaign;
use App\Models\CalendarCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class CalendarCampaignController extends Controller
{
    public function create()
    {
        $statuses = CalendarCampaign::STATUSES;
        $categories = CalendarCategory::orderBy('name')->pluck('name', 'id');
        
        return view('admin.calendar.calendar_campaign', compact('statuses', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:calendar_categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        CalendarCampaign::create($validated);

        return redirect()
            ->route('admin.calendar.index')
            ->with('success', 'Campaign has been scheduled successfully.');
    }
} 