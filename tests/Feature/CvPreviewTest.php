<?php

namespace Tests\Feature;

use App\Models\CvProfile;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CvPreviewTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test guest cannot access the CV preview page.
     */
    public function test_guest_is_redirected_when_accessing_cv_preview(): void
    {
        $response = $this->get('/cv-preview');

        $response->assertRedirect('/login');
    }

    /**
     * Test guest cannot download the CV PDF.
     */
    public function test_guest_is_redirected_when_downloading_pdf(): void
    {
        $response = $this->get('/cv-preview/download');

        $response->assertRedirect('/login');
    }

    /**
     * Test authenticated user can access the preview page with their CV data.
     */
    public function test_authenticated_user_can_view_cv_preview_with_complete_data(): void
    {
        $user = User::factory()->create(['name' => 'Dewi Sartika']);

        CvProfile::factory()->create([
            'user_id' => $user->id,
            'full_name' => 'Dewi Sartika, S.T.',
            'headline' => 'Senior Frontend Engineer',
            'summary' => 'Spesialis antarmuka pengguna responsif dan performa tinggi.',
        ]);

        Education::factory()->create([
            'user_id' => $user->id,
            'institution' => 'Institut Teknologi Bandung',
            'degree' => 'S1 Teknik Elektro',
            'start_year' => '2016',
            'end_year' => '2020',
        ]);

        Experience::factory()->create([
            'user_id' => $user->id,
            'company_name' => 'Tech Nusantara Inc.',
            'position' => 'Lead UI Engineer',
            'start_date' => '2021-01-01',
            'is_current' => true,
        ]);

        Skill::factory()->create([
            'user_id' => $user->id,
            'skill_name' => 'Vue.js',
            'level' => 'Mahir',
        ]);

        $response = $this->actingAs($user)->get('/cv-preview');

        $response->assertStatus(200);
        $response->assertSee('Dewi Sartika, S.T.');
        $response->assertSee('Senior Frontend Engineer');
        $response->assertSee('Institut Teknologi Bandung');
        $response->assertSee('Tech Nusantara Inc.');
        $response->assertSee('Vue.js');
    }

    /**
     * Test switching between available templates.
     */
    public function test_user_can_switch_templates(): void
    {
        $user = User::factory()->create();

        $responseModern = $this->actingAs($user)->get('/cv-preview?template=modern');
        $responseModern->assertStatus(200);
        $responseModern->assertViewHas('template', 'modern');

        $responseClassic = $this->actingAs($user)->get('/cv-preview?template=classic');
        $responseClassic->assertStatus(200);
        $responseClassic->assertViewHas('template', 'classic');

        $responseMinimal = $this->actingAs($user)->get('/cv-preview?template=minimal');
        $responseMinimal->assertStatus(200);
        $responseMinimal->assertViewHas('template', 'minimal');
    }

    /**
     * Test generating and downloading the PDF document.
     */
    public function test_user_can_download_official_cv_pdf(): void
    {
        $user = User::factory()->create(['name' => 'Budi Santoso']);

        CvProfile::factory()->create([
            'user_id' => $user->id,
            'full_name' => 'Budi Santoso',
            'headline' => 'Junior Web Developer',
        ]);

        $response = $this->actingAs($user)->get('/cv-preview/download');

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
        $this->assertStringContainsString('LaraCV_budi_santoso.pdf', $response->headers->get('content-disposition'));
    }
}
