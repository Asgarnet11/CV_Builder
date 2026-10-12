<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'>
<head>
    <meta charset="utf-8">
    <title>Curriculum Vitae - {{ $profile?->full_name ?? $user->name }}</title>
    <!--[if gte mso 9]>
    <xml>
        <w:WordDocument>
            <w:View>Print</w:View>
            <w:Zoom>100</w:Zoom>
            <w:DoNotOptimizeForBrowser/>
        </w:WordDocument>
    </xml>
    <![endif]-->
    <style>
        body {
            font-family: 'Calibri', 'Arial', sans-serif;
            font-size: 11pt;
            line-height: 1.4;
            color: #2d3748;
            margin: 20mm;
        }
        h1 {
            font-size: 24pt;
            font-weight: bold;
            color: #1a202c;
            margin: 0 0 4pt 0;
            text-transform: uppercase;
        }
        .headline {
            font-size: 13pt;
            color: #4f46e5;
            font-weight: bold;
            margin: 0 0 10pt 0;
        }
        .contact-info {
            font-size: 10pt;
            color: #4a5568;
            margin-bottom: 16pt;
            border-bottom: 2pt solid #4f46e5;
            padding-bottom: 8pt;
        }
        .section-title {
            font-size: 13pt;
            font-weight: bold;
            color: #1a202c;
            text-transform: uppercase;
            border-bottom: 1pt solid #cbd5e0;
            padding-bottom: 3pt;
            margin-top: 14pt;
            margin-bottom: 8pt;
        }
        .item-header {
            margin-bottom: 2pt;
        }
        .item-title {
            font-weight: bold;
            font-size: 11pt;
            color: #2d3748;
        }
        .item-company {
            font-weight: 600;
            color: #4f46e5;
        }
        .item-date {
            float: right;
            font-size: 9.5pt;
            color: #718096;
            font-style: italic;
        }
        .item-desc {
            margin-top: 3pt;
            margin-bottom: 10pt;
            font-size: 10.5pt;
        }
        ul {
            margin-top: 3pt;
            margin-bottom: 6pt;
            padding-left: 20pt;
        }
        li {
            margin-bottom: 2pt;
        }
        .skill-tag {
            display: inline-block;
            background-color: #edf2f7;
            padding: 3pt 6pt;
            margin: 2pt;
            font-size: 9.5pt;
            border-radius: 3pt;
        }
    </style>
</head>
<body>

    <!-- Header / Name & Contact -->
    <h1>{{ $profile?->full_name ?? $user->name }}</h1>
    @if ($profile?->headline)
        <div class="headline">{{ $profile->headline }}</div>
    @endif

    <div class="contact-info">
        @php
            $contacts = [];
            if ($profile?->email_cv ?? $user->email) $contacts[] = ($profile?->email_cv ?? $user->email);
            if ($profile?->phone) $contacts[] = $profile->phone;
            if ($profile?->address) $contacts[] = $profile->address;
            if ($profile?->linkedin_url) $contacts[] = 'LinkedIn: ' . $profile->linkedin_url;
            if ($profile?->portfolio_url) $contacts[] = 'Portfolio: ' . $profile->portfolio_url;
        @endphp
        {{ implode(' | ', $contacts) }}
    </div>

    <!-- Summary -->
    @if ($profile?->summary)
        <div class="section-title">Ringkasan Profil</div>
        <div class="item-desc">
            {{ $profile->summary }}
        </div>
    @endif

    <!-- Experience -->
    @if (($profile?->show_experience ?? true) && $experiences->count() > 0)
        <div class="section-title">Pengalaman Kerja</div>
        @foreach ($experiences as $exp)
            <div style="margin-bottom: 10pt;">
                <table width="100%" style="border-collapse: collapse; margin-bottom: 3pt;">
                    <tr>
                        <td align="left">
                            <span class="item-title">{{ $exp->position }}</span> &mdash; 
                            <span class="item-company">{{ $exp->company_name }}</span>
                        </td>
                        <td align="right" style="color: #718096; font-size: 9.5pt; font-style: italic;">
                            {{ $exp->start_date ? $exp->start_date->format('M Y') : '' }} - 
                            {{ $exp->is_current ? 'Sekarang' : ($exp->end_date ? $exp->end_date->format('M Y') : '') }}
                        </td>
                    </tr>
                </table>
                @if ($exp->description)
                    <div class="item-desc">
                        {!! $exp->description !!}
                    </div>
                @endif
            </div>
        @endforeach
    @endif

    <!-- Education -->
    @if (($profile?->show_education ?? true) && $education->count() > 0)
        <div class="section-title">Pendidikan</div>
        @foreach ($education as $edu)
            <div style="margin-bottom: 8pt;">
                <table width="100%" style="border-collapse: collapse;">
                    <tr>
                        <td align="left">
                            <span class="item-title">{{ $edu->degree }}</span> &mdash; 
                            <span class="item-company">{{ $edu->institution }}</span>
                        </td>
                        <td align="right" style="color: #718096; font-size: 9.5pt; font-style: italic;">
                            {{ $edu->start_year }} - {{ $edu->end_year ?? 'Sekarang' }}
                        </td>
                    </tr>
                </table>
                @if ($edu->description)
                    <div class="item-desc">
                        {{ $edu->description }}
                    </div>
                @endif
            </div>
        @endforeach
    @endif

    <!-- Skills -->
    @if (($profile?->show_skills ?? true) && $skills->count() > 0)
        <div class="section-title">Keahlian & Kompetensi</div>
        <div style="margin-top: 4pt;">
            @php
                $skillNames = $skills->pluck('skill_name')->toArray();
            @endphp
            {{ implode(' • ', $skillNames) }}
        </div>
    @endif

</body>
</html>
