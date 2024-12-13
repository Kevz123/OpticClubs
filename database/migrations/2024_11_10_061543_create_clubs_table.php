<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up():void
{
    Schema::create('clubs', function (Blueprint $table) {
        $table->id('club_id'); // Primary key named 'club_id'
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('name');
        $table->text('description')->nullable();
        $table->date('created_date');
        $table->enum('club_type', ['small', 'medium', 'large']);
        $table->enum('physical_type', ['physical', 'non-physical']);
        $table->binary('monthly_practice_timetable')->nullable();
        $table->decimal('payment', 10, 2);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clubs');
    }
};
