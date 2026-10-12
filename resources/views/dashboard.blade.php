<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
                    {{ __('Dashboard Ringkasan CV') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    {{ __('Selamat datang kembali, ') }} <span class="font-semibold text-indigo-600 dark:text-indigo-400">{{ Auth::user()->name }}</span>!
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('cv-preview.show') }}" class="inline-flex items-center px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-white font-semibold text-sm rounded-xl shadow-sm transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.164 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    {{ __('Pratinjau & Unduh PDF') }}
                </a>
                <a href="{{ route('cv-profile.edit') }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-semibold text-sm rounded-xl shadow-md shadow-indigo-500/20 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    {{ __('Kelola Biodata CV') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @php
                $profile = Auth::user()->cvProfile;
                $hasProfile = !empty($profile);
            @endphp

            <!-- Hero Welcome Card -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 text-white p-8 sm:p-10 shadow-xl border border-indigo-900/40">
                <div class="absolute -right-16 -top-16 w-80 h-80 rounded-full bg-indigo-500/10 blur-3xl pointer-events-none"></div>
                <div class="absolute -left-16 -bottom-16 w-80 h-80 rounded-full bg-violet-500/10 blur-3xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="space-y-3 max-w-2xl">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/20 border border-indigo-400/30 text-indigo-300 text-xs font-semibold">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            LaraCV Phase 1 • Core Foundation Active
                        </div>
                        <h3 class="text-3xl font-extrabold tracking-tight sm:text-4xl">
                            Siapkan Portofolio & CV Impian Anda
                        </h3>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                            LaraCV memudahkan Anda mengelola data identitas profesional, riwayat karir, serta kompetensi teknis secara aman dan terstandar.
                        </p>
                    </div>

                    <div class="shrink-0 bg-white/10 backdrop-blur-md rounded-2xl p-5 border border-white/10 text-center min-w-[200px]">
                        <span class="block text-xs uppercase tracking-wider text-slate-400 font-semibold mb-1">Status Profil</span>
                        @if ($hasProfile)
                            <div class="inline-flex items-center gap-1.5 text-emerald-400 font-bold text-lg">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Biodata Aktif
                            </div>
                            <p class="text-xs text-slate-300 mt-1">Terakhir diperbarui {{ $profile->updated_at->diffForHumans() }}</p>
                        @else
                            <div class="inline-flex items-center gap-1.5 text-amber-300 font-bold text-lg">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                Belum Lengkap
                            </div>
                            <p class="text-xs text-slate-300 mt-1">Lengkapi biodata awal Anda</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Guided Workflow Stepper -->
            <x-cv-wizard-stepper current="dashboard" />

            <!-- Profile Summary / Snapshot -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Biodata Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700/60 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="p-3 rounded-xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </span>
                            @if ($hasProfile)
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300">Tersedia</span>
                            @else
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-50 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300">Perlu Diisi</span>
                            @endif
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">Biodata & Kontak</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Nama lengkap, headline, nomor WhatsApp, email CV, dan tautan sosial.</p>

                        @if ($hasProfile)
                            <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700 space-y-2 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-500 dark:text-gray-400">Nama:</span>
                                    <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $profile->full_name }}</span>
                                </div>
                                @if ($profile->headline)
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-500 dark:text-gray-400">Headline:</span>
                                        <span class="font-medium text-gray-700 dark:text-gray-300 truncate max-w-[150px]">{{ $profile->headline }}</span>
                                    </div>
                                @endif
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-500 dark:text-gray-400">Foto:</span>
                                    <span class="font-medium text-gray-700 dark:text-gray-300">{{ $profile->photo ? 'Foto Terunggah' : 'Belum Ada' }}</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('cv-profile.edit') }}" class="block text-center py-2 px-4 rounded-xl bg-gray-50 dark:bg-gray-700/60 hover:bg-indigo-50 dark:hover:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 text-xs font-bold transition">
                            {{ $hasProfile ? __('Perbarui Biodata') : __('Isi Biodata Sekarang') }} →
                        </a>
                    </div>
                </div>

                <!-- Education Card (Roadmap Phase) -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700/60 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="p-3 rounded-xl bg-violet-50 dark:bg-violet-950/60 text-violet-600 dark:text-violet-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                </svg>
                            </span>
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">Tabel Siap</span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">Riwayat Pendidikan</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Skema basis data `education` telah dimigrasi dan terhubung relasi cascade dengan akun Anda.</p>
                        
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700 text-xs text-gray-500 dark:text-gray-400">
                            {{ Auth::user()->education()->count() }} catatan tersimpan
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col gap-2">
                        <a href="{{ route('education.index') }}" class="block text-center py-2 px-4 rounded-xl bg-violet-50 dark:bg-violet-900/40 hover:bg-violet-100 dark:hover:bg-violet-800/60 text-violet-700 dark:text-violet-300 text-xs font-bold transition">
                            Kelola Pendidikan
                        </a>
                    </div>
                </div>

                <!-- Experience & Skills Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700/60 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="p-3 rounded-xl bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </span>
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">Tabel Siap</span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">Pengalaman & Keahlian</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Skema basis data `experiences` dan `skills` telah aktif terintegrasi dengan Eloquent ORM.</p>

                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700 text-xs text-gray-500 dark:text-gray-400">
                            {{ Auth::user()->experiences()->count() }} Pengalaman • {{ Auth::user()->skills()->count() }} Keahlian
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col sm:flex-row gap-2">
                        <a href="{{ route('experience.index') }}" class="flex-1 text-center py-2 px-4 rounded-xl bg-emerald-50 dark:bg-emerald-900/40 hover:bg-emerald-100 dark:hover:bg-emerald-800/60 text-emerald-700 dark:text-emerald-300 text-xs font-bold transition">
                            Pengalaman
                        </a>
                        <a href="{{ route('skills.index') }}" class="flex-1 text-center py-2 px-4 rounded-xl bg-emerald-50 dark:bg-emerald-900/40 hover:bg-emerald-100 dark:hover:bg-emerald-800/60 text-emerald-700 dark:text-emerald-300 text-xs font-bold transition">
                            Keahlian
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
