<x-guest-layout>
    <!-- Header Title -->
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight font-display">
            {{ __('Atur Ulang Kata Sandi') }}
        </h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
            {{ __('Masukkan sandi baru Anda untuk memulihkan akses ke akun CV Builder.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="text-xs font-bold text-slate-700 dark:text-slate-300" />
            <x-text-input id="email" class="block mt-1 w-full text-sm rounded-xl" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Kata Sandi Baru')" class="text-xs font-bold text-slate-700 dark:text-slate-300" />
            <x-text-input id="password" class="block mt-1 w-full text-sm rounded-xl" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi Baru')" class="text-xs font-bold text-slate-700 dark:text-slate-300" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full text-sm rounded-xl" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ketik ulang kata sandi" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-indigo-600 via-indigo-700 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/40 active:scale-[0.99] transition duration-200">
                <span>{{ __('Perbarui & Masuk Akun') }}</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </button>
        </div>
    </form>
</x-guest-layout>
