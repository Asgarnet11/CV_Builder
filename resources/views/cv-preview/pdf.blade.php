<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Curriculum Vitae - {{ $profile?->full_name ?? $user->name }}</title>
    <style>
        @page {
            margin: 25px 30px;
            size: a4 portrait;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1e293b;
            line-height: 1.45;
            font-size: 11px;
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
        .color-primary { color: {{ $profile?->theme_color ?? '#4338ca' }}; }
        .bg-primary { background-color: {{ $profile?->theme_color ?? '#4338ca' }}; }
        .border-primary { border-color: {{ $profile?->theme_color ?? '#4338ca' }}; }

        /* Header */
        .header-table {
            width: 100%;
            border-bottom: 2px solid {{ $profile?->theme_color ?? '#4338ca' }};
            padding-bottom: 14px;
            margin-bottom: 16px;
        }

        .candidate-name {
            font-size: 22px;
            font-weight: bold;
            color: #0f172a;
            margin: 0 0 3px 0;
            letter-spacing: -0.5px;
        }

        .candidate-headline {
            font-size: 13px;
            color: {{ $profile?->theme_color ?? '#4338ca' }};
            font-weight: 600;
            margin: 0 0 8px 0;
        }

        .contact-info {
            font-size: 10px;
            color: #475569;
            line-height: 1.6;
        }

        .photo-box {
            width: 85px;
            height: 105px;
            text-align: right;
            vertical-align: top;
        }

        .profile-img {
            width: 85px;
            height: 105px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            object-fit: cover;
        }

        /* Section Styling */
        .section-title {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #1e293b;
            border-bottom: 1.5px solid #e2e8f0;
            padding-bottom: 4px;
            margin-top: 14px;
            margin-bottom: 8px;
        }

        .section-title span {
            color: {{ $profile?->theme_color ?? '#4338ca' }};
            margin-right: 4px;
        }

        .summary-text {
            color: #334155;
            font-size: 10.5px;
            line-height: 1.5;
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
            font-size: 11px;
            font-weight: bold;
            color: #0f172a;
            text-align: left;
        }

        .item-header-right {
            font-size: 9.5px;
            color: #64748b;
            text-align: right;
            font-weight: 500;
        }

        .item-sub {
            font-size: 10px;
            color: {{ $profile?->theme_color ?? '#4338ca' }};
            font-weight: 600;
            margin-bottom: 3px;
        }

        .item-desc {
            font-size: 10px;
            color: #475569;
            line-height: 1.4;
            margin-top: 2px;
        }

        /* Skills */
        .skills-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
        }

        .skill-cell {
            padding: 4px 6px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            font-size: 9.5px;
            color: #1e293b;
            display: inline-block;
            margin: 2px 3px 2px 0;
        }

        .skill-level {
            font-size: 8.5px;
            color: {{ $profile?->theme_color ?? '#4338ca' }};
            font-weight: bold;
            margin-left: 3px;
        }

        /* Footer */
        .pdf-footer {
            margin-top: 25px;
            border-top: 1px dashed #cbd5e1;
            padding-top: 6px;
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
        <div class="section-title"><span>■</span> Ringkasan Profesional</div>
        <p class="summary-text">{{ $profile->summary }}</p>
    @endif

    <!-- Pengalaman Kerja -->
    @if ($experiences->count() > 0 && ($profile->show_experience ?? true))
        <div class="section-title"><span>■</span> Pengalaman Kerja</div>
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
        <div class="section-title"><span>■</span> Riwayat Pendidikan</div>
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
        <div class="section-title"><span>■</span> Keahlian & Kompetensi</div>
        <div style="margin-top: 4px;">
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
