<?php

namespace App\Http\Controllers;

use App\Http\Requests\AiGenerateExperienceRequest;
use App\Http\Requests\AiGenerateSummaryRequest;
use App\Services\AiResumeService;
use Illuminate\Http\JsonResponse;

class AiAssistantController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected AiResumeService $aiResumeService
    ) {}

    /**
     * Generate an AI-crafted professional summary.
     */
    public function generateSummary(AiGenerateSummaryRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $summary = $this->aiResumeService->generateSummary($validated);

        return response()->json([
            'status' => 'success',
            'summary' => $summary,
        ]);
    }

    /**
     * Generate AI-crafted bullet points for an experience item.
     */
    public function generateExperience(AiGenerateExperienceRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $bullets = $this->aiResumeService->generateExperienceBullets($validated);

        return response()->json([
            'status' => 'success',
            'bullets' => $bullets,
        ]);
    }
}
