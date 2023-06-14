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
        User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@leap.com',
            'password' => Hash::make('Leap@2022.'),
            'superadmin' => true,
            'email_verified_at' => now()
        ]);

        User::create([
            'name' => 'Doc 1',
            'email' => 'doc1@leap.com',
            'password' => Hash::make('Leap@2022.'),
            'email_verified_at' => now()
        ]);

        User::create([
            'name' => 'Doc 2',
            'email' => 'doc2@leap.com',
            'password' => Hash::make('Leap@2022.'),
            'email_verified_at' => now()
        ]);

        Patient::factory(100)->create();
    }
}
