<?php
namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = JobListing::all();
        return view('jobs.index', compact('jobs'));
    }

    public function store(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'role' => 'required|string|max:255',
                'company' => 'required|string|max:255',
                'contact' => 'required|string|max:255',
                'apply' => 'required|string|max:255',
                'location' => 'required|string|max:255',
            ]);

            // Create the job listing
            $job = JobListing::create([
                'role' => $validated['role'],
                'company' => $validated['company'],
                'contact' => $validated['contact'],
                'apply' => $validated['apply'],
                'location' => $validated['location'],
                'status' => 'pending', // Set initial status as pending for admin approval
                'is_admin' => false
            ]);

            return response()->json([
                'message' => 'Job submitted successfully! Waiting for admin approval.',
                'job' => $job
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error submitting job.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}