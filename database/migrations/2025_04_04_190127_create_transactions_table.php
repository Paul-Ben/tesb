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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('student_number');
            $table->string('amount');
            $table->string('paymentStatus');
            $table->string('guardian_name');
            $table->string('phone_number');
            $table->string('term');
            $table->foreignId('term_id')->constrained()->onDelete('cascade');
            $table->string('student_class');
            $table->string('session');
            $table->foreignId('session_id')->constrained('school_sessions')->onDelete('cascade');
            $table->string('tx_ref')->unique();
            $table->string('txr_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
