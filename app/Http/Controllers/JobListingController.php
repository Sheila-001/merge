<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;

class JobListingController extends Controller
{
    public function index(Request $request)
    {
        // Show all jobs for now (for testing)
        $jobs = \App\Models\JobListing::latest()->paginate(10);
        return view('jobs.index', compact('jobs'));
    }

    public function show(JobListing $job)
    {
        if ($job->status !== 'approved' || 
            ($job->expires_at && $job->expires_at < now())) {
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
        $validated['status'] = 'approved';
        $validated['is_admin_posted'] = true;
        $validated['posted_by'] = auth()->id();

        \App\Models\JobListing::create($validated);

        return redirect()->route('jobs.index')->with('success', 'Job listing created successfully.');
    }

    public function adminIndex()
    {
        $jobs = \App\Models\JobListing::latest()->get();
        return view('jobs.admin_index', compact('jobs'));
    }

    public function edit($id)
    {
        $job = \App\Models\JobListing::findOrFail($id);
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $job = \App\Models\JobListing::findOrFail($id);
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
        $job = \App\Models\JobListing::findOrFail($id);
        $job->delete();
        return redirect()->route('jobs.admin.index')->with('success', 'Job deleted successfully!');
    }

    public function approve($id)
    {
        $job = \App\Models\JobListing::findOrFail($id);
        $job->status = 'approved';
        $job->save();
        return redirect()->route('jobs.admin.index')->with('success', 'Job approved successfully!');
    }

    public function reject($id)
    {
        $job = \App\Models\JobListing::findOrFail($id);
        $job->status = 'rejected';
        $job->save();
        return redirect()->route('jobs.admin.index')->with('success', 'Job rejected successfully!');
    }
}
