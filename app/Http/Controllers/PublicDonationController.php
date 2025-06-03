<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Donation;
use App\Models\Campaign;

class PublicDonationController extends Controller
{
    /**
     * Handle the monetary donation form submission.
     */
    public function submitMonetaryDonation(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'payment_method' => 'required|in:bank_transfer,gcash',
            'amount' => 'required|numeric|min:1',
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'donor_phone' => 'required|string|max:20',
            'proof' => 'required|file|mimes:jpeg,png,pdf|max:2048', // Max 2MB
            'message' => 'nullable|string',
            'donation_preference' => 'required|in:anonymous,acknowledged', // Add validation for the preference
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Process the donation (e.g., save to database, send email)
        
        $proofPath = null;
        if ($request->hasFile('proof')) {
            $proofPath = $request->file('proof')->store('monetary', 'public');
        }

        // Determine the is_acknowledged value based on the preference
        $isAcknowledged = ($request->donation_preference === 'acknowledged');
        $isAnonymous = !$isAcknowledged; // If not acknowledged, then it's anonymous
        
        \App\Models\Donation::create([
            'type' => 'monetary',
            'donor_name' => $request->donor_name,
            'donor_email' => $request->donor_email,
            'donor_phone' => $request->donor_phone,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'description' => null, // Description is for non-monetary donations
            'status' => 'pending', // Initial status
            'transaction_id' => null, // You might get this from a payment gateway
            'proof_path' => $proofPath,
            'message' => $request->message,
            'is_acknowledged' => $isAcknowledged,
            'is_anonymous' => $isAnonymous,
        ]);

        // For this example, we'll just return a success response.
        return response()->json(['success' => true, 'message' => 'Donation submitted successfully!']);
    }

    /**
     * Handle the non-monetary donation form submission.
     */
    public function submitNonMonetaryDonation(Request $request)
    {
        // Log the incoming request data
        \Illuminate\Support\Facades\Log::info('Non-monetary donation request data:', $request->all());

        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|max:255',
            'condition' => 'required|string|max:255',
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'donor_phone' => 'required|string|max:20',
            'image' => 'required|file|image|max:2048', // Max 2MB, image file types
            'preferred_time' => 'required|date',
            'description' => 'required|string',
            'donation_preference' => 'required|in:anonymous,acknowledged', // Add validation for the preference
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Add this log to inspect the request data before saving
        \Illuminate\Support\Facades\Log::info('Request data before saving donation:', ['expected_date' => $request->expected_date, 'all' => $request->all()]);

        // Process the donation (e.g., save to database, send email)

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('non-monetary', 'public');
        }

        // Determine the is_acknowledged value based on the preference
        $isAcknowledged = ($request->donation_preference === 'acknowledged');
        $isAnonymous = !$isAcknowledged; // If not acknowledged, then it's anonymous

        // Create a new record in the donations table
        $donation = new \App\Models\Donation([
            'type' => 'non-monetary',
            'donor_name' => $request->donor_name,
            'donor_email' => $request->donor_email,
            'donor_phone' => $request->donor_phone,
            'amount' => null, // Amount is null for non-monetary donations
            'payment_method' => null, // Payment method is null for non-monetary donations
            'item_description' => 'Category: ' . $request->category . ', Condition: ' . $request->condition . ', Description: ' . $request->description,
            'status' => 'pending', // Initial status
            'transaction_id' => null,
            'proof_path' => $imagePath, // Store image path in proof_path
            'message' => 'Preferred Time: ' . $request->preferred_time, // Store preferred time in message
            'is_anonymous' => !($request->donation_preference === 'acknowledged'),
        ]);

        // For this example, we'll just return a success response.
        return response()->json(['success' => true, 'message' => 'Non-monetary donation submitted successfully!']);
    }

    // You might add other methods here for non-monetary donations or campaigns
}