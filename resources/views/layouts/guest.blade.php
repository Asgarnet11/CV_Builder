<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#1270a0">

        <title>{{ config('app.name', 'LaraCV') }}</title>

        <!-- Google Fonts: Poppins (Resmi SSCASN) -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Poppins', ui-sans-serif, system-ui, sans-serif; }
        </style>
    </head>
    <body class="h-full font-sans text-slate-800 antialiased selection:bg-primary selection:text-white relative overflow-x-hidden"
          style="background: linear-gradient(135deg, #1270a0 0%, #1a8cc8 40%, #1e293b 100%);">
        
        <!-- Subtle Dotted Grid Overlay Background -->
        <div class="fixed inset-0 pointer-events-none opacity-20 bg-[radial-gradient(#ffffff_1.5px,transparent_1.5px)] [background-size:24px_24px]"></div>

        <div class="min-h-screen flex flex-col justify-between items-center px-4 py-8 sm:py-10 relative z-10">
            <!-- Top Navigation / Back Link -->
            <div class="w-full max-w-md flex items-center justify-between">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-white/80 hover:text-white transition group">
                    <svg class="w-4 h-4 text-white/70 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Kembali ke Beranda</span>
                </a>
                <span class="text-[11px] font-bold tracking-widest uppercase px-2.5 py-1 rounded-full bg-white/15 text-white border border-white/30 backdrop-blur-sm">
                    PORTAL LARACV
                </span>
            </div>

            <!-- Central Form Container -->
            <div class="w-full sm:max-w-md my-auto pt-4 pb-6">
                <!-- Brand Badge -->
                <div class="text-center mb-5">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2.5 group">
                        <div class="w-12 h-12 rounded-2xl bg-white text-primary flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform duration-200">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="text-left leading-none text-white">
                            <span class="text-2xl font-extrabold tracking-tight">Lara<span class="text-sky-200">CV</span></span>
                            <span class="block text-[10px] font-medium text-white/80 uppercase tracking-wider mt-0.5">Portal Karir Terpadu</span>
                        </div>
                    </a>
                </div>

                <!-- Form Card -->
                <div class="bg-white/95 backdrop-blur-md p-6 sm:p-8 rounded-2xl border border-white/50 shadow-2xl relative">
                    {{ $slot }}
                </div>
            </div>

            <!-- Footer Note -->
            <div class="text-center text-xs text-white/70 mt-4">
                &copy; {{ date('Y') }} LaraCV. Portal Pembuat Dokumen CV Profesional Berstandar ATS.
            </div>
        </div>
    </body>
</html>
