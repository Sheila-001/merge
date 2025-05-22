<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScholarshipApplication;
use App\Models\User;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the scholarship applications.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $applications = ScholarshipApplication::where('status', 'pending')->latest()->get();
        $students = User::where('role', 'student')->where('status', 'active')->latest()->get();
        return view('admin.students.index', compact('applications', 'students'));
    }

    /**
     * Update application status to approved and create student account
     *
     * @param  string  $tracking_code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve($tracking_code)
    {
        $application = ScholarshipApplication::where('tracking_code', $tracking_code)->firstOrFail();
        
        // Check if a user with this email already exists
        $user = User::where('email', $application->email)->first();

        if ($user) {
            // If user exists, update their role to 'student'
            $user->role = 'student';
            $user->status = 'active'; // Assuming active status upon approval
            $user->scholarship_type = $application->scholarship_type; // Update scholarship type for existing user
            $user->save();
        } else {
            // If user does not exist, create a new student user
            $user = User::create([
                'name' => $application->full_name,
                'email' => $application->email,
                'password' => bcrypt(Str::random(10)), // Generate random password
                'role' => 'student',
                'status' => 'active',
                'phone_number' => $application->phone_number,
                'scholarship_type' => $application->scholarship_type,
            ]);
        }

        // Update application status
        $application->status = 'approved';
        $application->save();

        // Send email with credentials to the new student
        // TODO: Implement email sending with credentials

        return redirect()->route('admin.students.index.shortcut')->with('success', 'Application approved and student account created successfully');
    }

    /**
     * Update application status to rejected
     *
     * @param  string  $tracking_code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject($tracking_code)
    {
        $application = ScholarshipApplication::where('tracking_code', $tracking_code)->firstOrFail();
        $application->status = 'rejected';
        $application->save();

        return redirect()->back()->with('success', 'Application rejected successfully');
    }

    /**
     * Remove the specified scholarship application.
     *
     * @param  string  $tracking_code
     */
    public function destroy($tracking_code)
    {
        $application = ScholarshipApplication::where('tracking_code', $tracking_code)->firstOrFail();
        $application->delete();
        return redirect()->back()->with('success', 'Application deleted successfully.');
    }

    /**
     * Delete a student user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyUser($id)
    {
        $user = User::where('role', 'student')->findOrFail($id);
        $user->delete();
        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }
}
