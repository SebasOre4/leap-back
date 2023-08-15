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
            'default_config' => '{"name": "Rompecabezas","map": "BoatMap","config": {"dificulty": [{"label": "Facil","val": "Facil"},{"label": "Normal","val": "Normal"},{"label": "Dificil","val": "Dificil"}],"music": [{"label": "Si","val": true},{"label": "No","val": false}],"time": [{"label": "1 minutos","val": 1},{"label": "1.5 minutos","val": 1.5},{"label": "2 minutos","val": 2}],"distractors": [{"label": "0 distractores","val": 0},{"label": "1 distractores","val": 1},{"label": "2 distractores","val": 2},{"label": "3 distractores","val": 3}]}}',
        ]);

        Game::create([
            'name' => 'FruitNinja',
            'default_config' => '{"name": "FruitNinja","map": "CascadeMap","config": {"dificulty": [{"label": "Facil","val": "Facil"},{"label": "Normal","val": "Normal"},{"label": "Dificil","val": "Dificil"}],"music": [{"label": "Si","val": true},{"label": "No","val": false}],"time": [{"label": "1 minutos","val": 1},{"label": "1.5 minutos","val": 1.5},{"label": "2 minutos","val": 2}],"distractors": [{"label": "0 distractores","val": 0},{"label": "1 distractores","val": 1},{"label": "2 distractores","val": 2},{"label": "3 distractores","val": 3}]}}',
        ]);

        Game::create([
            'name' => 'Torre de Cubos',
            'default_config' => '{"name": "Torre de Cubos","map": "MountainMap","config": {"dificulty": [{"label": "Facil","val": "Facil"},{"label": "Normal","val": "Normal"},{"label": "Dificil","val": "Dificil"}],"music": [{"label": "Si","val": true},{"label": "No","val": false}],"time": [{"label": "1 minutos","val": 1},{"label": "1.5 minutos","val": 1.5},{"label": "2 minutos","val": 2}],"distractors": [{"label": "0 distractores","val": 0},{"label": "1 distractores","val": 1},{"label": "2 distractores","val": 2},{"label": "3 distractores","val": 3}]}}',
        ]);

        // Patient::factory(200)->create();
    }
}
