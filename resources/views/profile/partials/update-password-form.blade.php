<section>
    <header class="mb-6">
        <h2 class="text-xl font-extrabold text-slate-900 dark:text-white tracking-tight">
            {{ __('Perbarui Kata Sandi') }}
        </h2>
        <p class="mt-1 text-xs sm:text-sm text-slate-500 dark:text-slate-400">
            {{ __('Pastikan akun Anda menggunakan kombinasi kata sandi yang aman dan kuat.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Kata Sandi Saat Ini')" class="text-xs font-bold text-slate-700 dark:text-slate-300" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full rounded-xl text-sm" autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1.5" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Kata Sandi Baru')" class="text-xs font-bold text-slate-700 dark:text-slate-300" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full rounded-xl text-sm" autocomplete="new-password" placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1.5" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Kata Sandi Baru')" class="text-xs font-bold text-slate-700 dark:text-slate-300" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-xl text-sm" autocomplete="new-password" placeholder="Ketik ulang kata sandi baru" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1.5" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:scale-95 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-md shadow-indigo-600/25 transition">
                {{ __('Simpan Sandi Baru') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 flex items-center gap-1.5"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>{{ __('Kata sandi berhasil diperbarui.') }}</span>
                </p>
            @endif
        </div>
    </form>
</section>
