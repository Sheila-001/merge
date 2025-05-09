<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            $table->string('company_name')->nullable()->after('title');
            $table->string('role')->nullable()->after('company_name');
            $table->string('employment_type')->nullable()->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            $table->dropColumn(['company_name', 'role', 'employment_type']);
        });
    }
}; 