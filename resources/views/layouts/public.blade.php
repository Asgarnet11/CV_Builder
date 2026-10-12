<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#1270a0">
    <meta name="description" content="LaraCV - Portal Resmi Pembuat Dokumen CV Profesional Berstandar ATS. Bangun karir impian Anda dengan format terverifikasi.">

    <title>{{ $title ?? 'LaraCV - Portal Pembuat CV Profesional' }}</title>

    <!-- Google Fonts: Poppins (Resmi SSCASN) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <style>
        body {
            font-family: 'Poppins', ui-sans-serif, system-ui, sans-serif;
            color: #1e293b;
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-white text-slate-800 antialiased selection:bg-primary selection:text-white flex flex-col min-h-screen"
      x-data="{
          scrolled: false,
          mobileMenuOpen: false,
          scrollToTop() {
              window.scrollTo({ top: 0, behavior: 'smooth' });
          }
      }"
      @scroll.window="scrolled = (window.pageYOffset > 20)">

    <!-- Sticky Navbar -->
    <header class="fixed top-0 left-0 right-0 z-50 w-full transition-all duration-300"
            :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-md py-2 border-b border-slate-200/80' : 'bg-transparent py-3 border-none shadow-none'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between gap-4">
                
                <!-- Brand Logo (LaraCV) -->
                <div class="shrink-0">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-300 shadow-sm"
                             :class="scrolled ? 'bg-primary text-white' : 'bg-white text-primary'">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="leading-none">
                            <span class="text-xl font-extrabold tracking-tight transition-colors duration-300"
                                  :class="scrolled ? 'text-slate-900' : 'text-white'">
                                Lara<span class="text-primary" :class="scrolled ? 'text-primary' : 'text-sky-200'">CV</span>
                            </span>
                            <span class="block text-[10px] font-semibold tracking-wider uppercase transition-colors duration-300"
                                  :class="scrolled ? 'text-slate-500' : 'text-white/80'">
                                Portal CV Nasional
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation Menu -->
                <nav class="hidden xl:flex items-center space-x-7">
                    <a href="{{ route('home') }}" 
                       class="text-sm font-semibold transition-colors py-2 whitespace-nowrap {{ request()->routeIs('home') ? 'text-primary' : '' }}"
                       :class="scrolled ? ('{{ request()->routeIs('home') ? 'text-primary' : 'text-slate-700 hover:text-primary' }}') : ('{{ request()->routeIs('home') ? 'text-white border-b-2 border-white' : 'text-white/80 hover:text-white' }}')">
                        Beranda
                    </a>
                    <a href="{{ route('templates') }}" 
                       class="text-sm font-semibold transition-colors py-2 whitespace-nowrap {{ request()->routeIs('templates') ? 'text-primary' : '' }}"
                       :class="scrolled ? ('{{ request()->routeIs('templates') ? 'text-primary' : 'text-slate-700 hover:text-primary' }}') : ('{{ request()->routeIs('templates') ? 'text-white border-b-2 border-white' : 'text-white/80 hover:text-white' }}')">
                        Template CV
                    </a>
                    <a href="{{ route('faq') }}" 
                       class="text-sm font-semibold transition-colors py-2 whitespace-nowrap {{ request()->routeIs('faq') ? 'text-primary' : '' }}"
                       :class="scrolled ? ('{{ request()->routeIs('faq') ? 'text-primary' : 'text-slate-700 hover:text-primary' }}') : ('{{ request()->routeIs('faq') ? 'text-white border-b-2 border-white' : 'text-white/80 hover:text-white' }}')">
                        FAQ
                    </a>
                    <a href="{{ route('panduan') }}" 
                       class="text-sm font-semibold transition-colors py-2 whitespace-nowrap {{ request()->routeIs('panduan') ? 'text-primary' : '' }}"
                       :class="scrolled ? ('{{ request()->routeIs('panduan') ? 'text-primary' : 'text-slate-700 hover:text-primary' }}') : ('{{ request()->routeIs('panduan') ? 'text-white border-b-2 border-white' : 'text-white/80 hover:text-white' }}')">
                        Panduan
                    </a>
                    <a href="{{ route('bantuan') }}" 
                       class="text-sm font-semibold transition-colors py-2 whitespace-nowrap {{ request()->routeIs('bantuan') ? 'text-primary' : '' }}"
                       :class="scrolled ? ('{{ request()->routeIs('bantuan') ? 'text-primary' : 'text-slate-700 hover:text-primary' }}') : ('{{ request()->routeIs('bantuan') ? 'text-white border-b-2 border-white' : 'text-white/80 hover:text-white' }}')">
                        Bantuan
                    </a>
                </nav>

                <!-- Action Buttons -->
                <div class="hidden xl:flex items-center gap-2.5">
                    @auth
                        <a href="{{ route('dashboard') }}" 
                           id="btn-dashboard-nav"
                           class="inline-flex items-center gap-1.5 rounded-lg py-2 px-4 text-sm font-semibold transition-all duration-200 ease-out hover:-translate-y-0.5 shadow-sm"
                           :class="scrolled ? 'bg-primary text-white hover:bg-primary-dark' : 'bg-white text-primary hover:bg-white/90'">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            <span>Dashboard Saya</span>
                        </a>
                    @else
                        <!-- Buat Akun (Outline) -->
                        <a href="{{ route('register') }}" 
                           id="btn-register-nav"
                           class="inline-flex items-center gap-1.5 rounded-lg py-2 px-4 text-sm font-semibold whitespace-nowrap transition-all duration-200 ease-out hover:-translate-y-0.5 border"
                           :class="scrolled ? 'border-primary text-primary hover:bg-primary/5 bg-transparent' : 'border-white/50 bg-white/15 backdrop-blur-sm text-white hover:bg-white/25'">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m13-10a4 4 0 11-8 0 4 4 0 018 0zM19 11v6m3-3h-6"></path>
                            </svg>
                            <span>Daftar Gratis</span>
                        </a>

                        <!-- Masuk (Solid) -->
                        <a href="{{ route('login') }}" 
                           id="btn-login-nav"
                           class="inline-flex items-center gap-1.5 rounded-lg py-2 px-4 text-sm font-semibold whitespace-nowrap transition-all duration-200 ease-out hover:-translate-y-0.5 shadow-sm"
                           :class="scrolled ? 'bg-primary text-white hover:bg-primary-dark' : 'bg-white text-primary hover:bg-white/90'">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Masuk</span>
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button (Hamburger) -->
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                        aria-label="Toggle Mobile Menu"
                        class="xl:hidden p-2 rounded-lg border focus:outline-none transition-colors"
                        :class="scrolled ? 'border-slate-300 text-slate-700 hover:bg-slate-100' : 'border-white/30 text-white hover:bg-white/10'">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div x-show="mobileMenuOpen" 
             x-cloak 
             @click.away="mobileMenuOpen = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="xl:hidden bg-white border-b border-slate-200 shadow-xl px-4 py-6 space-y-4">
            <nav class="flex flex-col space-y-3">
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('home') ? 'bg-primary/10 text-primary' : 'text-slate-700 hover:bg-slate-50' }}">
                    Beranda
                </a>
                <a href="{{ route('templates') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('templates') ? 'bg-primary/10 text-primary' : 'text-slate-700 hover:bg-slate-50' }}">
                    Template CV
                </a>
                <a href="{{ route('faq') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('faq') ? 'bg-primary/10 text-primary' : 'text-slate-700 hover:bg-slate-50' }}">
                    FAQ
                </a>
                <a href="{{ route('panduan') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('panduan') ? 'bg-primary/10 text-primary' : 'text-slate-700 hover:bg-slate-50' }}">
                    Panduan
                </a>
                <a href="{{ route('bantuan') }}" class="px-3 py-2 rounded-lg text-sm font-semibold {{ request()->routeIs('bantuan') ? 'bg-primary/10 text-primary' : 'text-slate-700 hover:bg-slate-50' }}">
                    Bantuan
                </a>
            </nav>

            <div class="pt-4 border-t border-slate-100 flex flex-col gap-2.5">
                @auth
                    <a href="{{ route('dashboard') }}" class="w-full text-center py-2.5 px-4 rounded-lg bg-primary text-white font-semibold text-sm shadow">
                        Dashboard Saya
                    </a>
                @else
                    <a href="{{ route('register') }}" class="w-full text-center py-2.5 px-4 rounded-lg border border-primary text-primary font-semibold text-sm hover:bg-primary/5">
                        Daftar Gratis
                    </a>
                    <a href="{{ route('login') }}" class="w-full text-center py-2.5 px-4 rounded-lg bg-primary text-white font-semibold text-sm shadow">
                        Masuk
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content Slot -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Portal Footer (Gaya SSCASN: 3 Kolom + Bottom Bar) -->
    <footer class="bg-white border-t border-sky-100 pt-12 pb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-10 gap-8 mb-10">
                
                <!-- Kolom 1: Kontak (4 spans) -->
                <div class="lg:col-span-4 space-y-4">
                    <h3 class="text-sm font-bold text-primary uppercase tracking-wider flex items-center gap-2">
                        <span class="w-6 h-0.5 bg-primary rounded-full"></span>
                        Kontak
                    </h3>
                    <ul class="space-y-3 text-sm text-slate-600">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 mt-0.5 shrink-0 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <a href="tel:0218093008" class="hover:text-primary transition-colors">021-8093008 (Layanan Informasi)</a>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 mt-0.5 shrink-0 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <a href="mailto:helpdesk@laracv.id" class="hover:text-primary transition-colors">helpdesk@laracv.id</a>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 mt-0.5 shrink-0 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="leading-relaxed">Gedung Pusat Karir Digital, Lantai 5, Jl. Jenderal Sudirman Kav. 24, Jakarta Pusat 10220</span>
                        </li>
                    </ul>
                </div>

                <!-- Kolom 2: Tautan (3 spans) -->
                <div class="lg:col-span-3 space-y-4">
                    <h3 class="text-sm font-bold text-primary uppercase tracking-wider flex items-center gap-2">
                        <span class="w-6 h-0.5 bg-primary rounded-full"></span>
                        Tautan
                    </h3>
                    <ul class="grid grid-cols-2 gap-x-4 gap-y-2.5 text-sm">
                        <li>
                            <a href="{{ route('home') }}" class="text-slate-600 hover:text-primary hover:translate-x-1 transition-all inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary/50"></span>Beranda
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('templates') }}" class="text-slate-600 hover:text-primary hover:translate-x-1 transition-all inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary/50"></span>Template CV
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('faq') }}" class="text-slate-600 hover:text-primary hover:translate-x-1 transition-all inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary/50"></span>FAQ
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('panduan') }}" class="text-slate-600 hover:text-primary hover:translate-x-1 transition-all inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary/50"></span>Panduan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('bantuan') }}" class="text-slate-600 hover:text-primary hover:translate-x-1 transition-all inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary/50"></span>Bantuan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}" class="text-slate-600 hover:text-primary hover:translate-x-1 transition-all inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary/50"></span>Masuk Akun
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Kolom 3: Media Sosial (3 spans) -->
                <div class="lg:col-span-3 space-y-4">
                    <h3 class="text-sm font-bold text-primary uppercase tracking-wider flex items-center gap-2">
                        <span class="w-6 h-0.5 bg-primary rounded-full"></span>
                        Media Sosial
                    </h3>
                    <p class="text-xs text-slate-500">Ikuti pembaharuan informasi lowongan dan standar CV terbaru melalui kanal resmi kami:</p>
                    <div class="flex items-center gap-2.5 pt-1">
                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" 
                           class="w-9 h-9 rounded-lg border border-slate-200 flex items-center justify-center text-slate-600 hover:text-primary hover:border-primary transition-colors">
                            <span class="sr-only">Facebook</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8H6v4h3v12h5V12h3.642L18 8h-4V6.333C14 5.374 14.5 5 15.5 5H18V0h-3.808C10.595 0 9 1.582 9 4.615V8z"/></svg>
                        </a>
                        <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" 
                           class="w-9 h-9 rounded-lg border border-slate-200 flex items-center justify-center text-slate-600 hover:text-primary hover:border-primary transition-colors">
                            <span class="sr-only">Twitter / X</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" 
                           class="w-9 h-9 rounded-lg border border-slate-200 flex items-center justify-center text-slate-600 hover:text-primary hover:border-primary transition-colors">
                            <span class="sr-only">YouTube</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" 
                           class="w-9 h-9 rounded-lg border border-slate-200 flex items-center justify-center text-slate-600 hover:text-primary hover:border-primary transition-colors">
                            <span class="sr-only">Instagram</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright Strip -->
            <div class="pt-6 border-t border-slate-200/80 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-3">
                <p>&copy; {{ date('Y') }} LaraCV - Portal Pembuat Dokumen CV Profesional. Mengadopsi Standar Antarmuka Modern.</p>
                <div class="flex items-center gap-4">
                    <a href="{{ route('panduan') }}" class="hover:text-primary transition-colors">Syarat & Ketentuan</a>
                    <a href="{{ route('bantuan') }}" class="hover:text-primary transition-colors">Privasi</a>
                    <a href="{{ route('faq') }}" class="hover:text-primary transition-colors">Bantuan Teknis</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating Scroll-To-Top Button (Kanan Bawah) -->
    <button x-show="scrolled" 
            x-cloak
            @click="scrollToTop()"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            aria-label="Kembali ke atas"
            class="fixed bottom-6 right-6 z-50 w-11 h-11 rounded-full bg-primary hover:bg-primary-dark text-white flex items-center justify-center shadow-lg shadow-primary/30 active:scale-95 transition-all duration-200">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"></path>
        </svg>
    </button>

    @stack('scripts')
</body>
</html>
