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
            $table->date('expected_date')->nullable()->after('notes');
            $table->string('other_item_name')->nullable()->after('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            if (Schema::hasColumn('donations', 'item_name')) {
                $table->dropColumn('item_name');
            }
            if (Schema::hasColumn('donations', 'condition')) {
                $table->dropColumn('condition');
            }
            // ... repeat for description, proof_path, expected_date if needed
        });
    }
};
