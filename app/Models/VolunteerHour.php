<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VolunteerHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'volunteer_id',
        'event_id',
        'hours',
        'date',
    ];

    public function volunteer()
    {
        return $this->belongsTo(User::class, 'volunteer_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
