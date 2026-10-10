<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Tambah Riwayat Pendidikan') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700/60 rounded-2xl p-6 sm:p-8">
                <form method="POST" action="{{ route('education.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="institution" :value="__('Nama Institusi / Universitas')" />
                        <x-text-input id="institution" name="institution" type="text" class="mt-1 block w-full" :value="old('institution')" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('institution')" />
                    </div>

                    <div>
                        <x-input-label for="degree" :value="__('Gelar / Bidang Studi')" />
                        <x-text-input id="degree" name="degree" type="text" class="mt-1 block w-full" :value="old('degree')" required placeholder="Contoh: S1 Teknik Informatika" />
                        <x-input-error class="mt-2" :messages="$errors->get('degree')" />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="start_year" :value="__('Tahun Mulai')" />
                            <x-text-input id="start_year" name="start_year" type="number" min="1950" max="2099" class="mt-1 block w-full" :value="old('start_year')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('start_year')" />
                        </div>

                        <div>
                            <x-input-label for="end_year" :value="__('Tahun Selesai (Biarkan kosong jika masih menempuh)')" />
                            <x-text-input id="end_year" name="end_year" type="number" min="1950" max="2099" class="mt-1 block w-full" :value="old('end_year')" />
                            <x-input-error class="mt-2" :messages="$errors->get('end_year')" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Deskripsi Singkat / Pencapaian (Opsional)')" />
                        <input id="description" type="hidden" name="description" value="{{ old('description') }}">
                        <trix-editor input="description" class="trix-content mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm min-h-[150px]"></trix-editor>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('education.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 font-medium text-sm transition">Batal</a>
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl shadow-md transition">
                            Simpan Pendidikan
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
