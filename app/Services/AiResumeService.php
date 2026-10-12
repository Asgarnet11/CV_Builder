<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AiResumeService
{
    /**
     * Generate a compelling professional summary.
     */
    public function generateSummary(?string $headline, ?string $skills = null, ?string $tone = 'professional', string $lang = 'id'): string
    {
        $headline = $headline ?: 'Professional Specialist';
        $tone = $tone ?: 'professional';

        // Check if Gemini or OpenAI API keys exist
        $apiKey = config('services.gemini.api_key') ?? env('GEMINI_API_KEY');
        if ($apiKey) {
            try {
                $prompt = "Write a compelling 2-3 sentence resume professional summary in ".($lang === 'en' ? 'English' : 'Indonesian').".
                Role/Headline: {$headline}
                Skills: {$skills}
                Tone: {$tone}. Keep it punchy, impactful, and ready for a resume without greetings or quotes.";

                $response = Http::timeout(10)->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                    'contents' => [
                        ['parts' => [['text' => $prompt]]],
                    ],
                ]);

                if ($response->successful()) {
                    $text = $response->json('candidates.0.content.parts.0.text');
                    if (! empty($text)) {
                        return trim(str_replace(['"', '`'], '', $text));
                    }
                }
            } catch (\Throwable) {
                // Fallback to local intelligent template generator
            }
        }

        return $this->fallbackSummary($headline, $skills, $tone, $lang);
    }

    /**
     * Generate impactful achievement bullet points for work experience.
     *
     * @return array<int, string>
     */
    public function generateBulletPoints(string $position, ?string $companyName = null, ?string $keywords = null, string $lang = 'id'): array
    {
        $apiKey = config('services.gemini.api_key') ?? env('GEMINI_API_KEY');
        if ($apiKey) {
            try {
                $prompt = "Generate exactly 4 action-oriented, high-impact resume achievement bullet points for the position '{$position}' at '".($companyName ?: 'Company')."'.
                Keywords/Skills: {$keywords}.
                Language: ".($lang === 'en' ? 'English' : 'Indonesian').".
                Return each bullet point on a new line starting with an action verb, incorporating quantifiable impact. Do not include markdown asterisks or bullet characters.";

                $response = Http::timeout(10)->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                    'contents' => [
                        ['parts' => [['text' => $prompt]]],
                    ],
                ]);

                if ($response->successful()) {
                    $text = $response->json('candidates.0.content.parts.0.text');
                    if (! empty($text)) {
                        $lines = array_filter(array_map('trim', explode("\n", $text)));
                        $bullets = [];
                        foreach ($lines as $line) {
                            $clean = ltrim($line, "-*• \t\n\r\0\x0B");
                            if (! empty($clean)) {
                                $bullets[] = $clean;
                            }
                        }
                        if (count($bullets) >= 2) {
                            return array_slice($bullets, 0, 4);
                        }
                    }
                }
            } catch (\Throwable) {
                // Fallback to local intelligent generator
            }
        }

        return $this->fallbackBulletPoints($position, $companyName, $keywords, $lang);
    }

    /**
     * Local contextual generator for resume summaries.
     */
    protected function fallbackSummary(string $headline, ?string $skills, string $tone, string $lang): string
    {
        $roleLower = strtolower($headline);

        if ($lang === 'en') {
            if (Str::contains($roleLower, ['developer', 'engineer', 'programmer', 'tech', 'software', 'backend', 'frontend', 'fullstack'])) {
                return "Results-driven {$headline} with a solid track record in building modern, high-performance web applications. Adept at transforming complex technical challenges into scalable, user-centric software solutions".($skills ? " with expertise in {$skills}" : '').'. Committed to clean code practices, system efficiency, and continuous improvement.';
            }

            if (Str::contains($roleLower, ['design', 'ui', 'ux', 'product designer', 'creative'])) {
                return "Creative and detail-oriented {$headline} passionate about crafting intuitive, visually captivating digital user experiences. Proven ability in bridging user research with elegant interface design".($skills ? " utilizing {$skills}" : '').'. Dedicated to creating seamless product flows that delight users and drive business metrics.';
            }

            if (Str::contains($roleLower, ['manage', 'lead', 'director', 'head', 'product manager'])) {
                return "Strategic and proactive {$headline} with extensive experience spearheading cross-functional teams and accelerating project deliverables. Skilled in aligning stakeholders, optimizing operational workflows, and driving measurable company growth.";
            }

            return "Dedicated and adaptable {$headline} recognized for delivering high standards of operational excellence and innovative solutions. Possesses strong analytical problem-solving abilities".($skills ? " backed by proficiency in {$skills}" : '').', along with a demonstrated commitment to team success and ongoing professional advancement.';
        }

        // Indonesian fallback
        if (Str::contains($roleLower, ['developer', 'engineer', 'programmer', 'tech', 'software', 'backend', 'frontend', 'fullstack'])) {
            return "Tenaga profesional berdedikasi sebagai {$headline} yang berpengalaman dalam merancang dan mengembangkan aplikasi web berkinerja tinggi serta berskala besar. Terbiasa memecahkan tantangan teknis kompleks menjadi solusi digital yang andal dan ramah pengguna".($skills ? " dengan penguasaan pada {$skills}" : '').'. Berkomitmen menerapkan standar clean code, efisiensi sistem, dan kolaborasi tim yang proaktif.';
        }

        if (Str::contains($roleLower, ['design', 'ui', 'ux', 'product designer', 'creative'])) {
            return "Kreatif dan teliti sebagai {$headline} dengan komitmen mendalam untuk menghadirkan pengalaman visual digital yang memikat dan intuitif. Memiliki kemampuan solid dalam menghubungkan riset pengguna dengan rancangan antarmuka elegan".($skills ? " menggunakan {$skills}" : '').'. Berfokus pada kemudahan akses, estetika modern, dan kepuasan pengguna akhir.';
        }

        if (Str::contains($roleLower, ['manage', 'lead', 'director', 'head', 'product manager'])) {
            return "Pemimpin strategis dan visioner sebagai {$headline} yang terbukti andal dalam mengelola tim lintas fungsi dan mempercepat pencapaian target proyek. Memiliki keahlian komunikasi manajerial yang kuat, efisiensi alur kerja operasional, dan dedikasi dalam mendorong pertumbuhan bisnis yang berkelanjutan.";
        }

        return "Profesional yang dinamis dan berorientasi pada pencapaian hasil sebagai {$headline}. Memiliki rekam jejak konsisten dalam mengoptimalkan efisiensi alur kerja dan memecahkan tantangan secara inovatif".($skills ? " didukung keahlian pada {$skills}" : '').'. Siap memberikan kontribusi positif yang terukur bagi pertumbuhan organisasi.';
    }

    /**
     * Local contextual generator for bullet points.
     *
     * @return array<int, string>
     */
    protected function fallbackBulletPoints(string $position, ?string $companyName, ?string $keywords, string $lang): array
    {
        $posLower = strtolower($position);

        if ($lang === 'en') {
            if (Str::contains($posLower, ['dev', 'engineer', 'program', 'software', 'web'])) {
                return [
                    'Architected and implemented modular, maintainable features, reducing technical debt and improving system reliability.',
                    'Optimized application performance and database queries, yielding a 35% improvement in page load response times.',
                    'Partnered closely with product managers and UI/UX designers to deliver high-priority deliverables ahead of schedule.',
                    'Established automated unit and feature test suites, significantly curbing regressions across production releases.',
                ];
            }

            if (Str::contains($posLower, ['design', 'ui', 'ux'])) {
                return [
                    'Conducted user research and translated actionable findings into wireframes, prototypes, and high-fidelity mockups.',
                    'Standardized the design system and reusable UI component library, accelerating team design-to-development turnaround by 25%.',
                    'Collaborated with frontend engineering teams to ensure pixel-perfect visual fidelity and responsive interaction across all viewports.',
                    'Analyzed user feedback and usability test data to iterate on critical customer journey funnels.',
                ];
            }

            return [
                "Led day-to-day initiatives for {$position}, consistently meeting and exceeding key organizational performance indicators.",
                'Spearheaded workflow enhancements that improved project execution efficiency and cross-departmental alignment.',
                'Resolved operational bottlenecks through data-driven analysis and collaborative problem-solving strategies.',
                'Mentored colleagues and spearheaded documentation for key operational standards and best practices.',
            ];
        }

        // Indonesian fallback
        if (Str::contains($posLower, ['dev', 'engineer', 'program', 'software', 'web'])) {
            return [
                'Merancang dan membangun arsitektur fitur yang modular dan mudah dipelihara, meningkatkan stabilitas aplikasi secara signifikan.',
                'Mengoptimalkan performa pemuatan sistem dan efisiensi kueri database, menghasilkan peningkatan kecepatan respon hingga 35%.',
                'Berkolaborasi erat bersama manajer produk dan tim desain untuk merilis fitur-fitur strategis tepat waktu dengan standar kode bersih.',
                'Menerapkan pengujian otomatis (unit & feature testing) untuk meminimalkan potensi regresi pada lingkungan produksi.',
            ];
        }

        if (Str::contains($posLower, ['design', 'ui', 'ux'])) {
            return [
                'Melakukan riset pengguna dan mengonversi temuan analitis menjadi wireframe, prototipe interaktif, dan desain antarmuka berkualitas tinggi.',
                'Menyusun serta mengelola design system dan komponen UI terstandarisasi, mempercepat siklus transisi dari desain ke pengembangan sebesar 25%.',
                'Bekerja sama erat dengan tim developer untuk memastikan ketepatan implementasi visual (pixel-perfect) dan responsivitas layout.',
                'Mengevaluasi umpan balik pengguna dan hasil uji kegunaan (usability testing) untuk menyempurnakan alur navigasi aplikasi.',
            ];
        }

        return [
            "Memimpin dan mengeksekusi inisiatif operasional harian sebagai {$position}, secara konsisten melampaui indikator target kinerja utama.",
            'Menginisiasi penyederhanaan alur kerja lintas tim yang berdampak langsung pada efisiensi waktu penyelesaian proyek.',
            'Menganalisis data operasional untuk mengidentifikasi kendala proses dan mengimplementasikan solusi taktis yang terukur.',
            'Menyusun dokumentasi standar operasional kerja dan membimbing anggota tim baru demi menjaga mutu pekerjaan.',
        ];
    }
}
