<section class="space-y-6">
    <header>
        <h2 class="text-xl font-extrabold text-red-600 dark:text-red-400 tracking-tight">
            {{ __('Hapus Akun Permanen') }}
        </h2>

        <p class="mt-1 text-xs sm:text-sm text-slate-600 dark:text-slate-400">
            {{ __('Setelah akun Anda dihapus, seluruh data profil, riwayat pengalaman, pendidikan, keahlian, dan dokumen CV yang tersimpan akan dihapus secara permanen.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="rounded-xl px-5 py-2.5 font-bold text-xs uppercase tracking-wider"
    >{{ __('Hapus Akun Saya') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 sm:p-8">
            @csrf
            @method('delete')

            <h2 class="text-lg font-extrabold text-slate-900 dark:text-white">
                {{ __('Apakah Anda yakin ingin menghapus akun ini?') }}
            </h2>

            <p class="mt-2 text-xs sm:text-sm text-slate-500 dark:text-slate-400">
                {{ __('Tindakan ini tidak dapat dibatalkan. Masukkan kata sandi akun Anda untuk mengonfirmasi penghapusan permanen.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Kata Sandi') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full sm:w-3/4 rounded-xl text-sm"
                    placeholder="{{ __('Ketik kata sandi konfirmasi') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="rounded-xl px-4 py-2 text-xs font-bold">
                    {{ __('Batal') }}
                </x-secondary-button>

                <x-danger-button class="rounded-xl px-5 py-2 text-xs font-bold uppercase tracking-wider">
                    {{ __('Ya, Hapus Akun') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
