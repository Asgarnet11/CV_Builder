<x-public-layout title="Pusat Bantuan & Helpdesk - LaraCV">
    <!-- Subpage Banner -->
    <section class="pt-28 pb-12 lg:pt-36 lg:pb-16 text-white relative overflow-hidden"
             style="background: linear-gradient(135deg, #1270a0 0%, #1a8cc8 35%, #269dd8 65%, #1e8ec4 100%);">
        <div class="absolute inset-0 pointer-events-none opacity-20 bg-[radial-gradient(#ffffff_1.5px,transparent_1.5px)] [background-size:24px_24px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center sm:text-left">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur-sm border border-white/30 text-xs font-semibold mb-3">
                <a href="{{ route('home') }}" class="hover:underline">Beranda</a>
                <span>/</span>
                <span>Pusat Bantuan</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                PUSAT BANTUAN & HELPDESK LARACV
            </h1>
            <p class="mt-2 text-sm text-white/90 max-w-2xl">
                Sampaikan pertanyaan atau kendala teknis Anda. Tim layanan bantuan siap mendampingi proses pembuatan dokumen Anda.
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12 lg:py-16 bg-slate-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if (session('status'))
                <div class="mb-8 p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-800 text-xs sm:text-sm font-semibold flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left Column: Support Form -->
                <div class="lg:col-span-7 bg-white p-6 sm:p-8 rounded-3xl border border-slate-200 shadow-sm space-y-6">
                    <div>
                        <h2 class="text-xl font-extrabold text-slate-900">Kirim Tiket Aduan / Pertanyaan</h2>
                        <p class="text-xs text-slate-500 mt-1">
                            Isi formulir di bawah ini dengan lengkap untuk mendapatkan respon cepat dari tim teknis kami.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('bantuan.submit') }}" class="space-y-4">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div>
                            <label for="nama" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input id="nama" name="nama" type="text" required 
                                   value="{{ old('nama', auth()->user()->name ?? '') }}"
                                   placeholder="Contoh: Budi Santoso"
                                   class="w-full text-xs rounded-lg border-slate-300 focus:border-primary focus:ring-primary shadow-sm py-2.5 px-3">
                            @error('nama')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                                Alamat Email Aktif <span class="text-red-500">*</span>
                            </label>
                            <input id="email" name="email" type="email" required 
                                   value="{{ old('email', auth()->user()->email ?? '') }}"
                                   placeholder="nama@email.com"
                                   class="w-full text-xs rounded-lg border-slate-300 focus:border-primary focus:ring-primary shadow-sm py-2.5 px-3">
                            @error('email')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori Masalah -->
                        <div>
                            <label for="kategori" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                                Kategori Kendala <span class="text-red-500">*</span>
                            </label>
                            <select id="kategori" name="kategori" required
                                    class="w-full text-xs rounded-lg border-slate-300 focus:border-primary focus:ring-primary shadow-sm py-2.5 px-3">
                                <option value="Kendala Unggah Foto Profil">Kendala Unggah Foto Profil</option>
                                <option value="Kesalahan Input Data / Form">Kesalahan Input Data / Form</option>
                                <option value="Kendala Unduh File PDF">Kendala Unduh File PDF</option>
                                <option value="Pertanyaan Seputar Format ATS">Pertanyaan Seputar Format ATS</option>
                                <option value="Masalah Akun / Login">Masalah Akun / Login</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            @error('kategori')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pesan / Detail Kendala -->
                        <div>
                            <label for="pesan" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">
                                Uraian Pertanyaan / Kendala <span class="text-red-500">*</span>
                            </label>
                            <textarea id="pesan" name="pesan" rows="4" required
                                      placeholder="Jelaskan secara rinci kendala yang Anda alami..."
                                      class="w-full text-xs rounded-lg border-slate-300 focus:border-primary focus:ring-primary shadow-sm py-2.5 px-3">{{ old('pesan') }}</textarea>
                            @error('pesan')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button (Primary Solid 8px) -->
                        <div class="pt-2">
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 py-3 px-5 rounded-lg bg-primary hover:bg-primary-dark text-white font-bold text-xs uppercase tracking-wider transition shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                <span>Kirim Tiket Aduan</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Column: Contact Channels & Operational Hours -->
                <div class="lg:col-span-5 space-y-6">
                    
                    <!-- Box 1: Layanan Hotline & WhatsApp -->
                    <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-sm space-y-4">
                        <h3 class="text-sm font-bold text-primary uppercase tracking-wider flex items-center gap-2">
                            <span class="w-6 h-0.5 bg-primary rounded-full"></span>
                            Saluran Layanan Resmi BPVP
                        </h3>
                        <ul class="space-y-3.5 text-xs text-slate-600">
                            <li class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-sky-50 text-primary flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <strong class="block text-slate-900">Telepon / WhatsApp Layanan</strong>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <a href="tel:+62882021291025" class="font-bold text-primary hover:underline">+62 882-0212-91025</a>
                                        <a href="https://wa.me/62882021291025" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold hover:bg-emerald-200 transition">
                                            Chat WhatsApp &rarr;
                                        </a>
                                    </div>
                                    <span class="text-[11px] text-slate-400">Aktif Senin - Jumat (08.00 - 16.00 WITA)</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-sky-50 text-primary flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <strong class="block text-slate-900">Email Helpdesk</strong>
                                    <a href="mailto:helpdesk@laracv.id" class="text-primary hover:underline">helpdesk@laracv.id</a>
                                    <span class="block text-[11px] text-slate-400">Respon tiket 1x24 jam kerja</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-sky-50 text-primary flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <strong class="block text-slate-900">Alamat Kantor</strong>
                                    <span>Balai Pelatihan Vokasi dan Produktivitas (BPVP) Kendari, Kota Kendari, Sulawesi Tenggara</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Box 2: Pengembang & Kemitraan -->
                    <div class="p-6 rounded-3xl bg-slate-900 text-white shadow-sm space-y-3">
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-white/10 text-sky-300 text-[10px] font-bold uppercase tracking-wider">
                            <span>Informasi Pengembang</span>
                        </div>
                        <h4 class="font-extrabold text-sm text-white">Dikembangkan oleh a2developer kendari</h4>
                        <p class="text-xs text-slate-300 leading-relaxed">
                            Sistem portal CV Builder terstandarisasi ini dikembangkan oleh <strong>a2developer kendari</strong> untuk <strong>BPVP Kendari</strong> guna menunjang kesiapan karir vokasi dan serapan alumni pelatihan kerja.
                        </p>
                        <div class="pt-1">
                            <a href="https://a2dev.my.id" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-bold text-sky-400 hover:text-sky-300 transition underline underline-offset-2">
                                <span>Kunjungi https://a2dev.my.id</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Box 3: Jam Operasional -->
                    <div class="p-6 rounded-3xl bg-primary/5 border border-primary/20 space-y-2">
                        <h4 class="font-bold text-xs uppercase tracking-wide text-primary">Jam Operasional Layanan</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Layanan konsultasi tiket aktif pada hari Senin - Jumat pukul 08:00 - 16:00 WITA (kecuali hari libur nasional). Tiket yang masuk di luar jam operasional akan diproses pada hari kerja berikutnya.
                        </p>
                    </div>

                </div>

            </div>
        </div>
    </section>
</x-public-layout>
