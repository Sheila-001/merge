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
        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'status')) {
                $table->enum('status', ['active', 'cancelled'])->default('active');
            }
            if (!Schema::hasColumn('events', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable();
                $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            }
            if (!Schema::hasColumn('events', 'is_admin_posted')) {
                $table->boolean('is_admin_posted')->default(false);
            }
            if (!Schema::hasColumn('events', 'image')) {
                $table->string('image')->nullable();
            }
            if (!Schema::hasColumn('events', 'max_participants')) {
                $table->integer('max_participants')->nullable();
            }
            if (!Schema::hasColumn('events', 'registration_fee')) {
                $table->decimal('registration_fee', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('events', 'is_featured')) {
                $table->boolean('is_featured')->default(false);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'created_by',
                'is_admin_posted',
                'image',
                'max_participants',
                'registration_fee',
                'is_featured'
            ]);
        });
    }
};
