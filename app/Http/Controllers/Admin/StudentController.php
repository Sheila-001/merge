<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScholarshipApplication;

class StudentController extends Controller
{
    /**
     * Display a listing of the scholarship applications.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $applications = ScholarshipApplication::latest()->get();
        return view('admin.students.index', compact('applications'));
    }

    /**
     * Update application status to approved
     *
     * @param  string  $tracking_code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve($tracking_code)
    {
        $application = ScholarshipApplication::where('tracking_code', $tracking_code)->firstOrFail();
        $application->status = 'approved';
        $application->save();

        return redirect()->back()->with('success', 'Application approved successfully');
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
        return redirect()->back()->with('success', 'Student application deleted successfully.');
    }
}
