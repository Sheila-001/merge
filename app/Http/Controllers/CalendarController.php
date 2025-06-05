<?php

namespace App\Http\Controllers;

use App\Models\CalendarCampaign;
use App\Models\CalendarCategory;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $campaigns = CalendarCampaign::with('category')
            ->get()
            ->map(function ($campaign) {
                return [
                    'id' => $campaign->id,
                    'title' => $campaign->title,
                    'start' => $campaign->start_date->format('Y-m-d'),
                    'end' => $campaign->end_date->format('Y-m-d'),
                    'category' => $campaign->category->name,
                    'categoryColor' => $campaign->category->color,
                    'status' => $campaign->status,
                    'notes' => $campaign->notes,
                    'pledged' => $campaign->pledged_amount ? '₱' . number_format($campaign->pledged_amount, 2) : null,
                    'goal' => $campaign->goal_amount ? '₱' . number_format($campaign->goal_amount, 2) : null,
                    'percentage' => $campaign->goal_amount ? round(($campaign->pledged_amount / $campaign->goal_amount) * 100) : 0,
                ];
            });

        $categories = CalendarCategory::orderBy('name')->get();
        
        return view('donation.usercalendar', compact('campaigns', 'categories'));
    }
} 