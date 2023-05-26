<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Patient;
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
        Patient::factory(25)->create();

        User::create([
            'name' => 'Admin de Leap',
            'email' => 'admin@leap.com',
            'password' => Hash::make('Leap@2022.'),
            'email_verified_at' => now()
        ]);
    }
}
