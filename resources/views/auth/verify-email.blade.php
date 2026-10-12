<x-guest-layout>
    <!-- Header Title -->
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight font-display">
            {{ __('Verifikasi Email Anda') }}
        </h1>
        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
            {{ __('Terima kasih telah bergabung! Silakan periksa inbox email Anda dan klik tautan verifikasi yang kami kirimkan.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-xs font-medium text-emerald-800 dark:text-emerald-300">
            {{ __('Tautan verifikasi baru telah berhasil dikirim ke alamat email yang Anda daftarkan.') }}
        </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-indigo-600 via-indigo-700 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/40 active:scale-[0.99] transition duration-200">
                <span>{{ __('Kirim Ulang Email Verifikasi') }}</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </button>
        </form>

        <div class="pt-2 text-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs font-semibold text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 underline">
                    {{ __('Keluar dari Akun (Log Out)') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
