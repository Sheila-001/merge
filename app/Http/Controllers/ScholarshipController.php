<?php

namespace App\Http\Controllers;

use App\Models\ScholarshipApplication;
use App\Models\User; // Import User model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail; // If sending email
use Illuminate\Support\Str; // For random strings
use Illuminate\Support\Facades\Hash; // For hashing password
use App\Mail\ApplicationReceived; // Make sure Mailable is imported
use Illuminate\Support\Facades\Log; // For logging errors

class ScholarshipController extends Controller
{
    /**
     * Store a newly created scholarship application in storage.
     * Also creates a user record if one doesn't exist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function apply(Request $request)
    {
        // 1. Validate the incoming request data
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|string|max:20',
            'scholarship_type' => 'required|string|in:home_based,in_house', // Adjust types if needed
            'transcript' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // Max 5MB example
        ]);

        // 2. Handle File Upload
        $transcriptPath = null;
        if ($request->hasFile('transcript')) {
            // Store in 'public/transcripts' folder. Ensure storage link exists (`php artisan storage:link`)
            $transcriptPath = $request->file('transcript')->store('transcripts', 'public');
        }

        // 3. Generate Unique Tracking Code
        $trackingCode = Str::upper(Str::random(8));
        // Ensure uniqueness (rare collision chance, but good practice)
        while (ScholarshipApplication::where('tracking_code', $trackingCode)->exists()) {
            $trackingCode = Str::upper(Str::random(8));
        }

        // 4. Save the Scholarship Application
        $application = ScholarshipApplication::create([
            'full_name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'scholarship_type' => $validatedData['scholarship_type'],
            'transcript_path' => $transcriptPath,
            'tracking_code' => $trackingCode,
            'status' => 'pending', // Default status
        ]);

        // 5. Create User Record if not exists
        $existingUser = User::where('email', $validatedData['email'])->first();

        if (!$existingUser) {
            User::create([
                'name' => $validatedData['full_name'],
                'email' => $validatedData['email'],
                'password' => Hash::make(Str::random(10)), // Generate random password
                'role' => 'student', // Set role to student
                // Add any other required fields from your users table with defaults if necessary
                // 'status' => 'active', // Example if you have a status
            ]);
        }

        // 6. Send Email Notification
        try {
            Mail::to($validatedData['email'])->send(new ApplicationReceived($validatedData['full_name'], $trackingCode));
        } catch (\Exception $e) {
            // Optional: Log the error if email fails, but don't stop the process
             Log::error('Mail sending failed: ' . $e->getMessage()); 
            // You might want to flash a different message if email fails
            // return redirect()->route('admin.students.index')
            //                  ->with('success', 'Application submitted, but email notification failed.');
        }

        // 7. Redirect to the Admin Students page with a success message
        return redirect()->route('admin.students.index')
                         ->with('success', 'Application submitted successfully! Tracking code: ' . $trackingCode);
                         // Consider showing the tracking code on a success page instead of redirecting straight to admin
    }

    // Add other methods like showApplyForm, track, showTrackStatus if needed
    public function showApplyForm()
    {
        // Return the view containing the application form
        // Example: return view('scholarship.apply'); 
        // You'll need to create this view
        return "Scholarship Application Form Placeholder"; // Replace with actual view
    }
    
    public function track(Request $request)
    {
         // Logic to handle the submission of the tracking code form
         $request->validate(['tracking_code' => 'required|string|size:8']); // Adjust size if needed
         $code = $request->input('tracking_code');
         
         $application = ScholarshipApplication::where('tracking_code', $code)->first();

         if ($application) {
             // Found: Show status view
             return view('scholarship.track_status', compact('application'));
         } else {
             // Not Found: Redirect back with error
             return back()->withErrors(['tracking_code' => 'Invalid tracking code.']);
         }
    }
} 