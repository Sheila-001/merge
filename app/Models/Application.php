<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    // Explicitly link to the 'applications' table
    protected $table = 'applications';

    // Define fillable fields based on your migration
    protected $fillable = [
        'email',
        'status',
    ];

    // Add relationships if needed, e.g., to a User model via email
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'email', 'email');
    // }
} 