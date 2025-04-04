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
        Schema::create('fee_setups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->double( 'amount' );
            $table->foreignId('term_id')->constrained('terms')->onDelete('cascade');
            $table->enum('status',['active', 'inactive'])->default('inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_setups');
    }
};
