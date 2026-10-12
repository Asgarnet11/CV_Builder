<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full bg-indigo-50 dark:bg-indigo-950/60 border border-indigo-200/50 dark:border-indigo-800/50 text-indigo-600 dark:text-indigo-400 text-xs font-bold tracking-wide uppercase mb-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    CV Studio Dashboard
                </div>
                <h2 class="font-extrabold text-2xl sm:text-3xl text-slate-900 dark:text-white tracking-tight">
                    {{ __('Selamat Datang, ') }} <span class="bg-gradient-to-r from-indigo-600 via-violet-600 to-pink-600 bg-clip-text text-transparent">{{ Auth::user()->name }}</span>
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                    {{ __('Kelola dan optimalkan resume profesional Anda untuk peluang karir impian.') }}
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-2.5">
                <a href="{{ route('cv-preview.show') }}" class="inline-flex items-center px-4 py-2.5 bg-slate-900 dark:bg-slate-800 hover:bg-slate-800 dark:hover:bg-slate-700 text-white font-bold text-xs rounded-xl shadow-sm transition hover:shadow hover:-translate-y-0.5">
                    <svg class="w-4 h-4 mr-1.5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.164 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    {{ __('Pratinjau CV') }}
                </a>
                <a href="{{ route('cv-profile.edit') }}" class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-xs rounded-xl shadow-md shadow-indigo-500/25 transition hover:shadow-indigo-500/40 hover:-translate-y-0.5">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    {{ __('Edit Profil CV') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 sm:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            @php
                $profile = Auth::user()->cvProfile;
                $hasProfile = !empty($profile);
                $expCount = Auth::user()->experiences()->count();
                $eduCount = Auth::user()->education()->count();
                $skillsCount = Auth::user()->skills()->count();

                $completeness = 0;
                if ($hasProfile) $completeness += 25;
                if ($expCount > 0) $completeness += 25;
                if ($eduCount > 0) $completeness += 25;
                if ($skillsCount > 0) $completeness += 25;
            @endphp

            <!-- Hero Welcome Card with Glassmorphic Gradient & Progress Track -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 text-white p-7 sm:p-10 shadow-xl border border-indigo-500/20">
                <!-- Background Ambient Glows -->
                <div class="absolute -right-16 -top-16 w-96 h-96 rounded-full bg-indigo-500/20 blur-3xl pointer-events-none"></div>
                <div class="absolute -left-16 -bottom-16 w-96 h-96 rounded-full bg-violet-600/20 blur-3xl pointer-events-none"></div>
                <div class="absolute inset-0 bg-[radial-gradient(#ffffff0a_1px,transparent_1px)] [background-size:16px_16px] pointer-events-none"></div>

                <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                    <div class="space-y-4 max-w-2xl">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-indigo-200 text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>Sistem CV Cerdas & Ekspor Multi-Format</span>
                        </div>
                        <h3 class="text-2xl sm:text-4xl font-extrabold tracking-tight leading-tight">
                            Buat Resume Standar Industri dalam Hitungan Menit
                        </h3>
                        <p class="text-slate-300 text-xs sm:text-sm leading-relaxed max-w-xl">
                            LaraCV menyediakan format standar ATS, ringkasan AI interaktif, pemilihan palet warna tema, serta unduhan PDF, Word, dan JSON Resume.
                        </p>

                        <!-- Quick Action Pills -->
                        <div class="pt-2 flex flex-wrap items-center gap-3">
                            <a href="{{ route('cv-preview.show') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl shadow-lg shadow-indigo-600/30 transition hover:-translate-y-0.5">
                                <span>Lihat Pratinjau Dokumen</span>
                                <svg class="w-3.5 h-3.5 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                            @if ($hasProfile && $profile->slug)
                                <a href="{{ route('public.cv', ['slug' => $profile->slug]) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-white/10 hover:bg-white/20 text-white font-bold text-xs rounded-xl border border-white/15 backdrop-blur-md transition hover:-translate-y-0.5">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    <span>Buka Tautan Publik</span>
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Progress Gauge Box -->
                    <div class="shrink-0 bg-white/10 backdrop-blur-xl rounded-2xl p-6 border border-white/15 text-center min-w-[240px] shadow-lg">
                        <div class="flex items-center justify-between gap-4 mb-2">
                            <span class="text-xs uppercase tracking-wider text-slate-300 font-bold">Kelengkapan CV</span>
                            <span class="text-sm font-extrabold text-white px-2 py-0.5 rounded-full bg-indigo-500/40 border border-indigo-400/30">
                                {{ $completeness }}%
                            </span>
                        </div>

                        <!-- Progress Bar -->
                        <div class="w-full bg-white/15 rounded-full h-3 mb-4 overflow-hidden p-0.5 border border-white/10">
                            <div class="bg-gradient-to-r from-indigo-400 via-violet-400 to-emerald-400 h-full rounded-full transition-all duration-500" style="width: {{ $completeness }}%"></div>
                        </div>

                        <div class="grid grid-cols-2 gap-2 text-left text-[11px] text-slate-300">
                            <div class="flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full {{ $hasProfile ? 'bg-emerald-400' : 'bg-slate-500' }}"></span>
                                <span>Biodata</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full {{ $expCount > 0 ? 'bg-emerald-400' : 'bg-slate-500' }}"></span>
                                <span>Pengalaman</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full {{ $eduCount > 0 ? 'bg-emerald-400' : 'bg-slate-500' }}"></span>
                                <span>Pendidikan</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full {{ $skillsCount > 0 ? 'bg-emerald-400' : 'bg-slate-500' }}"></span>
                                <span>Keahlian</span>
                            </div>
                        </div>

                        @if ($completeness === 100)
                            <div class="mt-4 pt-3 border-t border-white/10 text-emerald-400 font-bold text-xs flex items-center justify-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                <span>CV Anda Sudah Siap Digunakan!</span>
                            </div>
                        @else
                            <div class="mt-4 pt-3 border-t border-white/10 text-amber-300 font-medium text-[11px]">
                                Lengkapi sisa bagian untuk memaksimalkan daya tarik CV
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Guided Workflow Stepper -->
            <x-cv-wizard-stepper current="dashboard" />

            <!-- Bento Grid 4 Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- 1. Biodata & Personal Contact Card -->
                <div class="bg-white dark:bg-slate-800/90 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 border border-slate-200/80 dark:border-slate-700 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-950/70 text-indigo-600 dark:text-indigo-400 flex items-center justify-center shadow-inner group-hover:scale-110 transition duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            @if ($hasProfile)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[11px] font-bold rounded-full bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 border border-emerald-200/50 dark:border-emerald-800/50">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Lengkap
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[11px] font-bold rounded-full bg-amber-50 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300 border border-amber-200/50 dark:border-amber-800/50">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Belum Diisi
                                </span>
                            @endif
                        </div>

                        <h4 class="text-base font-bold text-slate-900 dark:text-white">Biodata & Kontak</h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 line-clamp-2">Identitas profesional, headline karir, foto profil, dan kontak publik.</p>

                        <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-700/80 space-y-2 text-xs">
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Nama:</span>
                                <span class="font-semibold text-slate-800 dark:text-slate-200 truncate max-w-[120px]">{{ $hasProfile ? $profile->full_name : Auth::user()->name }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Headline:</span>
                                <span class="font-medium text-slate-700 dark:text-slate-300 truncate max-w-[120px]">{{ $hasProfile && $profile->headline ? $profile->headline : '-' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400">Foto:</span>
                                <span class="font-medium text-slate-700 dark:text-slate-300">{{ $hasProfile && $profile->photo ? 'Foto Aktif' : 'Belum Ada' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-2">
                        <a href="{{ route('cv-profile.edit') }}" class="block text-center py-2.5 px-4 rounded-xl bg-slate-50 dark:bg-slate-700/60 hover:bg-indigo-600 hover:text-white dark:hover:bg-indigo-600 text-indigo-600 dark:text-indigo-400 text-xs font-bold transition duration-200 shadow-sm">
                            {{ $hasProfile ? __('Perbarui Biodata') : __('Isi Biodata Sekarang') }} →
                        </a>
                    </div>
                </div>

                <!-- 2. Pengalaman Kerja Card -->
                <div class="bg-white dark:bg-slate-800/90 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 border border-slate-200/80 dark:border-slate-700 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-950/70 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shadow-inner group-hover:scale-110 transition duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-1 text-[11px] font-bold rounded-full bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 border border-emerald-200/50 dark:border-emerald-800/50">
                                {{ $expCount }} Riwayat
                            </span>
                        </div>

                        <h4 class="text-base font-bold text-slate-900 dark:text-white">Pengalaman Kerja</h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 line-clamp-2">Jabatan, nama instansi/perusahaan, durasi kerja, dan deskripsi pencapaian.</p>

                        <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-700/80 space-y-2 text-xs">
                            @php $latestExp = Auth::user()->experiences()->latest()->first(); @endphp
                            @if ($latestExp)
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-400">Terbaru:</span>
                                    <span class="font-semibold text-slate-800 dark:text-slate-200 truncate max-w-[130px]">{{ $latestExp->position }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-400">Instansi:</span>
                                    <span class="font-medium text-slate-700 dark:text-slate-300 truncate max-w-[130px]">{{ $latestExp->company_name }}</span>
                                </div>
                            @else
                                <div class="text-slate-400 text-center py-2 text-[11px]">Belum ada riwayat pengalaman kerja</div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6 pt-2 flex items-center gap-2">
                        <a href="{{ route('experience.index') }}" class="flex-1 text-center py-2.5 px-3 rounded-xl bg-slate-50 dark:bg-slate-700/60 hover:bg-emerald-600 hover:text-white dark:hover:bg-emerald-600 text-emerald-600 dark:text-emerald-400 text-xs font-bold transition duration-200 shadow-sm">
                            Kelola
                        </a>
                        <a href="{{ route('experience.create') }}" class="py-2.5 px-3 rounded-xl bg-emerald-50 dark:bg-emerald-950/70 hover:bg-emerald-100 text-emerald-700 dark:text-emerald-300 text-xs font-bold transition duration-200" title="Tambah Baru">
                            + Tambah
                        </a>
                    </div>
                </div>

                <!-- 3. Riwayat Pendidikan Card -->
                <div class="bg-white dark:bg-slate-800/90 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 border border-slate-200/80 dark:border-slate-700 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-violet-50 dark:bg-violet-950/70 text-violet-600 dark:text-violet-400 flex items-center justify-center shadow-inner group-hover:scale-110 transition duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                </svg>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-1 text-[11px] font-bold rounded-full bg-violet-50 dark:bg-violet-950/60 text-violet-700 dark:text-violet-300 border border-violet-200/50 dark:border-violet-800/50">
                                {{ $eduCount }} Riwayat
                            </span>
                        </div>

                        <h4 class="text-base font-bold text-slate-900 dark:text-white">Pendidikan Formal</h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 line-clamp-2">Institusi pendidikan, gelar akademik, tahun studi, dan prestasi kelulusan.</p>

                        <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-700/80 space-y-2 text-xs">
                            @php $latestEdu = Auth::user()->education()->latest()->first(); @endphp
                            @if ($latestEdu)
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-400">Kampus/Sekolah:</span>
                                    <span class="font-semibold text-slate-800 dark:text-slate-200 truncate max-w-[130px]">{{ $latestEdu->institution }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-400">Gelar/Jurusan:</span>
                                    <span class="font-medium text-slate-700 dark:text-slate-300 truncate max-w-[130px]">{{ $latestEdu->degree }}</span>
                                </div>
                            @else
                                <div class="text-slate-400 text-center py-2 text-[11px]">Belum ada riwayat pendidikan</div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6 pt-2 flex items-center gap-2">
                        <a href="{{ route('education.index') }}" class="flex-1 text-center py-2.5 px-3 rounded-xl bg-slate-50 dark:bg-slate-700/60 hover:bg-violet-600 hover:text-white dark:hover:bg-violet-600 text-violet-600 dark:text-violet-400 text-xs font-bold transition duration-200 shadow-sm">
                            Kelola
                        </a>
                        <a href="{{ route('education.create') }}" class="py-2.5 px-3 rounded-xl bg-violet-50 dark:bg-violet-950/70 hover:bg-violet-100 text-violet-700 dark:text-violet-300 text-xs font-bold transition duration-200" title="Tambah Baru">
                            + Tambah
                        </a>
                    </div>
                </div>

                <!-- 4. Keahlian & Kompetensi Card -->
                <div class="bg-white dark:bg-slate-800/90 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 border border-slate-200/80 dark:border-slate-700 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-rose-50 dark:bg-rose-950/70 text-rose-600 dark:text-rose-400 flex items-center justify-center shadow-inner group-hover:scale-110 transition duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-1 text-[11px] font-bold rounded-full bg-rose-50 dark:bg-rose-950/60 text-rose-700 dark:text-rose-300 border border-rose-200/50 dark:border-rose-800/50">
                                {{ $skillsCount }} Skill
                            </span>
                        </div>

                        <h4 class="text-base font-bold text-slate-900 dark:text-white">Keahlian & Skill</h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 line-clamp-2">Keahlian teknis maupun interpersonal dengan indikator tingkat kemahiran.</p>

                        <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-700/80 text-xs">
                            @php $sampleSkills = Auth::user()->skills()->take(3)->get(); @endphp
                            @if ($sampleSkills->isNotEmpty())
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach ($sampleSkills as $s)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 text-[11px] font-medium">
                                            {{ $s->skill_name }}
                                        </span>
                                    @endforeach
                                    @if ($skillsCount > 3)
                                        <span class="text-[11px] text-slate-400 self-center">+{{ $skillsCount - 3 }} lainnya</span>
                                    @endif
                                </div>
                            @else
                                <div class="text-slate-400 text-center py-2 text-[11px]">Belum ada keahlian ditambahkan</div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6 pt-2 flex items-center gap-2">
                        <a href="{{ route('skills.index') }}" class="flex-1 text-center py-2.5 px-3 rounded-xl bg-slate-50 dark:bg-slate-700/60 hover:bg-rose-600 hover:text-white dark:hover:bg-rose-600 text-rose-600 dark:text-rose-400 text-xs font-bold transition duration-200 shadow-sm">
                            Kelola
                        </a>
                        <a href="{{ route('skills.create') }}" class="py-2.5 px-3 rounded-xl bg-rose-50 dark:bg-rose-950/70 hover:bg-rose-100 text-rose-700 dark:text-rose-300 text-xs font-bold transition duration-200" title="Tambah Baru">
                            + Tambah
                        </a>
                    </div>
                </div>

            </div>

            <!-- CV Template Gallery Showcase -->
            <div class="bg-white dark:bg-slate-800/90 rounded-3xl p-6 sm:p-8 border border-slate-200/80 dark:border-slate-700 shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <div>
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 dark:text-indigo-400 text-xs font-bold uppercase tracking-wider mb-1">
                            <span>✨ Koleksi Template CV</span>
                        </div>
                        <h3 class="text-xl font-extrabold text-slate-900 dark:text-white">Pilihan Gaya Desain Template</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Pilih layout yang paling sesuai dengan industri dan standar lamaran Anda.</p>
                    </div>
                    <a href="{{ route('cv-preview.show') }}" class="inline-flex items-center text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition">
                        <span>Buka Studio Pratinjau Penuh</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Template 1: Modern Indigo -->
                    <div class="rounded-2xl border border-slate-200 dark:border-slate-700 p-5 bg-slate-50/50 dark:bg-slate-900/50 flex flex-col justify-between hover:border-indigo-500 dark:hover:border-indigo-500 transition group hover:shadow-lg">
                        <div>
                            <div class="aspect-[4/3] rounded-xl bg-white dark:bg-slate-800 p-4 border border-slate-200/60 dark:border-slate-700/60 flex flex-col justify-between shadow-xs mb-4 relative overflow-hidden group-hover:scale-[1.02] transition duration-300">
                                <div class="border-b-2 border-indigo-600 pb-2">
                                    <div class="w-20 h-2.5 bg-slate-800 dark:bg-slate-200 rounded-sm mb-1"></div>
                                    <div class="w-14 h-1.5 bg-indigo-500 rounded-xs"></div>
                                </div>
                                <div class="grid grid-cols-12 gap-2 my-auto">
                                    <div class="col-span-8 space-y-1.5">
                                        <div class="w-full h-1.5 bg-slate-200 dark:bg-slate-700 rounded-xs"></div>
                                        <div class="w-4/5 h-1.5 bg-slate-200 dark:bg-slate-700 rounded-xs"></div>
                                        <div class="w-3/4 h-1.5 bg-slate-200 dark:bg-slate-700 rounded-xs"></div>
                                    </div>
                                    <div class="col-span-4 bg-indigo-50 dark:bg-indigo-950/40 rounded p-1 space-y-1">
                                        <div class="w-full h-1 bg-indigo-300 rounded-xs"></div>
                                        <div class="w-2/3 h-1 bg-indigo-300 rounded-xs"></div>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center text-[10px] text-slate-400 pt-1 border-t border-slate-100 dark:border-slate-800">
                                    <span>ATS-Friendly</span>
                                    <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <h4 class="font-bold text-slate-900 dark:text-white text-sm">Modern Indigo</h4>
                                <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-indigo-100 text-indigo-700 dark:bg-indigo-950/70 dark:text-indigo-300">Populer</span>
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Layout profesional dengan aksen header modern dan sidebar ringkasan.</p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-200/60 dark:border-slate-700/60">
                            <a href="{{ route('cv-preview.show', ['template' => 'modern']) }}" class="block text-center py-2 px-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow-sm transition">
                                Pakai Template Ini
                            </a>
                        </div>
                    </div>

                    <!-- Template 2: Classic Executive -->
                    <div class="rounded-2xl border border-slate-200 dark:border-slate-700 p-5 bg-slate-50/50 dark:bg-slate-900/50 flex flex-col justify-between hover:border-slate-400 dark:hover:border-slate-500 transition group hover:shadow-lg">
                        <div>
                            <div class="aspect-[4/3] rounded-xl bg-white dark:bg-slate-800 p-4 border border-slate-200/60 dark:border-slate-700/60 flex flex-col justify-between shadow-xs mb-4 relative overflow-hidden group-hover:scale-[1.02] transition duration-300">
                                <div class="text-center pb-2 border-b border-slate-300 dark:border-slate-700 flex flex-col items-center">
                                    <div class="w-24 h-2.5 bg-slate-800 dark:bg-slate-200 rounded-sm mb-1"></div>
                                    <div class="w-16 h-1.5 bg-slate-400 rounded-xs"></div>
                                </div>
                                <div class="space-y-1.5 my-auto">
                                    <div class="w-16 h-2 bg-slate-700 dark:bg-slate-300 rounded-xs"></div>
                                    <div class="w-full h-1.5 bg-slate-200 dark:bg-slate-700 rounded-xs"></div>
                                    <div class="w-5/6 h-1.5 bg-slate-200 dark:bg-slate-700 rounded-xs"></div>
                                </div>
                                <div class="flex justify-between items-center text-[10px] text-slate-400 pt-1 border-t border-slate-100 dark:border-slate-800">
                                    <span>Formal & Korporat</span>
                                    <span class="w-2 h-2 rounded-full bg-slate-600"></span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <h4 class="font-bold text-slate-900 dark:text-white text-sm">Classic Executive</h4>
                                <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">Formal</span>
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Gaya tipografi klasik berpusat di tengah, ideal untuk industri hukum, perbankan, dan BUMN.</p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-200/60 dark:border-slate-700/60">
                            <a href="{{ route('cv-preview.show', ['template' => 'classic']) }}" class="block text-center py-2 px-3 rounded-xl bg-slate-800 hover:bg-slate-700 dark:bg-slate-700 dark:hover:bg-slate-600 text-white font-bold text-xs shadow-sm transition">
                                Pakai Template Ini
                            </a>
                        </div>
                    </div>

                    <!-- Template 3: Minimalist Clean -->
                    <div class="rounded-2xl border border-slate-200 dark:border-slate-700 p-5 bg-slate-50/50 dark:bg-slate-900/50 flex flex-col justify-between hover:border-emerald-500 dark:hover:border-emerald-500 transition group hover:shadow-lg">
                        <div>
                            <div class="aspect-[4/3] rounded-xl bg-white dark:bg-slate-800 p-4 border border-slate-200/60 dark:border-slate-700/60 flex flex-col justify-between shadow-xs mb-4 relative overflow-hidden group-hover:scale-[1.02] transition duration-300">
                                <div class="flex justify-between items-start pb-2">
                                    <div>
                                        <div class="w-20 h-2 bg-slate-900 dark:bg-white rounded-xs mb-1"></div>
                                        <div class="w-12 h-1 bg-emerald-500 rounded-xs"></div>
                                    </div>
                                    <div class="w-6 h-6 rounded-full bg-slate-200 dark:bg-slate-700"></div>
                                </div>
                                <div class="space-y-1.5 my-auto">
                                    <div class="w-full h-1 bg-slate-200 dark:bg-slate-700 rounded-xs"></div>
                                    <div class="w-11/12 h-1 bg-slate-200 dark:bg-slate-700 rounded-xs"></div>
                                    <div class="w-4/5 h-1 bg-slate-200 dark:bg-slate-700 rounded-xs"></div>
                                </div>
                                <div class="flex justify-between items-center text-[10px] text-slate-400 pt-1 border-t border-slate-100 dark:border-slate-800">
                                    <span>Minimalis & Modern</span>
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <h4 class="font-bold text-slate-900 dark:text-white text-sm">Minimalist Clean</h4>
                                <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-950/70 dark:text-emerald-300">Kreatif</span>
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Desain bersih dengan tata letak lapang, disukai oleh startup teknologi dan agensi kreatif.</p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-200/60 dark:border-slate-700/60">
                            <a href="{{ route('cv-preview.show', ['template' => 'minimal']) }}" class="block text-center py-2 px-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition">
                                Pakai Template Ini
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pro Features Banner (AI Assistant, Multi-Format, Live Sharing) -->
            <div class="rounded-3xl bg-gradient-to-r from-indigo-900 via-indigo-800 to-violet-900 text-white p-6 sm:p-8 shadow-lg flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-64 h-64 rounded-full bg-white/5 blur-2xl pointer-events-none"></div>
                <div class="space-y-2 max-w-2xl relative z-10">
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-white/20 text-indigo-200 text-[11px] font-bold">
                        <span>⚡ Fitur Unggulan Aktif</span>
                    </div>
                    <h4 class="text-lg sm:text-xl font-bold">AI Resume Assistant & Ekspor Lengkap Siap Digunakan</h4>
                    <p class="text-xs sm:text-sm text-indigo-200 leading-relaxed">
                        Manfaatkan asisten AI cerdas untuk menyempurnakan ringkasan profesional, kustomisasi palet warna tema, serta unduh langsung ke format PDF, Microsoft Word (.doc), atau JSON Resume.
                    </p>
                </div>
                <div class="relative z-10 flex items-center gap-3 shrink-0">
                    <a href="{{ route('cv-profile.edit') }}" class="px-5 py-2.5 rounded-xl bg-white text-indigo-950 font-extrabold text-xs shadow-md hover:bg-slate-100 transition hover:-translate-y-0.5">
                        Coba AI Assistant
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
