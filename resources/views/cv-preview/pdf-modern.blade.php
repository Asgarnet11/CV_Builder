@php
    $accent = ($profile?->theme_color && $profile->theme_color !== '#000000') ? $profile->theme_color : '#269dd8';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Curriculum Vitae - {{ $profile?->full_name ?? $user->name }}</title>
    <style>
        @page {
            margin: 28px 32px;
            size: a4 portrait;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1e293b;
            line-height: 1.45;
            font-size: 10.5px;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        /* Utility */
        .w-full { width: 100%; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        .uppercase { text-transform: uppercase; }

        /* Modern Template Accent */
        .color-primary { color: {{ $accent }}; }
        .bg-primary { background-color: {{ $accent }}; }
        .border-primary { border-color: {{ $accent }}; }

        /* Header */
        .header-table {
            width: 100%;
            border-bottom: 2px solid {{ $accent }};
            padding-bottom: 12px;
            margin-bottom: 14px;
            border-collapse: collapse;
        }

        .candidate-name {
            font-size: 22px;
            font-weight: bold;
            color: #0f172a;
            margin: 0 0 3px 0;
            letter-spacing: -0.3px;
        }

        .candidate-headline {
            font-size: 12px;
            color: {{ $accent }};
            font-weight: 600;
            margin: 0 0 6px 0;
        }

        .contact-info {
            font-size: 9.5px;
            color: #475569;
            line-height: 1.6;
        }

        .photo-box {
            width: {{ ($photoWidth ?? 85) + 12 }}px;
            text-align: right;
            vertical-align: top;
            padding-left: 12px;
        }

        .profile-img {
            width: {{ $photoWidth ?? 85 }}px;
            height: {{ $photoHeight ?? 110 }}px;
            border-radius: 4px;
            border: 1px solid #cbd5e1;
            display: block;
            margin-left: auto;
        }

        /* Section Styling */
        .section-title {
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #0f172a;
            border-left: 3.5px solid {{ $accent }};
            border-bottom: 1px solid #e2e8f0;
            padding-left: 8px;
            padding-bottom: 3px;
            margin-top: 14px;
            margin-bottom: 8px;
        }

        .summary-text {
            color: #334155;
            font-size: 10px;
            line-height: 1.55;
            text-align: justify;
            margin: 0 0 6px 0;
        }

        /* Item blocks */
        .item-table {
            width: 100%;
            margin-bottom: 8px;
            border-collapse: collapse;
        }

        .item-header-left {
            font-size: 10.5px;
            font-weight: bold;
            color: #0f172a;
            text-align: left;
        }

        .item-header-right {
            font-size: 9px;
            color: #64748b;
            text-align: right;
            font-weight: 600;
        }

        .item-sub {
            font-size: 9.5px;
            color: {{ $accent }};
            font-weight: 600;
            margin-top: 1px;
            margin-bottom: 2px;
        }

        .item-desc {
            font-size: 9.5px;
            color: #475569;
            line-height: 1.4;
            margin-top: 2px;
        }

        /* Skills */
        .skills-container {
            margin-top: 4px;
        }

        .skill-cell {
            padding: 3px 8px;
            background-color: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            font-size: 9px;
            color: #1e293b;
            display: inline-block;
            margin: 2px 4px 3px 0;
        }

        .skill-level {
            font-size: 8px;
            color: {{ $accent }};
            font-weight: bold;
            margin-left: 3px;
        }

        /* Footer */
        .pdf-footer {
            margin-top: 22px;
            border-top: 1px dashed #cbd5e1;
            padding-top: 5px;
            font-size: 8px;
            color: #94a3b8;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Header Table -->
    <table class="header-table">
        <tr>
            <td style="vertical-align: top;">
                <h1 class="candidate-name">{{ $profile?->full_name ?? $user->name }}</h1>
                @if ($profile?->headline)
                    <div class="candidate-headline">{{ $profile->headline }}</div>
                @endif
                <div class="contact-info">
                    @if ($profile?->email_cv ?? $user->email)
                        <span>Email: {{ $profile?->email_cv ?? $user->email }}</span>
                    @endif
                    @if ($profile?->phone)
                        <span> &bull; Telp: {{ $profile->phone }}</span>
                    @endif
                    @if ($profile?->address)
                        <span> &bull; Domisili: {{ $profile->address }}</span>
                    @endif
                    <br>
                    @if ($profile?->linkedin_url)
                        <span>LinkedIn: {{ $profile->linkedin_url }}</span>
                    @endif
                    @if ($profile?->portfolio_url)
                        <span> &bull; Portfolio: {{ $profile->portfolio_url }}</span>
                    @endif
                </div>
            </td>
            @if ($photoBase64)
                <td class="photo-box">
                    <img src="{{ $photoBase64 }}" class="profile-img" alt="Foto Profil">
                </td>
            @endif
        </tr>
    </table>

    <!-- Ringkasan Profesional -->
    @if ($profile?->summary)
        <div class="section-title">Ringkasan Profesional</div>
        <p class="summary-text">{{ $profile->summary }}</p>
    @endif

    <!-- Pengalaman Kerja -->
    @if ($experiences->count() > 0 && ($profile->show_experience ?? true))
        <div class="section-title">Pengalaman Kerja</div>
        @foreach ($experiences as $exp)
            <table class="item-table">
                <tr>
                    <td class="item-header-left">{{ $exp->position }}</td>
                    <td class="item-header-right">
                        {{ \Carbon\Carbon::parse($exp->start_date)->translatedFormat('M Y') }} - 
                        {{ $exp->is_current ? 'Sekarang' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->translatedFormat('M Y') : '-') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="item-sub">{{ $exp->company_name }}</td>
                </tr>
                @if ($exp->description)
                    <tr>
                        <td colspan="2" class="item-desc">{!! $exp->description !!}</td>
                    </tr>
                @endif
            </table>
        @endforeach
    @endif

    <!-- Riwayat Pendidikan -->
    @if ($education->count() > 0 && ($profile->show_education ?? true))
        <div class="section-title">Riwayat Pendidikan</div>
        @foreach ($education as $edu)
            <table class="item-table">
                <tr>
                    <td class="item-header-left">{{ $edu->institution }}</td>
                    <td class="item-header-right">
                        {{ $edu->start_year }} - {{ $edu->end_year ?? 'Sekarang' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="item-sub">{{ $edu->degree }}</td>
                </tr>
                @if ($edu->description)
                    <tr>
                        <td colspan="2" class="item-desc">{!! $edu->description !!}</td>
                    </tr>
                @endif
            </table>
        @endforeach
    @endif

    <!-- Keterampilan / Skills -->
    @if ($skills->count() > 0 && ($profile->show_skills ?? true))
        <div class="section-title">Keahlian &amp; Kompetensi</div>
        <div class="skills-container">
            @foreach ($skills as $skill)
                <span class="skill-cell">
                    {{ $skill->skill_name }} <span class="skill-level">({{ $skill->level }})</span>
                </span>
            @endforeach
        </div>
    @endif

    <!-- PDF Footer -->
    <div class="pdf-footer">
        Dihasilkan secara resmi melalui LaraCV (Online CV Builder Platform) &bull; {{ date('d F Y') }}
    </div>

</body>
</html>
