<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fullname' => fake()->name(),
            'nickname' => 'Fake Nickname',
            'birthday' => fake()->date(),
            'user_id' => rand(2, 3),
            'genre' => ['F', 'M'][rand(0,1)],
            'nhc' => rand(0,10000000)
        ];
    }
}
