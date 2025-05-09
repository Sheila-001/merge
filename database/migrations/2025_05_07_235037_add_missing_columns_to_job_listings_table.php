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
        Schema::table('job_listings', function (Blueprint $table) {
            if (!Schema::hasColumn('job_listings', 'qualifications')) {
                $table->text('qualifications')->nullable();
            }
            if (!Schema::hasColumn('job_listings', 'salary_min')) {
                $table->decimal('salary_min', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('job_listings', 'salary_max')) {
                $table->decimal('salary_max', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('job_listings', 'contact_person')) {
                $table->string('contact_person')->nullable();
            }
            if (!Schema::hasColumn('job_listings', 'is_admin_posted')) {
                $table->boolean('is_admin_posted')->default(false);
            }
            if (!Schema::hasColumn('job_listings', 'expires_at')) {
                $table->timestamp('expires_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            $table->dropColumn([
                'qualifications',
                'salary_min',
                'salary_max',
                'contact_person',
                'is_admin_posted',
                'expires_at'
            ]);
        });
    }
};
