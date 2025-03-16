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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('std_number');
            $table->date('date_of_birth');
            $table->string('image')->nullable();
            $table->string('nationality');
            $table->string('gender');
            $table->string('stateoforigin')->nullable();
            $table->string('lga')->nullable();
            $table->string('genotype');
            $table->string('bgroup');
            $table->foreignId('guardian_id')->constrained('guardians');
            $table->foreignId('class_id')->constrained('classrooms')->onDelete('cascade');
            $table->foreignId('current_session')->constrained('school_sessions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
