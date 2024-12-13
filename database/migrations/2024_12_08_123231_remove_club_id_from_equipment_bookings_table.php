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
        Schema::table('equipment_bookings', function (Blueprint $table) {
            $table->dropForeign(['club_id']); // Drop the foreign key first
            $table->dropColumn('club_id');    // Drop the column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipment_bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('club_id'); // Recreate the column
            $table->foreign('club_id')->references('club_id')->on('clubs')->onDelete('cascade'); // Recreate the foreign key
        });
    }
};
