<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;  // Corrected the import statement

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Igor Coccu',
            'email' => 'igor@felexindo.com',
            'password' => Hash::make('1234567890'),
        ]);

        //data dummy for company
        \App\Models\Company::create([
            'name'=>'PT Felixindo',
            'email'=>'igor@felixindo.com',
            'address'=>'Jl. Depok',
            'latitude'=>'-7.747033',
            'longitude'=>'110.355389',
            'radius_km'=>'0.5',
            'time_in'=>'08:00',
            'time_out'=>'17:00',
        ]);

        $this->call([
            AttendanceSeeder::class,
            PermissionSeeder::class,
        ]);
    }
}
