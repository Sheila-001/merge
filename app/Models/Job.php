<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'company_name',
        'contact_email',
        'location',
        'description',
        'qualifications',
        'contact_person',
        'contact_phone',
        'employment_type',
        'salary_min',
        'salary_max',
        'status',
        'is_admin_posted'
    ];

    protected $casts = [
        'is_admin_posted' => 'boolean',
    ];

    // Define any fillable fields or relationships here
}