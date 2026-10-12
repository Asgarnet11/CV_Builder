<x-public-layout title="LaraCV - Portal Resmi Pembuat CV Profesional">
    <!-- Hero Section (Gaya SSCASN: Gradasi Biru Resmi + Carousel + Controls) -->
    <section id="home" 
             class="relative z-10 pt-28 pb-16 lg:pt-36 lg:pb-24 overflow-hidden text-white"
             style="background: linear-gradient(135deg, #1270a0 0%, #1a8cc8 35%, #269dd8 65%, #1e8ec4 100%);"
             x-data="{
                 activeSlide: 0,
                 totalSlides: 3,
                 timer: null,
                 startAutoPlay() {
                     this.timer = setInterval(() => {
                         this.nextSlide();
                     }, 5000);
                 },
                 stopAutoPlay() {
                     clearInterval(this.timer);
                 },
                 nextSlide() {
                     this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
                 },
                 prevSlide() {
                     this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides;
                 },
                 goToSlide(index) {
                     this.activeSlide = index;
                 }
             }"
             x-init="startAutoPlay()"
             @mouseenter="stopAutoPlay()"
             @mouseleave="startAutoPlay()">

        <!-- Subtle Dot Grid / Map Overlay Background -->
        <div class="absolute inset-0 pointer-events-none opacity-20 bg-[radial-gradient(#ffffff_1.5px,transparent_1.5px)] [background-size:24px_24px]"></div>
        
        <!-- Subtle Ambient Rings -->
        <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(255,255,255,0.12) 0%, transparent 70%);"></div>
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] rounded-full pointer-events-none" style="background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 65%);"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <!-- Hero Left Column: Text & Slider Controls -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    
                    <!-- Pill Tag Status -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/15 backdrop-blur-sm border border-white/30 text-xs font-semibold tracking-wide">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>Portal Karir Vokasi • BPVP Kendari</span>
                    </div>

                    <!-- Dynamic Hero Heading (FR-01.2 & SSCASN style) -->
                    <h1 id="hero-heading" class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight text-white">
                        {{ $heroHeading ?? 'Bangun CV Profesional Anda dalam Hitungan Menit' }}
                    </h1>

                    <!-- Hero Subtitle -->
                    <p class="text-sm sm:text-base text-white/90 leading-relaxed max-w-2xl mx-auto lg:mx-0 font-normal">
                        Kelola data profil, pengalaman kerja, pendidikan terakreditasi, serta portofolio kompetensi dalam format dokumen terstandarisasi yang ramah pembaca mesin (ATS) dan tim penilai rekrutmen.
                    </p>

                    <!-- Hero Action Buttons -->
                    <div class="pt-2 flex flex-wrap items-center justify-center lg:justify-start gap-3">
                        @auth
                            <a href="{{ route('cv-profile.edit') }}" 
                               class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-white text-primary font-bold text-sm shadow-md hover:bg-white/90 hover:-translate-y-0.5 active:translate-y-0 transition-all">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                <span>Kelola Biodata CV</span>
                            </a>
                            <a href="{{ route('dashboard') }}" 
                               class="inline-flex items-center gap-2 px-5 py-3 rounded-lg border border-white/50 bg-white/15 backdrop-blur-sm text-white font-semibold text-sm hover:bg-white/25 transition-all">
                                <span>Buka Dashboard</span>
                            </a>
                        @else
                            <a href="{{ route('register') }}" 
                               class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-white text-primary font-bold text-sm shadow-md hover:bg-white/90 hover:-translate-y-0.5 active:translate-y-0 transition-all">
                                <span>Daftar Akun Sekarang</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                            <a href="{{ route('bantuan') }}" 
                               class="inline-flex items-center gap-2 px-5 py-3 rounded-lg border border-white/50 bg-white/15 backdrop-blur-sm text-white font-semibold text-sm hover:bg-white/25 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span>Layanan Bantuan</span>
                            </a>
                        @endauth
                    </div>

                    <!-- Carousel Controls (Gaya Resmi SSCASN: Panah Bulat + Indikator Titik/Pill) -->
                    <div class="pt-4 flex items-center justify-center lg:justify-start gap-3">
                        <!-- Panah Kiri -->
                        <button type="button" 
                                @click="prevSlide()" 
                                aria-label="Slide sebelumnya" 
                                class="flex items-center justify-center w-8 h-8 rounded-full border border-white/30 bg-white/15 text-white transition-colors duration-200 cursor-pointer hover:bg-white/30 backdrop-blur-sm">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m15 18-6-6 6-6"></path>
                            </svg>
                        </button>

                        <!-- Indikator Slide (Pill untuk aktif, dot untuk inaktif) -->
                        <div class="flex items-center gap-2">
                            <button type="button" 
                                    @click="goToSlide(0)" 
                                    aria-label="Slide 1: Seleksi Karir" 
                                    class="h-2 rounded-full transition-all duration-300 cursor-pointer"
                                    :class="activeSlide === 0 ? 'w-8 bg-white' : 'w-2 bg-white/40 hover:bg-white/70'"></button>
                            <button type="button" 
                                    @click="goToSlide(1)" 
                                    aria-label="Slide 2: Format Standar ATS" 
                                    class="h-2 rounded-full transition-all duration-300 cursor-pointer"
                                    :class="activeSlide === 1 ? 'w-8 bg-white' : 'w-2 bg-white/40 hover:bg-white/70'"></button>
                            <button type="button" 
                                    @click="goToSlide(2)" 
                                    aria-label="Slide 3: Ekspor Multi-Format" 
                                    class="h-2 rounded-full transition-all duration-300 cursor-pointer"
                                    :class="activeSlide === 2 ? 'w-8 bg-white' : 'w-2 bg-white/40 hover:bg-white/70'"></button>
                        </div>

                        <!-- Panah Kanan -->
                        <button type="button" 
                                @click="nextSlide()" 
                                aria-label="Slide berikutnya" 
                                class="flex items-center justify-center w-8 h-8 rounded-full border border-white/30 bg-white/15 text-white transition-colors duration-200 cursor-pointer hover:bg-white/30 backdrop-blur-sm">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </button>
                    </div>

                </div>

                <!-- Hero Right Column: Interactive Carousel Showcase -->
                <div class="lg:col-span-5 relative">
                    
                    <!-- Slide 1: Dokumen Standar Seleksi -->
                    <div x-show="activeSlide === 0"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-4"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-4"
                         class="rounded-3xl bg-white/95 text-slate-800 p-6 sm:p-7 shadow-2xl border border-white/40 backdrop-blur-md">
                        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                            <div class="flex items-center gap-2.5">
                                <span class="w-3 h-3 rounded-full bg-red-400"></span>
                                <span class="w-3 h-3 rounded-full bg-amber-400"></span>
                                <span class="w-3 h-3 rounded-full bg-emerald-400"></span>
                                <span class="text-xs font-bold text-primary ml-1">Dokumen Resmi Terverifikasi</span>
                            </div>
                            <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-primary/10 text-primary border border-primary/20">
                                Versi 2026
                            </span>
                        </div>
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-primary-dark to-primary flex items-center justify-center text-white font-extrabold text-xl shadow-md">
                                LP
                            </div>
                            <div>
                                <h4 class="font-extrabold text-base text-slate-900 leading-snug">Larasati Putri, S.Kom</h4>
                                <p class="text-xs text-primary font-semibold">Alumni Pelatihan • BPVP Kendari</p>
                                <p class="text-[11px] text-slate-500">larasati.putri@email.com</p>
                            </div>
                        </div>
                        <div class="space-y-2 text-xs text-slate-600 bg-slate-50 p-3.5 rounded-xl border border-slate-200/80 mb-4">
                            <div class="font-bold text-slate-800 uppercase tracking-wider text-[11px] flex items-center gap-1.5 text-primary">
                                <span class="w-2 h-2 rounded-full bg-primary"></span>
                                Ringkasan Kualifikasi
                            </div>
                            <p class="leading-relaxed">
                                Lulusan berprestasi dengan rekam jejak riset sistem enterprise dan sertifikasi keahlian digital nasional. Siap berkontribusi optimal.
                            </p>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-center text-xs">
                            <div class="p-2 rounded-lg bg-sky-50 border border-sky-100 font-semibold text-primary">
                                Skor ATS: <strong class="text-slate-900">96/100</strong>
                            </div>
                            <div class="p-2 rounded-lg bg-emerald-50 border border-emerald-100 font-semibold text-emerald-700">
                                Status: <strong>Siap Seleksi</strong>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2: Format Standar ATS -->
                    <div x-show="activeSlide === 1"
                         x-cloak
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-4"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-4"
                         class="rounded-3xl bg-white/95 text-slate-800 p-6 sm:p-7 shadow-2xl border border-white/40 backdrop-blur-md">
                        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                            <span class="text-xs font-bold text-slate-700 uppercase tracking-wider">Format Baku ATS Friendly</span>
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded bg-emerald-100 text-emerald-800">
                                100% Terbaca
                            </span>
                        </div>
                        <ul class="space-y-3 text-xs text-slate-700">
                            <li class="flex items-start gap-2.5 p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                                <span class="w-5 h-5 rounded-full bg-primary text-white flex items-center justify-center shrink-0 text-[10px] font-bold">1</span>
                                <div>
                                    <strong class="block text-slate-900">Hierarki Heading Baku</strong>
                                    Struktur tag judul H1-H3 terstandar internasional tanpa elemen dekoratif rancu.
                                </div>
                            </li>
                            <li class="flex items-start gap-2.5 p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                                <span class="w-5 h-5 rounded-full bg-primary text-white flex items-center justify-center shrink-0 text-[10px] font-bold">2</span>
                                <div>
                                    <strong class="block text-slate-900">Tipografi Teruji</strong>
                                    Font Poppins & Helvetica dengan spasi proporsional agar lolos parsing otomatis.
                                </div>
                            </li>
                            <li class="flex items-start gap-2.5 p-2.5 rounded-xl bg-slate-50 border border-slate-200">
                                <span class="w-5 h-5 rounded-full bg-primary text-white flex items-center justify-center shrink-0 text-[10px] font-bold">3</span>
                                <div>
                                    <strong class="block text-slate-900">Tautan Kontak Valid</strong>
                                    Format nomor telepon, email, dan portofolio resmi tanpa broken links.
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Slide 3: Ekspor & Integrasi Cepat -->
                    <div x-show="activeSlide === 2"
                         x-cloak
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-4"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-4"
                         class="rounded-3xl bg-white/95 text-slate-800 p-6 sm:p-7 shadow-2xl border border-white/40 backdrop-blur-md">
                        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                            <span class="text-xs font-bold text-slate-700 uppercase tracking-wider">Multi-Format Dokumen</span>
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded bg-primary text-white">
                                Siap Unduh
                            </span>
                        </div>
                        <div class="grid grid-cols-3 gap-3 mb-4 text-center">
                            <div class="p-3 rounded-xl border border-slate-200 bg-slate-50">
                                <div class="text-red-600 font-extrabold text-sm mb-1">PDF</div>
                                <div class="text-[10px] text-slate-500">Cetak A4 Siap Upload</div>
                            </div>
                            <div class="p-3 rounded-xl border border-slate-200 bg-slate-50">
                                <div class="text-blue-600 font-extrabold text-sm mb-1">DOCX</div>
                                <div class="text-[10px] text-slate-500">Format Word Editable</div>
                            </div>
                            <div class="p-3 rounded-xl border border-slate-200 bg-slate-50">
                                <div class="text-emerald-600 font-extrabold text-sm mb-1">JSON</div>
                                <div class="text-[10px] text-slate-500">Data Terstruktur</div>
                            </div>
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed mb-4">
                            Unduh berkas CV Anda dalam sekali klik dengan preservasi layout piksel presisi tanpa distorsi pada lembar cetak A4.
                        </p>
                        <a href="{{ route('templates') }}" class="w-full inline-flex items-center justify-center py-2.5 px-4 rounded-lg bg-primary hover:bg-primary-dark text-white font-bold text-xs transition">
                            Lihat Galeri Template →
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- Section 2: Tab Pill & Timeline (Gaya SSCASN: section bg-primary/5 + kartu border-primary/60) -->
    <section class="py-12 lg:py-16 bg-primary/5" x-data="{ currentTab: 'timeline' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header (Judul Tebal Kapital + Garis Bawah Pendek Primary) -->
            <div class="text-center mb-8">
                <h2 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-wide uppercase">
                    ALUR & TAHAPAN PEMBUATAN CV
                </h2>
                <div class="w-16 h-1 bg-primary mx-auto mt-2.5 rounded-full"></div>
                <p class="text-xs sm:text-sm text-slate-500 mt-2 max-w-xl mx-auto">
                    Ikuti alur terstruktur untuk menghasilkan dokumen CV berstandar resmi yang siap diajukan ke instansi dan perusahaan impian.
                </p>
            </div>

            <!-- Tab / Pill Controls (Kelompok pill bergaris tipis, tab aktif latar primary) -->
            <div class="flex items-center justify-center gap-2 mb-8 flex-wrap">
                <button type="button" 
                        @click="currentTab = 'timeline'"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition-all duration-200 cursor-pointer border"
                        :class="currentTab === 'timeline' ? 'bg-primary text-white border-primary shadow-sm' : 'bg-white text-slate-600 border-primary/20 hover:border-primary/50 hover:bg-white'">
                    Alur 5 Langkah Terpadu
                </button>
                <button type="button" 
                        @click="currentTab = 'ats'"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition-all duration-200 cursor-pointer border"
                        :class="currentTab === 'ats' ? 'bg-primary text-white border-primary shadow-sm' : 'bg-white text-slate-600 border-primary/20 hover:border-primary/50 hover:bg-white'">
                    Standar Skrining ATS 2026
                </button>
                <button type="button" 
                        @click="currentTab = 'berkas'"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition-all duration-200 cursor-pointer border"
                        :class="currentTab === 'berkas' ? 'bg-primary text-white border-primary shadow-sm' : 'bg-white text-slate-600 border-primary/20 hover:border-primary/50 hover:bg-white'">
                    Kelengkapan Dokumen Portofolio
                </button>
            </div>

            <!-- Tab 1: Timeline Card (Kartu Besar dengan border primary tipis & radius besar) -->
            <div x-show="currentTab === 'timeline'"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="w-full rounded-3xl bg-white/95 backdrop-blur-sm shadow-sm border border-primary/60 py-8 px-6 lg:px-10">
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 lg:gap-4 relative">
                    
                    <!-- Langkah 1 -->
                    <div class="relative flex flex-col items-center lg:items-start text-center lg:text-left space-y-2 group">
                        <div class="flex items-center justify-between w-full mb-1">
                            <div class="w-12 h-12 rounded-xl bg-primary/10 border border-primary/30 flex items-center justify-center text-primary font-bold shadow-sm group-hover:scale-105 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-warning/20 text-amber-800 border border-warning/40">
                                Aktif
                            </span>
                        </div>
                        <h4 class="font-bold text-sm text-primary">1. Biodata Diri</h4>
                        <span class="text-[11px] font-semibold text-accent">Tahap 1 • Identitas</span>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Lengkapi kontak publik, headline karir, dan unggah pas foto formal maksimal 2MB.
                        </p>
                    </div>

                    <!-- Langkah 2 -->
                    <div class="relative flex flex-col items-center lg:items-start text-center lg:text-left space-y-2 group">
                        <div class="flex items-center justify-between w-full mb-1">
                            <div class="w-12 h-12 rounded-xl bg-primary/10 border border-primary/30 flex items-center justify-center text-primary font-bold shadow-sm group-hover:scale-105 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600">
                                Berurutan
                            </span>
                        </div>
                        <h4 class="font-bold text-sm text-primary">2. Pengalaman Kerja</h4>
                        <span class="text-[11px] font-semibold text-accent">Tahap 2 • Karir</span>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Cantumkan riwayat pekerjaan dengan urutan drag & drop kronologis yang rapi.
                        </p>
                    </div>

                    <!-- Langkah 3 -->
                    <div class="relative flex flex-col items-center lg:items-start text-center lg:text-left space-y-2 group">
                        <div class="flex items-center justify-between w-full mb-1">
                            <div class="w-12 h-12 rounded-xl bg-primary/10 border border-primary/30 flex items-center justify-center text-primary font-bold shadow-sm group-hover:scale-105 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                </svg>
                            </div>
                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600">
                                Berurutan
                            </span>
                        </div>
                        <h4 class="font-bold text-sm text-primary">3. Pendidikan Formal</h4>
                        <span class="text-[11px] font-semibold text-accent">Tahap 3 • Akademik</span>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Masukkan gelar, institusi, tahun kelulusan, dan nilai/IPK terverifikasi.
                        </p>
                    </div>

                    <!-- Langkah 4 -->
                    <div class="relative flex flex-col items-center lg:items-start text-center lg:text-left space-y-2 group">
                        <div class="flex items-center justify-between w-full mb-1">
                            <div class="w-12 h-12 rounded-xl bg-primary/10 border border-primary/30 flex items-center justify-center text-primary font-bold shadow-sm group-hover:scale-105 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600">
                                Berurutan
                            </span>
                        </div>
                        <h4 class="font-bold text-sm text-primary">4. Keahlian Khusus</h4>
                        <span class="text-[11px] font-semibold text-accent">Tahap 4 • Skill</span>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Pilih level kompetensi (Pemula s.d. Ahli) yang selaras dengan formasi target.
                        </p>
                    </div>

                    <!-- Langkah 5 -->
                    <div class="relative flex flex-col items-center lg:items-start text-center lg:text-left space-y-2 group">
                        <div class="flex items-center justify-between w-full mb-1">
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-300 flex items-center justify-center text-emerald-600 font-bold shadow-sm group-hover:scale-105 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                            </div>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">
                                Siap Cetak
                            </span>
                        </div>
                        <h4 class="font-bold text-sm text-emerald-700">5. Pratinjau & PDF</h4>
                        <span class="text-[11px] font-semibold text-accent">Tahap Akhir • Unduh</span>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Simulasi kanvas A4 langsung dan cetak dokumen resmi tanpa watermarking.
                        </p>
                    </div>

                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>Seluruh alur terintegrasi dalam modul wizard terpadu LaraCV.</span>
                    </div>
                    @auth
                        <a href="{{ route('cv-profile.edit') }}" class="font-bold text-primary hover:underline">
                            Mulai Langkah 1 Sekarang &rarr;
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="font-bold text-primary hover:underline">
                            Daftar Gratis untuk Memulai &rarr;
                        </a>
                    @endauth
                </div>

            </div>

            <!-- Tab 2: Standar ATS Content -->
            <div x-show="currentTab === 'ats'"
                 x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="w-full rounded-3xl bg-white/95 backdrop-blur-sm shadow-sm border border-primary/60 py-8 px-6 lg:px-10">
                <div class="max-w-3xl mx-auto space-y-4">
                    <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-primary"></span>
                        Prinsip Utama Format ATS Ramah Mesin
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                        <div class="p-4 rounded-2xl bg-sky-50/50 border border-sky-100">
                            <h4 class="font-bold text-sm text-primary mb-1">Struktur Font & Spasi Baku</h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Hindari penggunaan tabel kompleks berlipat atau grafik pie chart dalam CV. Robot parser ATS membaca baris linear secara vertikal.
                            </p>
                        </div>
                        <div class="p-4 rounded-2xl bg-sky-50/50 border border-sky-100">
                            <h4 class="font-bold text-sm text-primary mb-1">Kata Kunci Relevan</h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Gunakan istilah jabatan standar industri seperti 'Frontend Engineer' atau 'Akuntan Publik' agar cocok dengan kriteria formasi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab 3: Kelengkapan Berkas Content -->
            <div x-show="currentTab === 'berkas'"
                 x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="w-full rounded-3xl bg-white/95 backdrop-blur-sm shadow-sm border border-primary/60 py-8 px-6 lg:px-10">
                <div class="max-w-3xl mx-auto space-y-4">
                    <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-primary"></span>
                        Daftar Periksa Berkas & Lampiran
                    </h3>
                    <ul class="space-y-2.5 text-xs text-slate-600">
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-[10px]">✓</span>
                            <span>Pas foto formal dengan rasio 3:4 latar belakang polos (maksimum 2 MB).</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-[10px]">✓</span>
                            <span>Riwayat ijazah dan transkrip nilai resmi dari institusi terdaftar.</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-[10px]">✓</span>
                            <span>Sertifikat pelatihan teknis atau lisensi profesi yang masih berlaku.</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <!-- Section 3: Template Showcase Gallery (Formasi Template CV) -->
    <section class="py-12 lg:py-16 bg-white border-t border-sky-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-wide uppercase">
                    PILIHAN TEMPLATE FORMASI CV
                </h2>
                <div class="w-16 h-1 bg-primary mx-auto mt-2.5 rounded-full"></div>
                <p class="text-xs sm:text-sm text-slate-500 mt-2 max-w-xl mx-auto">
                    Tersedia berbagai pilihan tata letak profesional yang siap diaplikasikan seketika pada berkas Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Template 1: Modern Indigo -->
                <div class="rounded-2xl border border-slate-200 bg-white hover:border-primary/60 hover:shadow-lg transition-all duration-300 overflow-hidden group">
                    <div class="h-44 bg-slate-100 relative overflow-hidden flex items-center justify-center border-b border-slate-200">
                        <div class="w-32 h-40 bg-white rounded shadow-md p-2 flex flex-col justify-between group-hover:scale-105 transition-transform">
                            <div class="h-3 bg-primary rounded w-3/4 mb-1"></div>
                            <div class="space-y-1">
                                <div class="h-1 bg-slate-200 rounded w-full"></div>
                                <div class="h-1 bg-slate-200 rounded w-5/6"></div>
                                <div class="h-1 bg-slate-200 rounded w-4/6"></div>
                            </div>
                            <div class="h-6 bg-sky-50 rounded border border-sky-100"></div>
                        </div>
                        <span class="absolute top-3 right-3 text-[10px] font-bold px-2 py-0.5 rounded-full bg-primary text-white">
                            Default
                        </span>
                    </div>
                    <div class="p-5 space-y-3">
                        <h3 class="font-bold text-base text-slate-900">Modern Indigo</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Tata letak modern dengan aksen warna cyan-indigo yang cocok untuk industri teknologi, startup, dan korporat masa kini.
                        </p>
                        <div class="pt-2 flex items-center justify-between border-t border-slate-100">
                            <span class="text-[11px] font-semibold text-emerald-600">✓ Standar ATS</span>
                            <a href="{{ route('templates') }}" class="text-xs font-bold text-primary hover:underline">
                                Pratinjau &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Template 2: Classic Executive -->
                <div class="rounded-2xl border border-slate-200 bg-white hover:border-primary/60 hover:shadow-lg transition-all duration-300 overflow-hidden group">
                    <div class="h-44 bg-slate-100 relative overflow-hidden flex items-center justify-center border-b border-slate-200">
                        <div class="w-32 h-40 bg-white rounded shadow-md p-2 flex flex-col justify-between group-hover:scale-105 transition-transform">
                            <div class="h-3 bg-slate-800 rounded w-2/3 mx-auto mb-1"></div>
                            <div class="space-y-1">
                                <div class="h-1 bg-slate-200 rounded w-full"></div>
                                <div class="h-1 bg-slate-200 rounded w-5/6"></div>
                                <div class="h-1 bg-slate-200 rounded w-full"></div>
                            </div>
                            <div class="h-6 bg-slate-100 rounded border border-slate-200"></div>
                        </div>
                    </div>
                    <div class="p-5 space-y-3">
                        <h3 class="font-bold text-base text-slate-900">Classic Executive</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Gaya monokrom klasik berwibawa dengan penekanan pada rekam jejak kepemimpinan, cocok untuk instansi dan posisi manajerial.
                        </p>
                        <div class="pt-2 flex items-center justify-between border-t border-slate-100">
                            <span class="text-[11px] font-semibold text-emerald-600">✓ Standar ATS</span>
                            <a href="{{ route('templates') }}" class="text-xs font-bold text-primary hover:underline">
                                Pratinjau &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Template 3: Minimalist Clean -->
                <div class="rounded-2xl border border-slate-200 bg-white hover:border-primary/60 hover:shadow-lg transition-all duration-300 overflow-hidden group">
                    <div class="h-44 bg-slate-100 relative overflow-hidden flex items-center justify-center border-b border-slate-200">
                        <div class="w-32 h-40 bg-white rounded shadow-md p-2 flex flex-col justify-between group-hover:scale-105 transition-transform">
                            <div class="h-2 bg-slate-400 rounded w-1/2 mb-1"></div>
                            <div class="space-y-1">
                                <div class="h-1 bg-slate-200 rounded w-full"></div>
                                <div class="h-1 bg-slate-200 rounded w-3/4"></div>
                                <div class="h-1 bg-slate-200 rounded w-5/6"></div>
                            </div>
                            <div class="h-6 bg-slate-50 rounded border border-slate-100"></div>
                        </div>
                    </div>
                    <div class="p-5 space-y-3">
                        <h3 class="font-bold text-base text-slate-900">Minimalist Clean</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Format serba ringkas dan elegan dengan pemanfaatan ruang putih seimbang untuk keterbacaan tingkat tinggi.
                        </p>
                        <div class="pt-2 flex items-center justify-between border-t border-slate-100">
                            <span class="text-[11px] font-semibold text-emerald-600">✓ Standar ATS</span>
                            <a href="{{ route('templates') }}" class="text-xs font-bold text-primary hover:underline">
                                Pratinjau &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('templates') }}" class="inline-flex items-center gap-1.5 px-6 py-2.5 rounded-lg border border-primary text-primary font-bold text-xs hover:bg-primary/5 transition">
                    <span>Lihat Seluruh Koleksi Template Formasi</span>
                    <span>&rarr;</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Section 4: FAQ Singkat -->
    <section class="py-12 lg:py-16 bg-slate-50 border-t border-slate-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-wide uppercase">
                    PERTANYAAN UMUM (FAQ)
                </h2>
                <div class="w-16 h-1 bg-primary mx-auto mt-2.5 rounded-full"></div>
                <p class="text-xs sm:text-sm text-slate-500 mt-2">
                    Jawaban seputar kendala pendaftaran, format berkas, dan prosedur pengunduhan.
                </p>
            </div>

            <div class="space-y-3" x-data="{ openFaq: 1 }">
                <!-- FAQ 1 -->
                <div class="rounded-xl border border-slate-200 bg-white overflow-hidden shadow-sm">
                    <button type="button" 
                            @click="openFaq = (openFaq === 1 ? null : 1)"
                            class="w-full p-4 text-left font-bold text-sm text-slate-900 flex items-center justify-between">
                        <span>Apakah pembuatan CV di portal LaraCV dipungut biaya?</span>
                        <span class="text-primary text-base" x-text="openFaq === 1 ? '−' : '+'"></span>
                    </button>
                    <div x-show="openFaq === 1" class="p-4 pt-0 text-xs text-slate-600 border-t border-slate-100 leading-relaxed">
                        Layanan pembuatan CV di portal LaraCV bersifat 100% gratis tanpa biaya tersembunyi. Anda dapat mengisi data, memilih template, dan mengunduh berkas PDF kapan saja.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="rounded-xl border border-slate-200 bg-white overflow-hidden shadow-sm">
                    <button type="button" 
                            @click="openFaq = (openFaq === 2 ? null : 2)"
                            class="w-full p-4 text-left font-bold text-sm text-slate-900 flex items-center justify-between">
                        <span>Apakah template CV yang disediakan kompatibel dengan mesin seleksi ATS?</span>
                        <span class="text-primary text-base" x-text="openFaq === 2 ? '−' : '+'"></span>
                    </button>
                    <div x-show="openFaq === 2" class="p-4 pt-0 text-xs text-slate-600 border-t border-slate-100 leading-relaxed">
                        Ya. Seluruh template dirancang dengan spesifikasi hierarki heading standar dan font terbaca sistem sehingga terjamin ramah terhadap algoritma Applicant Tracking System (ATS).
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="rounded-xl border border-slate-200 bg-white overflow-hidden shadow-sm">
                    <button type="button" 
                            @click="openFaq = (openFaq === 3 ? null : 3)"
                            class="w-full p-4 text-left font-bold text-sm text-slate-900 flex items-center justify-between">
                        <span>Bagaimana cara mengedit kembali data yang sudah saya simpan?</span>
                        <span class="text-primary text-base" x-text="openFaq === 3 ? '−' : '+'"></span>
                    </button>
                    <div x-show="openFaq === 3" class="p-4 pt-0 text-xs text-slate-600 border-t border-slate-100 leading-relaxed">
                        Cukup masuk ke akun Anda, buka halaman Dashboard, lalu pilih modul data yang ingin diperbarui (Biodata, Pengalaman, Pendidikan, atau Keahlian). Perubahan akan otomatis tersimpan.
                    </div>
                </div>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('faq') }}" class="text-xs font-bold text-primary hover:underline">
                    Buka Halaman FAQ Lengkap &rarr;
                </a>
            </div>
        </div>
    </section>
</x-public-layout>
