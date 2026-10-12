<?php

namespace Tests\Feature;

use App\Models\CvProfile;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CvExportFormatsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_download_word_or_json_cv(): void
    {
        $responseWord = $this->get('/cv-preview/download-word');
        $responseWord->assertRedirect('/login');

        $responseJson = $this->get('/cv-preview/download-json');
        $responseJson->assertRedirect('/login');
    }

    public function test_authenticated_user_can_download_word_cv(): void
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
        ]);

        CvProfile::factory()->create([
            'user_id' => $user->id,
            'full_name' => 'Johnathan Doe',
            'headline' => 'Senior Cloud Architect',
            'summary' => 'Experienced architect building scalable systems.',
        ]);

        Experience::factory()->create([
            'user_id' => $user->id,
            'company_name' => 'Cloud Inc',
            'position' => 'Lead DevOps',
        ]);

        Education::factory()->create([
            'user_id' => $user->id,
            'institution' => 'MIT',
            'degree' => 'Bachelor of Science',
        ]);

        Skill::factory()->create([
            'user_id' => $user->id,
            'skill_name' => 'Kubernetes',
        ]);

        $response = $this->actingAs($user)->get('/cv-preview/download-word');

        $response->assertOk();
        $this->assertStringContainsString('application/msword', $response->headers->get('Content-Type') ?? '');
        $this->assertStringContainsString('LaraCV_johnathan_doe.doc', $response->headers->get('Content-Disposition') ?? '');
        $this->assertStringContainsString('Johnathan Doe', $response->getContent() ?: '');
        $this->assertStringContainsString('Cloud Inc', $response->getContent() ?: '');
        $this->assertStringContainsString('Kubernetes', $response->getContent() ?: '');
    }

    public function test_authenticated_user_can_download_json_resume(): void
    {
        $user = User::factory()->create([
            'name' => 'Jane Smith',
        ]);

        CvProfile::factory()->create([
            'user_id' => $user->id,
            'full_name' => 'Jane Smith',
            'headline' => 'Product Designer',
            'linkedin_url' => 'https://linkedin.com/in/janesmith',
        ]);

        Experience::factory()->create([
            'user_id' => $user->id,
            'company_name' => 'Design Studio',
            'position' => 'Lead UI Designer',
        ]);

        Skill::factory()->create([
            'user_id' => $user->id,
            'skill_name' => 'Figma',
        ]);

        $response = $this->actingAs($user)->get('/cv-preview/download-json');

        $response->assertOk();
        $this->assertStringContainsString('application/json', $response->headers->get('Content-Type') ?? '');
        $this->assertStringContainsString('LaraCV_jane_smith.json', $response->headers->get('Content-Disposition') ?? '');

        $json = $response->json();
        $this->assertIsArray($json);
        $this->assertArrayHasKey('basics', $json);
        $this->assertEquals('Jane Smith', $json['basics']['name']);
        $this->assertEquals('Product Designer', $json['basics']['label']);
        $this->assertArrayHasKey('work', $json);
        $this->assertNotEmpty($json['work']);
        $this->assertEquals('Design Studio', $json['work'][0]['name']);
        $this->assertArrayHasKey('skills', $json);
        $this->assertNotEmpty($json['skills']);
        $this->assertEquals('Figma', $json['skills'][0]['name']);
    }
}
