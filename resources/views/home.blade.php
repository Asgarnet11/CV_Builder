<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="LaraCV - Platform Online CV Builder profesional untuk pencari kerja, siswa, dan profesional muda. Bangun CV terstandar dalam hitungan menit.">
    <title>LaraCV - Online CV Builder Platform Profesional</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        h1, h2, h3, h4, .font-heading {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Background Atmospheric Glows -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10">
        <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[70rem] h-[35rem] bg-gradient-to-tr from-indigo-600/20 via-violet-600/20 to-sky-500/10 blur-[130px] rounded-full"></div>
        <div class="absolute top-[45rem] -left-40 w-[45rem] h-[35rem] bg-indigo-900/15 blur-[140px] rounded-full"></div>
        <div class="absolute top-[80rem] -right-40 w-[45rem] h-[35rem] bg-violet-900/15 blur-[140px] rounded-full"></div>
    </div>

    <!-- Navigation Header -->
    <header class="sticky top-0 z-50 backdrop-blur-xl bg-slate-950/80 border-b border-slate-800/80 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-indigo-600 via-indigo-500 to-violet-500 flex items-center justify-center shadow-lg shadow-indigo-500/30 group-hover:scale-105 transition duration-200">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <span class="text-2xl font-black tracking-tight text-white font-heading">Lara<span class="text-indigo-400">CV</span></span>
                        <span class="hidden sm:inline-block ml-2 px-2 py-0.5 text-[10px] uppercase font-bold tracking-wider bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 rounded-md">Builder</span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-300">
                    <a href="#fitur" class="hover:text-white transition">Fitur Utama</a>
                    <a href="#keunggulan" class="hover:text-white transition">Keunggulan</a>
                    <a href="#workflow" class="hover:text-white transition">Cara Kerja</a>
                    <a href="#faq" class="hover:text-white transition">FAQ</a>
                </nav>

                <!-- Contextual Authentication Action Buttons -->
                <div class="flex items-center gap-3">
                    @auth
                        <!-- Authenticated User -->
                        <a id="btn-dashboard-nav" href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white text-sm font-bold shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 transition duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            {{ __('Dashboard Saya') }}
                        </a>
                    @else
                        <!-- Guest User -->
                        <a id="btn-login-nav" href="{{ route('login') }}" class="px-4 py-2.5 text-sm font-semibold text-slate-300 hover:text-white transition">
                            {{ __('Masuk') }}
                        </a>
                        <a id="btn-register-nav" href="{{ route('register') }}" class="inline-flex items-center px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/50 transition duration-200">
                            {{ __('Daftar Gratis') }}
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative pt-12 pb-24 md:pt-20 md:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900 border border-slate-700/80 shadow-inner mb-6">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    <span class="text-xs font-semibold text-slate-300">Generasi Baru Builder Karir Digital • v1.0 Foundation</span>
                </div>

                <!-- Dynamic Hero Heading (FR-01.2) -->
                <h1 id="hero-heading" class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-white font-heading leading-tight md:leading-[1.15]">
                    {{ $heroHeading ?? 'Bangun CV Profesional Anda dalam Hitungan Menit' }}
                </h1>

                <!-- Subtitle / Value Proposition -->
                <p class="mt-6 text-lg sm:text-xl text-slate-300 leading-relaxed max-w-2xl mx-auto">
                    Platform cerdas untuk mengelola biodata, riwayat pendidikan, pengalaman kerja, dan keahlian Anda secara modular, aman, dan siap memikat HRD & Recruiter.
                </p>

                <!-- Hero CTA Buttons -->
                <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                    @auth
                        <a href="{{ route('cv-profile.edit') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-2xl bg-gradient-to-r from-indigo-600 via-indigo-500 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white text-base font-bold shadow-xl shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                            <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            {{ __('Kelola Biodata CV Saya') }}
                        </a>
                        <a href="{{ route('dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-7 py-4 rounded-2xl bg-slate-900/90 hover:bg-slate-800 border border-slate-700/80 text-slate-200 text-base font-semibold hover:border-slate-600 transition duration-200">
                            {{ __('Buka Dashboard') }}
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-2xl bg-gradient-to-r from-indigo-600 via-indigo-500 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white text-base font-bold shadow-xl shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                            {{ __('Mulai Buat CV Gratis') }}
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                        <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-7 py-4 rounded-2xl bg-slate-900/90 hover:bg-slate-800 border border-slate-700/80 text-slate-200 text-base font-semibold hover:border-slate-600 transition duration-200">
                            {{ __('Masuk ke Akun') }}
                        </a>
                    @endauth
                </div>

                <!-- Trust Badges -->
                <div class="mt-12 flex flex-wrap items-center justify-center gap-y-2 gap-x-8 text-xs text-slate-400 font-medium">
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        100% Bebas Biaya Pendaftaran
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        Standar Form Terstruktur & Aman
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                        Penyimpanan Berkas Foto Terisolasi
                    </span>
                </div>
            </div>

            <!-- Interactive Visual Preview Showcase -->
            <div class="mt-16 max-w-5xl mx-auto">
                <div class="relative rounded-3xl p-2 sm:p-3 bg-gradient-to-b from-indigo-500/30 via-slate-800/40 to-slate-900/60 border border-indigo-500/20 shadow-2xl shadow-indigo-500/10">
                    <div class="rounded-2xl bg-slate-900 border border-slate-800 overflow-hidden shadow-inner p-6 sm:p-8">
                        <!-- Mockup Topbar -->
                        <div class="flex items-center justify-between pb-6 border-b border-slate-800 mb-6">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-red-500/80"></span>
                                <span class="w-3 h-3 rounded-full bg-amber-500/80"></span>
                                <span class="w-3 h-3 rounded-full bg-emerald-500/80"></span>
                                <span class="ml-3 text-xs text-slate-400 font-mono">laracv.app/cv-preview</span>
                            </div>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-indigo-500/20 text-indigo-300 border border-indigo-500/30">
                                Mode Editor Interaktif
                            </span>
                        </div>

                        <!-- Mockup Content Grid -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <!-- Left Sidebar Mock -->
                            <div class="p-5 rounded-2xl bg-slate-950/70 border border-slate-800/80 space-y-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 rounded-xl bg-gradient-to-tr from-indigo-500 to-violet-500 flex items-center justify-center text-white font-bold text-xl shadow-md">
                                        JD
                                    </div>
                                    <div>
                                        <div class="h-4 w-28 bg-slate-700 rounded mb-1.5"></div>
                                        <div class="h-3 w-20 bg-indigo-500/50 rounded"></div>
                                    </div>
                                </div>
                                <div class="space-y-2 pt-2">
                                    <div class="h-2.5 w-full bg-slate-800 rounded"></div>
                                    <div class="h-2.5 w-4/5 bg-slate-800 rounded"></div>
                                    <div class="h-2.5 w-3/4 bg-slate-800 rounded"></div>
                                </div>
                                <div class="pt-4 border-t border-slate-800/80 space-y-2">
                                    <div class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Keahlian Teruji</div>
                                    <div class="flex flex-wrap gap-1.5">
                                        <span class="px-2 py-0.5 rounded bg-indigo-500/20 text-indigo-300 text-[10px] font-medium">Laravel</span>
                                        <span class="px-2 py-0.5 rounded bg-sky-500/20 text-sky-300 text-[10px] font-medium">Tailwind CSS</span>
                                        <span class="px-2 py-0.5 rounded bg-amber-500/20 text-amber-300 text-[10px] font-medium">MySQL</span>
                                        <span class="px-2 py-0.5 rounded bg-violet-500/20 text-violet-300 text-[10px] font-medium">REST API</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Content Mock -->
                            <div class="lg:col-span-2 p-5 rounded-2xl bg-slate-950/70 border border-slate-800/80 space-y-5">
                                <div>
                                    <div class="text-xs font-bold uppercase tracking-wider text-indigo-400 mb-2">Ringkasan Profesional</div>
                                    <p class="text-xs text-slate-300 leading-relaxed">
                                        Profesional web developer muda dengan fokus pada arsitektur bersih, performa tinggi, dan pengalaman pengguna modern. Berpengalaman merancang basis data relasional ternormalisasi dan antarmuka responsif.
                                    </p>
                                </div>
                                <div>
                                    <div class="text-xs font-bold uppercase tracking-wider text-indigo-400 mb-3">Riwayat Karir & Pendidikan</div>
                                    <div class="space-y-3">
                                        <div class="p-3 rounded-xl bg-slate-900/80 border border-slate-800 flex justify-between items-center">
                                            <div>
                                                <div class="text-xs font-bold text-white">Full Stack Developer Junior</div>
                                                <div class="text-[11px] text-slate-400">PT Inovasi Teknologi Bangsa</div>
                                            </div>
                                            <span class="text-[10px] px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-300 font-semibold">2024 - Sekarang</span>
                                        </div>
                                        <div class="p-3 rounded-xl bg-slate-900/80 border border-slate-800 flex justify-between items-center">
                                            <div>
                                                <div class="text-xs font-bold text-white">S1 Rekayasa Perangkat Lunak</div>
                                                <div class="text-[11px] text-slate-400">Institut Teknologi Digital Nusantara</div>
                                            </div>
                                            <span class="text-[10px] px-2 py-0.5 rounded bg-slate-800 text-slate-300 font-semibold">2020 - 2024</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section (FR-01.1) -->
    <section id="fitur" class="py-20 border-t border-slate-800/80 bg-slate-900/40 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-bold tracking-widest text-indigo-400 uppercase">Fitur Fondasi Unggulan</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-2 font-heading">
                    Semua yang Anda Butuhkan untuk Memulai Karir
                </h2>
                <p class="text-slate-400 text-sm mt-3">
                    Fondasi sistem yang kokoh dan modular, dirancang untuk memudahkan kustomisasi profil tanpa ribet.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="rounded-2xl p-7 bg-slate-900/90 border border-slate-800 hover:border-indigo-500/50 hover:bg-slate-850 transition duration-300 group">
                    <div class="w-12 h-12 rounded-xl bg-indigo-600/20 text-indigo-400 flex items-center justify-center mb-5 group-hover:scale-110 transition duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white font-heading">Manajemen Biodata Cerdas</h3>
                    <p class="text-sm text-slate-400 mt-2 leading-relaxed">
                        Pengisian profil otomatis mengambil nama dan email akun sebagai fallback awal. Sistem auto-upsert mencegah duplikasi data pengguna.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="rounded-2xl p-7 bg-slate-900/90 border border-slate-800 hover:border-indigo-500/50 hover:bg-slate-850 transition duration-300 group">
                    <div class="w-12 h-12 rounded-xl bg-violet-600/20 text-violet-400 flex items-center justify-center mb-5 group-hover:scale-110 transition duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white font-heading">Pengelolaan Foto Terisolasi</h3>
                    <p class="text-sm text-slate-400 mt-2 leading-relaxed">
                        Unggah foto profil formal dengan validasi ukuran file ketat (maks 2MB). Foto lama otomatis terhapus saat diganti untuk menjaga efisiensi storage.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="rounded-2xl p-7 bg-slate-900/90 border border-slate-800 hover:border-indigo-500/50 hover:bg-slate-850 transition duration-300 group">
                    <div class="w-12 h-12 rounded-xl bg-emerald-600/20 text-emerald-400 flex items-center justify-center mb-5 group-hover:scale-110 transition duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white font-heading">Integritas Relasional Cascade</h3>
                    <p class="text-sm text-slate-400 mt-2 leading-relaxed">
                        Seluruh entitas (profil, pendidikan, pengalaman, keahlian) terikat relasi aman dengan cascade deletion guna melindungi privasi dan integritas data.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Workflow Section -->
    <section id="workflow" class="py-20 border-t border-slate-800/80 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-bold tracking-widest text-indigo-400 uppercase">Alur Pembuatan</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white mt-2 font-heading">
                    Tiga Langkah Menuju CV Impian
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="relative p-6">
                    <div class="w-16 h-16 rounded-2xl bg-indigo-600/20 text-indigo-400 font-extrabold text-2xl flex items-center justify-center mx-auto mb-4 border border-indigo-500/30 font-heading">
                        01
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2 font-heading">Daftarkan Akun</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Buat akun gratis menggunakan email Anda dengan perlindungan enkripsi kata sandi standar Laravel Breeze.
                    </p>
                </div>

                <div class="relative p-6">
                    <div class="w-16 h-16 rounded-2xl bg-violet-600/20 text-violet-400 font-extrabold text-2xl flex items-center justify-center mx-auto mb-4 border border-violet-500/30 font-heading">
                        02
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2 font-heading">Isi Biodata & Unggah Foto</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Lengkapi headline karir, nomor kontak publik, ringkasan keahlian, dan unggah foto formal berukuran maksimal 2MB.
                    </p>
                </div>

                <div class="relative p-6">
                    <div class="w-16 h-16 rounded-2xl bg-emerald-600/20 text-emerald-400 font-extrabold text-2xl flex items-center justify-center mx-auto mb-4 border border-emerald-500/30 font-heading">
                        03
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2 font-heading">Simpan & Siap Digunakan</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Data langsung tersimpan via operasi updateOrCreate dan siap dipadukan dengan riwayat pendidikan & pengalaman.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-20 border-t border-slate-800/80 bg-slate-900/30">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-xs font-bold tracking-widest text-indigo-400 uppercase">Tanya Jawab</span>
                <h2 class="text-3xl font-extrabold text-white mt-2 font-heading">Pertanyaan yang Sering Diajukan</h2>
            </div>

            <div class="space-y-4">
                <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800">
                    <h4 class="text-base font-bold text-white font-heading">Apakah data profil saya dapat diedit kapan saja?</h4>
                    <p class="text-sm text-slate-400 mt-2">
                        Ya. Sistem menggunakan mekanisme updateOrCreate sehingga setiap kali Anda memperbarui form biodata di `/cv-profile`, data yang tersimpan akan diperbarui tanpa membuat duplikat akun.
                    </p>
                </div>
                <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800">
                    <h4 class="text-base font-bold text-white font-heading">Bagaimana pengelolaan file foto profil dilakukan?</h4>
                    <p class="text-sm text-slate-400 mt-2">
                        Foto disimpan pada storage publik terlindung. Saat Anda mengunggah foto baru, sistem secara otomatis menghapus file foto lama dari storage server untuk menjaga kebersihan data.
                    </p>
                </div>
                <div class="p-6 rounded-2xl bg-slate-900/80 border border-slate-800">
                    <h4 class="text-base font-bold text-white font-heading">Apa saja format gambar yang didukung?</h4>
                    <p class="text-sm text-slate-400 mt-2">
                        Format yang didukung adalah JPG, JPEG, dan PNG dengan batas ukuran berkas maksimum 2048 KB (2 MB).
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA Banner -->
    <section class="py-16 border-t border-slate-800/80 relative overflow-hidden">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="p-10 sm:p-14 rounded-3xl bg-gradient-to-r from-indigo-900/60 via-slate-900 to-violet-900/60 border border-indigo-500/30 shadow-2xl relative">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white font-heading">
                    Siap Membuka Peluang Karir Baru Anda?
                </h2>
                <p class="mt-4 text-slate-300 text-sm sm:text-base max-w-xl mx-auto">
                    Bergabunglah bersama ribuan pencari kerja lainnya dan buat CV profesional Anda sekarang juga.
                </p>
                <div class="mt-8">
                    @auth
                        <a href="{{ route('cv-profile.edit') }}" class="inline-flex items-center px-8 py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm shadow-lg shadow-indigo-600/30 transition">
                            {{ __('Buka Formulir Biodata CV') }} →
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm shadow-lg shadow-indigo-600/30 transition">
                            {{ __('Daftar Sekarang - Gratis!') }} →
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-10 border-t border-slate-900 bg-slate-950 text-slate-500 text-xs text-center">
        <div class="max-w-7xl mx-auto px-4">
            <p>&copy; {{ date('Y') }} LaraCV (Online CV Builder Platform). Dikembangkan sesuai Fondasi Fase 1.</p>
        </div>
    </footer>

</body>
</html>
