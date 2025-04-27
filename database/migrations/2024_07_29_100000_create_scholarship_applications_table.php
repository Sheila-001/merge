<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scholarship_applications', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email'); // Add unique() if email should be unique per application
            $table->string('phone_number')->nullable();
            $table->string('scholarship_type'); // Added: e.g., 'home_based', 'in_house'
            $table->string('transcript_path')->nullable();
            $table->string('tracking_code')->unique()->nullable(); // Added: Unique tracking code
            $table->string('status')->default('pending'); // e.g., pending, approved, rejected
            // Add a tracking code column if needed
            // $table->string('tracking_code')->unique()->nullable();
            $table->timestamps(); // Adds created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarship_applications');
    }
}; 