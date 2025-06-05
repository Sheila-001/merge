<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;

class DonationReportController extends Controller
{
    public function index(Request $request)
    {
        // Calculate summary statistics
        $monetaryDonationsTotal = Donation::where('type', 'monetary')->where('status', 'completed')->sum('amount');
        $nonMonetaryDonationsCount = Donation::where('type', 'non-monetary')->count();
        $campaignsCount = Campaign::count();
        // Count unique donors based on email
        $donorsCount = Donation::whereNotNull('donor_email')->distinct('donor_email')->count('donor_email');

        $query = Campaign::withCount('donations');

        // Apply date range filter
        if ($request->has('date_range')) {
            $days = $request->date_range;
            $query->where('created_at', '>=', Carbon::now()->subDays($days));
        }

        // Apply campaign filter
        if ($request->has('campaign_id') && $request->campaign_id) {
            $query->where('id', $request->campaign_id);
        }

        $campaigns = $query->get();

        // Get recent donations with filters
        $donationsQuery = Donation::with(['donor', 'campaign']);

        if ($request->has('date_range')) {
            $days = $request->date_range;
            $donationsQuery->where('created_at', '>=', Carbon::now()->subDays($days));
        }

        if ($request->has('campaign_id') && $request->campaign_id) {
            $donationsQuery->where('campaign_id', $request->campaign_id);
        }

        if ($request->has('status') && $request->status) {
            $donationsQuery->where('status', $request->status);
        }

        $donations = $donationsQuery->latest()->get();
        $recentDonations = $donations->take(10); // Get the 10 most recent donations

        // Pass all necessary data to the view
        return view('admin.donation.reports', compact('campaigns', 'donations', 'monetaryDonationsTotal', 'nonMonetaryDonationsCount', 'campaignsCount', 'donorsCount', 'recentDonations'));
    }

    public function export(Request $request)
    {
        $query = Donation::with(['donor', 'campaign']);

        // Apply filters
        if ($request->has('date_range')) {
            $days = $request->date_range;
            $query->where('created_at', '>=', Carbon::now()->subDays($days));
        }

        if ($request->has('campaign_id') && $request->campaign_id) {
            $query->where('campaign_id', $request->campaign_id);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $donations = $query->get();

        // Generate CSV
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="donation-reports.csv"',
        ];

        $callback = function() use ($donations) {
            $file = fopen('php://output', 'w');
            
            // Add headers
            fputcsv($file, ['Donor', 'Campaign', 'Amount', 'Date', 'Status', 'Type']);
            
            // Add data
            foreach ($donations as $donation) {
                fputcsv($file, [
                    $donation->donor->name,
                    $donation->campaign->title,
                    $donation->amount,
                    $donation->created_at->format('Y-m-d H:i:s'),
                    $donation->status,
                    $donation->type
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
} 