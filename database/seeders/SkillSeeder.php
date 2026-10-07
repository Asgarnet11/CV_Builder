<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        if ($user && $user->skills()->count() === 0) {
            Skill::factory()->count(4)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
