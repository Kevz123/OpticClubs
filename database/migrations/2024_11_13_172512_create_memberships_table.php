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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id('membership_id'); 
            $table->date('join_date');
            $table->decimal('membership_fee', 8, 2);

            // Foreign key for users table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 

            // Foreign key for clubs table
            $table->unsignedBigInteger('club_id');
            $table->foreign('club_id')->references('club_id')->on('clubs')->onDelete('cascade'); 

            $table->timestamps();

            // Unique constraint on user_id and club_id
            $table->unique(['user_id', 'club_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
