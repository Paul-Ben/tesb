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
        Schema::create('school_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('sessionName');
            $table->enum('termName', ['first', 'second', 'third', 'extra', 'extension']);
            $table->boolean('staus')->default(false);
            $table->enum('status', ['active','inactive'])->default('inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_sessions');
    }
};
