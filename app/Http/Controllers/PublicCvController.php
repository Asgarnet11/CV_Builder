<?php

namespace App\Http\Controllers;

use App\Models\CvProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PublicCvController extends Controller
{
    /**
     * Display the public CV.
     */
    public function show(Request $request, $slug)
    {
        $profile = CvProfile::where('slug', $slug)->firstOrFail();

        $template = $request->query('template', 'modern');
        if (! in_array($template, ['modern', 'classic', 'minimal'], true)) {
            $template = 'modern';
        }

        // Cache the output for 1 hour, key depends on slug and template
        $cacheKey = "cv_public_{$slug}_{$template}";

        return Cache::remember($cacheKey, 3600, function () use ($profile, $template) {
            $user = $profile->user->load([
                'education' => fn ($q) => $q->orderBy('order_index')->orderByDesc('start_year'),
                'experiences' => fn ($q) => $q->orderBy('order_index')->orderByDesc('start_date'),
                'skills' => fn ($q) => $q->orderBy('order_index')->orderBy('skill_name'),
            ]);

            return view('cv-preview.public', [
                'user' => $user,
                'profile' => $profile,
                'education' => $user->education,
                'experiences' => $user->experiences,
                'skills' => $user->skills,
                'template' => $template,
            ])->render();
        });
    }
}
