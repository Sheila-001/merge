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
        'posted_by',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_admin_posted' => 'boolean',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
    ];

    public function postedBy()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'approved')
                    ->where(function($q) {
                        $q->whereNull('expires_at')
                          ->orWhere('expires_at', '>', now());
                    });
    }
}
