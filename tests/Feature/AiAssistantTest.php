<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AiAssistantTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_ai_endpoints(): void
    {
        $responseSummary = $this->postJson('/ai/generate-summary', [
            'role' => 'Laravel Developer',
        ]);
        $responseSummary->assertUnauthorized();

        $responseExperience = $this->postJson('/ai/generate-experience', [
            'job_title' => 'Software Engineer',
        ]);
        $responseExperience->assertUnauthorized();
    }

    public function test_summary_generation_requires_role(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/ai/generate-summary', []);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['role']);
    }

    public function test_authenticated_user_can_generate_summary_in_indonesian(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/ai/generate-summary', [
            'role' => 'Full Stack Developer',
            'experience_level' => 'mid',
            'skills' => 'Laravel, Vue.js, MySQL',
            'tone' => 'professional',
            'language' => 'id',
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'summary',
        ]);
        $this->assertNotEmpty($response->json('summary'));
        $this->assertStringContainsString('Full Stack Developer', $response->json('summary'));
    }

    public function test_authenticated_user_can_generate_summary_in_english(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/ai/generate-summary', [
            'role' => 'Data Analyst',
            'experience_level' => 'fresh_graduate',
            'skills' => 'Python, SQL, Tableau',
            'tone' => 'professional',
            'language' => 'en',
        ]);

        $response->assertOk();
        $this->assertNotEmpty($response->json('summary'));
        $this->assertStringContainsString('Data Analyst', $response->json('summary'));
    }

    public function test_experience_bullets_generation_requires_job_title(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/ai/generate-experience', []);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['job_title']);
    }

    public function test_authenticated_user_can_generate_experience_bullet_points(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/ai/generate-experience', [
            'job_title' => 'Backend Engineer',
            'company' => 'Acme Corp',
            'skills' => 'PHP, Redis, Docker',
            'language' => 'id',
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'bullets',
        ]);
        $bullets = $response->json('bullets');
        $this->assertIsArray($bullets);
        $this->assertNotEmpty($bullets);
        $this->assertGreaterThanOrEqual(3, count($bullets));
    }
}
