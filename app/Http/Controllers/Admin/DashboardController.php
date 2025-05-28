<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $activeStudents = User::where('role', 'student')->where('status', 'active')->count();

        // Get recent events (last 5 completed or ongoing events)
        $recentEvents = Event::where(function($query) {
                $query->where('end_date', '<=', Carbon::now())
                    ->orWhere(function($q) {
                        $q->where('start_date', '<=', Carbon::now())
                          ->where('end_date', '>=', Carbon::now());
                    });
            })
            ->orderBy('end_date', 'desc')
            ->take(5)
            ->get();

        // Get upcoming events (next 5 events that haven't started)
        $upcomingEvents = Event::where('start_date', '>', Carbon::now())
            ->orderBy('start_date', 'asc')
            ->take(5)
            ->get();

        // Add donation stats for dashboard cards
        $monetaryDonations = \App\Models\Donation::where('type', 'monetary')->count();
        $nonMonetaryItems = \App\Models\Donation::where('type', 'non-monetary')->count();
        $totalDonors = \App\Models\Donation::distinct('donor_email')->count('donor_email');

        // Get recent donations with pagination
        $recentDonations = \App\Models\Donation::latest()->paginate(10);

        // Get pending drop-offs
        $pendingDropoffs = \App\Models\Donation::where('type', 'non-monetary')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'activeStudents',
            'recentEvents',
            'upcomingEvents',
            'monetaryDonations',
            'nonMonetaryItems',
            'totalDonors',
            'recentDonations',
            'pendingDropoffs'
        ));
    }
}
