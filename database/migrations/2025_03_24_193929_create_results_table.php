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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('student_number')->index();
            $table->string('student_name');
            $table->string('state')->nullable();
            $table->string('class');
            $table->string('term');
            $table->string('session');
            $table->integer('school_opened')->nullable();
            $table->integer('times_present')->nullable();
            $table->integer('times_absent')->nullable();
            $table->text('teacher_remark')->nullable();
            $table->string('principal_signature')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });

        Schema::create('result_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('result_id')->constrained('results')->onDelete('cascade');
            $table->string('subject');
            $table->integer('ca')->default(0);
            $table->integer('exam')->default(0);
            $table->integer('total')->default(0);
            $table->string('grade')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });

        Schema::create('result_affective_developments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('result_id')->constrained('results')->onDelete('cascade');
            $table->string('category');
            $table->string('rating')->nullable();
            $table->timestamps();
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result_affective_development');
        Schema::dropIfExists('result_subjects');
        Schema::dropIfExists('results');
    }
};
