@props(['solidBackground' => false])

@php
    $logoPath = 'image/logometland.png';
    $logoUrl = asset($logoPath);
@endphp

<!-- Navbar Component -->
<header x-data="{ scrolled: false, menuOpen: false, lang: 'id' }"
    @scroll.window="scrolled = (window.pageYOffset > 50)"
    class="fixed top-0 left-0 w-full z-50 transition-all duration-500 border-b border-transparent"
    :class="[
        scrolled || {{ $solidBackground ? 'true' : 'false' }} ? 'bg-[#1a1a1a] shadow-lg border-white/10 h-16' : 'bg-transparent h-20'
    ]">

    <!-- Main Header Content -->
    <div class="max-w-[1400px] mx-auto px-6 h-full flex items-center justify-between">

        <!-- Logo area -->
        <a href="/" class="flex items-center gap-4 group transition-all duration-500">
            <div class="relative w-10 h-10">
                <img src="{{ $logoUrl }}" class="w-full h-full object-contain transition-transform group-hover:scale-110">
            </div>
            <div class="flex flex-col text-white">
                <span class="font-bold text-sm leading-none tracking-wider">SMK METLAND</span>
                <span class="text-[9px] tracking-[0.2em] font-light text-gray-400 uppercase">School of Tourism</span>
            </div>
        </a>

        <!-- Desktop Menu -->
        <nav class="hidden md:flex items-center h-full gap-8">
            <div class="flex items-center gap-8 text-[11px] font-bold tracking-[0.12em] text-white">
                <a href="{{ route('home') }}" class="hover:text-blue-400 transition-colors uppercase">Beranda</a>
                <a href="{{ route('about') }}" class="hover:text-blue-400 transition-colors uppercase">Tentang</a>
                <a href="{{ route('news.page') }}" class="hover:text-blue-400 transition-colors uppercase">Berita</a>
                <a href="{{ route('ppdb.index') }}" class="hover:text-blue-400 transition-colors uppercase">PPDB</a>
            </div>

            <!-- Language Toggle -->
            <button @click="lang = lang === 'id' ? 'en' : 'id'"
                class="flex items-center bg-white rounded-full px-1 py-1 w-14 h-7 relative shadow-inner"
                :title="lang === 'id' ? 'Switch to English' : 'Ganti ke Indonesia'">
                <div class="absolute inset-0 flex items-center justify-between px-2 text-[8px] font-bold text-gray-400">
                    <span>ID</span>
                    <span>EN</span>
                </div>
                <div class="w-5 h-5 bg-[#1a1a1a] rounded-full shadow-md transform transition-transform duration-300 flex items-center justify-center text-[7px] font-bold text-white z-10"
                    :class="lang === 'en' ? 'translate-x-7' : 'translate-x-0'">
                    <span x-text="lang.toUpperCase()"></span>
                </div>
            </button>

            <!-- PPDB Button -->
            <a href="{{ route('ppdb.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-4 py-2 rounded-lg transition-colors shadow-lg shadow-blue-600/30">
                Daftar Sekarang
            </a>
        </nav>

        <!-- Mobile Toggle -->
        <button class="md:hidden text-white p-2" @click="menuOpen = !menuOpen">
            <svg x-show="!menuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
            <svg x-show="menuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div x-show="menuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="md:hidden bg-[#1a1a1a] border-t border-white/10">
        <div class="px-6 py-4 space-y-4">
            <a href="{{ route('home') }}" class="block text-white hover:text-blue-400 font-medium">Beranda</a>
            <a href="{{ route('about') }}" class="block text-white hover:text-blue-400 font-medium">Tentang</a>
            <a href="{{ route('news.page') }}" class="block text-white hover:text-blue-400 font-medium">Berita</a>
            <a href="{{ route('ppdb.index') }}" class="block text-white hover:text-blue-400 font-medium">PPDB</a>
            <a href="{{ route('ppdb.create') }}" class="block bg-blue-600 text-white text-center py-2 rounded-lg font-bold">
                Daftar Sekarang
            </a>
        </div>
    </div>
</header>

<!-- Spacer to prevent content from going under fixed navbar -->
@if($solidBackground)
<div class="h-16"></div>
@endif
