<?php

namespace Database\Factories;

use App\Models\Education;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Education>
 */
class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startYear = fake()->numberBetween(2015, 2022);

        return [
            'user_id' => User::factory(),
            'institution' => fake()->company().' University',
            'degree' => fake()->randomElement(['S1 Teknik Informatika', 'S1 Sistem Informasi', 'D3 Manajemen Informatika', 'SMK Rekayasa Perangkat Lunak']),
            'start_year' => (string) $startYear,
            'end_year' => (string) ($startYear + 4),
            'description' => fake()->sentence(),
        ];
    }
}
