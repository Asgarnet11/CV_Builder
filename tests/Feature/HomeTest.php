<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the landing page renders with dynamic hero heading and guest navigation buttons.
     */
    public function test_landing_page_renders_dynamic_hero_heading_and_guest_actions(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewHas('heroHeading', 'Bangun CV Profesional Anda dalam Hitungan Menit');
        $response->assertSee('Bangun CV Profesional Anda dalam Hitungan Menit');
        $response->assertSee('Masuk');
        $response->assertSee('Daftar Gratis');
        $response->assertDontSee('Dashboard Saya');
    }

    /**
     * Test that the landing page renders contextual dashboard navigation for authenticated users.
     */
    public function test_landing_page_renders_dashboard_link_for_authenticated_users(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
        $response->assertViewHas('heroHeading');
        $response->assertSee('Dashboard Saya');
        $response->assertDontSee('Daftar Gratis');
    }
}
