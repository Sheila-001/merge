<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;

class JobListingController extends Controller
{
    public function index()
    {
        $jobs = JobListing::where('status', 'approved')->latest()->paginate(6);
        return view('jobs.listings', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|string|max:255',
            'requirements' => 'nullable|string',
        ]);
        $validated['status'] = 'pending';
        \App\Models\JobListing::create($validated);
        return redirect()->route('jobs.index')->with('success', 'Job listing submitted and is pending admin approval.');
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
