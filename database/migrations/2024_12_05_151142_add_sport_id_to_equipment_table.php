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
        // Schema::table('equipment', function (Blueprint $table) {
        //     $table->unsignedBigInteger('sport_id')->nullable(); // Add the column without foreign key
        // });
        Schema::table('equipment', function (Blueprint $table) {
            if (!Schema::hasColumn('equipment', 'sport_id')) {
                $table->unsignedBigInteger('sport_id')->nullable(); // Add sport_id column
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('equipment', function (Blueprint $table) {
        //     $table->dropForeign(['sport_id']);
        //     $table->dropColumn('sport_id');
        // });
        Schema::table('equipment', function (Blueprint $table) {
            if (Schema::hasColumn('equipment', 'sport_id')) {
                $table->dropColumn('sport_id'); // Remove the sport_id column
            }
        });
    }
};
