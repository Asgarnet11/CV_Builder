<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full bg-indigo-50 dark:bg-indigo-950/60 border border-indigo-200/50 dark:border-indigo-800/50 text-indigo-600 dark:text-indigo-400 text-xs font-bold tracking-wide uppercase mb-1">
                    <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                    Pengaturan Pengguna
                </div>
                <h2 class="font-extrabold text-2xl sm:text-3xl text-slate-900 dark:text-white tracking-tight">
                    {{ __('Profil & Keamanan Akun') }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                    {{ __('Kelola data autentikasi, kredensial sandi, dan preferensi akun Anda.') }}
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2.5 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-xs font-bold rounded-xl transition">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Dashboard') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Profile Info Card -->
            <div class="p-6 sm:p-8 bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 shadow-sm rounded-3xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Password Card -->
            <div class="p-6 sm:p-8 bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 shadow-sm rounded-3xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Danger Zone Card -->
            <div class="p-6 sm:p-8 bg-red-50/40 dark:bg-red-950/20 border border-red-200/60 dark:border-red-900/40 shadow-sm rounded-3xl">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
