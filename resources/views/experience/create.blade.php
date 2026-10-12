<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Tambah Pengalaman Kerja') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700/60 rounded-2xl p-6 sm:p-8" x-data="{ isCurrent: {{ old('is_current') ? 'true' : 'false' }} }">
                <form method="POST" action="{{ route('experience.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="company_name" :value="__('Nama Perusahaan / Organisasi')" />
                        <x-text-input id="company_name" name="company_name" type="text" class="mt-1 block w-full" :value="old('company_name')" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
                    </div>

                    <div>
                        <x-input-label for="position" :value="__('Posisi / Jabatan')" />
                        <x-text-input id="position" name="position" type="text" class="mt-1 block w-full" :value="old('position')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('position')" />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="start_date" :value="__('Tanggal Mulai')" />
                            <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" :value="old('start_date')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                        </div>

                        <div>
                            <x-input-label for="end_date" :value="__('Tanggal Selesai')" />
                            <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full disabled:bg-gray-100 dark:disabled:bg-gray-900 disabled:text-gray-400" x-bind:disabled="isCurrent" :value="old('end_date')" />
                            <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                        </div>
                    </div>

                    <div class="block">
                        <label for="is_current" class="inline-flex items-center">
                            <input id="is_current" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_current" value="1" x-model="isCurrent">
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Saya masih bekerja di sini') }}</span>
                        </label>
                    </div>

                    <div x-data="{
                        aiBulletLoading: false,
                        async generateAiBullets() {
                            const position = document.getElementById('position')?.value || '';
                            const company = document.getElementById('company_name')?.value || '';
                            if (!position) {
                                window.dispatchEvent(new CustomEvent('notify', { detail: 'Harap isi Posisi / Jabatan terlebih dahulu!' }));
                                return;
                            }
                            this.aiBulletLoading = true;
                            try {
                                const res = await fetch('{{ route('ai.generate-bullet-points') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content'),
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        position: position,
                                        company_name: company,
                                        lang: 'id'
                                    })
                                });
                                const data = await res.json();
                                if (data.status === 'success' && data.html) {
                                    const trix = document.querySelector('trix-editor');
                                    if (trix && trix.editor) {
                                        trix.editor.loadHTML(data.html);
                                    } else {
                                        document.getElementById('description').value = data.html;
                                    }
                                    window.dispatchEvent(new CustomEvent('notify', { detail: 'Poin pencapaian berhasil disusun oleh AI!' }));
                                }
                            } catch (e) {
                                window.dispatchEvent(new CustomEvent('notify', { detail: 'Gagal membuat poin: ' + e.message }));
                            } finally {
                                this.aiBulletLoading = false;
                            }
                        }
                    }">
                        <div class="flex flex-wrap items-center justify-between gap-2 mb-1">
                            <x-input-label for="description" :value="__('Deskripsi Pekerjaan & Pencapaian (Opsional)')" />
                            <button type="button" 
                                    @click="generateAiBullets()" 
                                    :disabled="aiBulletLoading" 
                                    class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white text-xs font-bold rounded-lg shadow-sm transition disabled:opacity-50 cursor-pointer">
                                <svg x-show="!aiBulletLoading" class="w-3.5 h-3.5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg x-show="aiBulletLoading" class="animate-spin w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                                <span x-text="aiBulletLoading ? 'Menyusun...' : '✨ Buat Poin dengan AI'"></span>
                            </button>
                        </div>
                        <input id="description" type="hidden" name="description" value="{{ old('description') }}">
                        <trix-editor input="description" class="trix-content mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm min-h-[150px]"></trix-editor>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('experience.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 font-medium text-sm transition">Batal</a>
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-xl shadow-md transition">
                            Simpan Pengalaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
        .trix-content {
            background-color: transparent;
        }
    </style>
@endpush

@push('scripts')
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script>
        document.addEventListener("trix-file-accept", function(event) {
            event.preventDefault();
        });
    </script>
@endpush
