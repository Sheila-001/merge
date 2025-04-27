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
        Schema::table('scholarship_applications', function (Blueprint $table) {
            // Add columns after 'phone_number' for better organization (optional)
            $table->string('scholarship_type')->after('phone_number'); 
            $table->string('tracking_code')->unique()->nullable()->after('transcript_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scholarship_applications', function (Blueprint $table) {
            $table->dropColumn('scholarship_type');
            $table->dropColumn('tracking_code');
        });
    }
};
