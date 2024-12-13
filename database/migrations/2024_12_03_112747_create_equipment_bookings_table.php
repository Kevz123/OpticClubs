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
        Schema::create('equipment_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('club_id'); // Matches 'club_id' in 'clubs' table
            $table->unsignedBigInteger('equipment_id');
            $table->integer('quantity_booked');
            $table->timestamps();
    
            // Foreign keys
            $table->foreign('club_id')->references('club_id')->on('clubs')->onDelete('cascade'); // Referencing 'club_id'
            $table->foreign('equipment_id')->references('id')->on('equipment')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_bookings');
    }
};
