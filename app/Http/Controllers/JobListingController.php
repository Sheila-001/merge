<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;

class JobListingController extends Controller
{
    public function index(Request $request)
    {
        $query = JobListing::query();

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

        // Status filter
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Posted by filter
        if ($request->has('posted_by') && $request->posted_by !== '') {
            $query->where('is_admin_posted', $request->posted_by === 'admin');
        }

        // Expiry filter
        if ($request->has('expiry') && $request->expiry !== '') {
            switch ($request->expiry) {
                case 'active':
                    $query->where('expires_at', '>', now());
                    break;
                case 'expired':
                    $query->where('expires_at', '<', now());
                    break;
                case 'no_expiry':
                    $query->whereNull('expires_at');
                    break;
            }
        }

        $jobs = $query->latest()->paginate(10)->withQueryString();

        return view('admin.jobs.index', compact('jobs'));
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
