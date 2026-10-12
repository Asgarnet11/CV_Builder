<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }
            h1, h2, h3, h4, .font-heading {
                font-family: 'Outfit', sans-serif;
            }
        </style>
    </head>
    <body class="font-sans antialiased text-slate-800 dark:text-slate-100 bg-slate-50 dark:bg-slate-950 selection:bg-indigo-500 selection:text-white relative">
        <!-- Background Ambient Glow -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10">
            <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[65rem] h-[30rem] bg-gradient-to-tr from-indigo-500/10 via-violet-500/10 to-sky-400/5 blur-[120px] rounded-full"></div>
            <div class="absolute top-[35rem] -left-20 w-[40rem] h-[30rem] bg-indigo-500/5 dark:bg-indigo-900/10 blur-[130px] rounded-full"></div>
            <div class="absolute top-[60rem] -right-20 w-[40rem] h-[30rem] bg-violet-500/5 dark:bg-violet-900/10 blur-[130px] rounded-full"></div>
        </div>

        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200/60 dark:border-slate-800/60">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            
            <!-- Global Toast Notification -->
            @if (session('status'))
                <div x-data="{ show: true }" 
                     x-init="setTimeout(() => show = false, 4000)"
                     x-show="show"
                     x-transition:enter="transform ease-out duration-300 transition"
                     x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                     x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed bottom-5 right-5 sm:bottom-10 sm:right-10 z-50 pointer-events-none"
                     style="display: none;">
                    <div class="max-w-sm w-full bg-gray-900 shadow-xl rounded-2xl pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
                        <div class="p-4 flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center">
                                    <svg class="h-5 w-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p class="text-sm font-medium text-white">
                                    Berhasil
                                </p>
                                <p class="mt-1 text-xs text-gray-300">
                                    {{ session('status') }}
                                </p>
                            </div>
                            <div class="ml-4 flex-shrink-0 flex">
                                <button @click="show = false" class="rounded-md inline-flex text-gray-400 hover:text-white focus:outline-none">
                                    <span class="sr-only">Tutup</span>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @stack('scripts')
    </body>
</html>
