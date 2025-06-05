<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarCampaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'start_date',
        'end_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public const STATUSES = [
        'scheduled' => 'Scheduled',
        'pending' => 'Pending',
        'done' => 'Done',
        'cancelled' => 'Cancelled',
    ];

    public const CATEGORIES = [
        'feeding' => 'Feeding Program',
        'outreach' => 'Outreach',
        'donation' => 'Donation Drive',
        'medical' => 'Medical Mission',
        'education' => 'Educational Program',
        'other' => 'Other',
    ];

    public function category()
    {
        return $this->belongsTo(CalendarCategory::class);
    }
} 