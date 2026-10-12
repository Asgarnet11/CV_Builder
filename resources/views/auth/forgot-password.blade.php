<x-guest-layout>
    <!-- Header Title -->
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight font-display">
            Lupa Kata Sandi?
        </h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
            Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi akun Anda.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="text-xs font-bold text-slate-700 dark:text-slate-300" />
            <x-text-input id="email" class="block mt-1 w-full text-sm rounded-xl" type="email" name="email" :value="old('email')" required autofocus placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-indigo-600 via-indigo-700 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/40 active:scale-[0.99] transition duration-200">
                <span>{{ __('Kirim Tautan Reset Sandi') }}</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </button>
        </div>

        <!-- Back to Login Prompt -->
        <div class="pt-4 border-t border-slate-100 dark:border-slate-800 text-center">
            <a href="{{ route('login') }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">
                &larr; {{ __('Kembali ke Halaman Masuk') }}
            </a>
        </div>
    </form>
</x-guest-layout>
