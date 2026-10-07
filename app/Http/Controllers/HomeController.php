<?php

namespace App\Http\Controllers;

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
}
