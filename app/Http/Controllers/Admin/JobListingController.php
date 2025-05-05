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
            'company_name' => 'required|string|max:255',
            'description' => 'required|string',
            'role' => 'required|string|max:255',
            'qualifications' => 'required|string',
            'employment_type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gt:salary_min',
            'contact_person' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'expires_at' => 'nullable|date|after:today',
        ]);

        $job = new JobListing($validated);
        $job->status = 'approved';
        $job->is_admin_posted = true;
        $job->posted_by = Auth::id();
        $job->save();

        return redirect()->route('jobs.index')
            ->with('success', 'Job listing created successfully.');
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
            'company_name' => 'required|string|max:255',
            'description' => 'required|string',
            'role' => 'required|string|max:255',
            'qualifications' => 'required|string',
            'employment_type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gt:salary_min',
            'contact_person' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'expires_at' => 'nullable|date',
        ]);

        $job->update($validated);

        return redirect()->route('jobs.index')
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
