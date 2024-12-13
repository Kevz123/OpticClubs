<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('equipment')->insert([
            ['name' => 'Cricket Bat', 'description' => 'Professional cricket bat', 'quantity_available' => 25, 'price' => 3500, 'location_id' => 19],
            ['name' => 'Cricket Ball', 'description' => 'Professional leather ball', 'quantity_available' => 30, 'price' => 2500, 'location_id' => 19],
            ['name' => 'Stumps', 'description' => 'High-quality wooden stumps', 'quantity_available' => 15, 'price' => 3000, 'location_id' => 19],
            ['name' => 'Batting Gloves', 'description' => 'High-quality gloves', 'quantity_available' => 10, 'price' => 2000, 'location_id' => 19],

            ['name' => 'Football', 'description' => 'Standard football', 'quantity_available' => 30, 'price' => 2500, 'location_id' => 20],
            ['name' => 'Cleats', 'description' => 'Professional cleats', 'quantity_available' => 20, 'price' => 3500, 'location_id' => 20],
            ['name' => 'Shin Guards', 'description' => 'High-quality shin guards', 'quantity_available' => 20, 'price' => 1000, 'location_id' => 20],
            ['name' => 'Goalpost', 'description' => 'Standard goalpost', 'quantity_available' => 10, 'price' => 8000, 'location_id' => 20],

            ['name' => 'Basketball', 'description' => 'Standard basketball', 'quantity_available' => 30, 'price' => 2500, 'location_id' => 21],
            ['name' => 'Basketball Hoop', 'description' => 'Standard basketball hoop', 'quantity_available' => 15, 'price' => 3500, 'location_id' => 21],
            ['name' => 'Sneakers', 'description' => 'Professional sneakers', 'quantity_available' => 15, 'price' => 4000, 'location_id' => 21],
            ['name' => 'Jersey', 'description' => 'Professional jersey', 'quantity_available' => 25, 'price' => 1500, 'location_id' => 21],
            
            ['name' => 'Carrom Board', 'description' => 'Standard carrom board', 'quantity_available' => 30, 'price' => 6000, 'location_id' => 22],
            ['name' => 'Carrom Coins', 'description' => 'High-quality carrom coins', 'quantity_available' => 50, 'price' => 3000, 'location_id' => 22],
            ['name' => 'Striker', 'description' => 'Standard carrom striker', 'quantity_available' => 50, 'price' => 500, 'location_id' => 22],
            ['name' => 'Powder', 'description' => 'Smooth carrom powder', 'quantity_available' => 20, 'price' => 800, 'location_id' => 22],
            
            ['name' => 'Chess Board', 'description' => 'Standard chess board', 'quantity_available' => 30, 'price' => 2000, 'location_id' => 23],
            ['name' => 'Chess Mat', 'description' => 'Professional chess mat', 'quantity_available' => 30, 'price' => 2500, 'location_id' => 23],
            ['name' => 'Chess Pieces', 'description' => 'Professional chess pieces', 'quantity_available' => 30, 'price' => 1500, 'location_id' => 23],
            ['name' => 'Chess Clock', 'description' => 'Professional chess clock', 'quantity_available' => 15, 'price' => 1000, 'location_id' => 23],
            
            ['name' => 'Cue Stick', 'description' => 'Professional pool cue', 'quantity_available' => 20, 'price' => 2000, 'location_id' => 24],
            ['name' => 'Billiards Ball Set', 'description' => '15 ball set with cue ball', 'quantity_available' => 40, 'price' => 4000, 'location_id' => 24],
            ['name' => 'Triangle Rack', 'description' => 'Ball arrangement frame', 'quantity_available' => 15, 'price' => 1000, 'location_id' => 24],
            ['name' => 'Cue Chalk', 'description' => 'Cue tip friction enhancer', 'quantity_available' => 30, 'price' => 500, 'location_id' => 24],
        ]);

       
        
    }
}
