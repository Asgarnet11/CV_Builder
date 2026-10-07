<?php

namespace Tests\Feature;

use App\Models\CvProfile;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RelationCascadeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * AC-06: Deleting a user in users table automatically removes related records
     * in cv_profiles, education, experiences, and skills via foreign key cascade delete.
     */
    public function test_deleting_user_cascades_and_removes_all_related_cv_records(): void
    {
        $user = User::factory()->create();

        // Create related entities
        $cvProfile = CvProfile::factory()->create(['user_id' => $user->id]);
        $education = Education::factory()->create(['user_id' => $user->id]);
        $experience = Experience::factory()->create(['user_id' => $user->id]);
        $skill = Skill::factory()->create(['user_id' => $user->id]);

        // Verify entities exist
        $this->assertDatabaseHas('cv_profiles', ['id' => $cvProfile->id, 'user_id' => $user->id]);
        $this->assertDatabaseHas('education', ['id' => $education->id, 'user_id' => $user->id]);
        $this->assertDatabaseHas('experiences', ['id' => $experience->id, 'user_id' => $user->id]);
        $this->assertDatabaseHas('skills', ['id' => $skill->id, 'user_id' => $user->id]);

        // Delete user
        $user->delete();

        // Verify cascade deletion
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        $this->assertDatabaseMissing('cv_profiles', ['id' => $cvProfile->id]);
        $this->assertDatabaseMissing('education', ['id' => $education->id]);
        $this->assertDatabaseMissing('experiences', ['id' => $experience->id]);
        $this->assertDatabaseMissing('skills', ['id' => $skill->id]);
    }
}
