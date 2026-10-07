<?php

namespace Database\Seeders;

use App\Models\CvProfile;
use App\Models\User;
use Illuminate\Database\Seeder;

class CvProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        if ($user && ! $user->cvProfile) {
            CvProfile::factory()->create([
                'user_id' => $user->id,
                'full_name' => $user->name,
                'email_cv' => $user->email,
            ]);
        }
    }
}
