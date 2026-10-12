<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Edit Riwayat Pengalaman') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700/60 rounded-2xl p-6 sm:p-8" x-data="{ isCurrent: {{ old('is_current', $experience->is_current) ? 'true' : 'false' }} }">
                <form method="POST" action="{{ route('experience.update', $experience) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="company_name" :value="__('Nama Perusahaan / Organisasi')" />
                        <x-text-input id="company_name" name="company_name" type="text" class="mt-1 block w-full" :value="old('company_name', $experience->company_name)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
                    </div>

                    <div>
                        <x-input-label for="position" :value="__('Posisi / Jabatan')" />
                        <x-text-input id="position" name="position" type="text" class="mt-1 block w-full" :value="old('position', $experience->position)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('position')" />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="start_date" :value="__('Tanggal Mulai')" />
                            <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" :value="old('start_date', $experience->start_date)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                        </div>

                        <div>
                            <x-input-label for="end_date" :value="__('Tanggal Selesai')" />
                            <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full disabled:bg-gray-100 dark:disabled:bg-gray-900 disabled:text-gray-400" x-bind:disabled="isCurrent" :value="old('end_date', $experience->end_date)" />
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
                        loadingBullets: false,
                        showBulletsModal: false,
                        bulletLang: 'id',
                        bulletSkills: '',
                        generatedBullets: [],
                        generateBullets() {
                            const pos = document.getElementById('position')?.value || '';
                            const comp = document.getElementById('company_name')?.value || '';
                            if (!pos.trim()) {
                                alert('Mohon isi Posisi / Jabatan terlebih dahulu.');
                                return;
                            }
                            this.loadingBullets = true;
                            this.generatedBullets = [];
                            fetch('{{ route('ai.generate-experience') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content'),
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    job_title: pos,
                                    company: comp,
                                    skills: this.bulletSkills,
                                    language: this.bulletLang
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                this.loadingBullets = false;
                                if (data.status === 'success') {
                                    this.generatedBullets = data.bullets;
                                } else {
                                    alert('Gagal menghasilkan poin-poin AI.');
                                }
                            })
                            .catch(err => {
                                this.loadingBullets = false;
                                alert('Terjadi kesalahan jaringan.');
                            });
                        },
                        insertBullets() {
                            if (this.generatedBullets.length === 0) return;
                            const html = '<ul>' + this.generatedBullets.map(b => '<li>' + b + '</li>').join('') + '</ul>';
                            const trix = document.querySelector('trix-editor');
                            if (trix && trix.editor) {
                                trix.editor.insertHTML(html);
                            }
                            this.showBulletsModal = false;
                        }
                    }">
                        <div class="flex items-center justify-between mb-1">
                            <x-input-label for="description" :value="__('Deskripsi Pekerjaan & Pencapaian (Opsional)')" />
                            <button type="button" @click="showBulletsModal = true" class="inline-flex items-center px-3 py-1 bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-700 hover:to-indigo-700 text-white text-xs font-bold rounded-lg shadow-sm transition">
                                <span class="mr-1">✨</span> {{ __('Saran Poin AI') }}
                            </button>
                        </div>
                        <input id="description" type="hidden" name="description" value="{{ old('description', $experience->description) }}">
                        <trix-editor input="description" class="trix-content mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm min-h-[150px]"></trix-editor>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />

                        <!-- Modal AI Bullets -->
                        <div x-show="showBulletsModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0">
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden border border-gray-200 dark:border-gray-700 flex flex-col"
                                 @click.away="showBulletsModal = false">
                                <div class="px-6 py-4 bg-gradient-to-r from-violet-600 to-indigo-600 text-white flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <span class="p-1.5 bg-white/20 rounded-lg">✨</span>
                                        <h3 class="font-bold text-base">AI Bullet Points Helper</h3>
                                    </div>
                                    <button type="button" @click="showBulletsModal = false" class="text-white/80 hover:text-white text-xl leading-none">&times;</button>
                                </div>
                                <div class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        AI akan membuat poin-poin pencapaian yang terukur (STAR Method) sesuai posisi pekerjaan Anda.
                                    </p>
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1">Bahasa</label>
                                            <select x-model="bulletLang" class="w-full text-sm rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                                <option value="id">Bahasa Indonesia</option>
                                                <option value="en">English</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1">Fokus Keahlian</label>
                                            <input type="text" x-model="bulletSkills" placeholder="Misal: Tailwind, Git, API" class="w-full text-sm rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                                        </div>
                                    </div>

                                    <div x-show="generatedBullets.length > 0" class="p-3 bg-indigo-50 dark:bg-indigo-950/40 rounded-xl border border-indigo-200 dark:border-indigo-800 text-sm text-gray-800 dark:text-gray-200">
                                        <div class="text-xs font-bold text-indigo-600 dark:text-indigo-400 mb-2">🎯 Rekomendasi Poin Pencapaian:</div>
                                        <ul class="list-disc list-inside space-y-1.5 text-xs">
                                            <template x-for="(bullet, index) in generatedBullets" :key="index">
                                                <li x-text="bullet"></li>
                                            </template>
                                        </ul>
                                    </div>
                                </div>
                                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                                    <button type="button" @click="generateBullets" :disabled="loadingBullets" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl transition disabled:opacity-50 shadow-sm">
                                        <svg x-show="loadingBullets" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                        <span x-text="loadingBullets ? 'Menghasilkan...' : (generatedBullets.length > 0 ? 'Buat Ulang (Regenerate)' : 'Buat Poin Pencapaian ✨')"></span>
                                    </button>
                                    <div class="flex items-center space-x-2">
                                        <button type="button" @click="showBulletsModal = false" class="px-3 py-2 text-xs font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800 rounded-xl transition">Batal</button>
                                        <button type="button" x-show="generatedBullets.length > 0" @click="insertBullets" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition shadow-sm">Sisipkan ke Deskripsi ✓</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('experience.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 font-medium text-sm transition">Batal</a>
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-xl shadow-md transition">
                            Simpan Perubahan
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
