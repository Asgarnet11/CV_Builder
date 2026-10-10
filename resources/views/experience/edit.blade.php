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

                    <div>
                        <x-input-label for="description" :value="__('Deskripsi Pekerjaan & Pencapaian (Opsional)')" />
                        <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg shadow-sm">{{ old('description', $experience->description) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
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
