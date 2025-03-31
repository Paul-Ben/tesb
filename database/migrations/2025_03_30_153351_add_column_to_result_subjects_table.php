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
        Schema::table('result_subjects', function (Blueprint $table) {
            $table->integer('highest_in_class')->after('total');
            $table->integer('lowest_in_class')->after('highest_in_class');
            $table->integer('position')->after('lowest_in_class');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('result_subjects', function (Blueprint $table) {
            $table->dropColumn('highest_in_class');
            $table->dropColumn('lowest_in_class');
            $table->dropColumn('position');
        });
    }
};
