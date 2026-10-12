<x-public-layout title="Daftar Template Formasi CV - LaraCV">
    <!-- Subpage Banner (Gaya Resmi SSCASN: Header Biru Gradasi + Breadcrumb) -->
    <section class="pt-28 pb-12 lg:pt-36 lg:pb-16 text-white relative overflow-hidden"
             style="background: linear-gradient(135deg, #1270a0 0%, #1a8cc8 35%, #269dd8 65%, #1e8ec4 100%);">
        <div class="absolute inset-0 pointer-events-none opacity-20 bg-[radial-gradient(#ffffff_1.5px,transparent_1.5px)] [background-size:24px_24px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center sm:text-left">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur-sm border border-white/30 text-xs font-semibold mb-3">
                <a href="{{ route('home') }}" class="hover:underline">Beranda</a>
                <span>/</span>
                <span>Template CV</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                DAFTAR TEMPLATE FORMASI CV
            </h1>
            <p class="mt-2 text-sm text-white/90 max-w-2xl">
                Katalog tata letak kurikulum vitae terstandarisasi untuk berbagai jenjang karir, rekrutmen BUMN, instansi, dan korporat swasta.
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12 lg:py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Filter Pills -->
            <div class="flex items-center justify-between mb-8 pb-4 border-b border-slate-200 flex-wrap gap-4">
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="text-xs font-bold text-slate-500 uppercase mr-2">Filter Kategori:</span>
                    <button class="px-3.5 py-1.5 rounded-lg text-xs font-bold bg-primary text-white shadow-sm">
                        Semua Template
                    </button>
                    <button class="px-3.5 py-1.5 rounded-lg text-xs font-semibold bg-white border border-slate-200 text-slate-600 hover:border-primary">
                        ATS-Friendly
                    </button>
                    <button class="px-3.5 py-1.5 rounded-lg text-xs font-semibold bg-white border border-slate-200 text-slate-600 hover:border-primary">
                        Eksekutif & Manajerial
                    </button>
                    <button class="px-3.5 py-1.5 rounded-lg text-xs font-semibold bg-white border border-slate-200 text-slate-600 hover:border-primary">
                        Fresh Graduate
                    </button>
                </div>
                <div class="text-xs text-slate-500">
                    Menampilkan <strong>3 Template Resmi</strong>
                </div>
            </div>

            <!-- Templates Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Card 1 -->
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-md hover:border-primary/50 transition duration-200 overflow-hidden flex flex-col justify-between">
                    <div>
                        <div class="p-6 bg-slate-100 flex items-center justify-center border-b border-slate-200">
                            <div class="w-48 h-64 bg-white rounded shadow p-3 flex flex-col justify-between text-[8px] text-slate-400">
                                <div>
                                    <div class="h-4 bg-primary rounded w-3/4 mb-1"></div>
                                    <div class="h-2 bg-sky-200 rounded w-1/2 mb-3"></div>
                                    <div class="space-y-1">
                                        <div class="h-1 bg-slate-200 rounded w-full"></div>
                                        <div class="h-1 bg-slate-200 rounded w-5/6"></div>
                                        <div class="h-1 bg-slate-200 rounded w-4/6"></div>
                                    </div>
                                </div>
                                <div class="border-t pt-2 space-y-1">
                                    <div class="h-2 bg-slate-700 rounded w-1/3 mb-1"></div>
                                    <div class="h-1 bg-slate-200 rounded w-full"></div>
                                    <div class="h-1 bg-slate-200 rounded w-4/5"></div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[10px] font-bold px-2.5 py-0.5 rounded-full bg-primary/10 text-primary border border-primary/20">
                                    Kode: TPL-01
                                </span>
                                <span class="text-[11px] font-semibold text-emerald-600 flex items-center gap-1">
                                    ✓ ATS 98%
                                </span>
                            </div>
                            <h3 class="font-extrabold text-lg text-slate-900">Modern Indigo</h3>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                Format paling populer dengan struktur visual seimbang, header berwarna cyan-indigo elegan, dan hierarki kronologis teratur.
                            </p>
                        </div>
                    </div>
                    <div class="p-6 pt-0">
                        @auth
                            <a href="{{ route('cv-preview.show', ['template' => 'modern']) }}" class="w-full inline-flex items-center justify-center py-2.5 px-4 rounded-lg bg-primary hover:bg-primary-dark text-white font-bold text-xs transition">
                                Terapkan pada CV Saya
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="w-full inline-flex items-center justify-center py-2.5 px-4 rounded-lg bg-primary hover:bg-primary-dark text-white font-bold text-xs transition">
                                Buat Akun & Gunakan
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-md hover:border-primary/50 transition duration-200 overflow-hidden flex flex-col justify-between">
                    <div>
                        <div class="p-6 bg-slate-100 flex items-center justify-center border-b border-slate-200">
                            <div class="w-48 h-64 bg-white rounded shadow p-3 flex flex-col justify-between text-[8px] text-slate-400">
                                <div>
                                    <div class="h-3 bg-slate-800 rounded w-2/3 mx-auto mb-1"></div>
                                    <div class="h-2 bg-slate-400 rounded w-1/3 mx-auto mb-3"></div>
                                    <div class="space-y-1">
                                        <div class="h-1 bg-slate-200 rounded w-full"></div>
                                        <div class="h-1 bg-slate-200 rounded w-5/6"></div>
                                        <div class="h-1 bg-slate-200 rounded w-full"></div>
                                    </div>
                                </div>
                                <div class="border-t pt-2 space-y-1">
                                    <div class="h-2 bg-slate-800 rounded w-1/3 mb-1"></div>
                                    <div class="h-1 bg-slate-200 rounded w-full"></div>
                                    <div class="h-1 bg-slate-200 rounded w-3/4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[10px] font-bold px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 border border-slate-200">
                                    Kode: TPL-02
                                </span>
                                <span class="text-[11px] font-semibold text-emerald-600 flex items-center gap-1">
                                    ✓ ATS 100%
                                </span>
                            </div>
                            <h3 class="font-extrabold text-lg text-slate-900">Classic Executive</h3>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                Gaya formal tradisional teruji yang disukai instansi pemerintah, BUMN, perbankan, dan firma hukum terkemuka.
                            </p>
                        </div>
                    </div>
                    <div class="p-6 pt-0">
                        @auth
                            <a href="{{ route('cv-preview.show', ['template' => 'classic']) }}" class="w-full inline-flex items-center justify-center py-2.5 px-4 rounded-lg bg-primary hover:bg-primary-dark text-white font-bold text-xs transition">
                                Terapkan pada CV Saya
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="w-full inline-flex items-center justify-center py-2.5 px-4 rounded-lg bg-primary hover:bg-primary-dark text-white font-bold text-xs transition">
                                Buat Akun & Gunakan
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-md hover:border-primary/50 transition duration-200 overflow-hidden flex flex-col justify-between">
                    <div>
                        <div class="p-6 bg-slate-100 flex items-center justify-center border-b border-slate-200">
                            <div class="w-48 h-64 bg-white rounded shadow p-3 flex flex-col justify-between text-[8px] text-slate-400">
                                <div>
                                    <div class="h-2.5 bg-slate-600 rounded w-1/2 mb-1"></div>
                                    <div class="h-1.5 bg-slate-400 rounded w-1/3 mb-3"></div>
                                    <div class="space-y-1">
                                        <div class="h-1 bg-slate-200 rounded w-full"></div>
                                        <div class="h-1 bg-slate-200 rounded w-4/5"></div>
                                        <div class="h-1 bg-slate-200 rounded w-3/4"></div>
                                    </div>
                                </div>
                                <div class="border-t pt-2 space-y-1">
                                    <div class="h-2 bg-slate-600 rounded w-1/4 mb-1"></div>
                                    <div class="h-1 bg-slate-200 rounded w-full"></div>
                                    <div class="h-1 bg-slate-200 rounded w-5/6"></div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[10px] font-bold px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 border border-slate-200">
                                    Kode: TPL-03
                                </span>
                                <span class="text-[11px] font-semibold text-emerald-600 flex items-center gap-1">
                                    ✓ ATS 97%
                                </span>
                            </div>
                            <h3 class="font-extrabold text-lg text-slate-900">Minimalist Clean</h3>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                Tata letak minimalis dengan pemanfaatan white-space cerdas untuk pembacaan cepat dalam waktu 6 detik oleh recruiter.
                            </p>
                        </div>
                    </div>
                    <div class="p-6 pt-0">
                        @auth
                            <a href="{{ route('cv-preview.show', ['template' => 'minimalist']) }}" class="w-full inline-flex items-center justify-center py-2.5 px-4 rounded-lg bg-primary hover:bg-primary-dark text-white font-bold text-xs transition">
                                Terapkan pada CV Saya
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="w-full inline-flex items-center justify-center py-2.5 px-4 rounded-lg bg-primary hover:bg-primary-dark text-white font-bold text-xs transition">
                                Buat Akun & Gunakan
                            </a>
                        @endauth
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-public-layout>
