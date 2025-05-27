<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Campaign;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DonationController extends Controller
{
    public function index()
    {
        // Get current month's data
        $currentMonth = Carbon::now();
        $lastMonth = Carbon::now()->subMonth();

        // Get total monetary donations
        $monetaryTotal = Donation::where('type', 'monetary')
            ->where('status', 'completed')
            ->sum('amount');

        // Calculate monetary change
        $lastMonthMonetary = Donation::where('type', 'monetary')
            ->where('status', 'completed')
            ->whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->sum('amount');
        
        $monetaryChange = $lastMonthMonetary > 0 
            ? (($monetaryTotal - $lastMonthMonetary) / $lastMonthMonetary) * 100 
            : 0;

        // Get count of non-monetary donations
        $nonMonetaryCount = Donation::where('type', 'non-monetary')
            ->where('status', 'completed')
            ->count();

        // Calculate non-monetary change
        $lastMonthNonMonetary = Donation::where('type', 'non-monetary')
            ->where('status', 'completed')
            ->whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();
        
        $nonMonetaryChange = $lastMonthNonMonetary > 0 
            ? (($nonMonetaryCount - $lastMonthNonMonetary) / $lastMonthNonMonetary) * 100 
            : 0;

        // Get campaign total and change
        $campaignTotal = Campaign::where('status', 'active')
            ->sum('raised_amount');
        
        $lastMonthCampaign = Campaign::where('status', 'active')
            ->whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->sum('raised_amount');
        
        $campaignChange = $lastMonthCampaign > 0 
            ? (($campaignTotal - $lastMonthCampaign) / $lastMonthCampaign) * 100 
            : 0;

        // Get donor count and change
        $donorCount = Donation::select('donor_email')
            ->distinct()
            ->count();
        
        $lastMonthDonors = Donation::select('donor_email')
            ->distinct()
            ->whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();
        
        $donorChange = $lastMonthDonors > 0 
            ? (($donorCount - $lastMonthDonors) / $lastMonthDonors) * 100 
            : 0;

        // Get paginated donations
        $donations = Donation::with(['campaign', 'donor'])
            ->latest()
            ->paginate(10);

        // Get pending drop-offs
        $pendingDropoffs = Donation::where('type', 'non-monetary')
            ->where('status', 'pending')
            ->whereNotNull('expected_date')
            ->get();

        return view('admin.donation.index', compact(
            'monetaryTotal',
            'monetaryChange',
            'nonMonetaryCount',
            'nonMonetaryChange',
            'campaignTotal',
            'campaignChange',
            'donorCount',
            'donorChange',
            'donations',
            'pendingDropoffs'
        ));
    }

    public function create()
    {
        $campaigns = Campaign::where('status', 'active')->get();
        return view('admin.donation.create', compact('campaigns'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:monetary,non-monetary',
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'campaign_id' => 'nullable|exists:campaigns,id',
            'amount' => 'required_if:type,monetary|numeric|min:0',
            'item_name' => 'required_if:type,non-monetary|string|max:255',
            'quantity' => 'required_if:type,non-monetary|integer|min:1',
            'expected_date' => 'required_if:type,non-monetary|date|after:today',
            'notes' => 'nullable|string'
        ]);

        $donation = Donation::create($validated);

        return redirect()
            ->route('admin.donations.show', $donation)
            ->with('success', 'Donation created successfully.');
    }

    public function show(Donation $donation)
    {
        return view('admin.donation.show', compact('donation'));
    }

    public function edit(Donation $donation)
    {
        $campaigns = Campaign::where('status', 'active')->get();
        return view('admin.donation.edit', compact('donation', 'campaigns'));
    }

    public function update(Request $request, Donation $donation)
    {
        $validated = $request->validate([
            'type' => 'required|in:monetary,non-monetary',
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'campaign_id' => 'nullable|exists:campaigns,id',
            'amount' => 'required_if:type,monetary|numeric|min:0',
            'item_name' => 'required_if:type,non-monetary|string|max:255',
            'quantity' => 'required_if:type,non-monetary|integer|min:1',
            'expected_date' => 'required_if:type,non-monetary|date|after:today',
            'notes' => 'nullable|string'
        ]);

        $donation->update($validated);

        return redirect()
            ->route('admin.donations.show', $donation)
            ->with('success', 'Donation updated successfully.');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()
            ->route('admin.donations.index')
            ->with('success', 'Donation deleted successfully.');
    }

    public function updateStatus(Request $request, Donation $donation)
    {
        $request->validate([
            'status' => 'required|in:completed,pending,rejected'
        ]);

        $donation->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Donation status updated successfully');
    }

    public function dropoffs()
    {
        $dropoffs = Donation::where('type', 'non-monetary')
            ->whereNotNull('expected_date')
            ->latest()
            ->paginate(20);

        return view('admin.donation.dropoffs', compact('dropoffs'));
    }
} 