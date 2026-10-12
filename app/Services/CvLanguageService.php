<?php

namespace App\Services;

class CvLanguageService
{
    /**
     * Supported languages.
     *
     * @var array<int, string>
     */
    public const SUPPORTED = ['id', 'en'];

    /**
     * Get dictionary for given language code.
     *
     * @return array<string, string>
     */
    public static function get(string $lang = 'id'): array
    {
        $lang = in_array($lang, self::SUPPORTED, true) ? $lang : 'id';

        if ($lang === 'en') {
            return [
                'summary_title' => 'Professional Summary',
                'experience_title' => 'Work Experience',
                'education_title' => 'Education',
                'skills_title' => 'Skills & Competencies',
                'contact_title' => 'Contact Information',
                'present' => 'Present',
                'phone' => 'Phone',
                'email' => 'Email',
                'address' => 'Address',
                'portfolio' => 'Portfolio / Web',
                'github' => 'GitHub',
                'linkedin' => 'LinkedIn',
                'social_links' => 'Links & Portfolio',
                'degree' => 'Degree',
                'institution' => 'Institution',
                'position' => 'Position',
                'company' => 'Company',
                'period' => 'Period',
            ];
        }

        return [
            'summary_title' => 'Ringkasan Profesional',
            'experience_title' => 'Pengalaman Kerja',
            'education_title' => 'Riwayat Pendidikan',
            'skills_title' => 'Keahlian & Kompetensi',
            'contact_title' => 'Informasi Kontak',
            'present' => 'Saat Ini',
            'phone' => 'Telepon',
            'email' => 'Email',
            'address' => 'Alamat',
            'portfolio' => 'Portofolio / Web',
            'github' => 'GitHub',
            'linkedin' => 'LinkedIn',
            'social_links' => 'Tautan & Portofolio',
            'degree' => 'Gelar / Jurusan',
            'institution' => 'Institusi',
            'position' => 'Posisi',
            'company' => 'Perusahaan',
            'period' => 'Periode',
        ];
    }
}
