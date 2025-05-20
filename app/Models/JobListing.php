<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company_name',
        'description',
        'role',
        'qualifications',
        'contact_person',
        'contact_email',
        'contact_phone',
        'status',
        'location',
        'employment_type',
        'salary_min',
        'salary_max',
        'is_admin_posted',
        'posted_by'
    ];

    protected $casts = [
        'is_admin_posted' => 'boolean',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
    ];

    // Add accessors to handle salary values
    public function getSalaryMinAttribute($value)
    {
        return $value !== null ? (float) $value : null;
    }

    public function getSalaryMaxAttribute($value)
    {
        return $value !== null ? (float) $value : null;
    }

    public function postedBy()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'approved');
    }

    public function dashboard()
    {
        try {
            // Load only admin-posted and active events
            $events = Event::where('status', 'active')
                          ->where('is_admin_posted', true)
                          ->where('end_date', '>', now())
                          ->get();
            
            // Load only admin-posted and approved jobs
            $jobs = JobListing::where('status', 'approved')
                             ->where('is_admin_posted', true)
                             ->where(function($query) {
                                 $query->whereNull('expires_at')
                                       ->orWhere('expires_at', '>', now());
                             })
                             ->get();
            
            return view('volunteers.volunteerdashboard', compact('events', 'jobs'));
        } catch (\Exception $e) {
            \Log::error('Volunteer Dashboard Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the dashboard.');
        }
    }
}
