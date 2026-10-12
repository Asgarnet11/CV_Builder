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

        $pdf = Pdf::loadView('cv-preview.pdf-'.$template, [
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

    /**
     * Generate and download Word (.doc) compatible document.
     */
    public function downloadWord(Request $request): Response
    {
        $user = $request->user()->load([
            'cvProfile',
            'education' => fn ($q) => $q->orderBy('order_index')->orderByDesc('start_year'),
            'experiences' => fn ($q) => $q->orderBy('order_index')->orderByDesc('start_date'),
            'skills' => fn ($q) => $q->orderBy('order_index')->orderBy('skill_name'),
        ]);
        $profile = $user->cvProfile;

        $candidateName = $profile?->full_name ?? $user->name;
        $sanitizedName = Str::slug($candidateName, '_');
        $filename = 'LaraCV_'.$sanitizedName.'.doc';

        $content = view('cv-preview.word', [
            'user' => $user,
            'profile' => $profile,
            'education' => $user->education,
            'experiences' => $user->experiences,
            'skills' => $user->skills,
        ])->render();

        return response($content, 200, [
            'Content-Type' => 'application/msword',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    /**
     * Export CV data in standardized JSON Resume format.
     */
    public function downloadJson(Request $request): Response
    {
        $user = $request->user()->load([
            'cvProfile',
            'education' => fn ($q) => $q->orderBy('order_index')->orderByDesc('start_year'),
            'experiences' => fn ($q) => $q->orderBy('order_index')->orderByDesc('start_date'),
            'skills' => fn ($q) => $q->orderBy('order_index')->orderBy('skill_name'),
        ]);
        $profile = $user->cvProfile;

        $candidateName = $profile?->full_name ?? $user->name;
        $sanitizedName = Str::slug($candidateName, '_');
        $filename = 'LaraCV_'.$sanitizedName.'.json';

        $profiles = [];
        if ($profile?->linkedin_url) {
            $profiles[] = [
                'network' => 'LinkedIn',
                'url' => $profile->linkedin_url,
            ];
        }
        if ($profile?->portfolio_url) {
            $profiles[] = [
                'network' => 'Portfolio/GitHub',
                'url' => $profile->portfolio_url,
            ];
        }

        $work = [];
        foreach ($user->experiences as $exp) {
            $work[] = [
                'name' => $exp->company_name,
                'position' => $exp->position,
                'startDate' => $exp->start_date ? $exp->start_date->format('Y-m-d') : null,
                'endDate' => $exp->is_current ? null : ($exp->end_date ? $exp->end_date->format('Y-m-d') : null),
                'summary' => strip_tags($exp->description ?? ''),
            ];
        }

        $education = [];
        foreach ($user->education as $edu) {
            $education[] = [
                'institution' => $edu->institution,
                'area' => $edu->description ?? '',
                'studyType' => $edu->degree,
                'startDate' => (string) $edu->start_year,
                'endDate' => (string) $edu->end_year,
            ];
        }

        $skills = [];
        foreach ($user->skills as $skill) {
            $skills[] = [
                'name' => $skill->skill_name,
                'level' => $skill->level,
            ];
        }

        $data = [
            '$schema' => 'https://raw.githubusercontent.com/jsonresume/resume-schema/v1.0.0/schema.json',
            'basics' => [
                'name' => $candidateName,
                'label' => $profile?->headline ?? '',
                'email' => $profile?->email_cv ?? $user->email,
                'phone' => $profile?->phone ?? '',
                'url' => $profile?->portfolio_url ?? '',
                'summary' => $profile?->summary ?? '',
                'location' => [
                    'address' => $profile?->address ?? '',
                ],
                'profiles' => $profiles,
            ],
            'work' => $work,
            'education' => $education,
            'skills' => $skills,
        ];

        return response((string) json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE), 200, [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ]);
    }
}
