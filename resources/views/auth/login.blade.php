<x-guest-layout>
    <!-- Header Title -->
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight font-display">
            Selamat Datang Kembali
        </h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
            Masuk ke akun Anda untuk melanjutkan pembuatan & pengelolaan CV profesional.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="text-xs font-bold text-slate-700 dark:text-slate-300" />
            <x-text-input id="email" class="block mt-1 w-full text-sm rounded-xl" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Kata Sandi')" class="text-xs font-bold text-slate-700 dark:text-slate-300" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition" href="{{ route('password.request') }}">
                        {{ __('Lupa sandi?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="block mt-1 w-full text-sm rounded-xl"
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                <input id="remember_me" type="checkbox" class="rounded-lg dark:bg-slate-900 border-slate-300 dark:border-slate-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-slate-900" name="remember">
                <span class="ms-2 text-xs font-medium text-slate-600 dark:text-slate-400">{{ __('Ingat sesi masuk saya') }}</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full inline-flex items-center justify-center px-5 py-3 bg-primary hover:bg-primary-dark text-white font-bold text-sm rounded-lg shadow-md hover:shadow active:scale-[0.99] transition duration-200">
                <span>{{ __('Masuk ke Akun') }}</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </button>
        </div>

        <!-- Register Switch Prompt -->
        <div class="pt-4 border-t border-slate-100 text-center">
            <p class="text-xs text-slate-500">
                Belum memiliki akun?
                <a href="{{ route('register') }}" class="font-bold text-primary hover:underline ml-1">
                    Daftar Sekarang &rarr;
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
