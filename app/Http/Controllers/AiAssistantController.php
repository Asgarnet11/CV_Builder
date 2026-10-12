<?php

namespace App\Http\Controllers;

use App\Services\AiResumeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AiAssistantController extends Controller
{
    public function __construct(
        protected AiResumeService $aiResumeService
    ) {}

    /**
     * Generate professional career summary.
     */
    public function generateSummary(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'headline' => ['nullable', 'string', 'max:255'],
            'skills' => ['nullable', 'string', 'max:500'],
            'tone' => ['nullable', 'string', 'in:professional,energetic,executive,creative'],
            'lang' => ['nullable', 'string', 'in:id,en'],
        ]);

        $summary = $this->aiResumeService->generateSummary(
            headline: $validated['headline'] ?? null,
            skills: $validated['skills'] ?? null,
            tone: $validated['tone'] ?? 'professional',
            lang: $validated['lang'] ?? 'id',
        );

        return response()->json([
            'status' => 'success',
            'summary' => $summary,
        ]);
    }

    /**
     * Generate achievement bullet points for work experience.
     */
    public function generateBulletPoints(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'position' => ['required', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'keywords' => ['nullable', 'string', 'max:500'],
            'lang' => ['nullable', 'string', 'in:id,en'],
        ]);

        $bullets = $this->aiResumeService->generateBulletPoints(
            position: $validated['position'],
            companyName: $validated['company_name'] ?? null,
            keywords: $validated['keywords'] ?? null,
            lang: $validated['lang'] ?? 'id',
        );

        // Format as HTML unordered list suitable for Trix / rich text editors
        $html = '<ul>'.implode('', array_map(fn ($b) => "<li>{$b}</li>", $bullets)).'</ul>';

        return response()->json([
            'status' => 'success',
            'bullet_points' => $bullets,
            'html' => $html,
        ]);
    }
}
