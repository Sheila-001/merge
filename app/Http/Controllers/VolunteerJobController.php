<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class VolunteerJobController extends Controller
{
    public function create()
    {
        return view('volunteers.volunteer_job_post');
    }

    public function store(Request $request)
    {
        try {
            // Log the incoming request data
            \Log::info('Job submission request data:', $request->all());

            // Convert empty strings to null for salary fields
            $data = $request->all();
            $data['salary_min'] = $data['salary_min'] === '' || $data['salary_min'] === null ? null : $data['salary_min'];
            $data['salary_max'] = $data['salary_max'] === '' || $data['salary_max'] === null ? null : $data['salary_max'];

            // Log the processed data
            \Log::info('Processed data:', $data);

            $validator = Validator::make($data, [
                'title' => 'required|string|max:255',
                'role' => 'required|string|max:255',
                'company_name' => 'required|string|max:255',
                'contact_email' => 'required|email|max:255',
                'location' => 'required|string|max:255',
                'description' => 'required|string',
                'qualifications' => 'required|string',
                'contact_person' => 'required|string|max:255',
                'contact_phone' => 'required|string|max:20',
                'employment_type' => 'required|string|max:50',
                'salary_min' => ['nullable', function ($attribute, $value, $fail) {
                    if ($value !== null && !is_numeric($value)) {
                        $fail('The salary minimum must be a number.');
                    }
                }],
                'salary_max' => ['nullable', function ($attribute, $value, $fail) {
                    if ($value !== null && !is_numeric($value)) {
                        $fail('The salary maximum must be a number.');
                    }
                }],
            ]);

            if ($validator->fails()) {
                \Log::error('Validation failed:', $validator->errors()->toArray());
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Convert salary values to float if they exist
            $salaryMin = $data['salary_min'] !== null ? (float) $data['salary_min'] : null;
            $salaryMax = $data['salary_max'] !== null ? (float) $data['salary_max'] : null;

            $job = JobListing::create([
                'title' => $request->title,
                'role' => $request->role,
                'company_name' => $request->company_name,
                'contact_email' => $request->contact_email,
                'location' => $request->location,
                'description' => $request->description,
                'qualifications' => $request->qualifications,
                'contact_person' => $request->contact_person,
                'contact_phone' => $request->contact_phone,
                'employment_type' => $request->employment_type,
                'salary_min' => $salaryMin,
                'salary_max' => $salaryMax,
                'status' => 'pending',
                'is_admin_posted' => false,
                'posted_by' => Auth::id()
            ]);

            return response()->json([
                'message' => 'Job submitted successfully! Waiting for admin approval.',
                'job' => $job
            ], 201);

        } catch (\Exception $e) {
            \Log::error('Job submission error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'message' => 'Error submitting job. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 