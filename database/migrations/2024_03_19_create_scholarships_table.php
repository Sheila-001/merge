<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('student_id');
            $table->string('email');
            $table->string('phone_number');
            $table->decimal('gpa', 3, 2);
            $table->string('major');
            $table->string('year_level');
            $table->date('expected_graduation');
            $table->string('scholarship_type');
            $table->text('why_deserve');
            $table->text('career_goals');
            $table->string('tracking_code')->unique();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scholarships');
    }
}; 