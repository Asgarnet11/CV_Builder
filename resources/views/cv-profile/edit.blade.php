<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full bg-indigo-50 dark:bg-indigo-950/60 border border-indigo-200/50 dark:border-indigo-800/50 text-indigo-600 dark:text-indigo-400 text-xs font-bold tracking-wide uppercase mb-1">
                    <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                    Profil Personal & Kontak
                </div>
                <h2 class="font-extrabold text-2xl sm:text-3xl text-slate-900 dark:text-white tracking-tight">
                    {{ __('Kelola Biodata CV') }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                    {{ __('Kelola profil personal, kontak publik, dan berkas foto resmi Anda untuk dokumen CV.') }}
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2.5 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-xs font-bold rounded-xl transition">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Dashboard') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10" x-data="{
        splitPreview: false,
        saveStatus: '',
        timeout: null,
        autoSave() {
            clearTimeout(this.timeout);
            this.saveStatus = 'Menyimpan...';
            this.timeout = setTimeout(() => {
                const form = document.getElementById('cv-profile-form');
                if (!form) return;
                let formData = new FormData(form);
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    this.saveStatus = 'Tersimpan';
                    if (this.splitPreview && this.$refs.previewFrame) {
                        this.$refs.previewFrame.contentWindow.location.reload();
                    }
                    setTimeout(() => this.saveStatus = '', 3000);
                })
                .catch(error => {
                    this.saveStatus = 'Gagal menyimpan';
                });
            }, 1000);
        }
    }">
        <div :class="splitPreview ? 'max-w-7xl' : 'max-w-5xl'" class="mx-auto sm:px-6 lg:px-8 space-y-6 transition-all duration-300">

            <!-- Guided Workflow Stepper -->
            <x-cv-wizard-stepper current="profile" />

            <!-- Subheader Bar with Split Preview Toggle -->
            <div class="flex items-center justify-between">
                <button type="button" 
                        @click="splitPreview = !splitPreview"
                        :class="splitPreview ? 'bg-indigo-600 text-white shadow-md' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700'"
                        class="hidden lg:inline-flex items-center px-4 py-2 text-xs font-bold rounded-xl transition shadow-sm">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                    </svg>
                    <span x-text="splitPreview ? 'Tutup Pratinjau Samping' : '👁️ Buka Pratinjau Samping (Split Live Preview)'"></span>
                </button>
                <div class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1.5 ml-auto">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Penyimpanan otomatis aktif</span>
                </div>
            </div>

            <!-- Two Columns on Split Mode -->
            <div :class="splitPreview ? 'grid grid-cols-1 lg:grid-cols-12 gap-8 items-start' : ''">
                <!-- Form Column -->
                <div :class="splitPreview ? 'lg:col-span-7 space-y-6' : 'space-y-6'">

            <!-- Validation Errors Summary -->
            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 dark:text-red-200 bg-red-50 dark:bg-red-950/50 border border-red-300 dark:border-red-800 rounded-xl" role="alert">
                    <div class="flex items-center mb-1">
                        <svg class="w-5 h-5 mr-2 shrink-0 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-semibold">{{ __('Terdapat kesalahan pada isian formulir:') }}</span>
                    </div>
                    <ul class="list-disc list-inside mt-2 space-y-1 text-xs">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="cv-profile-form" method="POST" action="{{ route('cv-profile.update') }}" enctype="multipart/form-data" class="space-y-6"
                  @input="autoSave"
                  @change="autoSave"
            >
                @csrf
                @method('PUT')

                <!-- Toast Notification -->
                <div x-show="saveStatus" 
                     x-transition.opacity.duration.300ms
                     class="fixed bottom-5 right-5 z-50 bg-gray-900 text-white px-4 py-2 rounded-lg shadow-lg flex items-center space-x-2 text-sm"
                     style="display: none;">
                    <svg x-show="saveStatus === 'Menyimpan...'" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <svg x-show="saveStatus === 'Tersimpan'" class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span x-text="saveStatus"></span>
                </div>

                <!-- Card 1: Foto Profil & Info Utama -->
                <div class="bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700/60 rounded-2xl p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 border-b border-gray-100 dark:border-gray-700/60 pb-3 mb-6 flex items-center">
                        <span class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-950/70 text-indigo-600 dark:text-indigo-400 inline-flex items-center justify-center mr-3 font-semibold text-sm">1</span>
                        {{ __('Foto Profil & Identitas Utama') }}
                    </h3>

                    <!-- Foto Profil Section -->
                    <div class="mb-8" x-data="cvPhotoCropper({
                        uploadUrl: '{{ route('cv-profile.update-photo') }}',
                        deleteUrl: '{{ route('cv-profile.destroy-photo') }}',
                        csrfToken: '{{ csrf_token() }}'
                    })">
                        <label class="block text-sm font-bold text-slate-800 dark:text-slate-200 mb-1">
                            {{ __('Foto Profil Formal') }}
                        </label>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mb-4">
                            {{ __('Format: JPG, JPEG, PNG, WEBP. Maksimal ukuran file setelah kompresi otomatis: 2 MB (2048 KB).') }}
                        </p>

                        <!-- Modal Cropper Dialog -->
                        <div x-show="showCropper" 
                             x-cloak
                             style="display: none;" 
                             class="fixed inset-0 z-50 flex items-center justify-center p-3 sm:p-5 bg-slate-900/80 backdrop-blur-sm"
                             @keydown.escape.window="cancelCrop">
                            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-2xl w-full max-w-2xl overflow-hidden flex flex-col border border-slate-200 dark:border-slate-800 transition-all">
                                
                                <!-- Modal Header -->
                                <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                                    <div>
                                        <h3 class="text-base font-extrabold text-slate-900 dark:text-white flex items-center gap-2">
                                            <span class="w-2.5 h-2.5 rounded-full bg-primary animate-pulse"></span>
                                            Potong & Sesuaikan Foto Profil
                                        </h3>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                            Sesuaikan area foto. Resolusi asli dipertahankan penuh dan ukuran otomatis di bawah 2 MB.
                                        </p>
                                    </div>
                                    <button type="button" @click="cancelCrop" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>

                                <!-- Controls Bar (Aspect Ratios & Tools) -->
                                <div class="px-6 py-3 bg-slate-50 dark:bg-slate-950/50 border-b border-slate-200/80 dark:border-slate-800 flex flex-wrap items-center justify-between gap-3 text-xs">
                                    <!-- Aspect Ratio Presets -->
                                    <div class="flex items-center gap-1.5 bg-white dark:bg-slate-900 p-1 rounded-xl border border-slate-200 dark:border-slate-800">
                                        <span class="px-2 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Rasio:</span>
                                        <button type="button" 
                                                @click="setRatio('1:1')"
                                                :class="activeRatio === '1:1' ? 'bg-primary text-white shadow-sm' : 'text-slate-600 dark:text-slate-300 hover:text-primary'"
                                                class="px-2.5 py-1 rounded-lg font-semibold transition">
                                            1:1 (Persegi)
                                        </button>
                                        <button type="button" 
                                                @click="setRatio('3:4')"
                                                :class="activeRatio === '3:4' ? 'bg-primary text-white shadow-sm' : 'text-slate-600 dark:text-slate-300 hover:text-primary'"
                                                class="px-2.5 py-1 rounded-lg font-semibold transition">
                                            3:4 (Pas Foto)
                                        </button>
                                        <button type="button" 
                                                @click="setRatio('free')"
                                                :class="activeRatio === 'free' ? 'bg-primary text-white shadow-sm' : 'text-slate-600 dark:text-slate-300 hover:text-primary'"
                                                class="px-2.5 py-1 rounded-lg font-semibold transition">
                                            Bebas
                                        </button>
                                    </div>

                                    <!-- Zoom & Rotate Actions -->
                                    <div class="flex items-center gap-1">
                                        <button type="button" @click="zoom(0.1)" title="Perbesar (Zoom In)" class="p-1.5 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-200 hover:border-primary hover:text-primary transition shadow-xs">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path></svg>
                                        </button>
                                        <button type="button" @click="zoom(-0.1)" title="Perkecil (Zoom Out)" class="p-1.5 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-200 hover:border-primary hover:text-primary transition shadow-xs">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM13 10H7"></path></svg>
                                        </button>
                                        <button type="button" @click="rotate(-90)" title="Putar Kiri 90°" class="p-1.5 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-200 hover:border-primary hover:text-primary transition shadow-xs">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a5 5 0 015 5v2m0 0l-3-3m3 3l3-3M3 10l3 3M3 10l3-3"></path></svg>
                                        </button>
                                        <button type="button" @click="rotate(90)" title="Putar Kanan 90°" class="p-1.5 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-200 hover:border-primary hover:text-primary transition shadow-xs">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10H11a5 5 0 00-5 5v2m0 0l3-3m-3 3l-3-3m18-7l-3 3m3-3l-3-3"></path></svg>
                                        </button>
                                        <button type="button" @click="resetCrop" title="Kembalikan Posisi Semula" class="p-1.5 rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-200 hover:border-primary hover:text-primary transition shadow-xs">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Cropper Canvas Workspace -->
                                <div class="relative bg-slate-950 p-2 sm:p-4 flex items-center justify-center overflow-hidden h-[340px] sm:h-[400px]">
                                    <div class="w-full h-full flex items-center justify-center">
                                        <img id="cropper-image" src="" class="max-w-full max-h-full block" alt="Foto untuk dipotong">
                                    </div>
                                </div>

                                <!-- Live Resolution & Compression Bar -->
                                <div class="px-6 py-2.5 bg-slate-100 dark:bg-slate-800/80 border-t border-slate-200 dark:border-slate-700 flex flex-wrap items-center justify-between gap-2 text-[11px] text-slate-600 dark:text-slate-300">
                                    <div class="flex items-center gap-1.5">
                                        <span class="font-bold text-slate-700 dark:text-slate-200">Resolusi Potongan:</span>
                                        <span class="font-mono bg-white dark:bg-slate-900 px-2 py-0.5 rounded border border-slate-200 dark:border-slate-700 font-semibold text-primary" x-text="cropWidth ? (cropWidth + ' × ' + cropHeight + ' px') : 'Menghitung...'"></span>
                                    </div>
                                    <div class="flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400 font-semibold">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        <span>Auto-kompres &lt; 2 MB • Resolusi Asli Terjaga Penuh</span>
                                    </div>
                                </div>

                                <!-- Error Alert if any -->
                                <div x-show="errorMessage" x-cloak class="px-6 py-2.5 bg-rose-50 text-rose-700 text-xs font-semibold border-t border-rose-200 flex items-center justify-between">
                                    <span x-text="errorMessage"></span>
                                    <button type="button" @click="errorMessage = null" class="text-rose-500 font-bold text-base">&times;</button>
                                </div>

                                <!-- Modal Footer -->
                                <div class="p-4 px-6 border-t border-slate-200 dark:border-slate-800 flex items-center justify-end gap-3 bg-white dark:bg-slate-900">
                                    <button type="button" 
                                            @click="cancelCrop" 
                                            :disabled="isUploading"
                                            class="px-4 py-2.5 text-xs font-bold text-slate-600 dark:text-slate-300 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 rounded-lg transition disabled:opacity-50">
                                        Batal
                                    </button>
                                    <button type="button" 
                                            @click="cropAndSave" 
                                            :disabled="isUploading"
                                            class="inline-flex items-center gap-2 px-5 py-2.5 text-xs font-bold text-white bg-primary hover:bg-primary-dark rounded-lg shadow-md transition disabled:opacity-50">
                                        <svg x-show="isUploading" class="animate-spin -ml-1 mr-1 h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <span x-text="isUploading ? 'Memproses & Menyimpan...' : 'Potong & Simpan Foto'"></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Card Display on Edit Form -->
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                            <!-- Image Display / Placeholder -->
                            <div class="shrink-0 relative">
                                <template x-if="photoPreview && photoPreview !== 'deleted'">
                                    <div class="relative group">
                                        <img :src="photoPreview" 
                                             alt="Foto Profil" 
                                             class="w-32 h-32 rounded-2xl object-cover shadow-md border-2 border-primary/50">
                                        <span class="absolute bottom-2 right-2 bg-emerald-500 text-white p-1 rounded-full text-xs shadow-md" title="Foto Tersimpan">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </template>

                                <template x-if="!photoPreview || photoPreview === 'deleted'">
                                    <div>
                                        @if ($profile && $profile->photo)
                                            <div x-show="photoPreview !== 'deleted'" class="relative group">
                                                <img src="{{ asset('storage/' . $profile->photo) }}" 
                                                     alt="{{ $profile->full_name }}" 
                                                     class="w-32 h-32 rounded-2xl object-cover shadow-md border border-slate-200 dark:border-slate-700">
                                                <span class="absolute bottom-2 right-2 bg-emerald-500 text-white p-1 rounded-full text-xs shadow-md" title="Foto Tersimpan">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div x-show="photoPreview === 'deleted'" class="w-32 h-32 rounded-2xl bg-slate-100 dark:bg-slate-800 border-2 border-dashed border-slate-300 dark:border-slate-700 flex flex-col items-center justify-center text-slate-400">
                                                <svg class="w-10 h-10 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">No Photo</span>
                                            </div>
                                        @else
                                            <div class="w-32 h-32 rounded-2xl bg-slate-100 dark:bg-slate-800 border-2 border-dashed border-slate-300 dark:border-slate-700 flex flex-col items-center justify-center text-slate-400">
                                                <svg class="w-10 h-10 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">No Photo</span>
                                            </div>
                                        @endif
                                    </div>
                                </template>
                            </div>

                            <!-- Upload Input Controls -->
                            <div class="flex-1 space-y-3">
                                <input type="file" 
                                       id="photo" 
                                       name="photo_dummy" 
                                       accept="image/png, image/jpeg, image/jpg, image/webp"
                                       class="hidden" 
                                       x-ref="photo"
                                       x-on:change="
                                           if ($refs.photo.files.length > 0) {
                                               const file = $refs.photo.files[0];
                                               photoName = file.name;
                                               const reader = new FileReader();
                                               reader.onload = (e) => {
                                                   initCropper(e.target.result);
                                               };
                                               reader.readAsDataURL(file);
                                               $refs.photo.value = null;
                                           }
                                       " />

                                <div class="flex flex-wrap items-center gap-3">
                                    <button type="button" 
                                            x-on:click.prevent="$refs.photo.click()" 
                                            class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary hover:bg-primary-dark text-white text-xs font-bold rounded-lg shadow-sm transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                        </svg>
                                        <span>{{ __('Pilih & Potong Foto') }}</span>
                                    </button>

                                    @if ($profile && $profile->photo)
                                        <button type="button" 
                                                x-show="photoPreview !== 'deleted'"
                                                x-on:click="deletePhoto"
                                                :disabled="isDeleting"
                                                class="inline-flex items-center gap-1.5 px-3 py-2.5 bg-white dark:bg-slate-800 border border-rose-300 dark:border-rose-900 text-rose-600 dark:text-rose-400 hover:bg-rose-50 text-xs font-bold rounded-lg transition disabled:opacity-50">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            <span x-text="isDeleting ? 'Menghapus...' : 'Hapus Foto'"></span>
                                        </button>
                                    @endif
                                </div>

                                <div x-show="photoMessage" x-cloak class="p-2.5 rounded-lg bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 text-xs font-semibold flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    <span x-text="photoMessage"></span>
                                </div>

                                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                                    Format: <strong>JPG, JPEG, PNG, WEBP</strong>. Sistem secara otomatis memotong sesuai keinginan Anda dan mengompres ukuran file di bawah <strong>2 MB</strong> dengan mempertahankan ketajaman resolusi asli.
                                </p>

                                <x-input-error class="mt-1" :messages="$errors->get('photo')" />
                            </div>
                        </div>
                    </div>

                    <!-- Input Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div>
                            <x-input-label for="full_name" :value="__('Nama Lengkap & Gelar *')" />
                            <x-text-input id="full_name" 
                                          name="full_name" 
                                          type="text" 
                                          class="mt-1 block w-full rounded-xl" 
                                          :value="old('full_name', $profile?->full_name ?? $user->name)" 
                                          placeholder="Contoh: Budi Santoso, S.Kom."
                                          required 
                                          autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('full_name')" />
                        </div>

                        <!-- Headline -->
                        <div>
                            <x-input-label for="headline" :value="__('Headline Profesional')" />
                            <x-text-input id="headline" 
                                          name="headline" 
                                          type="text" 
                                          class="mt-1 block w-full rounded-xl" 
                                          :value="old('headline', $profile?->headline ?? '')" 
                                          placeholder="Contoh: Junior Web Developer | Laravel Enthusiast" />
                            <x-input-error class="mt-2" :messages="$errors->get('headline')" />
                        </div>
                    </div>
                </div>

                <!-- Card 2: Kontak & Media Sosial -->
                <div class="bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700/60 rounded-2xl p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 border-b border-gray-100 dark:border-gray-700/60 pb-3 mb-6 flex items-center">
                        <span class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-950/70 text-indigo-600 dark:text-indigo-400 inline-flex items-center justify-center mr-3 font-semibold text-sm">2</span>
                        {{ __('Kontak & Tautan Portofolio') }}
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Phone -->
                        <div>
                            <x-input-label for="phone" :value="__('Nomor Telepon / WhatsApp')" />
                            <x-text-input id="phone" 
                                          name="phone" 
                                          type="tel" 
                                          class="mt-1 block w-full rounded-xl" 
                                          :value="old('phone', $profile?->phone ?? '')" 
                                          placeholder="Contoh: +62 812-3456-7890" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>

                        <!-- Public CV Email -->
                        <div>
                            <x-input-label for="email_cv" :value="__('Email Publik CV')" />
                            <x-text-input id="email_cv" 
                                          name="email_cv" 
                                          type="email" 
                                          class="mt-1 block w-full rounded-xl" 
                                          :value="old('email_cv', $profile?->email_cv ?? $user->email)" 
                                          placeholder="Contoh: contact@budisantoso.id" />
                            <x-input-error class="mt-2" :messages="$errors->get('email_cv')" />
                        </div>

                        <!-- LinkedIn URL -->
                        <div>
                            <x-input-label for="linkedin_url" :value="__('Tautan LinkedIn')" />
                            <x-text-input id="linkedin_url" 
                                          name="linkedin_url" 
                                          type="url" 
                                          class="mt-1 block w-full rounded-xl" 
                                          :value="old('linkedin_url', $profile?->linkedin_url ?? '')" 
                                          placeholder="https://linkedin.com/in/username" />
                            <x-input-error class="mt-2" :messages="$errors->get('linkedin_url')" />
                        </div>

                        <!-- Portfolio URL -->
                        <div>
                            <x-input-label for="portfolio_url" :value="__('Tautan Portofolio / GitHub / Website')" />
                            <x-text-input id="portfolio_url" 
                                          name="portfolio_url" 
                                          type="url" 
                                          class="mt-1 block w-full rounded-xl" 
                                          :value="old('portfolio_url', $profile?->portfolio_url ?? '')" 
                                          placeholder="https://budisantoso.dev" />
                        </div>

                        <div>
                            <x-input-label for="theme_color" :value="__('Warna Aksen CV')" />
                            <div class="flex items-center gap-3 mt-1">
                                <input type="color" id="theme_color" name="theme_color" 
                                       value="{{ old('theme_color', $profile?->theme_color ?? '#4f46e5') }}" 
                                       class="h-10 w-14 rounded-lg cursor-pointer border-0 bg-transparent p-0">
                                <span class="text-sm text-gray-500 dark:text-gray-400">Pilih warna utama untuk template CV Anda</span>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('theme_color')" />
                        </div>
                    </div>
                </div>

                <!-- Card 3: Domisili & Ringkasan Profil -->
                <div class="bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700/60 rounded-2xl p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 border-b border-gray-100 dark:border-gray-700/60 pb-3 mb-6 flex items-center">
                        <span class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-950/70 text-indigo-600 dark:text-indigo-400 inline-flex items-center justify-center mr-3 font-semibold text-sm">3</span>
                        {{ __('Domisili & Ringkasan Karir') }}
                    </h3>

                    <div class="space-y-6">
                        <!-- Address -->
                        <div>
                            <x-input-label for="address" :value="__('Alamat Domisili')" />
                            <textarea id="address" 
                                      name="address" 
                                      rows="2" 
                                      class="mt-1 block w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm"
                                      placeholder="Contoh: Jakarta Selatan, DKI Jakarta">{{ old('address', $profile?->address ?? '') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>

                        <!-- Summary with AI Assistant -->
                        <div x-data="{
                            showAiModal: false,
                            loadingAi: false,
                            aiRole: '{{ addslashes($profile?->headline ?? '') }}',
                            aiLevel: 'mid',
                            aiSkills: '',
                            aiTone: 'professional',
                            aiLang: 'id',
                            aiResult: '',
                            generateSummary() {
                                if (!this.aiRole.trim()) {
                                    alert('Mohon masukkan profesi/bidang pekerjaan Anda.');
                                    return;
                                }
                                this.loadingAi = true;
                                this.aiResult = '';
                                fetch('{{ route('ai.generate-summary') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content'),
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        role: this.aiRole,
                                        experience_level: this.aiLevel,
                                        skills: this.aiSkills,
                                        tone: this.aiTone,
                                        language: this.aiLang
                                    })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    this.loadingAi = false;
                                    if (data.status === 'success') {
                                        this.aiResult = data.summary;
                                    } else {
                                        alert('Gagal menghasilkan ringkasan AI.');
                                    }
                                })
                                .catch(err => {
                                    this.loadingAi = false;
                                    alert('Terjadi kesalahan jaringan.');
                                });
                            },
                            applySummary() {
                                const textarea = document.getElementById('summary');
                                textarea.value = this.aiResult;
                                textarea.dispatchEvent(new Event('input', { bubbles: true }));
                                this.showAiModal = false;
                            }
                        }">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                                <div>
                                    <x-input-label for="summary" :value="__('Ringkasan Profil (Professional Summary)')" />
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ __('Tuliskan 2-4 kalimat ringkas yang merangkum latar belakang, minat spesialisasi, dan nilai tambah Anda.') }}
                                    </p>
                                </div>
                                <button type="button" 
                                        @click="showAiModal = true; if(!aiRole) { const hl = document.getElementById('headline'); if(hl && hl.value) aiRole = hl.value; }"
                                        class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-700 hover:to-indigo-700 text-white text-xs font-bold rounded-xl shadow-sm transition shrink-0 self-start sm:self-auto">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-amber-300 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    {{ __('✨ AI Assistant') }}
                                </button>
                            </div>

                            <textarea id="summary" 
                                      name="summary" 
                                      rows="5" 
                                      class="mt-1 block w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm"
                                      placeholder="Contoh: Lulusan baru Informatika dengan minat kuat dalam pengembangan aplikasi web Laravel. Terbiasa membangun antarmuka responsif dan REST API yang teruji...">{{ old('summary', $profile?->summary ?? '') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('summary')" />

                            <!-- AI Assistant Modal -->
                            <div x-show="showAiModal" 
                                 style="display: none;" 
                                 class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0"
                                 x-transition:enter-end="opacity-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100"
                                 x-transition:leave-end="opacity-0">
                                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden border border-gray-200 dark:border-gray-700 flex flex-col"
                                     @click.away="showAiModal = false">
                                    <div class="px-6 py-4 bg-gradient-to-r from-violet-600 to-indigo-600 text-white flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <span class="p-1.5 bg-white/20 rounded-lg">✨</span>
                                            <h3 class="font-bold text-base">AI Resume Writer</h3>
                                        </div>
                                        <button type="button" @click="showAiModal = false" class="text-white/80 hover:text-white text-xl leading-none">&times;</button>
                                    </div>

                                    <div class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
                                        <div>
                                            <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1">Profesi / Target Pekerjaan *</label>
                                            <input type="text" x-model="aiRole" placeholder="Misal: Backend Laravel Developer, UI Designer" class="w-full text-sm rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                        </div>

                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1">Tingkat Pengalaman</label>
                                                <select x-model="aiLevel" class="w-full text-sm rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                                    <option value="fresh_graduate">Fresh Graduate / Pemula</option>
                                                    <option value="junior">Junior (1-2 tahun)</option>
                                                    <option value="mid">Menengah (3-5 tahun)</option>
                                                    <option value="senior">Senior / Eksekutif (5+ tahun)</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1">Gaya Bahasa (Tone)</label>
                                                <select x-model="aiTone" class="w-full text-sm rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                                    <option value="professional">Profesional</option>
                                                    <option value="executive">Eksekutif / Strategis</option>
                                                    <option value="impactful">Berdampak & Aktif</option>
                                                    <option value="concise">Ringkas & Padat</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1">Bahasa</label>
                                                <select x-model="aiLang" class="w-full text-sm rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                                    <option value="id">Bahasa Indonesia</option>
                                                    <option value="en">English</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1">Keahlian Utama (Opsional)</label>
                                                <input type="text" x-model="aiSkills" placeholder="Misal: PHP, MySQL, REST API" class="w-full text-sm rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                            </div>
                                        </div>

                                        <!-- Preview Box -->
                                        <div x-show="aiResult" class="p-3 bg-indigo-50 dark:bg-indigo-950/40 rounded-xl border border-indigo-200 dark:border-indigo-800 text-sm text-gray-800 dark:text-gray-200 leading-relaxed">
                                            <div class="text-xs font-bold text-indigo-600 dark:text-indigo-400 mb-1 flex items-center">
                                                <span class="mr-1">🎯</span> Saran Hasil AI:
                                            </div>
                                            <p x-text="aiResult"></p>
                                        </div>
                                    </div>

                                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                                        <button type="button" @click="generateSummary" :disabled="loadingAi" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl transition disabled:opacity-50 shadow-sm">
                                            <svg x-show="loadingAi" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                            <span x-text="loadingAi ? 'Menghasilkan...' : (aiResult ? 'Buat Ulang (Regenerate)' : 'Hasilkan Ringkasan ✨')"></span>
                                        </button>

                                        <div class="flex items-center space-x-2">
                                            <button type="button" @click="showAiModal = false" class="px-3 py-2 text-xs font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800 rounded-xl transition">Batal</button>
                                            <button type="button" x-show="aiResult" @click="applySummary" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition shadow-sm">Gunakan Hasil Ini ✓</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Display Settings Block -->
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-2xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                {{ __('Pengaturan Tampilan CV') }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                {{ __('Pilih bagian mana yang ingin ditampilkan atau disembunyikan pada hasil akhir CV Anda.') }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Show Education -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" id="show_education" name="show_education" value="1" 
                                       {{ old('show_education', $profile?->show_education ?? true) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 h-5 w-5 cursor-pointer @change="autoSave"">
                                <label for="show_education" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer">
                                    {{ __('Tampilkan Pendidikan') }}
                                </label>
                            </div>
                        </div>

                        <!-- Show Experience -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" id="show_experience" name="show_experience" value="1" 
                                       {{ old('show_experience', $profile?->show_experience ?? true) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 h-5 w-5 cursor-pointer @change="autoSave"">
                                <label for="show_experience" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer">
                                    {{ __('Tampilkan Pengalaman') }}
                                </label>
                            </div>
                        </div>

                        <!-- Show Skills -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" id="show_skills" name="show_skills" value="1" 
                                       {{ old('show_skills', $profile?->show_skills ?? true) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 h-5 w-5 cursor-pointer @change="autoSave"">
                                <label for="show_skills" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer">
                                    {{ __('Tampilkan Keahlian') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end gap-4 pt-4">
                    <a href="{{ route('dashboard') }}" class="px-5 py-2.5 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 font-semibold text-sm transition">
                        {{ __('Batal') }}
                    </a>

                    <button type="submit" 
                            class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-500/25 transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ __('Simpan Biodata') }}
                    </button>
                </div>
            </form>

                </div>
                <!-- End Form Column -->

                <!-- Sticky Live Preview Column -->
                <div x-show="splitPreview" 
                     style="display: none;"
                     class="hidden lg:block lg:col-span-5 sticky top-8 self-start space-y-4"
                     x-transition.opacity>
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden flex flex-col h-[850px]">
                        <div class="px-5 py-3.5 bg-slate-900 text-white flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                <span class="text-xs font-bold uppercase tracking-wider">Live Preview CV</span>
                            </div>
                            <div class="flex items-center space-x-2 text-xs">
                                <button type="button" @click="$refs.previewFrame.contentWindow.location.reload()" class="text-indigo-300 hover:text-white transition flex items-center gap-1 font-semibold">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                    Segarkan
                                </button>
                                <a href="{{ route('cv-preview.show') }}" target="_blank" class="text-indigo-300 hover:text-white ml-2 flex items-center gap-1 font-semibold">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    Buka Penuh
                                </a>
                            </div>
                        </div>
                        <div class="flex-1 bg-slate-100 dark:bg-slate-900 overflow-hidden relative">
                            <iframe x-ref="previewFrame" src="{{ route('cv-preview.show') }}" class="w-full h-full border-0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Two Columns -->

        </div>
    </div>
</x-app-layout>

@push('scripts')
<script>
    function cvPhotoCropper(config = {}) {
        return {
            photoName: null,
            photoPreview: null,
            showCropper: false,
            cropper: null,
            isUploading: false,
            isDeleting: false,
            activeRatio: '1:1',
            cropWidth: 0,
            cropHeight: 0,
            photoMessage: null,
            errorMessage: null,
            uploadUrl: config.uploadUrl || '',
            deleteUrl: config.deleteUrl || '',
            csrfToken: config.csrfToken || '',

            initCropper(imageUrl) {
                this.showCropper = true;
                this.activeRatio = '1:1';
                this.errorMessage = null;

                this.$nextTick(() => {
                    const image = document.getElementById('cropper-image');
                    if (!image) return;

                    if (this.cropper) {
                        this.cropper.destroy();
                        this.cropper = null;
                    }

                    image.onload = () => {
                        const CropperClass = window.Cropper || (typeof Cropper !== 'undefined' ? Cropper : null);
                        if (!CropperClass) {
                            this.errorMessage = 'Pustaka pemotong gambar sedang dimuat, silakan coba sesaat lagi.';
                            return;
                        }

                        this.cropper = new CropperClass(image, {
                            aspectRatio: 1,
                            viewMode: 1,
                            dragMode: 'move',
                            autoCropArea: 0.9,
                            responsive: true,
                            restore: false,
                            guides: true,
                            center: true,
                            highlight: false,
                            cropBoxMovable: true,
                            cropBoxResizable: true,
                            toggleDragModeOnDblclick: false,
                            crop: (e) => {
                                this.cropWidth = Math.round(e.detail.width);
                                this.cropHeight = Math.round(e.detail.height);
                            }
                        });
                    };

                    image.src = imageUrl;
                });
            },

            setRatio(ratio) {
                this.activeRatio = ratio;
                if (!this.cropper) return;
                if (ratio === '1:1') this.cropper.setAspectRatio(1);
                else if (ratio === '3:4') this.cropper.setAspectRatio(3 / 4);
                else if (ratio === 'free') this.cropper.setAspectRatio(NaN);
            },

            zoom(delta) {
                if (this.cropper) this.cropper.zoom(delta);
            },

            rotate(deg) {
                if (this.cropper) this.cropper.rotate(deg);
            },

            resetCrop() {
                if (this.cropper) {
                    this.cropper.reset();
                    this.setRatio(this.activeRatio);
                }
            },

            cancelCrop() {
                this.showCropper = false;
                if (this.cropper) {
                    this.cropper.destroy();
                    this.cropper = null;
                }
                if (this.$refs.photo) {
                    this.$refs.photo.value = null;
                }
            },

            async cropAndSave() {
                if (!this.cropper || this.isUploading) return;
                this.isUploading = true;
                this.errorMessage = null;

                try {
                    // Ambil canvas hasil crop dengan resolusi asli tanpa dipaksa mengecil ke 400x400
                    const canvas = this.cropper.getCroppedCanvas({
                        imageSmoothingEnabled: true,
                        imageSmoothingQuality: 'high'
                    });

                    if (!canvas) {
                        throw new Error('Gagal memproses area foto yang dipilih.');
                    }

                    // Kompresi adaptif: jaga di bawah 2 MB (target aman 1.95 MB) dengan menjaga ketajaman resolusi asli
                    const TARGET_BYTES = 1950000;
                    let quality = 0.94;
                    let base64 = canvas.toDataURL('image/jpeg', quality);
                    let approxBytes = Math.round((base64.length * 3) / 4);

                    if (approxBytes > TARGET_BYTES) {
                        const qualities = [0.90, 0.86, 0.82, 0.78, 0.74, 0.70];
                        for (const q of qualities) {
                            quality = q;
                            base64 = canvas.toDataURL('image/jpeg', quality);
                            approxBytes = Math.round((base64.length * 3) / 4);
                            if (approxBytes <= TARGET_BYTES) break;
                        }
                    }

                    // Edge case ekstrim bila gambar di atas 30-40 megapixel: skala proporsional secukupnya
                    let workingCanvas = canvas;
                    while (approxBytes > TARGET_BYTES && (workingCanvas.width > 1600 || workingCanvas.height > 1600)) {
                        const scale = 0.88;
                        const newW = Math.round(workingCanvas.width * scale);
                        const newH = Math.round(workingCanvas.height * scale);
                        const tempCanvas = document.createElement('canvas');
                        tempCanvas.width = newW;
                        tempCanvas.height = newH;
                        const ctx = tempCanvas.getContext('2d');
                        ctx.imageSmoothingEnabled = true;
                        ctx.imageSmoothingQuality = 'high';
                        ctx.drawImage(workingCanvas, 0, 0, newW, newH);
                        workingCanvas = tempCanvas;
                        base64 = workingCanvas.toDataURL('image/jpeg', 0.85);
                        approxBytes = Math.round((base64.length * 3) / 4);
                    }

                    const token = this.csrfToken || document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    const response = await fetch(this.uploadUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({ photo_base64: base64 })
                    });

                    const data = await response.json();

                    if (response.ok && data.status === 'success') {
                        this.photoPreview = data.photo_url;
                        this.photoMessage = `Foto tersimpan (${data.width} × ${data.height} px • ${data.size_kb} KB)`;
                        setTimeout(() => { this.photoMessage = null; }, 6000);
                        this.cancelCrop();
                    } else {
                        this.errorMessage = data.message || 'Gagal menyimpan foto profil.';
                    }
                } catch (err) {
                    this.errorMessage = err.message || 'Terjadi kendala saat memproses foto.';
                } finally {
                    this.isUploading = false;
                }
            },

            async deletePhoto() {
                if (!confirm('Apakah Anda yakin ingin menghapus foto profil ini?')) return;
                this.isDeleting = true;
                this.errorMessage = null;

                try {
                    const token = this.csrfToken || document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    const response = await fetch(this.deleteUrl, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token
                        }
                    });

                    const data = await response.json();
                    if (response.ok && data.status === 'success') {
                        this.photoPreview = 'deleted';
                        this.photoName = null;
                        this.photoMessage = 'Foto profil berhasil dihapus.';
                        setTimeout(() => { this.photoMessage = null; }, 5000);
                    } else {
                        this.errorMessage = data.message || 'Gagal menghapus foto.';
                    }
                } catch (err) {
                    this.errorMessage = err.message || 'Terjadi kesalahan saat menghapus foto.';
                } finally {
                    this.isDeleting = false;
                }
            }
        };
    }

    window.cvPhotoCropper = cvPhotoCropper;
    document.addEventListener('alpine:init', () => {
        if (window.Alpine) {
            window.Alpine.data('cvPhotoCropper', cvPhotoCropper);
        }
    });
</script>
@endpush
