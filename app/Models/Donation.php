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
} 