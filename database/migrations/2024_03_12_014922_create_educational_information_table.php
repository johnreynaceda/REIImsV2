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
        Schema::create('educational_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_information_id');
            $table->string('lrn');
            $table->foreignId('grade_level_id');
            $table->string('student_type')->nullable();
            $table->string('last_grade_completed')->nullable();
            $table->string('last_school_year')->nullable();
            $table->string('last_school_name')->nullable();
            $table->string('last_school_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_information');
    }
};
