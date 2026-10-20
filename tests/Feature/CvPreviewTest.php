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

        foreach (['modern', 'classic', 'minimal'] as $tpl) {
            $response = $this->actingAs($user)->get('/cv-preview/download?template='.$tpl);

            $response->assertStatus(200);
            $response->assertHeader('content-type', 'application/pdf');
            $this->assertStringContainsString('LaraCV_budi_santoso.pdf', $response->headers->get('content-disposition'));
        }
    }

    /**
     * Test that section visibility toggles are respected in preview across all templates.
     */
    public function test_section_visibility_toggles_are_respected_across_templates(): void
    {
        $user = User::factory()->create();

        CvProfile::factory()->create([
            'user_id' => $user->id,
            'full_name' => 'Aditya Pratama',
            'show_experience' => false,
            'show_education' => false,
            'show_skills' => false,
        ]);

        Experience::factory()->create([
            'user_id' => $user->id,
            'position' => 'Senior Backend Engineer',
            'company_name' => 'PT Karya Cipta',
        ]);

        Education::factory()->create([
            'user_id' => $user->id,
            'institution' => 'Universitas Indonesia',
            'degree' => 'S1 Ilmu Komputer',
        ]);

        Skill::factory()->create([
            'user_id' => $user->id,
            'skill_name' => 'Laravel PHP',
        ]);

        foreach (['modern', 'classic', 'minimal'] as $tpl) {
            $response = $this->actingAs($user)->get('/cv-preview?template='.$tpl);
            $response->assertOk();
            $response->assertDontSee('PT Karya Cipta');
            $response->assertDontSee('Universitas Indonesia');
            $response->assertDontSee('Laravel PHP');
        }
    }

    /**
     * Test preview renders aligned section headings and official platform footer.
     */
    public function test_preview_renders_aligned_section_headings_and_footer(): void
    {
        $user = User::factory()->create();

        CvProfile::factory()->create([
            'user_id' => $user->id,
            'full_name' => 'Rina Wijaya',
            'summary' => 'Profesional manajemen proyek berpengalaman.',
            'show_experience' => true,
            'show_education' => true,
            'show_skills' => true,
        ]);

        Experience::factory()->create([
            'user_id' => $user->id,
            'position' => 'Project Lead',
            'company_name' => 'Solusi Nusantara',
        ]);

        Education::factory()->create([
            'user_id' => $user->id,
            'institution' => 'Universitas Gadjah Mada',
            'degree' => 'S1 Manajemen',
        ]);

        Skill::factory()->create([
            'user_id' => $user->id,
            'skill_name' => 'Scrum Master',
        ]);

        // Modern
        $responseModern = $this->actingAs($user)->get('/cv-preview?template=modern');
        $responseModern->assertOk();
        $responseModern->assertSee('Ringkasan Profesional');
        $responseModern->assertSee('Pengalaman Kerja');
        $responseModern->assertSee('Riwayat Pendidikan');
        $responseModern->assertSee('Keahlian &amp; Kompetensi', false);
        $responseModern->assertSee('Dihasilkan secara resmi melalui LaraCV (Online CV Builder Platform)');

        // Classic
        $responseClassic = $this->actingAs($user)->get('/cv-preview?template=classic');
        $responseClassic->assertOk();
        $responseClassic->assertSee('PROFIL SINGKAT');
        $responseClassic->assertSee('PENGALAMAN KERJA');
        $responseClassic->assertSee('PENDIDIKAN');
        $responseClassic->assertSee('KEAHLIAN');
        $responseClassic->assertSee('Dihasilkan secara resmi melalui LaraCV (Online CV Builder Platform)');

        // Minimal
        $responseMinimal = $this->actingAs($user)->get('/cv-preview?template=minimal');
        $responseMinimal->assertOk();
        $responseMinimal->assertSee('TENTANG');
        $responseMinimal->assertSee('PENGALAMAN');
        $responseMinimal->assertSee('PENDIDIKAN');
        $responseMinimal->assertSee('KEAHLIAN');
        $responseMinimal->assertSee('Dihasilkan secara resmi melalui LaraCV (Online CV Builder Platform)');
    }

    /**
     * Test public CV URL renders aligned templates matching PDF output.
     */
    public function test_public_cv_renders_aligned_templates(): void
    {
        $user = User::factory()->create();

        $profile = CvProfile::factory()->create([
            'user_id' => $user->id,
            'full_name' => 'Maya Kartika',
            'summary' => 'Product designer specializing in accessible design systems.',
            'slug' => 'maya-kartika-cv',
            'show_experience' => true,
            'show_education' => true,
            'show_skills' => true,
        ]);

        Experience::factory()->create([
            'user_id' => $user->id,
            'position' => 'Design System Lead',
            'company_name' => 'Studio Kreatif',
        ]);

        Education::factory()->create([
            'user_id' => $user->id,
            'institution' => 'Institut Kesenian Jakarta',
            'degree' => 'S1 Desain Komunikasi Visual',
        ]);

        Skill::factory()->create([
            'user_id' => $user->id,
            'skill_name' => 'Figma Design Tokens',
        ]);

        $response = $this->get('/cv/'.$profile->slug.'?template=modern');
        $response->assertOk();
        $response->assertSee('Maya Kartika');
        $response->assertSee('Ringkasan Profesional');
        $response->assertSee('Pengalaman Kerja');
        $response->assertSee('Riwayat Pendidikan');
        $response->assertSee('Keahlian &amp; Kompetensi', false);
        $response->assertSee('Dihasilkan secara resmi melalui LaraCV (Online CV Builder Platform)');
    }
}
