<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalendarCampaign;
use App\Models\CalendarCategory;
use App\Models\Campaign;

class UserCalendarController extends Controller
{
    public function index()
    {
        $statusColors = [
            'scheduled' => '#34D399', // Green
            'pending' => '#FBBF24',   // Yellow
            'done' => '#6366F1',      // Indigo
            'cancelled' => '#EF4444', // Red
        ];

        $calendarCampaigns = CalendarCampaign::with('category')->get()->map(function ($campaign) use ($statusColors) {
            return [
                'id' => $campaign->id,
                'title' => $campaign->title,
                'start' => $campaign->start_date->format('Y-m-d'),
                'end' => $campaign->end_date->format('Y-m-d'),
                'category' => $campaign->category->name,
                'categoryColor' => $campaign->category->color ?? '#D4D4D4', // Use category color
                'status' => $campaign->status,
                'statusColor' => $statusColors[$campaign->status] ?? '#D4D4D4', // Use status color
                'className' => 'bg-[' . ($campaign->category->color ?? '#D4D4D4') . ']',
                'pledged' => $campaign->pledged_amount, // Assuming this field exists
                'notes' => $campaign->notes, // Add notes field
            ];
        });

        $categories = CalendarCategory::orderBy('name')->get();

        $campaigns = Campaign::where('is_archived', false)
                             ->where('status', 'active')
                             ->get();

        return view('donation.usercalendar', compact('calendarCampaigns', 'categories', 'campaigns'));
    }
} 