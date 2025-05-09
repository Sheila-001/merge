<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'location',
        'status',
        'created_by',
        'is_admin_posted'
    ];

    protected $attributes = [
        'status' => 'active'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_admin_posted' => 'boolean'
    ];

    public function isCompleted()
    {
        return $this->end_date < Carbon::now();
    }

    public function getStatusAttribute($value)
    {
        if ($value === 'cancelled') {
            return 'cancelled';
        }
        
        if ($this->end_date < Carbon::now()) {
            return 'completed';
        } elseif ($this->start_date > Carbon::now()) {
            return 'upcoming';
        } else {
            return 'ongoing';
        }
    }

    public function scopeAdminPosted($query)
    {
        return $query->where('is_admin_posted', true);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                    ->where('start_date', '>', Carbon::now());
    }
}