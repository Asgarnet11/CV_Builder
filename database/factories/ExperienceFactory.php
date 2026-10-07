<?php

namespace Database\Factories;

use App\Models\Experience;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('-4 years', '-1 years');

        return [
            'user_id' => User::factory(),
            'company_name' => fake()->company(),
            'position' => fake()->jobTitle(),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => fake()->boolean(70) ? fake()->dateTimeBetween($startDate, 'now')->format('Y-m-d') : null,
            'is_current' => fake()->boolean(30),
            'description' => fake()->paragraph(),
        ];
    }
}
