<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DonationController extends Controller
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
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Process the donation (e.g., save to database, send email)
        // For now, let's just handle the file upload
        
        $proofPath = null;
        if ($request->hasFile('proof')) {
            $proofPath = $request->file('proof')->store('proofs', 'public');
        }

        // Here you would typically save the donation details to a database table.
        // Example (assuming a Donation model exists):
        // \App\Models\MonetaryDonation::create([
        //     'payment_method' => $request->payment_method,
        //     'amount' => $request->amount,
        //     'donor_name' => $request->donor_name,
        //     'donor_email' => $request->donor_email,
        //     'donor_phone' => $request->donor_phone,
        //     'proof_path' => $proofPath,
        //     'message' => $request->message,
        // ]);

        // For this example, we'll just return a success response.
        return response()->json(['success' => true, 'message' => 'Donation submitted successfully!']);
    }

    /**
     * Handle the non-monetary donation form submission.
     */
    public function submitNonMonetaryDonation(Request $request)
    {
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
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Process the donation (e.g., save to database, send email)
        // For now, let's just handle the file upload

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('non-monetary-donations', 'public');
        }

        // Here you would typically save the donation details to a database table.
        // Example (assuming a NonMonetaryDonation model exists):
        // \App\Models\NonMonetaryDonation::create([
        //     'category' => $request->category,
        //     'condition' => $request->condition,
        //     'donor_name' => $request->donor_name,
        //     'donor_email' => $request->donor_email,
        //     'donor_phone' => $request->donor_phone,
        //     'image_path' => $imagePath,
        //     'preferred_time' => $request->preferred_time,
        //     'description' => $request->description,
        // ]);

        // For this example, we'll just return a success response.
        return response()->json(['success' => true, 'message' => 'Non-monetary donation submitted successfully!']);
    }

    // You might add other methods here for non-monetary donations or campaigns
} 