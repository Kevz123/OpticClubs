<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('review_id');
            $table->text('description');
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->unsignedBigInteger('membership_id'); // Match the primary key type in the clubs table
            $table->foreign('membership_id')->references('membership_id')->on('memberships')->onDelete('cascade');
            $table->unsignedBigInteger('club_id'); // Match the primary key type in the clubs table
            $table->foreign('club_id')->references('club_id')->on('clubs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
