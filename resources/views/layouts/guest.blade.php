<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CV Builder') }}</title>

        <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full font-sans text-slate-800 dark:text-slate-100 bg-slate-950 antialiased selection:bg-indigo-500 selection:text-white relative overflow-x-hidden">
        <!-- Ambient Glowing Orbs Background -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden -z-10">
            <div class="absolute -top-32 -left-32 w-96 h-96 bg-indigo-600/25 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute top-1/2 -right-32 w-96 h-96 bg-purple-600/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute -bottom-32 left-1/3 w-80 h-80 bg-blue-600/20 rounded-full blur-3xl"></div>
            <div class="absolute inset-0 bg-[radial-gradient(#334155_1px,transparent_1px)] [background-size:24px_24px] opacity-15"></div>
        </div>

        <div class="min-h-screen flex flex-col justify-between items-center px-4 py-8 sm:py-12 relative z-10">
            <!-- Top Navigation / Back Link -->
            <div class="w-full max-w-md flex items-center justify-between">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-white transition group">
                    <svg class="w-4 h-4 text-slate-500 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Kembali ke Beranda</span>
                </a>
                <span class="text-[11px] font-bold tracking-widest uppercase px-2.5 py-1 rounded-full bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                    CV BUILDER PRO
                </span>
            </div>

            <!-- Central Form Container -->
            <div class="w-full sm:max-w-md my-auto pt-6 pb-8">
                <!-- Brand Badge -->
                <div class="text-center mb-6">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-3 group">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center shadow-xl shadow-indigo-500/25 group-hover:scale-105 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </a>
                </div>

                <!-- Glassmorphic Form Card -->
                <div class="bg-white/95 dark:bg-slate-900/90 backdrop-blur-2xl p-6 sm:p-8 rounded-3xl border border-slate-200/80 dark:border-slate-800/80 shadow-2xl shadow-indigo-950/40 relative">
                    {{ $slot }}
                </div>
            </div>

            <!-- Footer Note -->
            <div class="text-center text-xs text-slate-500 dark:text-slate-500 mt-6">
                &copy; {{ date('Y') }} CV Builder Pro. Platform Karir & Generator Dokumen Profesional.
            </div>
        </div>
    </body>
</html>
