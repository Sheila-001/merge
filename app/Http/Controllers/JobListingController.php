<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;

class JobListingController extends Controller
{
    public function index(Request $request)
    {
        $query = JobListing::query();

        // Always filter to only approved jobs for public/volunteer listing
        $query->where('status', 'approved');

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Company filter
        if ($request->has('company') && $request->company !== '') {
            $query->where('company_name', $request->company);
        }

        // Location filter
        if ($request->has('location') && $request->location !== '') {
            $query->where('location', $request->location);
        }

        // For volunteer/public view, use the correct view and pass companies/locations for filters
        $companies = JobListing::where('status', 'approved')->distinct()->pluck('company_name');
        $locations = JobListing::where('status', 'approved')->distinct()->pluck('location');

        $jobs = $query->latest()->paginate(10)->withQueryString();

        return view('jobs.listings', compact('jobs', 'companies', 'locations'));
    }

    public function show(JobListing $job)
    {
        if ($job->status !== 'approved') {
            abort(404);
        }

        return view('jobs.show', compact('job'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'description' => 'required|string',
            'qualifications' => 'required|string',
            'employment_type' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gt:salary_min',
            'contact_person' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'expires_at' => 'nullable|date',
        ]);

        $validated['status'] = 'pending';
        $validated['is_admin_posted'] = false;
        
        JobListing::create($validated);
        
        return redirect()->route('volunteer.dashboard')
            ->with('success', 'Job listing submitted and is pending admin approval.');
    }

    public function adminIndex()
    {
        $jobs = JobListing::latest()->get();
        return view('jobs.admin_index', compact('jobs'));
    }

    public function edit($id)
    {
        $job = JobListing::findOrFail($id);
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $job = JobListing::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|string|max:255',
            'requirements' => 'nullable|string',
        ]);
        $job->update($validated);
        return redirect()->route('jobs.admin.index')->with('success', 'Job updated successfully!');
    }

    public function destroy($id)
    {
        $job = JobListing::findOrFail($id);
        $job->delete();
        return redirect()->route('jobs.admin.index')->with('success', 'Job deleted successfully!');
    }

    public function approve($id)
    {
        $job = JobListing::findOrFail($id);
        $job->status = 'approved';
        $job->save();
        return redirect()->route('jobs.admin.index')->with('success', 'Job approved successfully!');
    }

    public function reject($id)
    {
        $job = JobListing::findOrFail($id);
        $job->status = 'rejected';
        $job->save();
        return redirect()->route('jobs.admin.index')->with('success', 'Job rejected successfully!');
    }
}
