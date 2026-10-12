<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the landing page with dynamic hero heading.
     */
    public function index(): View
    {
        $heroHeading = 'Bangun CV Profesional Anda dalam Hitungan Menit';

        return view('home', [
            'heroHeading' => $heroHeading,
        ]);
    }

    /**
     * Display the CV templates gallery page.
     */
    public function templates(): View
    {
        return view('pages.templates');
    }

    /**
     * Display the FAQ page.
     */
    public function faq(): View
    {
        return view('pages.faq');
    }

    /**
     * Display the guidelines and legal basis page.
     */
    public function panduan(): View
    {
        return view('pages.panduan');
    }

    /**
     * Display the helpdesk and support page.
     */
    public function bantuan(): View
    {
        return view('pages.bantuan');
    }

    /**
     * Handle support ticket submission.
     */
    public function submitBantuan(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'kategori' => ['required', 'string', 'max:100'],
            'pesan' => ['required', 'string', 'max:2000'],
        ]);

        return redirect()->route('bantuan')
            ->with('status', 'Pesan Anda telah berhasil dikirim ke Tim Bantuan LaraCV. Kami akan segera menghubungi Anda.')
            ->with('success', 'Tiket bantuan berhasil dikirim.');
    }
}
