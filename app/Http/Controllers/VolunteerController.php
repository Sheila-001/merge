<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Models\VolunteerHour;
use Carbon\Carbon;
use App\Models\JobListing;
use Illuminate\Support\Facades\Validator;
use App\Models\Volunteer;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class VolunteerController extends Controller
{
    public function dashboard()
    {
        // Fetch all upcoming events (active and not ended), regardless of who posted them
        $events = Event::where('status', 'active')
            ->where('end_date', '>', now())
            ->orderBy('start_date', 'asc')
            ->get();

        // Fetch all jobs that are approved, regardless of who posted them
        $jobs = JobListing::where('status', 'approved')
            ->where(function($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
            })
            ->get();

        // Calculate hours for the current month for the logged-in volunteer
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $volunteerId = auth()->id();
        
        // Calculate current month hours
        $hoursThisMonth = VolunteerHour::where('volunteer_id', $volunteerId)
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->sum('hours');

        // Calculate total hours
        $totalHours = VolunteerHour::where('volunteer_id', $volunteerId)
            ->sum('hours');

        // Fetch recent activities (last 5 volunteer hour records)
        $recentActivities = VolunteerHour::with('event')
            ->where('volunteer_id', $volunteerId)
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();

        return view('volunteers.volunteerdashboard', compact('events', 'jobs', 'hoursThisMonth', 'totalHours', 'recentActivities'));
    }

    public function jobPost()
    {
        // Fetch all approved job listings
        $jobs = JobListing::where('status', 'approved')
            ->where(function($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('volunteers.volunteer_job_post', compact('jobs'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'skills' => 'nullable|array',
            'status' => 'required|in:Active,Pending,Inactive',
            'notes' => 'nullable|string',
            'start_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation error', 'errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            // Create the volunteer as a User with role 'volunteer'
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('volunteer123'), // Set a default password
                'phone' => $request->phone,
                'role' => 'volunteer',
            ]);

            // Process skills array
            $skills = $request->skills;
            if (is_array($skills)) {
                $skills = array_filter($skills); // Remove empty values
            }

            // Create the volunteer record
            $volunteer = Volunteer::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'skills' => !empty($skills) ? json_encode($skills) : null,
                'status' => $request->status,
                'notes' => $request->notes,
                'start_date' => $request->start_date,
            ]);

            DB::commit();

            // Return success response
            return response()->json([
                'message' => 'Volunteer created successfully',
                'volunteer' => $volunteer
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create volunteer:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['message' => 'Failed to create volunteer', 'error' => $e->getMessage()], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Active,Pending,Inactive',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation error', 'errors' => $validator->errors()], 422);
        }

        try {
            // Find the volunteer
            $volunteer = Volunteer::findOrFail($id);
            
            // Update the status
            $volunteer->status = $request->status;
            $volunteer->save();

            return response()->json([
                'message' => 'Volunteer status updated successfully',
                'volunteer' => $volunteer
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update volunteer status', 'error' => $e->getMessage()], 500);
        }
    }

    public function viewEvents()
    {
        return view('volunteers.events');
    }

    public function viewCalendar()
    {
        return view('volunteer.calendar');
    }

    public function addJobOffer(Request $request)
    {
        // Logic for adding job offers
        // Implement validation and job offer creation
        return back()->with('success', 'Job offer added successfully');
    }

    public function storeJobPost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'type' => 'required|string|in:Full-time,Part-time,Contract,Temporary,Internship',
            'employment_type' => 'required|string|in:Paid,Unpaid',
            'hours_per_week' => 'nullable|numeric',
            'category' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'salary_min' => 'nullable|numeric',
            'salary_max' => 'nullable|numeric|greater_than_field:salary_min',
            'contact_person' => 'required|string|max:255',
            'expires_at' => 'nullable|date|after_or_equal:today',
        ]);

        $job = JobListing::create([
            'title' => $request->title,
            'description' => $request->description,
            'company' => Auth::user()->name, // Assuming the logged-in user is the company/poster
            'company_name' => Auth::user()->name, // Assuming the logged-in user is the company/poster
            'location' => $request->location,
            'type' => $request->type,
            'employment_type' => $request->employment_type,
            'hours_per_week' => $request->hours_per_week,
            'status' => 'pending', // Jobs posted by volunteers might need admin approval
            'category' => $request->category,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'requirements' => $request->requirements,
            'benefits' => $request->benefits,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'role' => $request->title, // Using title as a default for role if not provided
            'qualifications' => $request->requirements, // Using requirements as a default for qualifications if not provided
            'contact_person' => $request->contact_person,
            'expires_at' => $request->expires_at,
            'is_admin_posted' => false, // Mark as not admin posted
            'posted_by' => Auth::id(), // Record the user who posted it
        ]);

        // Redirect or return a response
        return redirect()->route('volunteer.dashboard')->with('success', 'Job post submitted successfully for review.');
    }

    /**
     * Remove the specified volunteer from storage.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Volunteer $volunteer)
    {
        try {
            $volunteer->delete();
            return response()->json(['message' => 'Volunteer deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Failed to delete volunteer:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['message' => 'Failed to delete volunteer', 'error' => $e->getMessage()], 500);
        }
    }
}
