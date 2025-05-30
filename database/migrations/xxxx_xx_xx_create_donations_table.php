<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('donor_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('type'); // 'monetary' or 'non-monetary'
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('description')->nullable();
            $table->string('status')->default('pending');
            $table->string('proof_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('donations');
    }
};