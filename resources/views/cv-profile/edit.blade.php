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

            <!-- Flash Success Notification -->
            @if (session('status'))
                <div class="p-4 mb-4 text-sm text-emerald-800 dark:text-emerald-200 bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-300 dark:border-emerald-800 rounded-xl flex items-center shadow-sm" role="alert">
                    <svg class="w-5 h-5 mr-3 shrink-0 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-medium">{{ session('status') }}</span>
                </div>
            @endif

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

            <form method="POST" action="{{ route('cv-profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Card 1: Foto Profil & Info Utama -->
                <div class="bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700/60 rounded-2xl p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 border-b border-gray-100 dark:border-gray-700/60 pb-3 mb-6 flex items-center">
                        <span class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-950/70 text-indigo-600 dark:text-indigo-400 inline-flex items-center justify-center mr-3 font-semibold text-sm">1</span>
                        {{ __('Foto Profil & Identitas Utama') }}
                    </h3>

                    <!-- Foto Profil Section -->
                    <div class="mb-8" x-data="{ photoName: null, photoPreview: null }">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Foto Profil Formal') }}
                        </label>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                            {{ __('Format: JPG, JPEG, PNG. Maksimal ukuran file: 2 MB (2048 KB).') }}
                        </p>

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
                                       name="photo" 
                                       accept="image/png, image/jpeg, image/jpg"
                                       class="hidden" 
                                       x-ref="photo"
                                       x-on:change="
                                           photoName = $refs.photo.files[0].name;
                                           const reader = new FileReader();
                                           reader.onload = (e) => {
                                               photoPreview = e.target.result;
                                           };
                                           reader.readAsDataURL($refs.photo.files[0]);
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

                        <!-- Portfolio URL -->
                        <div>
                            <x-input-label for="portfolio_url" :value="__('Tautan Portofolio / GitHub / Website')" />
                            <x-text-input id="portfolio_url" 
                                          name="portfolio_url" 
                                          type="url" 
                                          class="mt-1 block w-full rounded-xl" 
                                          :value="old('portfolio_url', $profile?->portfolio_url ?? '')" 
                                          placeholder="https://budisantoso.dev" />
                            <x-input-error class="mt-2" :messages="$errors->get('portfolio_url')" />
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

                        <!-- Summary -->
                        <div>
                            <x-input-label for="summary" :value="__('Ringkasan Profil (Professional Summary)') />
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                                {{ __('Tuliskan 2-4 kalimat ringkas yang merangkum latar belakang, minat spesialisasi, dan nilai tambah Anda.') }}
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
