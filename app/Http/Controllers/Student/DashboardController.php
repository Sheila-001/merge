<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\JobListing;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the student dashboard with events and job listings.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get upcoming events (not started yet)
        $upcomingEvents = Event::where('start_date', '>', Carbon::now())
            ->where('status', '!=', 'cancelled')
            ->orderBy('start_date', 'asc')
            ->take(5)
            ->get();

        // Get admin-created events
        $adminEvents = Event::adminPosted()
            ->where('start_date', '>', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get active job listings
        $latestJobs = JobListing::active()
            ->latest()
            ->take(5)
            ->get();

        // Get event count
        $eventCount = Event::where('start_date', '>', Carbon::now())
            ->where('status', '!=', 'cancelled')
            ->count();

        // Get active job count
        $jobCount = JobListing::active()->count();

        // Get unread notifications
        $notifications = auth()->user()->unreadNotifications()
            ->where('type', 'App\Notifications\NewEventNotification')
            ->get();

        return view('student.dashboard', compact(
            'upcomingEvents',
            'adminEvents',
            'latestJobs',
            'eventCount',
            'jobCount',
            'notifications'
        ));
    }
} 