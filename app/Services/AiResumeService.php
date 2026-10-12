<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiResumeService
{
    /**
     * Generate a tailored professional summary.
     *
     * @param  array{
     *     role: string,
     *     experience_level?: ?string,
     *     skills?: ?string,
     *     tone?: ?string,
     *     language?: ?string
     * }  $params
     */
    public function generateSummary(array $params): string
    {
        $role = trim($params['role'] ?? '');
        $level = $params['experience_level'] ?? 'mid';
        $skills = trim($params['skills'] ?? '');
        $tone = $params['tone'] ?? 'professional';
        $lang = $params['language'] ?? 'id';

        $prompt = $this->buildSummaryPrompt($role, $level, $skills, $tone, $lang);

        $llmResult = $this->queryLlm($prompt);
        if ($llmResult !== null) {
            return trim($llmResult);
        }

        return $this->fallbackSummary($role, $level, $skills, $tone, $lang);
    }

    /**
     * Generate impactful bullet points for work experience.
     *
     * @param  array{
     *     job_title: string,
     *     company?: ?string,
     *     skills?: ?string,
     *     language?: ?string
     * }  $params
     * @return array<int, string>
     */
    public function generateExperienceBullets(array $params): array
    {
        $jobTitle = trim($params['job_title'] ?? '');
        $company = trim($params['company'] ?? '');
        $skills = trim($params['skills'] ?? '');
        $lang = $params['language'] ?? 'id';

        $prompt = $this->buildExperiencePrompt($jobTitle, $company, $skills, $lang);

        $llmResult = $this->queryLlm($prompt);
        if ($llmResult !== null) {
            $lines = array_filter(
                array_map('trim', explode("\n", $llmResult)),
                fn ($line) => ! empty($line)
            );
            $cleanBullets = [];
            foreach ($lines as $line) {
                $cleanBullets[] = ltrim($line, "-*• \t\n\r\0\x0B");
            }
            if (! empty($cleanBullets)) {
                return array_values($cleanBullets);
            }
        }

        return $this->fallbackExperienceBullets($jobTitle, $company, $skills, $lang);
    }

    /**
     * Build prompt for professional summary.
     */
    protected function buildSummaryPrompt(string $role, string $level, string $skills, string $tone, string $lang): string
    {
        $languageName = $lang === 'en' ? 'English' : 'Indonesian';

        return "Write a high-impact, professional resume summary (3-4 sentences) in {$languageName} for a {$role}.
Level: {$level}.
Key Skills: {$skills}.
Tone: {$tone}.
Do not include any greeting, preamble, or markdown formatting, output just the plain text paragraph.";
    }

    /**
     * Build prompt for work experience bullets.
     */
    protected function buildExperiencePrompt(string $jobTitle, string $company, string $skills, string $lang): string
    {
        $languageName = $lang === 'en' ? 'English' : 'Indonesian';
        $companyPart = $company !== '' ? " at {$company}" : '';

        return "Write 3-4 impactful resume bullet points in {$languageName} using the STAR method (Action Verb + Task + Measurable Result) for the role: {$jobTitle}{$companyPart}.
Key Skills: {$skills}.
Format: Each bullet point on a new line starting with a dash (-). No introductory or concluding remarks.";
    }

    /**
     * Query LLM via Gemini or OpenAI if configured.
     */
    protected function queryLlm(string $prompt): ?string
    {
        $geminiKey = config('services.gemini.api_key');
        if (! empty($geminiKey)) {
            try {
                $response = Http::timeout(10)->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$geminiKey}", [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt],
                            ],
                        ],
                    ],
                ]);

                if ($response->successful()) {
                    $text = $response->json('candidates.0.content.parts.0.text');
                    if (! empty($text)) {
                        return trim($text);
                    }
                }
            } catch (\Throwable $e) {
                Log::warning('Gemini API call failed: '.$e->getMessage());
            }
        }

        $openaiKey = config('services.openai.api_key');
        if (! empty($openaiKey)) {
            try {
                $response = Http::timeout(10)->withToken($openaiKey)->post('https://api.openai.com/v1/chat/completions', [
                    'model' => 'gpt-4o-mini',
                    'messages' => [
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'temperature' => 0.7,
                ]);

                if ($response->successful()) {
                    $text = $response->json('choices.0.message.content');
                    if (! empty($text)) {
                        return trim($text);
                    }
                }
            } catch (\Throwable $e) {
                Log::warning('OpenAI API call failed: '.$e->getMessage());
            }
        }

        return null;
    }

    /**
     * High quality fallback summary generator.
     */
    protected function fallbackSummary(string $role, string $level, string $skills, string $tone, string $lang): string
    {
        $skillList = ! empty($skills) ? $skills : ($lang === 'en' ? 'problem solving, team collaboration, and modern tools' : 'pemecahan masalah, kolaborasi tim, dan teknologi modern');

        if ($lang === 'en') {
            if ($level === 'fresh_graduate' || $level === 'entry') {
                return "Enthusiastic and driven {$role} with a solid academic foundation and hands-on project experience in {$skillList}. Eager to apply problem-solving capabilities and modern best practices to contribute effectively to team goals and business outcomes.";
            }

            if ($level === 'senior' || $tone === 'executive') {
                return "Accomplished {$role} with extensive experience leading cross-functional initiatives and driving technical excellence. Proven track record in {$skillList}, optimizing workflows, and delivering high-value solutions that exceed organizational objectives.";
            }

            return "Results-oriented {$role} with proven expertise in {$skillList}. Adept at designing and implementing efficient workflows, collaborating with cross-functional teams, and consistently delivering high-quality deliverables that drive business growth.";
        }

        // Indonesian fallback
        if ($level === 'fresh_graduate' || $level === 'entry') {
            return "Lulusan yang penuh dedikasi dan berorientasi pada hasil dengan fokus kuat pada bidang {$role}. Memiliki pemahaman mendalam serta pengalaman praktik dalam {$skillList}, siap berkontribusi secara proaktif dalam lingkungan kerja dinamis serta memecahkan tantangan bisnis.";
        }

        if ($level === 'senior' || $tone === 'executive') {
            return "Profesional {$role} berpengalaman dengan rekam jejak sukses dalam memimpin inisiatif strategis dan mengoptimalkan performa tim. Ahli dalam {$skillList}, terbukti mampu mendorong efisiensi operasional dan memberikan solusi berdampak tinggi bagi organisasi.";
        }

        return "{$role} berdedikasi dan berorientasi pada pencapaian dengan keahlian teruji di bidang {$skillList}. Memiliki komitmen tinggi terhadap kualitas kerja, kolaborasi tim yang solid, serta kemampuan adaptasi cepat dalam menghadirkan solusi inovatif untuk kemajuan perusahaan.";
    }

    /**
     * High quality fallback experience bullets generator.
     *
     * @return array<int, string>
     */
    protected function fallbackExperienceBullets(string $jobTitle, string $company, string $skills, string $lang): array
    {
        $skillText = ! empty($skills) ? " memanfaatkan {$skills}" : '';
        $skillTextEn = ! empty($skills) ? " leveraging {$skills}" : '';
        $compText = ! empty($company) ? " di {$company}" : '';
        $compTextEn = ! empty($company) ? " at {$company}" : '';

        if ($lang === 'en') {
            return [
                "Spearheaded key responsibilities as {$jobTitle}{$compTextEn}, improving project efficiency and delivery timelines by 25%.",
                "Designed and implemented high-quality solutions{$skillTextEn}, ensuring alignment with industry best practices and stakeholder requirements.",
                'Collaborated closely with cross-functional team members to streamline workflows, troubleshoot complex issues, and enhance overall output quality.',
                'Analyzed existing processes, identified bottlenecks, and introduced optimizations that consistently drove measurable performance gains.',
            ];
        }

        return [
            "Memimpin dan mengeksekusi tanggung jawab utama sebagai {$jobTitle}{$compText}, berhasil meningkatkan efisiensi alur kerja dan ketepatan waktu penyelesaian proyek hingga 25%.",
            "Merancang serta menerapkan solusi operasional dan teknis berkualitas tinggi{$skillText}, memastikan kepatuhan terhadap standar terbaik dan kebutuhan pemangku kepentingan.",
            'Berkolaborasi erat bersama tim lintas fungsi untuk mempercepat integrasi proses, menyelesaikan permasalahan secara efektif, serta mempertahankan standar mutu yang tinggi.',
            'Melakukan analisis berkala terhadap performa kerja dan menginisiasi perbaikan berkelanjutan yang memberikan dampak positif terukur bagi efektivitas tim.',
        ];
    }
}
