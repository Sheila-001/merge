<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScholarshipApplication extends Model
{
    use HasFactory;

    // --- IMPORTANT --- 
    // Make sure this matches your actual table name in the database
    protected $table = 'scholarship_applications'; 

    // --- IMPORTANT --- 
    // Add all columns from your table that should be mass assignable
    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'scholarship_type',
        'transcript_path',
        'tracking_code',
        'status', // e.g., pending, approved, rejected
        // Add other fields like 'tracking_code' if necessary
    ];

    /**
     * Define any attribute casting needed.
     */
    // protected $casts = [
    //     'application_date' => 'datetime',
    // ];
} 