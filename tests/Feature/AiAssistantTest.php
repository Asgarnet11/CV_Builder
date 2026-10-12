<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AiAssistantTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test guest cannot access AI summary generator.
     */
    public function test_guest_cannot_access_ai_summary(): void
    {
        $response = $this->postJson('/ai/generate-summary', [
            'headline' => 'Senior Backend Developer',
        ]);

        $response->assertStatus(401);
    }

    /**
     * Test authenticated user can generate summary in Indonesian and English.
     */
    public function test_authenticated_user_can_generate_summary(): void
    {
        $user = User::factory()->create();

        // Indonesian test
        $responseId = $this->actingAs($user)->postJson('/ai/generate-summary', [
            'headline' => 'Fullstack Laravel Developer',
            'skills' => 'PHP, Laravel, Vue.js, Tailwind CSS',
            'tone' => 'professional',
            'lang' => 'id',
        ]);

        $responseId->assertStatus(200);
        $responseId->assertJsonStructure(['status', 'summary']);
        $this->assertEquals('success', $responseId->json('status'));
        $this->assertNotEmpty($responseId->json('summary'));
        $this->assertStringContainsString('Fullstack Laravel Developer', $responseId->json('summary'));

        // English test
        $responseEn = $this->actingAs($user)->postJson('/ai/generate-summary', [
            'headline' => 'Fullstack Laravel Developer',
            'skills' => 'PHP, Laravel, Vue.js, Tailwind CSS',
            'tone' => 'professional',
            'lang' => 'en',
        ]);

        $responseEn->assertStatus(200);
        $this->assertStringContainsString('Fullstack Laravel Developer', $responseEn->json('summary'));
    }

    /**
     * Test authenticated user can generate achievement bullet points.
     */
    public function test_authenticated_user_can_generate_bullet_points(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/ai/generate-bullet-points', [
            'position' => 'Senior Software Engineer',
            'company_name' => 'PT Teknologi Unggul',
            'keywords' => 'High performance, Scalability, Database indexing',
            'lang' => 'id',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['status', 'bullet_points', 'html']);
        $this->assertEquals('success', $response->json('status'));
        $this->assertCount(4, $response->json('bullet_points'));
        $this->assertStringContainsString('<ul>', $response->json('html'));
        $this->assertStringContainsString('<li>', $response->json('html'));
    }

    /**
     * Test validation failure when position is missing for bullet points.
     */
    public function test_bullet_points_requires_position(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/ai/generate-bullet-points', []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['position']);
    }
}
