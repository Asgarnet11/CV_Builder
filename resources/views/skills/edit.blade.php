<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Edit Keahlian') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700/60 rounded-2xl p-6 sm:p-8">
                <form method="POST" action="{{ route('skills.update', $skill) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="skill_name" :value="__('Nama Keahlian')" />
                        <x-text-input id="skill_name" name="skill_name" type="text" class="mt-1 block w-full" :value="old('skill_name', $skill->skill_name)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('skill_name')" />
                    </div>

                    <div>
                        <x-input-label for="level" :value="__('Tingkat Kemampuan')" />
                        <select id="level" name="level" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg shadow-sm" required>
                            <option value="Pemula" @selected(old('level', $skill->level) == 'Pemula')>Pemula (Beginner)</option>
                            <option value="Menengah" @selected(old('level', $skill->level) == 'Menengah')>Menengah (Intermediate)</option>
                            <option value="Mahir" @selected(old('level', $skill->level) == 'Mahir')>Mahir (Advanced)</option>
                            <option value="Ahli" @selected(old('level', $skill->level) == 'Ahli')>Ahli (Expert)</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('level')" />
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('skills.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 font-medium text-sm transition">Batal</a>
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-bold text-sm rounded-xl shadow-md transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
