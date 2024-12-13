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
        Schema::table('clubs', function (Blueprint $table) {
            $table->decimal('payment', 10, 2)->default(0.00)->change(); // For decimal values like 0.00
            // OR if it's a boolean field
            // $table->boolean('payment')->default(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clubs', function (Blueprint $table) {
            $table->decimal('payment', 10, 2)->default(null)->change(); // Revert to NULL or other default
            // OR for boolean
            // $table->boolean('payment')->default(null)->change();
        });
    }
};
