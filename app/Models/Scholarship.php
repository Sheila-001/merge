<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Scholarship extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'full_name',
        'student_id',
        'email',
        'phone_number',
        'gpa',
        'major',
        'year_level',
        'expected_graduation',
        'scholarship_type',
        'why_deserve',
        'career_goals',
        'tracking_code',
        'status'
    ];

    protected $casts = [
        'expected_graduation' => 'date',
        'gpa' => 'float'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('transcript')
            ->singleFile();
        
        $this->addMediaCollection('recommendation_letter')
            ->singleFile();
        
        $this->addMediaCollection('resume')
            ->singleFile();
        
        $this->addMediaCollection('additional_documents')
            ->singleFile();
    }
} 