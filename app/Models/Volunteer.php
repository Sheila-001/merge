<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'skills',
        'status',
        'notes',
        'start_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'skills' => 'array',
        'start_date' => 'datetime',
    ];

    /**
     * Get the volunteer's skills as an array.
     *
     * @return array
     */
    public function getSkillsArrayAttribute()
    {
        if (is_string($this->skills)) {
            return json_decode($this->skills, true) ?? [];
        }
        
        return $this->skills ?? [];
    }
} 