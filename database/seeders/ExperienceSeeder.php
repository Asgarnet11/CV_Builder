<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\User;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        if ($user && $user->experiences()->count() === 0) {
            Experience::factory()->count(2)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
