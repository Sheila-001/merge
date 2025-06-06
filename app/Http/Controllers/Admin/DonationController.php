<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Campaign;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\MonetaryDonationReceived;
use App\Mail\NonMonetaryDropoffConfirmed;

class DonationController extends Controller
{
    public function index()
    {
        // If the URL contains /all, redirect to /all-donors
        if (request()->is('admin/donations/all')) {
            return redirect()->route('admin.donations.all-donors');
        }

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
        $campaignTotal = Donation::whereHas('campaign', function($query) {
                $query->where('status', 'active');
            })
            ->where('status', 'completed')
            ->sum('amount');
        
        $lastMonthCampaign = Donation::whereHas('campaign', function($query) use ($lastMonth) {
                $query->where('status', 'active');
            })
            ->where('status', 'completed')
            ->whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->sum('amount');
        
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
        $donations = Donation::with(['campaign'])
            ->latest()
            ->paginate(10);

        // Get pending drop-offs
        $pendingDropoffs = Donation::where('type', 'non-monetary')
            ->where('status', 'pending')
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
            'notes' => 'nullable|string',
            'category' => 'required_if:type,non-monetary|nullable|string|max:255',
            'condition' => 'required_if:type,non-monetary|nullable|string|max:255',
        ]);

        $donation = Donation::create($validated);

        // For monetary donations
        if ($request->hasFile('proof')) {
            $proofPath = $request->file('proof')->store('proofs', 'public');
            $donation->update(['proof_path' => $proofPath]);
        }

        // For non-monetary donations
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('non-monetary-donations', 'public');
            $donation->update(['image_path' => $imagePath]);
        }

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
        return view('admin.donation.adddonation', compact('donation', 'campaigns'));
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
            'notes' => 'nullable|string',
            'category' => 'required_if:type,non-monetary|nullable|string|max:255',
            'condition' => 'required_if:type,non-monetary|nullable|string|max:255',
        ]);

        $donation->update($validated);

        // For monetary donations
        if ($request->hasFile('proof')) {
            $proofPath = $request->file('proof')->store('proofs', 'public');
            $donation->update(['proof_path' => $proofPath]);
        }

        // For non-monetary donations
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('non-monetary-donations', 'public');
            $donation->update(['image_path' => $imagePath]);
        }

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

        // Store the old status before updating
        $oldStatus = $donation->status;

        $donation->update([
            'status' => $request->status
        ]);

        // Check if the status changed to 'completed'
        if ($oldStatus !== 'completed' && $donation->status === 'completed') {
            // Send email based on donation type
            if ($donation->type === 'monetary') {
                Mail::to($donation->donor_email)->send(new MonetaryDonationReceived(
                    $donation->donor_name,
                    $donation->amount,
                    $donation->created_at->format('M d, Y H:i')
                ));
            } elseif ($donation->type === 'non-monetary') {
                Mail::to($donation->donor_email)->send(new NonMonetaryDropoffConfirmed(
                    $donation->donor_name,
                    $donation->expected_date?->format('M d, Y H:i')
                ));
            }
        }

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

    public function serveProofImage($filename)
    {
        $path = storage_path('app/public/proofs/' . $filename);
        
        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }

    public function allDonors()
    {
        \Illuminate\Support\Facades\Log::info('allDonors method reached');
        $donations = Donation::with(['campaign'])
            ->latest()
            ->get(); // Get all donations without pagination

        return view('admin.donation.all-donors', compact('donations'));
    }
} 