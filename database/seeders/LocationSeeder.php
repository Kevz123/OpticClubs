<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Insert sample locations into the locations table
        DB::table('locations')->insert([
            [
                'sports_name' => 'Cricket',
                'image' => 'chance.png', 
                'is_physical' => 1,
                'shop_name' => 'The Chance Sports',
                'address' => 'YMBA Shopping Complex, 70/3 Kanatta Rd, Colombo 00700',
                'contact_number' => '0112 699 496',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sports_name' => 'Football',
                'image' => 'khazana.jpg',
                'is_physical' => 1,
                'shop_name' => 'KHAZANA SPORTS (PVT) LTD',
                'address' => '119 Main St, Colombo 00110',
                'contact_number' => '076 866 9564',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sports_name' => 'Basketball',
                'image' => 'peak.png',
                'is_physical' => 1,
                'shop_name' => 'Peak Sports Sri Lanka',
                'address' => '216 Sri Sambuddhathva Jayanthi Mawatha, Colombo 00500',
                'contact_number' => '076 852 8011',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sports_name' => 'Carrom',
                'image' => 'carromshop.png',
                'is_physical' => 0,
                'shop_name' => 'SL Carrom Shop',
                'address' => '49 D/4, Kotikawatta 10600',
                'contact_number' => '077 741 1181',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sports_name' => 'Chess',
                'image' => 'chessmart.jpg',
                'is_physical' => 0,
                'shop_name' => 'Lanka Chess Mart',
                'address' => '44C Ananda Rajakaruna Mawatha, Punchi 01000',
                'contact_number' => '071 633 6000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sports_name' => 'Billiards',
                'image' => 'panther.png',
                'is_physical' => 0,
                'shop_name' => 'Panther Billiards International',
                'address' => '6, 107, 3 W.A. Silva Mawatha, Colombo 00600',
                'contact_number' => '077 718 5789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
