<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobListing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'company',
        'company_name',
        'location',
        'type',
        'employment_type',
        'hours_per_week',
        'status',
        'category',
        'start_date',
        'end_date',
        'requirements',
        'benefits',
        'contact_email',
        'contact_phone',
        'salary_min',
        'salary_max',
        'role',
        'qualifications',
        'contact_person',
<<<<<<< HEAD
        'expires_at',
=======
        'contact_email',
        'contact_phone',
        'status',
        'location',
        'employment_type',
        'salary_min',
        'salary_max',
>>>>>>> d3def028a6636791b5390676f51fd78d45b40d80
        'is_admin_posted',
        'posted_by'
    ];

    protected $casts = [
<<<<<<< HEAD
        'start_date' => 'date',
        'end_date' => 'date',
        'expires_at' => 'datetime',
=======
        'is_admin_posted' => 'boolean',
>>>>>>> d3def028a6636791b5390676f51fd78d45b40d80
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2'
    ];

<<<<<<< HEAD
=======
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

>>>>>>> d3def028a6636791b5390676f51fd78d45b40d80
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

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }
}
