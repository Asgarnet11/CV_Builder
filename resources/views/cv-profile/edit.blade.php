<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
                    {{ __('Biodata CV') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    {{ __('Kelola profil personal, kontak publik, dan berkas foto resmi Anda untuk dokumen CV.') }}
                </p>
            </div>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-sm font-medium rounded-lg transition duration-150 ease-in-out">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                {{ __('Kembali ke Dashboard') }}
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">



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

            <form method="POST" action="{{ route('cv-profile.update') }}" enctype="multipart/form-data" class="space-y-6"
                  x-data="{
                      saveStatus: '',
                      timeout: null,
                      autoSave() {
                          clearTimeout(this.timeout);
                          this.saveStatus = 'Menyimpan...';
                          this.timeout = setTimeout(() => {
                              let formData = new FormData(this.$el);
                              fetch(this.$el.action, {
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
                                  setTimeout(() => this.saveStatus = '', 3000);
                              })
                              .catch(error => {
                                  this.saveStatus = 'Gagal menyimpan';
                              });
                          }, 1000);
                      }
                  }"
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
                    <div class="mb-8" x-data="{ 
                        photoName: null, 
                        photoPreview: null,
                        showCropper: false,
                        cropper: null,
                        initCropper(imageUrl) {
                            this.showCropper = true;
                            this.$nextTick(() => {
                                const image = document.getElementById('cropper-image');
                                image.src = imageUrl;
                                if (this.cropper) {
                                    this.cropper.destroy();
                                }
                                this.cropper = new Cropper(image, {
                                    aspectRatio: 1,
                                    viewMode: 1,
                                });
                            });
                        },
                        cropImage() {
                            if (!this.cropper) return;
                            const canvas = this.cropper.getCroppedCanvas({
                                width: 400,
                                height: 400
                            });
                            const base64 = canvas.toDataURL('image/jpeg', 0.9);
                            this.photoPreview = base64;
                            this.showCropper = false;
                            
                            // Upload via AJAX immediately
                            fetch('{{ route('cv-profile.update-photo') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content')
                                },
                                body: JSON.stringify({ photo_base64: base64 })
                            }).then(res => res.json()).then(data => {
                                if(data.status === 'success') {
                                    console.log('Photo updated');
                                }
                            });
                        },
                        cancelCrop() {
                            this.showCropper = false;
                            if (this.cropper) {
                                this.cropper.destroy();
                                this.cropper = null;
                            }
                        }
                    }">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Foto Profil Formal') }}
                        </label>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                            {{ __('Format: JPG, JPEG, PNG. Maksimal ukuran file: 2 MB (2048 KB).') }}
                        </p>

                        <!-- Modal Cropper -->
                        <div x-show="showCropper" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70">
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-lg overflow-hidden flex flex-col" @click.away="cancelCrop">
                                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Potong Foto Profil</h3>
                                </div>
                                <div class="p-4 bg-gray-50 dark:bg-gray-900 h-[400px]">
                                    <img id="cropper-image" src="" class="max-w-full block" alt="Crop Image">
                                </div>
                                <div class="p-4 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-3">
                                    <button type="button" @click="cancelCrop" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">Batal</button>
                                    <button type="button" @click="cropImage" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">Potong & Simpan</button>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                            <!-- Image Display / Placeholder -->
                            <div class="shrink-0">
                                <!-- When new preview is selected -->
                                <div x-show="photoPreview" style="display: none;">
                                    <span class="block rounded-2xl w-32 h-32 bg-cover bg-no-repeat bg-center shadow-md border-2 border-indigo-500"
                                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                    </span>
                                </div>

                                <!-- Current Photo or Placeholder -->
                                <div x-show="!photoPreview">
                                    @if ($profile && $profile->photo)
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $profile->photo) }}" 
                                                 alt="{{ $profile->full_name }}" 
                                                 class="w-32 h-32 rounded-2xl object-cover shadow-md border border-gray-200 dark:border-gray-700">
                                            <span class="absolute bottom-2 right-2 bg-emerald-500 text-white p-1 rounded-full text-xs shadow" title="Foto Tersimpan">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    @else
                                        <!-- No Photo Component -->
                                        <div class="w-32 h-32 rounded-2xl bg-gray-100 dark:bg-gray-700/60 border-2 border-dashed border-gray-300 dark:border-gray-600 flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                                            <svg class="w-10 h-10 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">No Photo</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Upload Input Controls -->
                            <div class="flex-1 space-y-3">
                                <input type="file" 
                                       id="photo" 
                                       name="photo_dummy" 
                                       accept="image/png, image/jpeg, image/jpg"
                                       class="hidden" 
                                       x-ref="photo"
                                       x-on:change="
                                           if ($refs.photo.files.length > 0) {
                                               photoName = $refs.photo.files[0].name;
                                               const reader = new FileReader();
                                               reader.onload = (e) => {
                                                   initCropper(e.target.result);
                                               };
                                               reader.readAsDataURL($refs.photo.files[0]);
                                               $refs.photo.value = null;
                                           }
                                       " />

                                <div class="flex flex-wrap items-center gap-3">
                                    <button type="button" 
                                            x-on:click.prevent="$refs.photo.click()" 
                                            class="inline-flex items-center px-4 py-2 bg-indigo-50 hover:bg-indigo-100 dark:bg-indigo-950/60 dark:hover:bg-indigo-900/60 text-indigo-700 dark:text-indigo-300 text-sm font-semibold rounded-xl border border-indigo-200 dark:border-indigo-800 transition shadow-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                        </svg>
                                        {{ __('Pilih Berkas Foto') }}
                                    </button>

                                    <button type="button" 
                                            x-show="photoPreview" 
                                            x-on:click="photoPreview = null; $refs.photo.value = null; photoName = null;" 
                                            style="display: none;"
                                            class="inline-flex items-center px-3 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-sm rounded-xl transition">
                                        {{ __('Batal Ganti') }}
                                    </button>
                                </div>

                                <div x-show="photoName" class="text-xs text-gray-600 dark:text-gray-300 font-mono" style="display: none;">
                                    Berkas terpilih: <span x-text="photoName"></span>
                                </div>

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

                        <!-- GitHub URL -->
                        <div>
                            <x-input-label for="github_url" :value="__('Tautan GitHub')" />
                            <x-text-input id="github_url" 
                                          name="github_url" 
                                          type="url" 
                                          class="mt-1 block w-full rounded-xl" 
                                          :value="old('github_url', $profile?->github_url ?? '')" 
                                          placeholder="https://github.com/username" />
                            <x-input-error class="mt-2" :messages="$errors->get('github_url')" />
                        </div>

                        <!-- Portfolio URL -->
                        <div>
                            <x-input-label for="portfolio_url" :value="__('Tautan Portofolio / Website')" />
                            <x-text-input id="portfolio_url" 
                                          name="portfolio_url" 
                                          type="url" 
                                          class="mt-1 block w-full rounded-xl" 
                                          :value="old('portfolio_url', $profile?->portfolio_url ?? '')" 
                                          placeholder="https://budisantoso.dev" />
                            <x-input-error class="mt-2" :messages="$errors->get('portfolio_url')" />
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
                            aiLoading: false,
                            aiTone: 'professional',
                            aiLang: 'id',
                            async generateAiSummary() {
                                const headline = document.getElementById('headline')?.value || '';
                                this.aiLoading = true;
                                try {
                                    const res = await fetch('{{ route('ai.generate-summary') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content'),
                                            'Accept': 'application/json'
                                        },
                                        body: JSON.stringify({
                                            headline: headline,
                                            tone: this.aiTone,
                                            lang: this.aiLang
                                        })
                                    });
                                    const data = await res.json();
                                    if (data.status === 'success' && data.summary) {
                                        document.getElementById('summary').value = data.summary;
                                        window.dispatchEvent(new CustomEvent('notify', { detail: 'Ringkasan profesional berhasil dibuat oleh AI!' }));
                                    }
                                } catch (e) {
                                    window.dispatchEvent(new CustomEvent('notify', { detail: 'Gagal membuat ringkasan AI: ' + e.message }));
                                } finally {
                                    this.aiLoading = false;
                                }
                            }
                        }">
                            <div class="flex flex-wrap items-center justify-between gap-2 mb-1">
                                <x-input-label for="summary" :value="__('Ringkasan Profil (Professional Summary)')" />
                                <div class="flex items-center gap-2">
                                    <button type="button" 
                                            @click="generateAiSummary()" 
                                            :disabled="aiLoading" 
                                            class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white text-xs font-bold rounded-lg shadow-sm transition disabled:opacity-50 cursor-pointer">
                                        <svg x-show="!aiLoading" class="w-3.5 h-3.5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg x-show="aiLoading" class="animate-spin w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                                        <span x-text="aiLoading ? 'Menyusun...' : '✨ Bantu Tulis dengan AI'"></span>
                                    </button>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                                {{ __('Tuliskan 2-4 kalimat ringkas yang merangkum latar belakang dan spesialisasi Anda, atau gunakan asisten AI di atas.') }}
                            </p>
                            <textarea id="summary" 
                                      name="summary" 
                                      rows="5" 
                                      class="mt-1 block w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm"
                                      placeholder="Contoh: Lulusan baru Informatika dengan minat kuat dalam pengembangan aplikasi web Laravel. Terbiasa membangun antarmuka responsif dan REST API yang teruji...">{{ old('summary', $profile?->summary ?? '') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('summary')" />
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
    </div>
</x-app-layout>

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
@endpush
