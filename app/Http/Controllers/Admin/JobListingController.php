<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobListingController extends Controller
{
    public function index()
    {
        $jobs = JobListing::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'hours_per_week' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:255',
        ]);

        $validated['status'] = 'approved';
        $validated['is_admin_posted'] = true;

        $job = JobListing::create($validated);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job listing created and approved successfully.');
    }

    public function show(JobListing $job)
    {
        return view('admin.jobs.show', compact('job'));
    }

    public function edit(JobListing $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, JobListing $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'hours_per_week' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:255',
        ]);

        $job->update($validated);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job listing updated successfully.');
    }

    public function destroy(JobListing $job)
    {
        $job->delete();
        return redirect()->route('jobs.index')
            ->with('success', 'Job listing deleted successfully.');
    }

    public function approve(JobListing $job)
    {
        $job->status = 'approved';
        $job->save();
        return redirect()->route('jobs.index')
            ->with('success', 'Job listing approved successfully.');
    }

    public function reject(JobListing $job)
    {
        $job->status = 'rejected';
        $job->save();
        return redirect()->route('jobs.index')
            ->with('success', 'Job listing rejected successfully.');
    }
}
