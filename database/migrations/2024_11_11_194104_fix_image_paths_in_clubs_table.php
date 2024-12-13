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
        DB::table('clubs')
        ->where('main_image', 'like', 'club_images/club_images/%')
        ->update(['main_image' => DB::raw("REPLACE(main_image, 'club_images/club_images/', 'club_images/')")]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('clubs')
        ->where('main_image', 'like', 'club_images/%')
        ->update(['main_image' => DB::raw("REPLACE(main_image, 'club_images/', 'club_images/club_images/')")]);
    }
};
