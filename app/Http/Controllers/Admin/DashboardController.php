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

        return view('admin.dashboard', compact(
            'totalUsers',
            'activeStudents',
            'recentEvents',
            'upcomingEvents'
        ));
    }
}
