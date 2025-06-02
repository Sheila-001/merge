<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    /**
     * Get summary statistics for the dashboard
     */
    public static function getSummaryStatistics()
    {
        return [
            'totalDonations' => Donation::sum('amount'),
            'activeCampaigns' => Campaign::where('status', 'active')->count(),
            'totalDonors' => Donation::distinct('donor_email')->count(), // Assuming unique donors by email
            'pendingDonations' => Donation::where('status', 'pending')->count(), // Assuming a 'pending' status
        ];
    }

    /**
     * Get campaign performance data
     */
    public static function getCampaignPerformance()
    {
        return Campaign::all(); // Or apply filters/sorting as needed
    }

    /**
     * Get recent donations
     */
    public static function getRecentDonations()
    {
        return Donation::latest()->take(5)->get(); // Adjust take() as needed
    }

    /**
     * Get all report data for the dashboard
     */
    public static function getDashboardData()
    {
        return array_merge(
            self::getSummaryStatistics(),
            [
                'campaignPerformance' => self::getCampaignPerformance(),
                'recentDonations' => self::getRecentDonations(),
            ]
        );
    }
} 