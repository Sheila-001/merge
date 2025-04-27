<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalEvents = Event::count();
        $totalVolunteers = User::where('role', 'volunteer')->count();

        return view('admin.dashboard', compact('totalUsers', 'totalEvents', 'totalVolunteers'));
    }
}
