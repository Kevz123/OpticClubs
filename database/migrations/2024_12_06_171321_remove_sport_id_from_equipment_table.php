<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSportIdFromEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn('equipment', 'sport_id')) {
            Schema::table('equipment', function (Blueprint $table) {
                $table->dropColumn('sport_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipment', function (Blueprint $table) {
            $table->integer('sport_id')->nullable(); // Original definition
        });
    }
}
