<?php

namespace Tests\Feature;

use App\Models\CvProfile;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class PublicCvTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test public CV is accessible by any guest via valid slug.
     */
    public function test_guest_can_view_public_cv_by_slug(): void
    {
        $user = User::factory()->create();

        $profile = CvProfile::factory()->create([
            'user_id' => $user->id,
            'full_name' => 'Aditya Pratama',
            'headline' => 'Cloud Solutions Architect',
            'slug' => 'aditya-pratama-cloud',
            'summary' => 'Berpengalaman merancang arsitektur cloud skala besar.',
        ]);

        Education::factory()->create([
            'user_id' => $user->id,
            'institution' => 'Universitas Indonesia',
            'degree' => 'S1 Ilmu Komputer',
        ]);

        Experience::factory()->create([
            'user_id' => $user->id,
            'company_name' => 'Nusantara Cloud Services',
            'position' => 'Senior DevOps Engineer',
            'is_current' => true,
        ]);

        Skill::factory()->create([
            'user_id' => $user->id,
            'skill_name' => 'Kubernetes',
            'level' => 'Mahir',
        ]);

        $response = $this->get('/cv/aditya-pratama-cloud');

        $response->assertStatus(200);
        $response->assertSee('Aditya Pratama');
        $response->assertSee('Cloud Solutions Architect');
        $response->assertSee('Universitas Indonesia');
        $response->assertSee('Nusantara Cloud Services');
        $response->assertSee('Kubernetes');
    }

    /**
     * Test guest receives 404 for nonexistent slug.
     */
    public function test_nonexistent_slug_returns_404(): void
    {
        $response = $this->get('/cv/non-existent-user-slug-12345');

        $response->assertStatus(404);
    }

    /**
     * Test public CV supports different templates.
     */
    public function test_public_cv_supports_template_parameter(): void
    {
        $user = User::factory()->create();
        CvProfile::factory()->create([
            'user_id' => $user->id,
            'full_name' => 'Citra Lestari',
            'slug' => 'citra-lestari',
        ]);

        $responseModern = $this->get('/cv/citra-lestari?template=modern');
        $responseModern->assertStatus(200);

        $responseClassic = $this->get('/cv/citra-lestari?template=classic');
        $responseClassic->assertStatus(200);

        $responseMinimal = $this->get('/cv/citra-lestari?template=minimal');
        $responseMinimal->assertStatus(200);
    }

    /**
     * Test public CV caching and automatic cache clearing when profile is updated.
     */
    public function test_public_cv_caching_and_invalidation(): void
    {
        Cache::flush();

        $user = User::factory()->create();
        $profile = CvProfile::factory()->create([
            'user_id' => $user->id,
            'full_name' => 'Eko Kurniawan',
            'slug' => 'eko-kurniawan',
            'headline' => 'Junior Developer',
        ]);

        // First hit caches it
        $this->get('/cv/eko-kurniawan?template=modern')->assertStatus(200);
        $this->assertTrue(Cache::has('cv_public_eko-kurniawan_modern'));

        // Update profile - ClearsCvCache trait should invalidate cache
        $profile->update([
            'headline' => 'Senior Software Architect',
        ]);

        $this->assertFalse(Cache::has('cv_public_eko-kurniawan_modern'));
    }
}
