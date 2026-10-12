<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LaraCV — Platform Pembuat CV Profesional, Modern & ATS-Friendly</title>
    <meta name="description" content="Buat dan ekspor CV profesional berstandar ATS dalam hitungan menit dengan dukungan asisten AI, live preview, dan format PDF, Word, serta JSON Resume.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 antialiased selection:bg-indigo-500 selection:text-white relative overflow-x-hidden min-h-screen flex flex-col justify-between">

    <!-- Ambient Lighting Effects -->
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-96 bg-gradient-to-b from-indigo-600/15 via-violet-600/10 to-transparent blur-3xl pointer-events-none -z-10"></div>
    <div class="fixed -top-40 -right-40 w-96 h-96 rounded-full bg-indigo-500/10 blur-3xl pointer-events-none -z-10"></div>
    <div class="fixed top-1/3 -left-40 w-96 h-96 rounded-full bg-violet-500/10 blur-3xl pointer-events-none -z-10"></div>
    <div class="fixed inset-0 bg-[radial-gradient(#334155_1px,transparent_1px)] [background-size:32px_32px] opacity-25 pointer-events-none -z-10"></div>

    <!-- Header / Navbar -->
    <header class="sticky top-0 z-50 backdrop-blur-xl bg-slate-950/80 border-b border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-indigo-600 via-indigo-500 to-violet-500 text-white flex items-center justify-center font-black text-lg shadow-lg shadow-indigo-500/25 group-hover:scale-105 transition duration-300">
                    CV
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-extrabold text-xl text-white tracking-tight">LaraCV</span>
                        <span class="px-1.5 py-0.5 rounded text-[10px] font-extrabold bg-indigo-500/20 text-indigo-400 border border-indigo-500/30">PRO</span>
                    </div>
                    <span class="text-[10px] text-slate-400 block -mt-1 font-medium tracking-wide">Professional Builder</span>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-300">
                <a href="#fitur" class="hover:text-white transition">Fitur Utama</a>
                <a href="#template" class="hover:text-white transition">Koleksi Template</a>
                <a href="#ai" class="hover:text-white transition">Asisten AI</a>
                <a href="#ekspor" class="hover:text-white transition">Format Ekspor</a>
            </nav>

            <!-- Auth CTA -->
            <div class="flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs shadow-lg shadow-indigo-600/30 transition hover:-translate-y-0.5">
                            <span>Buka Dashboard</span>
                            <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-xs font-bold text-slate-300 hover:text-white transition">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-bold text-xs shadow-lg shadow-indigo-600/30 transition hover:-translate-y-0.5">
                                Buat Akun Gratis
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section class="pt-16 pb-20 sm:pt-24 sm:pb-32 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto text-center relative">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-300 text-xs font-bold tracking-wide uppercase mb-6 shadow-inner">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Standar Industri ATS • AI-Powered • Multi-Format</span>
            </div>

            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-white max-w-4xl mx-auto leading-[1.1]">
                Bangun CV Profesional Impian dalam <span class="bg-gradient-to-r from-indigo-400 via-violet-400 to-pink-400 bg-clip-text text-transparent">Hitungan Menit</span>
            </h1>

            <p class="mt-6 text-base sm:text-xl text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Platform resume cerdas dengan asisten AI, kustomisasi palet warna tema, pratinjau live split-screen, serta ekspor instan ke PDF, Word, atau JSON Resume.
            </p>

            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-2xl bg-gradient-to-r from-indigo-600 via-indigo-500 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-extrabold text-sm shadow-xl shadow-indigo-600/30 transition hover:-translate-y-0.5">
                        <span>Lanjutkan ke CV Dashboard</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-2xl bg-gradient-to-r from-indigo-600 via-indigo-500 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-extrabold text-sm shadow-xl shadow-indigo-600/30 transition hover:-translate-y-0.5">
                        <span>Mulai Buat CV Gratis Sekarang</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-2xl bg-slate-900 hover:bg-slate-800 text-slate-200 border border-slate-800 font-bold text-sm transition">
                        Masuk ke Akun
                    </a>
                @endauth
            </div>

            <!-- Trust / Highlights Badges -->
            <div class="mt-16 pt-10 border-t border-slate-800/80 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div>
                    <div class="text-2xl sm:text-3xl font-extrabold text-white">100% ATS</div>
                    <div class="text-xs text-slate-400 mt-1 font-medium">Lolos Mesin Skrining Rekruter</div>
                </div>
                <div>
                    <div class="text-2xl sm:text-3xl font-extrabold text-indigo-400">3 Pilihan</div>
                    <div class="text-xs text-slate-400 mt-1 font-medium">Template Desain Profesional</div>
                </div>
                <div>
                    <div class="text-2xl sm:text-3xl font-extrabold text-emerald-400">PDF, DOC, JSON</div>
                    <div class="text-xs text-slate-400 mt-1 font-medium">Format Ekspor Lengkap</div>
                </div>
                <div>
                    <div class="text-2xl sm:text-3xl font-extrabold text-violet-400">AI Assistant</div>
                    <div class="text-xs text-slate-400 mt-1 font-medium">Optimasi Ringkasan & Bullet Point</div>
                </div>
            </div>
        </section>

        <!-- Bento Feature Highlights -->
        <section id="fitur" class="py-20 bg-slate-900/60 border-y border-slate-800/80 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto space-y-12">
                <div class="text-center max-w-2xl mx-auto space-y-3">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-indigo-400">Keunggulan Sistem</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white">Semua Kebutuhan CV Profesional dalam Satu Platform</h2>
                    <p class="text-sm text-slate-400">Didesain khusus untuk meningkatkan peluang lolos panggilan wawancara kerja di perusahaan global maupun nasional.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Feature 1 -->
                    <div class="p-8 rounded-3xl bg-slate-900/80 border border-slate-800 hover:border-indigo-500/50 transition duration-300 group shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center font-bold text-xl mb-6 group-hover:scale-110 transition">
                                🤖
                            </div>
                            <h3 class="text-xl font-bold text-white">AI Resume Assistant</h3>
                            <p class="text-xs sm:text-sm text-slate-400 mt-2 leading-relaxed">
                                Hasilkan ringkasan profesional yang menarik dan susun poin pencapaian kerja berdampak tinggi secara instan dalam Bahasa Indonesia maupun Inggris.
                            </p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-slate-800/60 text-xs font-bold text-indigo-400 flex items-center gap-1">
                            <span>Didukung Generative AI</span>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="p-8 rounded-3xl bg-slate-900/80 border border-slate-800 hover:border-violet-500/50 transition duration-300 group shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-2xl bg-violet-500/10 text-violet-400 flex items-center justify-center font-bold text-xl mb-6 group-hover:scale-110 transition">
                                👁️
                            </div>
                            <h3 class="text-xl font-bold text-white">Split Live Preview</h3>
                            <p class="text-xs sm:text-sm text-slate-400 mt-2 leading-relaxed">
                                Sambil mengisi data biodata, lihat langsung render dokumen di panel samping secara real-time tanpa perlu bolak-balik halaman.
                            </p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-slate-800/60 text-xs font-bold text-violet-400 flex items-center gap-1">
                            <span>Auto-Save Aktif Otomatis</span>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="p-8 rounded-3xl bg-slate-900/80 border border-slate-800 hover:border-emerald-500/50 transition duration-300 group shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center font-bold text-xl mb-6 group-hover:scale-110 transition">
                                📦
                            </div>
                            <h3 class="text-xl font-bold text-white">Ekspor 3 Format Populer</h3>
                            <p class="text-xs sm:text-sm text-slate-400 mt-2 leading-relaxed">
                                Unduh langsung ke PDF cetak beresolusi tinggi, dokumen Microsoft Word (.doc) yang dapat disunting, atau format JSON Resume portabel.
                            </p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-slate-800/60 text-xs font-bold text-emerald-400 flex items-center gap-1">
                            <span>PDF • Word • JSON</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Template Gallery Showcase -->
        <section id="template" class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            <div class="text-center max-w-2xl mx-auto space-y-3 mb-16">
                <span class="text-xs font-extrabold uppercase tracking-widest text-indigo-400">Pilihan Layout</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white">Template Desain Sesuai Bidang Karir</h2>
                <p class="text-sm text-slate-400">Pilih tata letak yang paling sesuai dengan profil industri yang Anda tuju.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Modern Indigo -->
                <div class="rounded-3xl bg-slate-900 p-6 border border-slate-800 hover:border-indigo-500 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="aspect-[4/3] rounded-2xl bg-white p-5 flex flex-col justify-between shadow-md mb-6 relative overflow-hidden">
                            <div class="border-b-2 border-indigo-600 pb-2">
                                <div class="w-24 h-3 bg-slate-800 rounded mb-1"></div>
                                <div class="w-16 h-2 bg-indigo-500 rounded"></div>
                            </div>
                            <div class="grid grid-cols-12 gap-2 my-auto">
                                <div class="col-span-8 space-y-2">
                                    <div class="w-full h-1.5 bg-slate-200 rounded"></div>
                                    <div class="w-4/5 h-1.5 bg-slate-200 rounded"></div>
                                    <div class="w-3/4 h-1.5 bg-slate-200 rounded"></div>
                                </div>
                                <div class="col-span-4 bg-indigo-50 rounded p-1.5 space-y-1">
                                    <div class="w-full h-1 bg-indigo-300 rounded"></div>
                                    <div class="w-2/3 h-1 bg-indigo-300 rounded"></div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center text-[10px] text-slate-400 pt-1 border-t border-slate-100">
                                <span>ATS-Friendly</span>
                                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-white">Modern Indigo</h3>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-indigo-500/20 text-indigo-400">Populer</span>
                        </div>
                        <p class="text-xs text-slate-400 mt-2">Dua kolom seimbang dengan aksen header modern. Pilihan utama para profesional tech & finance.</p>
                    </div>
                </div>

                <!-- Classic Executive -->
                <div class="rounded-3xl bg-slate-900 p-6 border border-slate-800 hover:border-slate-500 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="aspect-[4/3] rounded-2xl bg-white p-5 flex flex-col justify-between shadow-md mb-6 relative overflow-hidden">
                            <div class="text-center pb-2 border-b border-slate-300 flex flex-col items-center">
                                <div class="w-28 h-3 bg-slate-800 rounded mb-1"></div>
                                <div class="w-16 h-2 bg-slate-400 rounded"></div>
                            </div>
                            <div class="space-y-2 my-auto">
                                <div class="w-20 h-2 bg-slate-700 rounded"></div>
                                <div class="w-full h-1.5 bg-slate-200 rounded"></div>
                                <div class="w-5/6 h-1.5 bg-slate-200 rounded"></div>
                            </div>
                            <div class="flex justify-between items-center text-[10px] text-slate-400 pt-1 border-t border-slate-100">
                                <span>Formal & Korporat</span>
                                <span class="w-2 h-2 rounded-full bg-slate-600"></span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-white">Classic Executive</h3>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-800 text-slate-300">Formal</span>
                        </div>
                        <p class="text-xs text-slate-400 mt-2">Format berpusat di tengah dengan tipografi klasik terhormat, sangat cocok untuk hukum, BUMN, dan korporat.</p>
                    </div>
                </div>

                <!-- Minimalist Clean -->
                <div class="rounded-3xl bg-slate-900 p-6 border border-slate-800 hover:border-emerald-500 transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="aspect-[4/3] rounded-2xl bg-white p-5 flex flex-col justify-between shadow-md mb-6 relative overflow-hidden">
                            <div class="flex justify-between items-start pb-2">
                                <div>
                                    <div class="w-20 h-2.5 bg-slate-900 rounded mb-1"></div>
                                    <div class="w-12 h-1.5 bg-emerald-500 rounded"></div>
                                </div>
                                <div class="w-7 h-7 rounded-full bg-slate-200"></div>
                            </div>
                            <div class="space-y-2 my-auto">
                                <div class="w-full h-1.5 bg-slate-200 rounded"></div>
                                <div class="w-11/12 h-1.5 bg-slate-200 rounded"></div>
                                <div class="w-4/5 h-1.5 bg-slate-200 rounded"></div>
                            </div>
                            <div class="flex justify-between items-center text-[10px] text-slate-400 pt-1 border-t border-slate-100">
                                <span>Minimalis & Kreatif</span>
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-white">Minimalist Clean</h3>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/20 text-emerald-400">Kreatif</span>
                        </div>
                        <p class="text-xs text-slate-400 mt-2">Desain lapang dengan whitespace tinggi yang disukai startup teknologi, agensi desain, dan media.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Bottom Banner -->
        <section class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            <div class="rounded-3xl bg-gradient-to-r from-indigo-900 via-indigo-800 to-violet-900 text-white p-8 sm:p-14 text-center relative overflow-hidden shadow-2xl border border-indigo-700/50">
                <div class="absolute -right-20 -bottom-20 w-80 h-80 rounded-full bg-indigo-500/20 blur-3xl pointer-events-none"></div>
                <div class="relative z-10 max-w-3xl mx-auto space-y-6">
                    <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight">
                        Siap Memulai Langkah Karir Impian Anda?
                    </h2>
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                        Bergabunglah dan buat dokumen resume berstandar internasional sekarang juga. Gratis, cepat, dan tanpa watermark.
                    </p>
                    <div class="pt-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-8 py-4 rounded-2xl bg-white text-indigo-950 font-extrabold text-sm shadow-xl hover:bg-slate-100 transition hover:-translate-y-0.5">
                                Buka Dashboard Studio
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 rounded-2xl bg-white text-indigo-950 font-extrabold text-sm shadow-xl hover:bg-slate-100 transition hover:-translate-y-0.5">
                                Daftar & Buat CV Sekarang
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-800/80 bg-slate-950 py-10 px-4 sm:px-6 lg:px-8 text-center text-xs text-slate-500">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <span class="font-bold text-slate-400">LaraCV Builder</span>
                <span>•</span>
                <span>Platform Resume ATS Terintegrasi</span>
            </div>
            <div>
                &copy; {{ date('Y') }} LaraCV. Seluruh hak cipta dilindungi undang-undang.
            </div>
        </div>
    </footer>

</body>
</html>
