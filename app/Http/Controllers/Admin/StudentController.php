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
}
