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
        $currentMonth = \Carbon\Carbon::now();
        $lastMonth = \Carbon\Carbon::now()->subMonth();

        // Monetary Donations
        $monetaryTotal = \App\Models\Donation::where('type', 'monetary')->where('status', 'completed')->sum('amount');
        $lastMonthMonetary = \App\Models\Donation::where('type', 'monetary')
            ->where('status', 'completed')
            ->whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->sum('amount');
        $monetaryChange = $lastMonthMonetary > 0 ? (($monetaryTotal - $lastMonthMonetary) / $lastMonthMonetary) * 100 : 0;

        // Non-Monetary Donations
        $nonMonetaryCount = \App\Models\Donation::where('type', 'non-monetary')->where('status', 'completed')->count();
        $lastMonthNonMonetary = \App\Models\Donation::where('type', 'non-monetary')
            ->where('status', 'completed')
            ->whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();
        $nonMonetaryChange = $lastMonthNonMonetary > 0 ? (($nonMonetaryCount - $lastMonthNonMonetary) / $lastMonthNonMonetary) * 100 : 0;

        // Campaign Donations
        $campaignTotal = \App\Models\Donation::whereHas('campaign', function($query) {
                $query->where('status', 'active');
            })
            ->where('status', 'completed')
            ->sum('amount');
        $lastMonthCampaign = \App\Models\Donation::whereHas('campaign', function($query) {
                $query->where('status', 'active');
            })
            ->where('status', 'completed')
            ->whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->sum('amount');
        $campaignChange = $lastMonthCampaign > 0 ? (($campaignTotal - $lastMonthCampaign) / $lastMonthCampaign) * 100 : 0;

        // Donor Count
        $donorCount = \App\Models\Donation::select('donor_email')->distinct()->count();
        $lastMonthDonors = \App\Models\Donation::select('donor_email')->distinct()
            ->whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();
        $donorChange = $lastMonthDonors > 0 ? (($donorCount - $lastMonthDonors) / $lastMonthDonors) * 100 : 0;

        // Recent Donations
        $donations = \App\Models\Donation::latest()->take(10)->get();

        // Pending Drop-offs
        $pendingDropoffs = \App\Models\Donation::where('type', 'non-monetary')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'activeStudents',
            'recentEvents',
            'upcomingEvents',
            'monetaryTotal',
            'monetaryChange',
            'nonMonetaryCount',
            'nonMonetaryChange',
            'campaignTotal',
            'campaignChange',
            'donorCount',
            'donorChange',
            'donations',
            'pendingDropoffs'
        ));
    }
}
