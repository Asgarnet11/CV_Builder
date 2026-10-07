<?php

namespace Database\Factories;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Skill>
 */
class SkillFactory extends Factory
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
            'skill_name' => fake()->randomElement(['Laravel', 'PHP', 'JavaScript', 'Vue.js', 'Tailwind CSS', 'MySQL', 'Git', 'Docker', 'REST API', 'Figma']),
            'level' => fake()->randomElement(['Pemula', 'Menengah', 'Mahir']),
        ];
    }
}
