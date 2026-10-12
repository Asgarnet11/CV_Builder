<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Curriculum Vitae - {{ $profile?->full_name ?? $user->name }}</title>
    <style>
        @page {
            margin: 30px 40px;
            size: a4 portrait;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1e293b;
            line-height: 1.5;
            font-size: 11px;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        .header-table {
            width: 100%;
            margin-bottom: 20px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 15px;
        }

        .candidate-name {
            font-size: 26px;
            font-weight: 900;
            color: #0f172a;
            margin: 0;
            letter-spacing: -1px;
        }

        .candidate-headline {
            font-size: 11px;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin: 5px 0 0 0;
        }

        .contact-info {
            font-size: 9px;
            color: #64748b;
            text-align: right;
            line-height: 1.5;
        }

        .section-title {
            font-size: 9px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #94a3b8;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .summary-text {
            color: #1e293b;
            font-size: 11px;
            line-height: 1.6;
            margin: 0 0 10px 0;
        }

        .item-table {
            width: 100%;
            margin-bottom: 12px;
            border-collapse: collapse;
        }

        .item-title {
            font-size: 11px;
            font-weight: bold;
            color: #0f172a;
        }

        .item-company {
            color: #64748b;
            font-weight: normal;
        }

        .item-date {
            font-size: 9px;
            color: #94a3b8;
            text-align: right;
            font-family: monospace;
        }

        .item-desc {
            font-size: 10px;
            color: #475569;
            line-height: 1.5;
            margin-top: 4px;
        }

        .skills-container {
            margin-top: 5px;
        }

        .skill-tag {
            display: inline-block;
            background-color: #f1f5f9;
            color: #334155;
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: 600;
            margin: 0 4px 4px 0;
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td style="vertical-align: top;">
                <h1 class="candidate-name">{{ $profile?->full_name ?? $user->name }}</h1>
                <div class="candidate-headline">{{ $profile?->headline ?? 'Professional Profile' }}</div>
            </td>
            <td class="contact-info" style="vertical-align: top;">
                <div>{{ $profile?->email_cv ?? $user->email }}</div>
                @if ($profile?->phone) <div>{{ $profile->phone }}</div> @endif
                @if ($profile?->address) <div>{{ $profile->address }}</div> @endif
                @if ($profile?->linkedin_url) <div>{{ $profile->linkedin_url }}</div> @endif
                @if ($profile?->github_url) <div>{{ $profile->github_url }}</div> @endif
                @if ($profile?->portfolio_url) <div>{{ $profile->portfolio_url }}</div> @endif
            </td>
        </tr>
    </table>

    @if ($profile?->summary)
        <div class="section-title">{{ strtoupper($labels['summary_title'] ?? 'TENTANG') }}</div>
        <p class="summary-text">{{ $profile->summary }}</p>
    @endif

    @if ($experiences->count() > 0 && ($profile->show_experience ?? true))
        <div class="section-title">{{ strtoupper($labels['experience_title'] ?? 'PENGALAMAN') }}</div>
        @foreach ($experiences as $exp)
            <table class="item-table">
                <tr>
                    <td class="item-title">
                        {{ $exp->position }} &bull; <span class="item-company">{{ $exp->company_name }}</span>
                    </td>
                    <td class="item-date">
                        {{ \Carbon\Carbon::parse($exp->start_date)->format('Y') }} - 
                        {{ $exp->is_current ? ($labels['present'] ?? 'Present') : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('Y') : '-') }}
                    </td>
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
        <div class="section-title">{{ strtoupper($labels['education_title'] ?? 'PENDIDIKAN') }}</div>
        @foreach ($education as $edu)
            <table class="item-table">
                <tr>
                    <td class="item-title">
                        {{ $edu->institution }} &bull; <span class="item-company">{{ $edu->degree }}</span>
                    </td>
                    <td class="item-date">
                        {{ $edu->start_year }} - {{ $edu->end_year ?? ($labels['present'] ?? 'Present') }}
                    </td>
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
        <div class="section-title">{{ strtoupper($labels['skills_title'] ?? 'KEAHLIAN') }}</div>
        <div class="skills-container">
            @foreach ($skills as $skill)
                <span class="skill-tag">{{ $skill->skill_name }}</span>
            @endforeach
        </div>
    @endif

</body>
</html>
