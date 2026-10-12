<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test templates gallery page renders correctly.
     */
    public function test_templates_catalog_page_renders(): void
    {
        $response = $this->get('/templates');

        $response->assertStatus(200);
        $response->assertSee('DAFTAR TEMPLATE FORMASI CV');
        $response->assertSee('Modern Indigo');
        $response->assertSee('Classic Executive');
        $response->assertSee('Minimalist Clean');
        $response->assertSee('Buat Akun');
    }

    /**
     * Test FAQ page renders questions and categories.
     */
    public function test_faq_page_renders(): void
    {
        $response = $this->get('/faq');

        $response->assertStatus(200);
        $response->assertSee('FREQUENTLY ASKED QUESTIONS (FAQ)');
        $response->assertSee('Apa yang dimaksud dengan CV ATS Friendly?');
        $response->assertSee('Berkas format apa yang paling direkomendasikan saat melamar?');
        $response->assertSee('Apakah data pribadi saya aman dan terlindungi?');
    }

    /**
     * Test Panduan page renders instructions and tips.
     */
    public function test_panduan_page_renders(): void
    {
        $response = $this->get('/panduan');

        $response->assertStatus(200);
        $response->assertSee('PEDOMAN RESMI CV 2026');
        $response->assertSee('Dasar Penyusunan Dokumen Karir Terstandarisasi');
        $response->assertSee('Komponen Struktur Wajib dalam CV');
        $response->assertSee('Dianjurkan');
    }

    /**
     * Test Bantuan (Helpdesk) page renders form and support details.
     */
    public function test_bantuan_page_renders(): void
    {
        $response = $this->get('/bantuan');

        $response->assertStatus(200);
        $response->assertSee('PUSAT BANTUAN');
        $response->assertSee('Kirim Tiket Aduan / Pertanyaan');
        $response->assertSee('Kirim Tiket Aduan');
        $response->assertSee('helpdesk@laracv.id');
    }

    /**
     * Test Helpdesk form submission validates required fields.
     */
    public function test_bantuan_form_validation(): void
    {
        $response = $this->post('/bantuan', []);

        $response->assertSessionHasErrors(['nama', 'email', 'kategori', 'pesan']);
    }

    /**
     * Test Helpdesk form submission succeeds with valid data.
     */
    public function test_bantuan_form_submits_successfully(): void
    {
        $response = $this->post('/bantuan', [
            'nama' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'kategori' => 'Pertanyaan Teknis',
            'pesan' => 'Halo, bagaimana cara mengubah template yang sudah tersimpan?',
        ]);

        $response->assertRedirect('/bantuan');
        $response->assertSessionHas('success');
    }

    /**
     * Test that public layout navigation links to all working routes.
     */
    public function test_public_navigation_contains_all_working_links(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee(route('home'));
        $response->assertSee(route('templates'));
        $response->assertSee(route('faq'));
        $response->assertSee(route('panduan'));
        $response->assertSee(route('bantuan'));
    }
}
