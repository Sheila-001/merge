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
} 