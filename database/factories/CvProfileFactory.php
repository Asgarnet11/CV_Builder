<?php

namespace Database\Factories;

use App\Models\CvProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CvProfile>
 */
class CvProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'full_name' => fake()->name(),
            'headline' => fake()->jobTitle(),
            'photo' => null,
            'phone' => fake()->phoneNumber(),
            'email_cv' => fake()->safeEmail(),
            'address' => fake()->address(),
            'summary' => fake()->paragraph(),
            'linkedin_url' => 'https://linkedin.com/in/'.fake()->userName(),
            'portfolio_url' => fake()->url(),
        ];
    }
}
