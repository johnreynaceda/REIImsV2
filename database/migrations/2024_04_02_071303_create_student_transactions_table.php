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
        Schema::create('student_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_payment_id')->nullable();
            $table->foreignId('student_information_id')->nullable();
            $table->string('transaction_number');
            $table->string('or_number');
            $table->double('total_amount');
            $table->boolean('is_voided')->default(false);
            $table->string('active_semester')->default('1st Semester');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_transactions');
    }
};
