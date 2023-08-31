<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Diagnosis;
use App\Models\Treatment;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'fullname' => fake()->name(),
            'nickname' => 'Fake Nickname',
            'birthday' => fake()->dateTimeBetween('-6 years', 'now'),
            'user_id' => rand(2, 3),
            'state' => ['Internado', 'Dado de alta', 'En tratamiento SJ'][rand(0, 2)],
            'genre' => ['F', 'M'][rand(0, 1)],
            'nhc' => rand(0, 10000000),
            'created_at' => fake()->dateTimeBetween('-1 years', 'now')
        ];
    }
}
