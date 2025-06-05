<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'donor_name',
        'donor_email',
        'donor_phone',
        'is_anonymous',
        'is_acknowledged',
        'type',
        'amount',
        'item_description',
        'quantity',
        'status',
        'payment_method',
        'transaction_id',
        'proof_path',
        'message',
        'category',
        'condition',
        'notes',
        'expected_date',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
        'is_acknowledged' => 'boolean',
        'amount' => 'decimal:2',
        'quantity' => 'integer',
        'expected_date' => 'datetime',
    ];

    /**
     * Get the campaign that owns the donation.
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * Get the donor associated with the donation.
     */
    public function donor()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Get the donor's name.
     */
    public function getDonorNameAttribute()
    {
        return $this->attributes['donor_name'] ?? null;
    }

    /**
     * Get the donor's email.
     */
    public function getDonorEmailAttribute()
    {
        return $this->attributes['donor_email'] ?? null;
    }
} 