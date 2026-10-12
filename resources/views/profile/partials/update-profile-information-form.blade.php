<section>
    <header class="mb-6">
        <h2 class="text-xl font-extrabold text-slate-900 dark:text-white tracking-tight">
            {{ __('Informasi Profil') }}
        </h2>
        <p class="mt-1 text-xs sm:text-sm text-slate-500 dark:text-slate-400">
            {{ __('Perbarui data nama pengguna dan alamat email akun Anda.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-xs font-bold text-slate-700 dark:text-slate-300" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-xl text-sm" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-1.5" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="text-xs font-bold text-slate-700 dark:text-slate-300" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full rounded-xl text-sm" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-1.5" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800 rounded-xl">
                    <p class="text-xs text-amber-800 dark:text-amber-300">
                        {{ __('Alamat email Anda belum diverifikasi.') }}

                        <button form="send-verification" class="underline font-bold text-amber-900 dark:text-amber-200 hover:text-amber-700 ml-1">
                            {{ __('Kirim ulang email verifikasi') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-xs text-emerald-600 dark:text-emerald-400">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:scale-95 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-md shadow-indigo-600/25 transition">
                {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
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
                    <span>{{ __('Berhasil disimpan.') }}</span>
                </p>
            @endif
        </div>
    </form>
</section>
