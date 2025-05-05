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

    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'scholarship_type',
        'transcript_path',
        'tracking_code',
        'status',
    ];

    /**
     * Define any attribute casting needed.
     */
    // protected $casts = [
    //     'application_date' => 'datetime',
    // ];
} 