<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Campaign;
use App\Models\Donation;

class ReportsController extends Controller
{
    /**
     * Show the reports dashboard.
     */
    public function index()
    {
        $data = Report::getDashboardData();
        $campaigns = Campaign::all(); // Fetch all campaigns for the filter
        return view('admin.reports.index', array_merge($data, ['campaigns' => $campaigns]));
    }

    /**
     * Export reports data.
     */
    public function export()
    {
        // TODO: Implement the actual export logic here.
        // This is a placeholder response.
        return response('Export functionality is not yet implemented.', 200);
    }
} 