<x-public-layout title="FAQ - Pertanyaan yang Sering Diajukan - LaraCV">
    <!-- Subpage Banner -->
    <section class="pt-28 pb-12 lg:pt-36 lg:pb-16 text-white relative overflow-hidden"
             style="background: linear-gradient(135deg, #1270a0 0%, #1a8cc8 35%, #269dd8 65%, #1e8ec4 100%);">
        <div class="absolute inset-0 pointer-events-none opacity-20 bg-[radial-gradient(#ffffff_1.5px,transparent_1.5px)] [background-size:24px_24px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center sm:text-left">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur-sm border border-white/30 text-xs font-semibold mb-3">
                <a href="{{ route('home') }}" class="hover:underline">Beranda</a>
                <span>/</span>
                <span>FAQ</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                FREQUENTLY ASKED QUESTIONS (FAQ)
            </h1>
            <p class="mt-2 text-sm text-white/90 max-w-2xl">
                Temukan panduan dan jawaban cepat seputar pembuatan CV, sistem ATS, akun, dan kendala teknis lainnya.
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12 lg:py-16 bg-slate-50" x-data="{ searchFaq: '', activeCat: 'all' }">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Category Tabs -->
            <div class="flex items-center gap-2 justify-center mb-8 flex-wrap">
                <button type="button" 
                        @click="activeCat = 'all'"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition border"
                        :class="activeCat === 'all' ? 'bg-primary text-white border-primary shadow-sm' : 'bg-white text-slate-600 border-slate-200 hover:border-primary'">
                    Semua Kategori
                </button>
                <button type="button" 
                        @click="activeCat = 'ats'"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition border"
                        :class="activeCat === 'ats' ? 'bg-primary text-white border-primary shadow-sm' : 'bg-white text-slate-600 border-slate-200 hover:border-primary'">
                    Sistem ATS & Format
                </button>
                <button type="button" 
                        @click="activeCat = 'akun'"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition border"
                        :class="activeCat === 'akun' ? 'bg-primary text-white border-primary shadow-sm' : 'bg-white text-slate-600 border-slate-200 hover:border-primary'">
                    Akun & Keamanan
                </button>
                <button type="button" 
                        @click="activeCat = 'berkas'"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition border"
                        :class="activeCat === 'berkas' ? 'bg-primary text-white border-primary shadow-sm' : 'bg-white text-slate-600 border-slate-200 hover:border-primary'">
                    Unduh & Berkas Foto
                </button>
            </div>

            <!-- FAQ List Accordion -->
            <div class="space-y-4" x-data="{ openItem: 1 }">
                
                <!-- Q1 -->
                <div x-show="activeCat === 'all' || activeCat === 'ats'" class="rounded-2xl border border-slate-200 bg-white overflow-hidden shadow-sm">
                    <button type="button" 
                            @click="openItem = (openItem === 1 ? null : 1)"
                            class="w-full p-5 text-left font-bold text-sm text-slate-900 flex items-center justify-between hover:text-primary transition-colors">
                        <span>1. Apa yang dimaksud dengan CV ATS Friendly?</span>
                        <span class="text-primary font-extrabold text-lg" x-text="openItem === 1 ? '−' : '+'"></span>
                    </button>
                    <div x-show="openItem === 1" class="p-5 pt-0 text-xs text-slate-600 border-t border-slate-100 leading-relaxed space-y-2">
                        <p>
                            Applicant Tracking System (ATS) adalah perangkat lunak yang digunakan oleh perusahaan dan instansi untuk memindai, menyortir, dan memberi peringkat ribuan lamaran kerja secara otomatis sebelum dibaca oleh manusia.
                        </p>
                        <p>
                            CV ATS Friendly dibuat tanpa elemen grafik rumit, teks kotak berlebihan, atau format tabel tersembunyi yang dapat membingungkan robot pemindai. Seluruh template di LaraCV telah diuji 100% terbaca sistem ATS.
                        </p>
                    </div>
                </div>

                <!-- Q2 -->
                <div x-show="activeCat === 'all' || activeCat === 'berkas'" class="rounded-2xl border border-slate-200 bg-white overflow-hidden shadow-sm">
                    <button type="button" 
                            @click="openItem = (openItem === 2 ? null : 2)"
                            class="w-full p-5 text-left font-bold text-sm text-slate-900 flex items-center justify-between hover:text-primary transition-colors">
                        <span>2. Berkas format apa yang paling direkomendasikan saat melamar?</span>
                        <span class="text-primary font-extrabold text-lg" x-text="openItem === 2 ? '−' : '+'"></span>
                    </button>
                    <div x-show="openItem === 2" class="p-5 pt-0 text-xs text-slate-600 border-t border-slate-100 leading-relaxed space-y-2">
                        <p>
                            Format <strong>PDF</strong> adalah standar paling disarankan karena mengunci tata letak, ukuran font, dan margin secara persis di semua perangkat (komputer HRD, tablet, smartphone). LaraCV menyediakan unduhan PDF beresolusi tinggi ukuran A4 siap cetak.
                        </p>
                    </div>
                </div>

                <!-- Q3 -->
                <div x-show="activeCat === 'all' || activeCat === 'berkas'" class="rounded-2xl border border-slate-200 bg-white overflow-hidden shadow-sm">
                    <button type="button" 
                            @click="openItem = (openItem === 3 ? null : 3)"
                            class="w-full p-5 text-left font-bold text-sm text-slate-900 flex items-center justify-between hover:text-primary transition-colors">
                        <span>3. Bagaimana ketentuan foto profil yang boleh diunggah?</span>
                        <span class="text-primary font-extrabold text-lg" x-text="openItem === 3 ? '−' : '+'"></span>
                    </button>
                    <div x-show="openItem === 3" class="p-5 pt-0 text-xs text-slate-600 border-t border-slate-100 leading-relaxed space-y-2">
                        <p>
                            Sistem menerima berkas gambar dengan format JPG, JPEG, atau PNG dengan ukuran berkas maksimum 2 MB (2048 KB). Disarankan menggunakan foto formal berpenampilan rapi dengan latar belakang polos.
                        </p>
                    </div>
                </div>

                <!-- Q4 -->
                <div x-show="activeCat === 'all' || activeCat === 'akun'" class="rounded-2xl border border-slate-200 bg-white overflow-hidden shadow-sm">
                    <button type="button" 
                            @click="openItem = (openItem === 4 ? null : 4)"
                            class="w-full p-5 text-left font-bold text-sm text-slate-900 flex items-center justify-between hover:text-primary transition-colors">
                        <span>4. Apakah data pribadi saya aman dan terlindungi?</span>
                        <span class="text-primary font-extrabold text-lg" x-text="openItem === 4 ? '−' : '+'"></span>
                    </button>
                    <div x-show="openItem === 4" class="p-5 pt-0 text-xs text-slate-600 border-t border-slate-100 leading-relaxed space-y-2">
                        <p>
                            Sangat aman. Seluruh data disimpan dalam basis data terenkripsi dan hanya dapat diakses melalui kredensial autentikasi akun Anda. Kami tidak pernah membagikan data biodata ke pihak ketiga tanpa izin.
                        </p>
                    </div>
                </div>

                <!-- Q5 -->
                <div x-show="activeCat === 'all' || activeCat === 'ats'" class="rounded-2xl border border-slate-200 bg-white overflow-hidden shadow-sm">
                    <button type="button" 
                            @click="openItem = (openItem === 5 ? null : 5)"
                            class="w-full p-5 text-left font-bold text-sm text-slate-900 flex items-center justify-between hover:text-primary transition-colors">
                        <span>5. Berapa halaman panjang ideal dokumen CV?</span>
                        <span class="text-primary font-extrabold text-lg" x-text="openItem === 5 ? '−' : '+'"></span>
                    </button>
                    <div x-show="openItem === 5" class="p-5 pt-0 text-xs text-slate-600 border-t border-slate-100 leading-relaxed space-y-2">
                        <p>
                            Untuk pelamar dengan pengalaman di bawah 5 tahun atau fresh graduate, idealnya adalah <strong>1 halaman</strong>. Untuk profesional senior dengan banyak proyek dan publikasi, maksimal 2 halaman.
                        </p>
                    </div>
                </div>

            </div>

            <!-- Help Contact Box -->
            <div class="mt-12 p-6 rounded-2xl bg-sky-50 border border-sky-100 text-center space-y-3">
                <h4 class="font-bold text-sm text-slate-900">Masih Memiliki Pertanyaan Lain?</h4>
                <p class="text-xs text-slate-600 max-w-md mx-auto">
                    Tim Helpdesk LaraCV siap membantu Anda menyelesaikan permasalahan teknis dan pertanyaan seputar pembuatan dokumen.
                </p>
                <div class="pt-1">
                    <a href="{{ route('bantuan') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-primary hover:bg-primary-dark text-white font-bold text-xs transition shadow-sm">
                        Hubungi Tim Bantuan &rarr;
                    </a>
                </div>
            </div>

        </div>
    </section>
</x-public-layout>
