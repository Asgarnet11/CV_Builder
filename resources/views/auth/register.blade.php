<x-guest-layout>
    <!-- Header Title -->
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight font-display">
            Buat Akun Baru
        </h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
            Mulai bangun CV profesional berstandar industri dalam hitungan menit.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-xs font-bold text-slate-700 dark:text-slate-300" />
            <x-text-input id="name" class="block mt-1 w-full text-sm rounded-xl" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Contoh: Alex Pratama" />
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="text-xs font-bold text-slate-700 dark:text-slate-300" />
            <x-text-input id="email" class="block mt-1 w-full text-sm rounded-xl" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Kata Sandi')" class="text-xs font-bold text-slate-700 dark:text-slate-300" />

            <x-text-input id="password" class="block mt-1 w-full text-sm rounded-xl"
                            type="password"
                            name="password"
                            placeholder="Minimal 8 karakter"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="text-xs font-bold text-slate-700 dark:text-slate-300" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full text-sm rounded-xl"
                            type="password"
                            name="password_confirmation"
                            placeholder="Ketik ulang kata sandi"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-indigo-600 via-indigo-700 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/40 active:scale-[0.99] transition duration-200">
                <span>{{ __('Daftar Akun Sekarang') }}</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </button>
        </div>

        <!-- Login Switch Prompt -->
        <div class="pt-4 border-t border-slate-100 dark:border-slate-800 text-center">
            <p class="text-xs text-slate-500 dark:text-slate-400">
                Sudah memiliki akun?
                <a href="{{ route('login') }}" class="font-bold text-indigo-600 dark:text-indigo-400 hover:underline ml-1">
                    Masuk di Sini &rarr;
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
