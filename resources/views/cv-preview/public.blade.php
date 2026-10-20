<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CV - {{ $profile?->full_name ?? $user->name }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100 text-slate-900 min-h-screen py-8 sm:py-12 relative selection:bg-indigo-500 selection:text-white">
    <!-- Ambient Background Grid -->
    <div class="fixed inset-0 bg-[radial-gradient(#cbd5e1_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none z-0"></div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Public Action Bar -->
        <div class="print:hidden bg-white/90 backdrop-blur-xl p-4 sm:p-5 rounded-3xl shadow-sm border border-slate-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-600 text-white flex items-center justify-center font-bold text-sm shadow-md shadow-indigo-500/20">
                    CV
                </div>
                <div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-indigo-600">Dokumen Publik Daring</div>
                    <div class="text-base font-extrabold text-slate-900 leading-tight">{{ $profile?->full_name ?? $user->name }}</div>
                </div>
            </div>
            <div class="flex items-center gap-2.5">
                <button onclick="window.print()" class="inline-flex items-center px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl transition shadow-xs">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Cetak / Simpan PDF
                </button>
                @auth
                    @if(auth()->id() === $user->id)
                        <a href="{{ route('cv-preview.show', ['template' => $template]) }}" class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 text-white text-xs font-bold rounded-xl transition shadow-md shadow-indigo-500/20">
                            Edit CV Saya
                        </a>
                    @endif
                @endauth
            </div>
        </div>

        <!-- The CV Paper -->
        <div class="flex justify-center py-2 overflow-x-auto">
            @php
                $accent = $profile?->resolved_theme_color ?? (($profile?->theme_color && $profile->theme_color !== '#000000') ? $profile->theme_color : '#269dd8');
            @endphp
            <style>
                #cv-paper .text-indigo-600, #cv-paper .text-indigo-500, #cv-paper .text-indigo-900 { color: {{ $accent }} !important; }
                #cv-paper .bg-indigo-600, #cv-paper .bg-indigo-500 { background-color: {{ $accent }} !important; }
                #cv-paper .border-indigo-600, #cv-paper .border-indigo-200, #cv-paper .border-indigo-100 { border-color: {{ $accent }} !important; }
                #cv-paper .bg-indigo-50 { background-color: {{ $accent }}20 !important; }
                @media print {
                    body { background: #fff !important; }
                    .print\:hidden { display: none !important; }
                    #cv-paper {
                        box-shadow: none !important;
                        border: none !important;
                        padding: 0 !important;
                        width: 100% !important;
                        max-width: 100% !important;
                        min-height: auto !important;
                    }
                }
            </style>
            <div id="cv-paper" class="w-full max-w-[210mm] min-h-[297mm] bg-white text-slate-900 p-8 sm:p-10 shadow-[0_20px_50px_rgba(0,0,0,0.18)] rounded-sm border border-slate-200 transition-all font-sans">

                @if ($template === 'modern')
                    <!-- ================= MODERN INDIGO TEMPLATE ================= -->
                    <div>
                        <!-- Header Bar -->
                        <div class="flex justify-between items-start pb-3 mb-3.5 border-b-2 gap-4" style="border-bottom-color: {{ $accent }};">
                            <div class="space-y-1">
                                <h1 class="text-2xl sm:text-[23px] font-bold text-slate-900 tracking-tight leading-tight m-0">
                                    {{ $profile?->full_name ?? $user->name }}
                                </h1>
                                @if ($profile?->headline)
                                    <div class="text-xs sm:text-[12.5px] font-semibold" style="color: {{ $accent }};">
                                        {{ $profile->headline }}
                                    </div>
                                @endif

                                <!-- Contact Meta -->
                                <div class="text-[10px] sm:text-[10.5px] text-slate-600 leading-relaxed font-normal pt-0.5">
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
                                        <span>LinkedIn: <a href="{{ $profile->linkedin_url }}" target="_blank" class="hover:underline text-slate-800 font-medium">{{ $profile->linkedin_url }}</a></span>
                                    @endif
                                    @if ($profile?->portfolio_url)
                                        <span> &bull; Portfolio: <a href="{{ $profile->portfolio_url }}" target="_blank" class="hover:underline text-slate-800 font-medium">{{ $profile->portfolio_url }}</a></span>
                                    @endif
                                </div>
                            </div>

                            <!-- Photo (if available) -->
                            @if ($profile?->photo)
                                <div class="shrink-0 pl-2">
                                    <img src="{{ asset('storage/' . $profile->photo) }}" 
                                         alt="{{ $profile->full_name }}" 
                                         style="width: {{ $photoWidth ?? 85 }}px; height: {{ $photoHeight ?? 110 }}px;"
                                         class="rounded-[4px] border border-slate-300 object-cover ml-auto">
                                </div>
                            @endif
                        </div>

                        <!-- Ringkasan Profesional -->
                        @if ($profile?->summary)
                            <div class="mt-3.5">
                                <div class="text-[11px] font-bold uppercase tracking-wider text-slate-900 border-l-[3.5px] border-b border-b-slate-200 pl-2 pb-0.5 mb-2" style="border-left-color: {{ $accent }};">
                                    Ringkasan Profesional
                                </div>
                                <p class="text-[10.5px] text-slate-700 leading-relaxed text-justify m-0">
                                    {{ $profile->summary }}
                                </p>
                            </div>
                        @endif

                        <!-- Pengalaman Kerja -->
                        @if ($experiences->count() > 0 && ($profile->show_experience ?? true))
                            <div class="mt-3.5">
                                <div class="text-[11px] font-bold uppercase tracking-wider text-slate-900 border-l-[3.5px] border-b border-b-slate-200 pl-2 pb-0.5 mb-2.5" style="border-left-color: {{ $accent }};">
                                    Pengalaman Kerja
                                </div>
                                <div class="space-y-2.5">
                                    @foreach ($experiences as $exp)
                                        <div>
                                            <div class="flex justify-between items-baseline text-[11px]">
                                                <span class="font-bold text-slate-900">{{ $exp->position }}</span>
                                                <span class="text-[10px] text-slate-500 font-semibold">
                                                    {{ \Carbon\Carbon::parse($exp->start_date)->translatedFormat('M Y') }} - 
                                                    {{ $exp->is_current ? 'Sekarang' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->translatedFormat('M Y') : '-') }}
                                                </span>
                                            </div>
                                            <div class="text-[10.5px] font-semibold mt-0.5" style="color: {{ $accent }};">{{ $exp->company_name }}</div>
                                            @if ($exp->description)
                                                <div class="text-[10.5px] text-slate-600 mt-1 leading-relaxed">{!! $exp->description !!}</div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Riwayat Pendidikan -->
                        @if ($education->count() > 0 && ($profile->show_education ?? true))
                            <div class="mt-3.5">
                                <div class="text-[11px] font-bold uppercase tracking-wider text-slate-900 border-l-[3.5px] border-b border-b-slate-200 pl-2 pb-0.5 mb-2.5" style="border-left-color: {{ $accent }};">
                                    Riwayat Pendidikan
                                </div>
                                <div class="space-y-2.5">
                                    @foreach ($education as $edu)
                                        <div>
                                            <div class="flex justify-between items-baseline text-[11px]">
                                                <span class="font-bold text-slate-900">{{ $edu->institution }}</span>
                                                <span class="text-[10px] text-slate-500 font-semibold">
                                                    {{ $edu->start_year }} - {{ $edu->end_year ?? 'Sekarang' }}
                                                </span>
                                            </div>
                                            <div class="text-[10.5px] font-semibold mt-0.5" style="color: {{ $accent }};">{{ $edu->degree }}</div>
                                            @if ($edu->description)
                                                <div class="text-[10.5px] text-slate-600 mt-1 leading-relaxed">{!! $edu->description !!}</div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Keahlian & Kompetensi -->
                        @if ($skills->count() > 0 && ($profile->show_skills ?? true))
                            <div class="mt-3.5">
                                <div class="text-[11px] font-bold uppercase tracking-wider text-slate-900 border-l-[3.5px] border-b border-b-slate-200 pl-2 pb-0.5 mb-2" style="border-left-color: {{ $accent }};">
                                    Keahlian &amp; Kompetensi
                                </div>
                                <div class="flex flex-wrap gap-1.5 mt-1">
                                    @foreach ($skills as $skill)
                                        <span class="inline-block px-2.5 py-1 rounded bg-slate-100 border border-slate-200 text-slate-800 text-[10px]">
                                            {{ $skill->skill_name }} <span class="font-bold text-[9px] ml-0.5" style="color: {{ $accent }};">({{ $skill->level }})</span>
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Official Footer -->
                        <div class="mt-8 pt-2.5 border-t border-dashed border-slate-300 text-[9px] text-slate-400 text-center">
                            Dihasilkan secara resmi melalui LaraCV (Online CV Builder Platform) &bull; {{ date('d F Y') }}
                        </div>
                    </div>

                @elseif ($template === 'classic')
                    <!-- ================= CLASSIC EXECUTIVE TEMPLATE ================= -->
                    <div style="font-family: 'Times New Roman', Times, serif;" class="text-black">
                        @if ($profile?->photo)
                            <div class="flex justify-between items-start pb-3 mb-4 border-b-[1.5px] border-black gap-4">
                                <div>
                                    <h1 class="text-2xl sm:text-[25px] font-bold text-black tracking-wide uppercase m-0 leading-tight">
                                        {{ $profile?->full_name ?? $user->name }}
                                    </h1>
                                    @if ($profile?->headline)
                                        <div class="text-xs sm:text-[13px] font-bold uppercase tracking-wider text-black mt-1">
                                            {{ $profile->headline }}
                                        </div>
                                    @endif
                                    <div class="text-[11px] sm:text-[11.5px] text-neutral-800 mt-1 leading-snug">
                                        {{ $profile?->email_cv ?? $user->email }}
                                        @if ($profile?->phone) | {{ $profile->phone }} @endif
                                        @if ($profile?->address) | {{ $profile->address }} @endif
                                        <br>
                                        @if ($profile?->linkedin_url) <a href="{{ $profile->linkedin_url }}" target="_blank" class="hover:underline text-black">{{ $profile->linkedin_url }}</a> @endif
                                        @if ($profile?->linkedin_url && $profile?->portfolio_url) | @endif
                                        @if ($profile?->portfolio_url) <a href="{{ $profile->portfolio_url }}" target="_blank" class="hover:underline text-black">{{ $profile->portfolio_url }}</a> @endif
                                    </div>
                                </div>
                                <div class="shrink-0 pl-3">
                                    <img src="{{ asset('storage/' . $profile->photo) }}" style="width: {{ $photoWidth ?? 85 }}px; height: {{ $photoHeight ?? 110 }}px;" class="border border-neutral-600 object-cover ml-auto" alt="Foto Profil">
                                </div>
                            </div>
                        @else
                            <div class="text-center pb-4 mb-5 border-b border-black">
                                <h1 class="text-2xl sm:text-[25px] font-bold text-black tracking-wide uppercase m-0 leading-tight">
                                    {{ $profile?->full_name ?? $user->name }}
                                </h1>
                                @if ($profile?->headline)
                                    <div class="text-xs sm:text-[13px] font-bold uppercase tracking-wider text-black mt-1">
                                        {{ $profile->headline }}
                                    </div>
                                @endif
                                <div class="text-[11px] sm:text-[11.5px] text-neutral-800 mt-1.5 leading-snug">
                                    {{ $profile?->email_cv ?? $user->email }}
                                    @if ($profile?->phone) | {{ $profile->phone }} @endif
                                    @if ($profile?->address) | {{ $profile->address }} @endif
                                    <br>
                                    @if ($profile?->linkedin_url) <a href="{{ $profile->linkedin_url }}" target="_blank" class="hover:underline text-black">{{ $profile->linkedin_url }}</a> @endif
                                    @if ($profile?->linkedin_url && $profile?->portfolio_url) | @endif
                                    @if ($profile?->portfolio_url) <a href="{{ $profile->portfolio_url }}" target="_blank" class="hover:underline text-black">{{ $profile->portfolio_url }}</a> @endif
                                </div>
                            </div>
                        @endif

                        @if ($profile?->summary)
                            <div class="mt-4">
                                <h3 class="text-xs sm:text-[12.5px] font-bold uppercase tracking-wider text-black border-b border-black pb-0.5 mb-2">
                                    PROFIL SINGKAT
                                </h3>
                                <p class="text-xs sm:text-[12px] text-neutral-900 leading-relaxed text-justify m-0">{{ $profile->summary }}</p>
                            </div>
                        @endif

                        @if ($experiences->count() > 0 && ($profile->show_experience ?? true))
                            <div class="mt-4">
                                <h3 class="text-xs sm:text-[12.5px] font-bold uppercase tracking-wider text-black border-b border-black pb-0.5 mb-2.5">
                                    PENGALAMAN KERJA
                                </h3>
                                <div class="space-y-3">
                                    @foreach ($experiences as $exp)
                                        <div>
                                            <div class="flex justify-between items-baseline text-xs sm:text-[12px]">
                                                <span class="font-bold text-black">{{ $exp->position }}</span>
                                                <span class="italic text-neutral-700 text-[11px]">
                                                    {{ \Carbon\Carbon::parse($exp->start_date)->translatedFormat('M Y') }} - 
                                                    {{ $exp->is_current ? 'Sekarang' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->translatedFormat('M Y') : '-') }}
                                                </span>
                                            </div>
                                            <div class="italic text-xs sm:text-[12px] text-black mt-0.5">{{ $exp->company_name }}</div>
                                            @if ($exp->description)
                                                <div class="text-xs sm:text-[11.5px] text-neutral-900 mt-1 leading-relaxed">{!! $exp->description !!}</div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($education->count() > 0 && ($profile->show_education ?? true))
                            <div class="mt-4">
                                <h3 class="text-xs sm:text-[12.5px] font-bold uppercase tracking-wider text-black border-b border-black pb-0.5 mb-2.5">
                                    PENDIDIKAN
                                </h3>
                                <div class="space-y-3">
                                    @foreach ($education as $edu)
                                        <div>
                                            <div class="flex justify-between items-baseline text-xs sm:text-[12px]">
                                                <span class="font-bold text-black">{{ $edu->institution }}</span>
                                                <span class="italic text-neutral-700 text-[11px]">{{ $edu->start_year }} - {{ $edu->end_year ?? 'Sekarang' }}</span>
                                            </div>
                                            <div class="italic text-xs sm:text-[12px] text-black mt-0.5">{{ $edu->degree }}</div>
                                            @if ($edu->description)
                                                <div class="text-xs sm:text-[11.5px] text-neutral-900 mt-1 leading-relaxed">{!! $edu->description !!}</div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($skills->count() > 0 && ($profile->show_skills ?? true))
                            <div class="mt-4">
                                <h3 class="text-xs sm:text-[12.5px] font-bold uppercase tracking-wider text-black border-b border-black pb-0.5 mb-2">
                                    KEAHLIAN
                                </h3>
                                <p class="text-xs sm:text-[12px] text-neutral-900 leading-relaxed m-0">
                                    {{ $skills->map(fn($s) => $s->skill_name . ' (' . $s->level . ')')->join(', ') }}
                                </p>
                            </div>
                        @endif

                        <!-- Official Footer -->
                        <div class="mt-8 pt-2.5 border-t border-neutral-300 text-[9px] text-neutral-500 text-center italic">
                            Dihasilkan secara resmi melalui LaraCV (Online CV Builder Platform) &bull; {{ date('d F Y') }}
                        </div>
                    </div>

                @else
                    <!-- ================= MINIMALIST CLEAN TEMPLATE ================= -->
                    <div>
                        <div class="flex justify-between items-start pb-4 mb-5 border-b border-slate-200 gap-4">
                            <div>
                                <h1 class="text-2xl sm:text-[28px] font-black text-slate-900 tracking-tighter uppercase m-0 leading-tight">
                                    {{ $profile?->full_name ?? $user->name }}
                                </h1>
                                <div class="text-[10px] sm:text-[11px] font-bold text-slate-500 uppercase tracking-widest mt-1">
                                    {{ $profile?->headline ?? 'Professional Profile' }}
                                </div>
                            </div>
                            <div class="flex items-start gap-4 ml-auto text-right">
                                <div class="text-[9.5px] sm:text-[10px] text-slate-500 space-y-0.5 leading-snug">
                                    <div>{{ $profile?->email_cv ?? $user->email }}</div>
                                    @if ($profile?->phone) <div>{{ $profile->phone }}</div> @endif
                                    @if ($profile?->address) <div>{{ $profile->address }}</div> @endif
                                    @if ($profile?->linkedin_url) <div><a href="{{ $profile->linkedin_url }}" target="_blank" class="hover:underline font-medium text-slate-700">LinkedIn</a></div> @endif
                                    @if ($profile?->portfolio_url) <div><a href="{{ $profile->portfolio_url }}" target="_blank" class="hover:underline font-medium text-slate-700">Portofolio</a></div> @endif
                                </div>
                                @if ($profile?->photo)
                                    <div class="shrink-0 pl-2">
                                        <img src="{{ asset('storage/' . $profile->photo) }}" style="width: {{ $photoWidth ?? 80 }}px; height: {{ $photoHeight ?? 105 }}px;" class="rounded-[4px] border border-slate-300 object-cover ml-auto" alt="Foto Profil">
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if ($profile?->summary)
                            <div class="mt-5">
                                <div class="text-[9.5px] font-black uppercase tracking-[2px] text-slate-400 mb-2">TENTANG</div>
                                <p class="text-[11px] sm:text-[11.5px] text-slate-800 leading-relaxed text-justify m-0">{{ $profile->summary }}</p>
                            </div>
                        @endif

                        @if ($experiences->count() > 0 && ($profile->show_experience ?? true))
                            <div class="mt-5">
                                <div class="text-[9.5px] font-black uppercase tracking-[2px] text-slate-400 mb-3">PENGALAMAN</div>
                                <div class="space-y-3">
                                    @foreach ($experiences as $exp)
                                        <div>
                                            <div class="flex justify-between items-baseline text-[11px] sm:text-[11.5px]">
                                                <span class="font-bold text-slate-900">{{ $exp->position }} &bull; <span class="text-slate-500 font-normal">{{ $exp->company_name }}</span></span>
                                                <span class="text-slate-400 font-mono text-[9.5px] sm:text-[10px]">
                                                    {{ \Carbon\Carbon::parse($exp->start_date)->format('Y') }} - 
                                                    {{ $exp->is_current ? 'Present' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('Y') : '-') }}
                                                </span>
                                            </div>
                                            @if ($exp->description)
                                                <div class="text-[10.5px] text-slate-600 mt-1 leading-relaxed">{!! $exp->description !!}</div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($education->count() > 0 && ($profile->show_education ?? true))
                            <div class="mt-5">
                                <div class="text-[9.5px] font-black uppercase tracking-[2px] text-slate-400 mb-3">PENDIDIKAN</div>
                                <div class="space-y-3">
                                    @foreach ($education as $edu)
                                        <div>
                                            <div class="flex justify-between items-baseline text-[11px] sm:text-[11.5px]">
                                                <span class="font-bold text-slate-900">{{ $edu->institution }} &bull; <span class="text-slate-500 font-normal">{{ $edu->degree }}</span></span>
                                                <span class="text-slate-400 font-mono text-[9.5px] sm:text-[10px]">{{ $edu->start_year }} - {{ $edu->end_year ?? 'Present' }}</span>
                                            </div>
                                            @if ($edu->description)
                                                <div class="text-[10.5px] text-slate-600 mt-1 leading-relaxed">{!! $edu->description !!}</div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($skills->count() > 0 && ($profile->show_skills ?? true))
                            <div class="mt-5">
                                <div class="text-[9.5px] font-black uppercase tracking-[2px] text-slate-400 mb-2">KEAHLIAN</div>
                                <div class="flex flex-wrap gap-1.5 mt-1">
                                    @foreach ($skills as $skill)
                                        <span class="inline-block px-2 py-0.5 rounded bg-slate-100 text-slate-700 text-[9.5px] sm:text-[10px] font-semibold">
                                            {{ $skill->skill_name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Official Footer -->
                        <div class="mt-8 pt-2.5 border-t border-slate-200 text-[9px] text-slate-400 text-center font-mono">
                            Dihasilkan secara resmi melalui LaraCV (Online CV Builder Platform) &bull; {{ date('d F Y') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

</body>
</html>
