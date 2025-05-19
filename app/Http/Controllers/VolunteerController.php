<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Models\VolunteerHour;
use Carbon\Carbon;

class VolunteerController extends Controller
{
    public function dashboard()
    {
        // Fetch all upcoming events (active and not ended), regardless of who posted them
        $events = \App\Models\Event::where('status', 'active')
            ->where('end_date', '>', now())
            ->orderBy('start_date', 'asc')
            ->get();

        // Fetch all jobs that are approved, regardless of who posted them
        $jobs = \App\Models\JobListing::where('status', 'approved')
            ->where(function($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
            })
            ->get();

        // Calculate hours for the current month for the logged-in volunteer
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $volunteerId = auth()->id();
        $hoursThisMonth = VolunteerHour::where('volunteer_id', $volunteerId)
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->sum('hours');

        // Fetch recent activities (last 5 volunteer hour records)
        $recentActivities = VolunteerHour::with('event')
            ->where('volunteer_id', $volunteerId)
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();

        return view('volunteers.volunteerdashboard', compact('events', 'jobs', 'hoursThisMonth', 'recentActivities'));
    }
} 