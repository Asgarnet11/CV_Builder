<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Curriculum Vitae - {{ $profile?->full_name ?? $user->name }}</title>
    <style>
        @page {
            margin: 30px 40px;
            size: a4 portrait;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            color: #000000;
            line-height: 1.5;
            font-size: 11px;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        .text-center { text-align: center; }
        .uppercase { text-transform: uppercase; }
        .tracking-wide { letter-spacing: 1px; }

        .header {
            text-align: center;
            border-bottom: 1px solid #000;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .candidate-name {
            font-size: 24px;
            font-weight: bold;
            margin: 0 0 5px 0;
            text-transform: uppercase;
        }

        .candidate-headline {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0 0 5px 0;
        }

        .contact-info {
            font-size: 10px;
            color: #333;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
            margin-top: 15px;
            margin-bottom: 10px;
        }

        .summary-text {
            font-size: 11px;
            line-height: 1.5;
            text-align: justify;
            margin: 0 0 10px 0;
        }

        .item-table {
            width: 100%;
            margin-bottom: 10px;
            border-collapse: collapse;
        }

        .item-header-left {
            font-size: 11px;
            font-weight: bold;
            text-align: left;
        }

        .item-header-right {
            font-size: 10px;
            text-align: right;
            font-style: italic;
        }

        .item-sub {
            font-size: 11px;
            font-style: italic;
            margin-bottom: 3px;
        }

        .item-desc {
            font-size: 11px;
            line-height: 1.4;
            margin-top: 3px;
        }

        .skills-list {
            font-size: 11px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1 class="candidate-name">{{ $profile?->full_name ?? $user->name }}</h1>
        @if ($profile?->headline)
            <div class="candidate-headline">{{ $profile->headline }}</div>
        @endif
        <div class="contact-info">
            {{ $profile?->email_cv ?? $user->email }}
            @if ($profile?->phone) | {{ $profile->phone }} @endif
            @if ($profile?->address) | {{ $profile->address }} @endif
            <br>
            @if ($profile?->linkedin_url) {{ $profile->linkedin_url }} @endif
            @if ($profile?->linkedin_url && $profile?->portfolio_url) | @endif
            @if ($profile?->portfolio_url) {{ $profile->portfolio_url }} @endif
        </div>
    </div>

    @if ($profile?->summary)
        <div class="section-title">Profil Singkat</div>
        <p class="summary-text">{{ $profile->summary }}</p>
    @endif

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

    @if ($education->count() > 0 && ($profile->show_education ?? true))
        <div class="section-title">Pendidikan</div>
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

    @if ($skills->count() > 0 && ($profile->show_skills ?? true))
        <div class="section-title">Keahlian</div>
        <div class="skills-list">
            {{ $skills->map(fn($s) => $s->skill_name . ' (' . $s->level . ')')->join(', ') }}
        </div>
    @endif

</body>
</html>
