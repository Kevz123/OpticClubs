<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VenueSeeder extends Seeder
{
    public function run(): void 
    {
        // Adding venues manually
        DB::table('venues')->insert([
            [
                'venue_name' => 'SSC Cricket Ground (Sinhalese Sports Club)',
                'location' => 'Colombo 7',
                'capacity' => 10000,
                'picture' => 'ssc.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venue_name' => 'Race Course Ground',
                'location' => 'Colombo 7',
                'capacity' => 10000,
                'picture' => 'racecourse.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venue_name' => 'Royal College Sports Complex',
                'location' => 'Colombo 7',
                'capacity' => 1000,
                'picture' => 'royal.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venue_name' => 'Sugathadasa Stadium',
                'location' => 'Colombo 14',
                'capacity' => 25000,
                'picture' => 'sugathadasa.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venue_name' => 'BMICH (Bandaranaike Memorial International Conference Hall)',
                'location' => 'Colombo 7',
                'capacity' => 25000,
                'picture' => 'bmich.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venue_name' => 'Brew 1867 by Dilmah - Flower Road',
                'location' => 'Colombo 7',
                'capacity' => 50,
                'picture' => 'brewcafe.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
