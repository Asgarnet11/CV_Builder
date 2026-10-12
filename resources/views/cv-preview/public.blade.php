<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CV - {{ $profile?->full_name ?? $user->name }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100 min-h-screen py-10">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Action Bar -->
        <div class="print:hidden bg-white p-4 rounded-2xl shadow-sm border border-gray-200 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-2 text-sm text-gray-500 font-medium">
                CV Daring: <strong class="text-gray-900">{{ $profile?->full_name ?? $user->name }}</strong>
            </div>

            <!-- Templates & Language Options -->
            <div class="flex flex-wrap items-center gap-3">
                <div class="flex items-center gap-1.5 bg-gray-100 p-1 rounded-xl text-xs font-bold">
                    <a href="{{ route('public.cv', ['slug' => $profile->slug, 'template' => 'modern', 'lang' => $lang]) }}" 
                       class="px-2.5 py-1 rounded-lg transition {{ $template === 'modern' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                        Modern
                    </a>
                    <a href="{{ route('public.cv', ['slug' => $profile->slug, 'template' => 'classic', 'lang' => $lang]) }}" 
                       class="px-2.5 py-1 rounded-lg transition {{ $template === 'classic' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                        Classic
                    </a>
                    <a href="{{ route('public.cv', ['slug' => $profile->slug, 'template' => 'minimal', 'lang' => $lang]) }}" 
                       class="px-2.5 py-1 rounded-lg transition {{ $template === 'minimal' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                        Minimal
                    </a>
                </div>

                <div class="flex items-center gap-1 bg-gray-100 p-1 rounded-xl text-xs font-bold">
                    <a href="{{ route('public.cv', ['slug' => $profile->slug, 'template' => $template, 'lang' => 'id']) }}" 
                       class="px-2.5 py-1 rounded-lg transition {{ $lang === 'id' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                        🇮🇩 ID
                    </a>
                    <a href="{{ route('public.cv', ['slug' => $profile->slug, 'template' => $template, 'lang' => 'en']) }}" 
                       class="px-2.5 py-1 rounded-lg transition {{ $lang === 'en' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                        🇬🇧 EN
                    </a>
                </div>

                <button onclick="window.print()" class="inline-flex items-center px-4 py-1.5 bg-slate-800 hover:bg-slate-700 text-white text-xs font-semibold rounded-xl transition shadow-sm">
                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Cetak
                </button>
                @auth
                    @if(auth()->id() === $user->id)
                        <a href="{{ route('cv-preview.show', ['template' => $template, 'lang' => $lang]) }}" class="inline-flex items-center px-3.5 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-xl transition shadow-sm">
                            Edit CV
                        </a>
                    @endif
                @endauth
            </div>
        </div>

        <!-- The CV Paper -->
        <div class="flex justify-center">
            @php
                $accent = $profile?->theme_color ?? '#4f46e5';
            @endphp
            <style>
                #cv-paper .text-indigo-600, #cv-paper .text-indigo-500, #cv-paper .text-indigo-900 { color: {{ $accent }} !important; }
                #cv-paper .bg-indigo-600, #cv-paper .bg-indigo-500 { background-color: {{ $accent }} !important; }
                #cv-paper .border-indigo-600, #cv-paper .border-indigo-200, #cv-paper .border-indigo-100 { border-color: {{ $accent }} !important; }
                #cv-paper .bg-indigo-50 { background-color: {{ $accent }}20 !important; }
            </style>
            <div id="cv-paper" class="w-full max-w-[210mm] min-h-[297mm] bg-white text-slate-900 p-8 sm:p-12 shadow-2xl rounded-sm border border-gray-200 transition-all">

                @if ($template === 'modern')
                    <!-- ================= MODERN INDIGO TEMPLATE ================= -->
                    <div>
                        <!-- Header / Brand Accent -->
                        <div class="flex flex-col-reverse sm:flex-row sm:items-start justify-between gap-6 pb-6 border-b-2 border-indigo-600">
                            <div class="space-y-1.5">
                                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                                    {{ $profile?->full_name ?? $user->name }}
                                </h1>
                                @if ($profile?->headline)
                                    <div class="text-base sm:text-lg font-semibold text-indigo-600">
                                        {{ $profile->headline }}
                                    </div>
                                @endif

                                <!-- Contact Meta -->
                                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-slate-600 pt-2 font-medium">
                                    @if ($profile?->email_cv ?? $user->email)
                                        <span class="inline-flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                            {{ $profile?->email_cv ?? $user->email }}
                                        </span>
                                    @endif
                                    @if ($profile?->phone)
                                        <span class="inline-flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                            {{ $profile->phone }}
                                        </span>
                                    @endif
                                    @if ($profile?->address)
                                        <span class="inline-flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            {{ $profile->address }}
                                        </span>
                                    @endif
                                </div>

                                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-indigo-600 font-medium pt-1">
                                    @if ($profile?->linkedin_url)
                                        <a href="{{ $profile->linkedin_url }}" target="_blank" class="inline-flex items-center gap-1 hover:underline">
                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                            LinkedIn
                                        </a>
                                    @endif
                                    @if ($profile?->github_url)
                                        <a href="{{ $profile->github_url }}" target="_blank" class="inline-flex items-center gap-1 hover:underline">
                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                                            GitHub
                                        </a>
                                    @endif
                                    @if ($profile?->portfolio_url)
                                        <a href="{{ $profile->portfolio_url }}" target="_blank" class="inline-flex items-center gap-1 hover:underline">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                            Portofolio
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Photo (if available) -->
                            @if ($profile?->photo)
                                <div class="shrink-0">
                                    <img src="{{ asset('storage/' . $profile->photo) }}" 
                                         alt="{{ $profile->full_name }}" 
                                         class="w-24 h-28 object-cover rounded-xl border-2 border-indigo-100 shadow-sm">
                                </div>
                            @endif
                        </div>

                        <!-- Professional Summary -->
                        @if ($profile?->summary)
                            <div class="mt-6">
                                <h3 class="text-xs font-bold uppercase tracking-wider text-indigo-900 border-b border-indigo-100 pb-1.5 mb-2.5 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                                    {{ $labels['summary_title'] }}
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-700 leading-relaxed text-justify">
                                    {{ $profile->summary }}
                                </p>
                            </div>
                        @endif

                        <!-- Experiences Section -->
                        @if ($experiences->count() > 0 && ($profile->show_experience ?? true))
                            <div class="mt-6">
                                <h3 class="text-xs font-bold uppercase tracking-wider text-indigo-900 border-b border-indigo-100 pb-1.5 mb-3 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                                    {{ $labels['experience_title'] }}
                                </h3>
                                <div class="space-y-4">
                                    @foreach ($experiences as $exp)
                                        <div class="relative pl-4 border-l-2 border-indigo-200">
                                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                                <h4 class="text-sm font-bold text-slate-900">{{ $exp->position }}</h4>
                                                <span class="text-xs font-medium text-slate-500">
                                                    {{ \Carbon\Carbon::parse($exp->start_date)->translatedFormat('M Y') }} - 
                                                    {{ $exp->is_current ? $labels['present'] : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->translatedFormat('M Y') : '-') }}
                                                </span>
                                            </div>
                                            <div class="text-xs font-semibold text-indigo-600">{{ $exp->company_name }}</div>
                                            @if ($exp->description)
                                                <p class="text-xs text-slate-600 mt-1 leading-relaxed">{!! $exp->description !!}</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Education Section -->
                        @if ($education->count() > 0 && ($profile->show_education ?? true))
                            <div class="mt-6">
                                <h3 class="text-xs font-bold uppercase tracking-wider text-indigo-900 border-b border-indigo-100 pb-1.5 mb-3 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                                    {{ $labels['education_title'] }}
                                </h3>
                                <div class="space-y-3">
                                    @foreach ($education as $edu)
                                        <div class="relative pl-4 border-l-2 border-indigo-200">
                                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                                <h4 class="text-sm font-bold text-slate-900">{{ $edu->institution }}</h4>
                                                <span class="text-xs font-medium text-slate-500">{{ $edu->start_year }} - {{ $edu->end_year ?? $labels['present'] }}</span>
                                            </div>
                                            <div class="text-xs font-semibold text-indigo-600">{{ $edu->degree }}</div>
                                            @if ($edu->description)
                                                <p class="text-xs text-slate-600 mt-0.5">{!! $edu->description !!}</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Skills Section -->
                        @if ($skills->count() > 0 && ($profile->show_skills ?? true))
                            <div class="mt-6">
                                <h3 class="text-xs font-bold uppercase tracking-wider text-indigo-900 border-b border-indigo-100 pb-1.5 mb-3 flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                                    {{ $labels['skills_title'] }}
                                </h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($skills as $skill)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-indigo-50 border border-indigo-200 text-slate-800 text-xs font-medium">
                                            {{ $skill->skill_name }}
                                            <span class="text-[10px] font-bold text-indigo-600 uppercase">({{ $skill->level }})</span>
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                @elseif ($template === 'classic')
                    <!-- ================= CLASSIC EXECUTIVE TEMPLATE ================= -->
                    <div style="font-family: 'Times New Roman', Times, serif;">
                        <div class="text-center pb-6 border-b border-slate-300">
                            <h1 class="text-3xl font-bold text-slate-900 tracking-wide uppercase">
                                {{ $profile?->full_name ?? $user->name }}
                            </h1>
                            @if ($profile?->headline)
                                <div class="text-sm font-bold text-slate-600 mt-1 uppercase tracking-wider">
                                    {{ $profile->headline }}
                                </div>
                            @endif
                            <div class="text-xs text-slate-600 mt-2 space-x-2">
                                <span>{{ $profile?->email_cv ?? $user->email }}</span>
                                @if ($profile?->phone) <span>|</span> <span>{{ $profile->phone }}</span> @endif
                                @if ($profile?->address) <span>|</span> <span>{{ $profile->address }}</span> @endif
                            </div>
                            @if ($profile?->linkedin_url || $profile?->github_url || $profile?->portfolio_url)
                                <div class="text-xs text-slate-600 mt-1 space-x-2">
                                    @if ($profile?->linkedin_url) <a href="{{ $profile->linkedin_url }}" target="_blank" class="hover:underline text-slate-800 font-medium">LinkedIn</a> @endif
                                    @if ($profile?->github_url) <span>|</span> <a href="{{ $profile->github_url }}" target="_blank" class="hover:underline text-slate-800 font-medium">GitHub</a> @endif
                                    @if ($profile?->portfolio_url) <span>|</span> <a href="{{ $profile->portfolio_url }}" target="_blank" class="hover:underline text-slate-800 font-medium">Portofolio</a> @endif
                                </div>
                            @endif
                        </div>

                        @if ($profile?->summary)
                            <div class="mt-6">
                                <h3 class="text-xs font-bold uppercase tracking-widest text-slate-800 border-b border-slate-800 pb-1 mb-2">
                                    {{ strtoupper($labels['summary_title']) }}
                                </h3>
                                <p class="text-xs text-slate-900 leading-relaxed text-justify">{{ $profile->summary }}</p>
                            </div>
                        @endif

                        @if ($experiences->count() > 0 && ($profile->show_experience ?? true))
                            <div class="mt-6">
                                <h3 class="text-xs font-bold uppercase tracking-widest text-slate-800 border-b border-slate-800 pb-1 mb-3">
                                    {{ strtoupper($labels['experience_title']) }}
                                </h3>
                                <div class="space-y-4">
                                    @foreach ($experiences as $exp)
                                        <div>
                                            <div class="flex justify-between items-baseline text-xs font-bold text-slate-900">
                                                <span>{{ $exp->position }} - <span class="font-normal italic">{{ $exp->company_name }}</span></span>
                                                <span class="font-normal text-slate-600 italic">
                                                    {{ \Carbon\Carbon::parse($exp->start_date)->translatedFormat('M Y') }} - 
                                                    {{ $exp->is_current ? $labels['present'] : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->translatedFormat('M Y') : '-') }}
                                                </span>
                                            </div>
                                            @if ($exp->description)
                                                <p class="text-xs text-slate-800 mt-1 leading-relaxed">{!! $exp->description !!}</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($education->count() > 0 && ($profile->show_education ?? true))
                            <div class="mt-6">
                                <h3 class="text-xs font-bold uppercase tracking-widest text-slate-800 border-b border-slate-800 pb-1 mb-3">
                                    {{ strtoupper($labels['education_title']) }}
                                </h3>
                                <div class="space-y-3">
                                    @foreach ($education as $edu)
                                        <div class="flex justify-between items-baseline text-xs">
                                            <div>
                                                <span class="font-bold text-slate-900">{{ $edu->institution }}</span>
                                                <div class="text-slate-700 italic">{{ $edu->degree }}</div>
                                            </div>
                                            <span class="text-slate-600 font-medium italic">{{ $edu->start_year }} - {{ $edu->end_year ?? $labels['present'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($skills->count() > 0 && ($profile->show_skills ?? true))
                            <div class="mt-6">
                                <h3 class="text-xs font-bold uppercase tracking-widest text-slate-800 border-b border-slate-800 pb-1 mb-2">
                                    {{ strtoupper($labels['skills_title']) }}
                                </h3>
                                <p class="text-xs text-slate-800">
                                    {{ $skills->map(fn($s) => $s->skill_name . ' (' . $s->level . ')')->join(', ') }}
                                </p>
                            </div>
                        @endif
                    </div>

                @else
                    <!-- ================= MINIMALIST CLEAN TEMPLATE ================= -->
                    <div style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pb-6 border-b border-slate-200">
                            <div class="sm:col-span-2">
                                <h1 class="text-4xl font-black text-slate-900 tracking-tighter uppercase">
                                    {{ $profile?->full_name ?? $user->name }}
                                </h1>
                                <div class="text-xs font-semibold text-slate-500 uppercase tracking-widest mt-1">
                                    {{ $profile?->headline ?? 'Professional Profile' }}
                                </div>
                            </div>
                            <div class="text-xs text-slate-500 sm:text-right space-y-0.5">
                                <div>{{ $profile?->email_cv ?? $user->email }}</div>
                                @if ($profile?->phone) <div>{{ $profile->phone }}</div> @endif
                                @if ($profile?->address) <div>{{ $profile->address }}</div> @endif
                                @if ($profile?->linkedin_url) <div><a href="{{ $profile->linkedin_url }}" target="_blank" class="hover:underline text-slate-900 font-bold">LinkedIn</a></div> @endif
                                @if ($profile?->github_url) <div><a href="{{ $profile->github_url }}" target="_blank" class="hover:underline text-slate-900 font-bold">GitHub</a></div> @endif
                                @if ($profile?->portfolio_url) <div><a href="{{ $profile->portfolio_url }}" target="_blank" class="hover:underline text-slate-900 font-bold">Portofolio</a></div> @endif
                            </div>
                        </div>

                        @if ($profile?->summary)
                            <div class="mt-8">
                                <div class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">{{ strtoupper($labels['summary_title']) }}</div>
                                <p class="text-xs text-slate-800 leading-relaxed">{{ $profile->summary }}</p>
                            </div>
                        @endif

                        @if ($experiences->count() > 0 && ($profile->show_experience ?? true))
                            <div class="mt-8">
                                <div class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4">{{ strtoupper($labels['experience_title']) }}</div>
                                <div class="space-y-5">
                                    @foreach ($experiences as $exp)
                                        <div>
                                            <div class="flex justify-between text-xs font-bold text-slate-900">
                                                <span>{{ $exp->position }} &bull; <span class="text-slate-500 font-normal">{{ $exp->company_name }}</span></span>
                                                <span class="text-slate-400 font-mono text-[11px]">
                                                    {{ \Carbon\Carbon::parse($exp->start_date)->format('Y') }} - 
                                                    {{ $exp->is_current ? $labels['present'] : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('Y') : '-') }}
                                                </span>
                                            </div>
                                            @if ($exp->description)
                                                <p class="text-xs text-slate-600 mt-1 leading-relaxed">{!! $exp->description !!}</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($education->count() > 0 && ($profile->show_education ?? true))
                            <div class="mt-8">
                                <div class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4">{{ strtoupper($labels['education_title']) }}</div>
                                <div class="space-y-4">
                                    @foreach ($education as $edu)
                                        <div class="flex justify-between text-xs">
                                            <span><strong class="font-bold text-slate-900">{{ $edu->institution }}</strong> &bull; <span class="text-slate-600">{{ $edu->degree }}</span></span>
                                            <span class="text-slate-400 font-mono text-[11px]">{{ $edu->start_year }} - {{ $edu->end_year ?? $labels['present'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($skills->count() > 0 && ($profile->show_skills ?? true))
                            <div class="mt-8">
                                <div class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">{{ strtoupper($labels['skills_title']) }}</div>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($skills as $skill)
                                        <span class="px-2.5 py-1 rounded-md bg-slate-100 text-slate-700 text-xs font-bold">
                                            {{ $skill->skill_name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

</body>
</html>
