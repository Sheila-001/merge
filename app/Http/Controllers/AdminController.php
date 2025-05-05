<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Event;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            if (!$user->is_admin) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'You do not have admin privileges.',
                ]);
            }

            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function dashboard()
    {
        // Auto-update completed events
        $this->updateCompletedEvents();

        // Get counts for dashboard
        $data = [
            'totalUsers' => User::count(),
            'totalEvents' => Event::where('status', '!=', 'completed')->count(),
            'upcomingEvents' => Event::where('start_date', '>', Carbon::now())
                                   ->where('status', '!=', 'completed')
                                   ->orderBy('start_date', 'asc')
                                   ->take(5)
                                   ->get(),
            'completedEvents' => Event::where('status', 'completed')
                                    ->orderBy('end_date', 'desc')
                                    ->take(5)
                                    ->get(),
            'recentEvents' => Event::orderBy('created_at', 'desc')
                                 ->take(5)
                                 ->get(),
            'activeStudents' => User::where('role', 'student')
                                  ->where('status', 'active')
                                  ->count(),
            'activeEvents' => Event::where('status', '!=', 'completed')
                                 ->where('status', '!=', 'cancelled')
                                 ->count()
        ];

        return view('admin.dashboard', $data);
    }

    private function updateCompletedEvents()
    {
        // Update status of completed events
        Event::where('end_date', '<', Carbon::now())
             ->where('status', '!=', 'completed')
             ->update(['status' => 'completed']);
    }
}