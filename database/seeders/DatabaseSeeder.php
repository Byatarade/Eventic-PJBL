<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder EO
        User::create([
            'name' => 'EO Artantic',
            'email' => 'eo@gmail.com',
            'password' => Hash::make('password123'),
            'phone' => '08123456789',
            'role' => 'eo',
        ]);

        // Data User
        User::create([
            'name' => 'Byan',
            'email' => 'byan@gmail.com',
            'password' => Hash::make('password123'),
            'phone' => '08987654321',
            'role' => 'user',
        ]);
    }
}