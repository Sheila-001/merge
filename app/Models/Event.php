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
        'status'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function isCompleted()
    {
        return $this->end_date < Carbon::now();
    }

    public function getStatusAttribute()
    {
        if ($this->end_date < Carbon::now()) {
            return 'completed';
        } elseif ($this->start_date > Carbon::now()) {
            return 'upcoming';
        } else {
            return 'ongoing';
        }
    }
}