<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
                    {{ __('Pratinjau CV (Live Preview)') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    {{ __('Lihat tampilan dokumen CV Anda secara real-time, pilih tema desain, dan ekspor ke PDF.') }}
                </p>
            </div>

            <!-- Action Buttons Toolbar -->
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('cv-profile.edit') }}" class="inline-flex items-center px-4 py-2.5 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-sm font-semibold rounded-xl transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    {{ __('Edit Biodata') }}
                </a>

                @if ($profile && $profile->slug)
                    <div x-data="{ copied: false }" class="relative inline-block">
                        <button @click="navigator.clipboard.writeText('{{ route('public.cv', ['slug' => $profile->slug, 'template' => $template]) }}'); copied = true; setTimeout(() => copied = false, 2000)" 
                                class="inline-flex items-center px-4 py-2.5 bg-emerald-50 dark:bg-emerald-900/30 hover:bg-emerald-100 dark:hover:bg-emerald-900/50 text-emerald-700 dark:text-emerald-400 text-sm font-semibold rounded-xl transition shadow-sm border border-emerald-200 dark:border-emerald-800">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                            <span x-show="!copied">Link Publik</span>
                            <span x-show="copied">Tersalin!</span>
                        </button>
                    </div>
                @endif

                <button onclick="window.print()" class="inline-flex items-center px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-white text-sm font-semibold rounded-xl transition shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    {{ __('Cetak / Print') }}
                </button>

                <div x-data="{ openExportMenu: false }" class="relative inline-block text-left">
                    <div class="inline-flex rounded-xl shadow-lg shadow-indigo-500/20">
                        <a href="{{ route('cv-preview.download', ['template' => $template]) }}" class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white text-sm font-bold rounded-l-xl transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            {{ __('Unduh PDF') }}
                        </a>
                        <button type="button" @click="openExportMenu = !openExportMenu" class="px-3 py-2.5 bg-indigo-700 hover:bg-indigo-800 text-white text-sm font-bold rounded-r-xl border-l border-indigo-500/40 transition focus:outline-none" title="Pilihan Format Lain">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </div>

                    <div x-show="openExportMenu" 
                         @click.away="openExportMenu = false" 
                         style="display: none;" 
                         class="origin-top-right absolute right-0 mt-2 w-64 rounded-2xl shadow-xl bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 dark:divide-gray-700 z-50 overflow-hidden"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95">
                        <div class="py-1">
                            <a href="{{ route('cv-preview.download-word') }}" class="flex items-center px-4 py-3 text-xs sm:text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-indigo-950/50 hover:text-indigo-600 transition">
                                <span class="mr-3 text-lg">📄</span>
                                <div>
                                    <div class="font-bold text-gray-900 dark:text-gray-100">Microsoft Word (.doc)</div>
                                    <div class="text-[11px] text-gray-500 font-normal">Format dokumen yang dapat diedit</div>
                                </div>
                            </a>
                            <a href="{{ route('cv-preview.download-json') }}" class="flex items-center px-4 py-3 text-xs sm:text-sm font-semibold text-gray-700 dark:text-gray-200 hover:bg-indigo-50 dark:hover:bg-indigo-950/50 hover:text-indigo-600 transition">
                                <span class="mr-3 text-lg">📋</span>
                                <div>
                                    <div class="font-bold text-gray-900 dark:text-gray-100">JSON Resume (.json)</div>
                                    <div class="text-[11px] text-gray-500 font-normal">Format data standar portabel</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-slate-100 dark:bg-slate-900 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Template Switcher Bar -->
            <div class="print:hidden bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Pilihan Tema Template:</span>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('cv-preview.show', ['template' => 'modern']) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold transition {{ $template === 'modern' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/20' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200' }}">
                        Modern Indigo
                    </a>
                    <a href="{{ route('cv-preview.show', ['template' => 'classic']) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold transition {{ $template === 'classic' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/20' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200' }}">
                        Classic Executive
                    </a>
                    <a href="{{ route('cv-preview.show', ['template' => 'minimal']) }}" 
                       class="px-4 py-2 rounded-xl text-xs font-bold transition {{ $template === 'minimal' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/20' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200' }}">
                        Minimalist Clean
                    </a>
                </div>
            </div>

            <!-- Profile Alert if empty -->
            @if (!$profile)
                <div class="print:hidden p-4 rounded-2xl bg-amber-50 dark:bg-amber-950/40 border border-amber-300 dark:border-amber-800 text-amber-800 dark:text-amber-200 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-amber-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-xs sm:text-sm font-medium">Biodata profil Anda masih menggunakan nilai default akun. Lengkapi biodata untuk hasil CV yang optimal.</span>
                    </div>
                    <a href="{{ route('cv-profile.edit') }}" class="px-3 py-1.5 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold shrink-0 ml-4">
                        Isi Biodata
                    </a>
                </div>
            @endif

            <!-- Paper Container (A4 Simulation) -->
            <div class="flex justify-center">
                @php
                    $accent = $profile?->theme_color ?? '#4f46e5';
                @endphp
                <style>
                    #cv-paper .text-indigo-600, #cv-paper .text-indigo-500, #cv-paper .text-indigo-900 { color: {{ $accent }} !important; }
                    #cv-paper .bg-indigo-600, #cv-paper .bg-indigo-500 { background-color: {{ $accent }} !important; }
                    #cv-paper .border-indigo-600, #cv-paper .border-indigo-200, #cv-paper .border-indigo-100 { border-color: {{ $accent }} !important; }
                    #cv-paper .bg-indigo-50 { background-color: {{ $accent }}20 !important; } /* 20 is hex opacity */
                </style>
                <div id="cv-paper" class="w-full max-w-[210mm] min-h-[297mm] bg-white text-slate-900 p-8 sm:p-12 shadow-2xl rounded-sm border border-gray-200 transition-all font-sans">

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
                                        {{ __('Ringkasan Profesional') }}
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
                                        {{ __('Pengalaman Kerja & Organisasi') }}
                                    </h3>
                                    <div class="space-y-4">
                                        @foreach ($experiences as $exp)
                                            <div class="relative pl-4 border-l-2 border-indigo-200">
                                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                                    <h4 class="text-sm font-bold text-slate-900">{{ $exp->position }}</h4>
                                                    <span class="text-xs font-medium text-slate-500">
                                                        {{ \Carbon\Carbon::parse($exp->start_date)->translatedFormat('M Y') }} - 
                                                        {{ $exp->is_current ? 'Sekarang' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->translatedFormat('M Y') : '-') }}
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
                                        {{ __('Riwayat Pendidikan') }}
                                    </h3>
                                    <div class="space-y-3">
                                        @foreach ($education as $edu)
                                            <div class="relative pl-4 border-l-2 border-indigo-200">
                                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                                    <h4 class="text-sm font-bold text-slate-900">{{ $edu->institution }}</h4>
                                                    <span class="text-xs font-medium text-slate-500">{{ $edu->start_year }} - {{ $edu->end_year ?? 'Sekarang' }}</span>
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
                                        {{ __('Keahlian & Kompetensi Teknis') }}
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
                        <div>
                            <div class="text-center pb-6 border-b border-slate-300">
                                <h1 class="text-3xl font-serif font-bold text-slate-900 tracking-wide uppercase">
                                    {{ $profile?->full_name ?? $user->name }}
                                </h1>
                                @if ($profile?->headline)
                                    <div class="text-sm font-medium text-slate-600 mt-1 uppercase tracking-wider">
                                        {{ $profile->headline }}
                                    </div>
                                @endif
                                <div class="text-xs text-slate-600 mt-2 space-x-2">
                                    <span>{{ $profile?->email_cv ?? $user->email }}</span>
                                    @if ($profile?->phone) <span>|</span> <span>{{ $profile->phone }}</span> @endif
                                    @if ($profile?->address) <span>|</span> <span>{{ $profile->address }}</span> @endif
                                </div>
                                @if ($profile?->linkedin_url || $profile?->portfolio_url)
                                    <div class="text-xs text-slate-600 mt-1 space-x-2">
                                        @if ($profile?->linkedin_url) <a href="{{ $profile->linkedin_url }}" target="_blank" class="hover:underline text-slate-800 font-medium">LinkedIn</a> @endif
                                        @if ($profile?->linkedin_url && $profile?->portfolio_url) <span>|</span> @endif
                                        @if ($profile?->portfolio_url) <a href="{{ $profile->portfolio_url }}" target="_blank" class="hover:underline text-slate-800 font-medium">Portofolio</a> @endif
                                    </div>
                                @endif
                            </div>

                            @if ($profile?->summary)
                                <div class="mt-6">
                                    <h3 class="text-xs font-bold uppercase tracking-widest text-slate-800 border-b border-slate-300 pb-1 mb-2">
                                        PROFIL SINGKAT
                                    </h3>
                                    <p class="text-xs text-slate-700 leading-relaxed text-justify">{{ $profile->summary }}</p>
                                </div>
                            @endif

                            @if ($experiences->count() > 0)
                                <div class="mt-6">
                                    <h3 class="text-xs font-bold uppercase tracking-widest text-slate-800 border-b border-slate-300 pb-1 mb-3">
                                        PENGALAMAN KERJA
                                    </h3>
                                    <div class="space-y-3">
                                        @foreach ($experiences as $exp)
                                            <div>
                                                <div class="flex justify-between items-baseline text-xs font-bold text-slate-900">
                                                    <span>{{ $exp->position }} - <span class="font-normal italic">{{ $exp->company_name }}</span></span>
                                                    <span class="font-normal text-slate-600">
                                                        {{ \Carbon\Carbon::parse($exp->start_date)->translatedFormat('M Y') }} - 
                                                        {{ $exp->is_current ? 'Sekarang' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->translatedFormat('M Y') : '-') }}
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

                            @if ($education->count() > 0)
                                <div class="mt-6">
                                    <h3 class="text-xs font-bold uppercase tracking-widest text-slate-800 border-b border-slate-300 pb-1 mb-3">
                                        PENDIDIKAN
                                    </h3>
                                    <div class="space-y-2">
                                        @foreach ($education as $edu)
                                            <div class="flex justify-between items-baseline text-xs">
                                                <div>
                                                    <span class="font-bold text-slate-900">{{ $edu->institution }}</span>
                                                    <div class="text-slate-600">{{ $edu->degree }}</div>
                                                </div>
                                                <span class="text-slate-600 font-medium">{{ $edu->start_year }} - {{ $edu->end_year ?? 'Sekarang' }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if ($skills->count() > 0 && ($profile->show_skills ?? true))
                                <div class="mt-6">
                                    <h3 class="text-xs font-bold uppercase tracking-widest text-slate-800 border-b border-slate-300 pb-1 mb-2">
                                        KEAHLIAN
                                    </h3>
                                    <p class="text-xs text-slate-700">
                                        {{ $skills->map(fn($s) => $s->skill_name . ' (' . $s->level . ')')->join(', ') }}
                                    </p>
                                </div>
                            @endif
                        </div>

                    @else
                        <!-- ================= MINIMALIST CLEAN TEMPLATE ================= -->
                        <div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pb-6 border-b border-slate-200">
                                <div class="sm:col-span-2">
                                    <h1 class="text-3xl font-black text-slate-900 tracking-tighter">
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
                                    @if ($profile?->linkedin_url) <div><a href="{{ $profile->linkedin_url }}" target="_blank" class="hover:underline">LinkedIn</a></div> @endif
                                    @if ($profile?->portfolio_url) <div><a href="{{ $profile->portfolio_url }}" target="_blank" class="hover:underline">Portofolio</a></div> @endif
                                </div>
                            </div>

                            @if ($profile?->summary)
                                <div class="mt-6">
                                    <div class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">TENTANG</div>
                                    <p class="text-xs text-slate-800 leading-relaxed">{{ $profile->summary }}</p>
                                </div>
                            @endif

                            @if ($experiences->count() > 0)
                                <div class="mt-6">
                                    <div class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">PENGALAMAN</div>
                                    <div class="space-y-4">
                                        @foreach ($experiences as $exp)
                                            <div>
                                                <div class="flex justify-between text-xs font-bold">
                                                    <span>{{ $exp->position }} &bull; <span class="text-slate-500 font-normal">{{ $exp->company_name }}</span></span>
                                                    <span class="text-slate-400 font-mono text-[11px]">
                                                        {{ \Carbon\Carbon::parse($exp->start_date)->format('Y') }} - 
                                                        {{ $exp->is_current ? 'Present' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('Y') : '-') }}
                                                    </span>
                                                </div>
                                                @if ($exp->description)
                                                    <p class="text-xs text-slate-600 mt-1">{!! $exp->description !!}</p>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if ($education->count() > 0)
                                <div class="mt-6">
                                    <div class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">PENDIDIKAN</div>
                                    <div class="space-y-2">
                                        @foreach ($education as $edu)
                                            <div class="flex justify-between text-xs">
                                                <span><strong class="font-bold">{{ $edu->institution }}</strong> &bull; {{ $edu->degree }}</span>
                                                <span class="text-slate-400 font-mono text-[11px]">{{ $edu->start_year }} - {{ $edu->end_year ?? 'Present' }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if ($skills->count() > 0 && ($profile->show_skills ?? true))
                                <div class="mt-6">
                                    <div class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">KEAHLIAN</div>
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach ($skills as $skill)
                                            <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-700 text-xs font-medium">
                                                {{ $skill->skill_name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Print Watermark / Footer -->
                    <div class="mt-12 pt-4 border-t border-slate-100 text-[10px] text-slate-400 text-center font-mono">
                        Dibuat dengan LaraCV &bull; {{ date('d M Y') }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
