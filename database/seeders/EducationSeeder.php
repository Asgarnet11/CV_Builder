<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\User;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        if ($user && $user->education()->count() === 0) {
            Education::factory()->count(2)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
