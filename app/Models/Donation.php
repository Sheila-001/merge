<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_name',
        'type',
        'amount',
        'description',
        'status',
        'email',
        'phone',
        'address',
        'payment_method',
        'transaction_id',
        'is_acknowledged',
        'proof_path',
        'message',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
} 