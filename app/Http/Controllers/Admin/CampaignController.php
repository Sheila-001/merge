<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Donation;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Display a listing of the campaigns.
     */
    public function index()
    {
        $campaigns = Campaign::with('donations')
            ->latest()
            ->paginate(10)
            ->through(function ($campaign) {
                $campaign->funds_raised = $campaign->donations->sum('amount');
                $campaign->type = $campaign->type ?? 'Regular';
                return $campaign;
            });

        return view('admin.campaigns.index', compact('campaigns'));
    }

    /**
     * Display the campaign management dashboard.
     */
    public function dashboard()
    {
        $campaigns = Campaign::withCount('donations')
            ->withSum('donations', 'amount')
            ->orderBy('created_at', 'desc')
            ->get();

        $recentDonations = Donation::whereHas('campaign')
            ->with('campaign')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.campaigns.dashboard', compact('campaigns', 'recentDonations'));
    }

    /**
     * Show the form for creating a new campaign.
     */
    public function create()
    {
        return view('admin.campaigns.create');
    }

    /**
     * Store a newly created campaign in storage.
     */
    public function store(StoreCampaignRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('campaigns', 'public');
        }

        Campaign::create($validated);

        return redirect()->route('admin.campaigns.dashboard')
            ->with('success', 'Campaign created successfully.');
    }

    /**
     * Display the specified campaign.
     */
    public function show(Campaign $campaign)
    {
        return view('admin.campaigns.show', compact('campaign'));
    }

    /**
     * Show the form for editing the specified campaign.
     */
    public function edit(Campaign $campaign)
    {
        return view('admin.campaigns.edit', compact('campaign'));
    }

    /**
     * Update the specified campaign in storage.
     */
    public function update(UpdateCampaignRequest $request, Campaign $campaign)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($campaign->image) {
                Storage::disk('public')->delete($campaign->image);
            }
            $validated['image'] = $request->file('image')->store('campaigns', 'public');
        }

        $campaign->update($validated);

        return redirect()->route('admin.campaigns.dashboard')
            ->with('success', 'Campaign updated successfully.');
    }

    /**
     * Remove the specified campaign from storage.
     */
    public function destroy(Campaign $campaign)
    {
        if ($campaign->image) {
            Storage::disk('public')->delete($campaign->image);
        }
        
        $campaign->delete();

        return redirect()->route('admin.campaigns.dashboard')
            ->with('success', 'Campaign deleted successfully.');
    }
} 