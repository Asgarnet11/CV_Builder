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

                    <div>
                        <x-input-label for="description" :value="__('Deskripsi Pekerjaan & Pencapaian (Opsional)')" />
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
