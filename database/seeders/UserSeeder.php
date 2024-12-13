<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {
        // Create Admin 
        User::create([
            'name' => 'Admin1',
            'email' => 'admin1@example.com',
            'password' => Hash::make('admin1'), 
            'role' => 0, // Admin role
            'date_of_birth' => '1990-01-01', 
            'gender' => 'male', 
            'employed_company' => 'Company1', 
            'employee_id' => '40923'

        ]);


        // Create Club Owner
        User::create([
            'name' => 'Club Owner1',
            'email' => 'clubowner1@example.com',
            'password' => Hash::make('clubowner1'),
            'role' => 2, // Club Owner role
            'date_of_birth' => '1994-08-01', 
            'gender' => 'male', 
            'employed_company' => 'Company2', 
            'employee_id' => '29745'
        ]);

        User::create([
            'name' => 'Club Owner2',
            'email' => 'clubowner2@example.com',
            'password' => Hash::make('clubowner2'),
            'role' => 2,
            'date_of_birth' => '1999-10-01', 
            'gender' => 'male', 
            'employed_company' => 'Company3', 
            'employee_id' => '29645'
        ]);
    
        User::create([
            'name' => 'Club Owner3',
            'email' => 'clubowner3@example.com',
            'password' => Hash::make('clubowner3'),
            'role' => 2,
            'date_of_birth' => '1996-08-18', 
            'gender' => 'female', 
            'employed_company' => 'Company3', 
            'employee_id' => '29743'
        ]);
    }

}
