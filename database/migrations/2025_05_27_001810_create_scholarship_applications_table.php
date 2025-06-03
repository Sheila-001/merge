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
            $table->string('tracking_code')->unique();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('scholarship_type');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('application_details')->nullable();
            $table->timestamps();
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
