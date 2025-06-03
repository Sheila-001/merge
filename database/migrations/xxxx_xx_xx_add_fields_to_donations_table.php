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
        Schema::table('donations', function (Blueprint $table) {
            if (!Schema::hasColumn('donations', 'item_name')) {
                $table->string('item_name')->nullable();
            }
            if (!Schema::hasColumn('donations', 'condition')) {
                $table->string('condition')->nullable();
            }
            if (!Schema::hasColumn('donations', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('donations', 'proof_path')) {
                $table->string('proof_path')->nullable();
            }
            if (!Schema::hasColumn('donations', 'expected_date')) {
                $table->date('expected_date')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn([
                'item_name',
                'condition',
                'description',
                'proof_path',
                'expected_date'
            ]);
        });
    }
};