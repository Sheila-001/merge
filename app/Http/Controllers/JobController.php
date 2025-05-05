<?php
namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all(); // Fetch all jobs from the database
        return view('jobs.index', compact('jobs'));
    }
}