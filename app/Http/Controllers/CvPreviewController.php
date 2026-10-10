<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CvPreviewController extends Controller
{
    /**
     * Display the live interactive CV preview.
     */
    public function show(Request $request): View
    {
        $user = $request->user()->load([
            'cvProfile',
            'education' => fn ($q) => $q->orderBy('order_index')->orderByDesc('start_year'),
            'experiences' => fn ($q) => $q->orderBy('order_index')->orderByDesc('start_date'),
            'skills' => fn ($q) => $q->orderBy('order_index')->orderBy('skill_name'),
        ]);
        $template = $request->query('template', 'modern');

        if (! in_array($template, ['modern', 'classic', 'minimal'], true)) {
            $template = 'modern';
        }

        return view('cv-preview.show', [
            'user' => $user,
            'profile' => $user->cvProfile,
            'education' => $user->education,
            'experiences' => $user->experiences,
            'skills' => $user->skills,
            'template' => $template,
        ]);
    }

    /**
     * Generate and download the official PDF document.
     */
    public function downloadPdf(Request $request): Response
    {
        $user = $request->user()->load([
            'cvProfile',
            'education' => fn ($q) => $q->orderBy('order_index')->orderByDesc('start_year'),
            'experiences' => fn ($q) => $q->orderBy('order_index')->orderByDesc('start_date'),
            'skills' => fn ($q) => $q->orderBy('order_index')->orderBy('skill_name'),
        ]);
        $profile = $user->cvProfile;
        $template = $request->query('template', 'modern');

        if (! in_array($template, ['modern', 'classic', 'minimal'], true)) {
            $template = 'modern';
        }

        $photoBase64 = null;
        if ($profile && $profile->photo && Storage::disk('public')->exists($profile->photo)) {
            $photoPath = Storage::disk('public')->path($profile->photo);
            if (file_exists($photoPath)) {
                $type = pathinfo($photoPath, PATHINFO_EXTENSION);
                $data = file_get_contents($photoPath);
                $photoBase64 = 'data:image/'.$type.';base64,'.base64_encode($data);
            }
        }

        $candidateName = $profile?->full_name ?? $user->name;
        $sanitizedName = Str::slug($candidateName, '_');
        $filename = 'LaraCV_'.$sanitizedName.'.pdf';

        $pdf = Pdf::loadView('cv-preview.pdf', [
            'user' => $user,
            'profile' => $profile,
            'photoBase64' => $photoBase64,
            'education' => $user->education,
            'experiences' => $user->experiences,
            'skills' => $user->skills,
            'template' => $template,
        ]);

        $pdf->setPaper('a4', 'portrait');

        return $pdf->download($filename);
    }
}
