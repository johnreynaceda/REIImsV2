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
        Schema::create('student_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->foreignId('school_year_id');
            $table->double('applied_tuition_subd')->nullable();
            $table->double('applied_misc_subd')->nullable();
            $table->double('total_payables')->nullable();
            $table->double('required_downpaymennt')->nullable();
            $table->double('total_tuition')->nullable();
            $table->double('total_misc')->nullable();
            $table->double('total_book')->nullable();
            $table->boolean('book_fee_updated')->default(false);
            $table->string('active_sem')->default('1st Semester');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_payments');
    }
};
