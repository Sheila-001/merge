<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::latest()->paginate(10);
        
        $totalDonations = $donations->total();
        $totalAmount = Donation::where('type', 'monetary')->sum('amount');
        $averageDonation = $totalDonations > 0 ? Donation::where('type', 'monetary')->avg('amount') : 0;
        $pendingDonations = Donation::where('status', 'pending')->count();

        return view('admin.donations.index', compact('donations', 'totalDonations', 'totalAmount', 'averageDonation', 'pendingDonations'));
    }

    public function adminDonation()
    {
        // Get statistics
        $monetaryDonations = Donation::where('type', 'monetary')->count();
        $nonMonetaryItems = Donation::where('type', 'non-monetary')->count();
        $totalDonors = Donation::distinct('donor_name')->count();
        
        // Get recent donations with pagination
        $recentDonations = Donation::latest()
            ->paginate(3);
            
        // Get pending drop-offs
        $pendingDropoffs = Donation::where('type', 'non-monetary')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.donation.addonation', compact(
            'monetaryDonations',
            'nonMonetaryItems',
            'totalDonors',
            'recentDonations',
            'pendingDropoffs'
        ));
    }

    public function updateStatus(Request $request, Donation $donation)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,rejected'
        ]);

        $donation->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Donation status updated successfully');
    }

    /**
     * Serve the private donation proof image.
     *
     * @param  string $filename
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function serveProofImage($filename)
    {
        $path = 'proofs/' . $filename; // Assuming 'proofs' or 'non-monetary-donations' are top-level folders in local storage

        // Check if the file exists in the local storage
        if (!\Illuminate\Support\Facades\Storage::disk('local')->exists($path)) {
            abort(404); // File not found
        }

        // Return the file as a response
        return \Illuminate\Support\Facades\Storage::disk('local')->response($path);
    }
} 