<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Patient;
use App\Models\User;
use App\Models\Game;
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
            'name' => 'Andres Molina',
            'email' => 'andresmol2006@yahoo.es',
            'password' => Hash::make('Leap@2022.'),
            'email_verified_at' => now()
        ]);

        User::create([
            'name' => 'Doc 2',
            'email' => 'doc2@leap.com',
            'password' => Hash::make('Leap@2022.'),
            'email_verified_at' => now()
        ]);

        Game::create([
            'name' => 'Rompecabezas',
            'default_config' => '{"name": "Rompecabezas","map": "BoatMap","config": {"dificulty": ["Facil", "Normal", "Difícil"],"music": [false, true],"time": [1, 1.5, 2],"distractors": [0, 1, 2, 3]}}',
        ]);

        Game::create([
            'name' => 'FruitNinja',
            'default_config' => '{"name": "FruitNinja","map": "CascadeMap","config": {"dificulty": ["Facil", "Normal", "Difícil"],"music": [false, true],"time": [1, 1.5, 2],"distractors": [0, 1, 2, 3]}}',
        ]);

        Game::create([
            'name' => 'Torre de Cubos',
            'default_config' => '{"name": "Torre de Cubos","map": "MountainMap","config": {"dificulty": ["Facil", "Normal", "Difícil"],"music": [false, true],"time": [1, 1.5, 2],"distractors": [0, 1, 2, 3]}}',
        ]);

        // Patient::factory(200)->create();
    }
}
