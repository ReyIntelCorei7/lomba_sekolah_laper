@props([
'solidBackground' => false,
'showOnScroll' => false,
'logoUrl' => null
])

@php
    if (!$logoUrl) {
        $logoSetting = \App\Models\WebsiteSetting::where('key', 'logo_image')->first();
        $logoUrl = ($logoSetting && $logoSetting->value) 
            ? img_url($logoSetting->value, 'website_settings', $logoSetting->id, 'value') 
            : asset('image/logometland.png');
    }
@endphp

<!-- Navbar -->
<header x-data="{ 
    scrolled: false, 
    menuOpen: false, 
    headerVisible: {{ $showOnScroll ? 'false' : 'true' }}
}"
    @scroll.window="
        scrolled = (window.pageYOffset > 50);
        @if($showOnScroll)
        headerVisible = (window.pageYOffset > window.innerHeight * 0.7);
        @endif
    "
    class="fixed top-0 left-0 w-full z-50 transition-all duration-1000 border-b border-transparent flex items-center"
    :class="[
        scrolled || {{ $solidBackground ? 'true' : 'false' }} ? 'bg-[#1a1a1a] shadow-lg border-white/10 h-16' : 'bg-transparent h-24',
        {{ $showOnScroll ? 'headerVisible' : 'true' }} ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none'
    ]">

    <!-- Main Header Content -->
    <div class="w-full md:max-w-[1400px] mx-auto px-4 md:px-6 h-20 flex items-center justify-between gap-4 md:gap-16 relative z-50"
        :class="scrolled || {{ $solidBackground ? 'true' : 'false' }} ? 'h-16' : 'h-24'">

        <!-- Logo area -->
        <a href="/" class="flex items-center gap-4 group transition-all duration-500"
            :class="menuOpen ? '-translate-y-10 opacity-0 pointer-events-none' : 'translate-y-0 opacity-100'">
            <div class="relative w-12 h-12">
                <img src="{{ $logoUrl }}" class="w-full h-full object-contain transition-transform group-hover:scale-110">
            </div>
            <div class="flex flex-col text-white">
                <span class="font-bold text-base leading-none tracking-wider">SMK METLAND</span>
                <span class="text-[9px] tracking-[0.3em] font-light text-gray-400 uppercase">School of Tourism</span>
            </div>
        </a>

        <!-- Desktop Menu -->
        <nav class="hidden md:flex items-center h-full gap-10 ml-auto">
            <!-- Text Links with Translation -->
            <div class="flex items-center gap-10 text-[11px] font-bold tracking-[0.15em] text-white transition-all duration-500 delay-75"
                :class="menuOpen ? '-translate-y-10 opacity-0 pointer-events-none' : 'translate-y-0 opacity-100'">
                <a href="/" class="hover:text-blue-400 transition-colors uppercase {{ request()->is('/') ? 'text-blue-400' : '' }}" x-text="$store.lang.t('nav_home')">Beranda</a>
                <a href="/about" class="hover:text-blue-400 transition-colors uppercase {{ request()->is('about') ? 'text-blue-400' : '' }}" x-text="$store.lang.t('nav_about')">Tentang Sekolah</a>
                <a href="/prokeh" class="hover:text-blue-400 transition-colors uppercase {{ request()->is('prokeh*') ? 'text-blue-400' : '' }}" x-text="$store.lang.t('nav_programs')">Program Keahlian</a>
                <a href="/kurikulum" class="hover:text-blue-400 transition-colors uppercase {{ request()->is('kurikulum*') ? 'text-blue-400' : '' }}" x-text="$store.lang.t('nav_curriculum')">Kurikulum</a>
                <a href="/news" class="hover:text-blue-400 transition-colors uppercase {{ request()->is('news*') ? 'text-blue-400' : '' }}" x-text="$store.lang.t('nav_news')">Berita Sekolah</a>
            </div>

            <!-- Language Toggle using Global Store -->
            <button @click="$store.lang.toggle()"
                class="flex items-center bg-white rounded-full px-1 py-1 w-16 h-8 relative shadow-inner transition-all duration-500 delay-100"
                :class="menuOpen ? '-translate-y-10 opacity-0 pointer-events-none' : 'translate-y-0 opacity-100'"
                :title="$store.lang.current === 'id' ? 'Switch to English' : 'Ganti ke Indonesia'">
                <div class="absolute inset-0 flex items-center justify-between px-2 text-[9px] font-bold text-gray-400">
                    <span>ID</span>
                    <span>EN</span>
                </div>
                <div class="w-6 h-6 bg-[#1a1a1a] rounded-full shadow-md transform transition-transform duration-300 flex items-center justify-center text-[8px] font-bold text-white z-10"
                    :class="$store.lang.current === 'en' ? 'translate-x-8' : 'translate-x-0'">
                    <span x-text="$store.lang.current.toUpperCase()"></span>
                </div>
            </button>

            <!-- Blue Pull Ribbon (Toggle) - Desktop only, positioned inside nav -->
        </nav>

        <!-- Blue Pull Ribbon (Toggle) - Works on both mobile and desktop -->
        <div class="relative group h-full flex items-start z-50 w-12 md:w-20 justify-end ml-auto">
            <button @click="menuOpen = !menuOpen"
                class="absolute w-10 md:w-16 bg-[#1E2188] hover:bg-blue-700 text-white flex flex-col items-center pb-4 transition-all duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)] shadow-2xl shadow-blue-900/50 cursor-pointer"
                :class="menuOpen ? 'h-[400px] md:h-[500px] -top-0 bg-blue-700' : 'h-20 md:h-32 -top-0 hover:h-24 md:hover:h-36'"
                style="clip-path: polygon(0 0, 100% 0, 100% calc(100% - 15px), 50% 100%, 0 calc(100% - 15px)); right: 0;">

                <div class="h-full flex flex-col justify-end items-center pb-4 md:pb-6 gap-2">
                    <div class="transition-transform duration-500"
                        :class="menuOpen ? 'rotate-180 mb-2' : 'rotate-0'">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-white animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </button>
        </div>


    </div>

    <!-- Mega Menu Component -->
    @include('components.mega-menu', ['logoUrl' => $logoUrl, 'settings' => $settings ?? []])

    <!-- Mobile Menu Dropdown -->
    <div x-show="menuOpen" x-transition class="md:hidden absolute top-full left-0 w-full bg-[#1a1a1a] border-t border-white/10 py-4">
        <div class="flex flex-col gap-4 px-6 text-white text-sm">
            <a href="/" class="hover:text-blue-400 {{ request()->is('/') ? 'text-blue-400' : '' }}" x-text="$store.lang.t('nav_home')">Beranda</a>
            <a href="/about" class="hover:text-blue-400 {{ request()->is('about') ? 'text-blue-400' : '' }}" x-text="$store.lang.t('nav_about')">Tentang Sekolah</a>
            <a href="/prokeh" class="hover:text-blue-400 {{ request()->is('prokeh*') ? 'text-blue-400' : '' }}" x-text="$store.lang.t('nav_programs')">Program Keahlian</a>
            <a href="/kurikulum" class="hover:text-blue-400 {{ request()->is('kurikulum') ? 'text-blue-400' : '' }}" x-text="$store.lang.t('nav_curriculum')">Kurikulum</a>
            <a href="/news" class="hover:text-blue-400 {{ request()->is('news*') ? 'text-blue-400' : '' }}" x-text="$store.lang.t('nav_news')">Berita Sekolah</a>
        </div>
        
        <!-- Mobile Language Toggle -->
        <div class="px-6 mt-4 pt-4 border-t border-white/10">
            <button @click="$store.lang.toggle()"
                class="flex items-center bg-white rounded-full px-1 py-1 w-16 h-8 relative shadow-inner"
                :title="$store.lang.current === 'id' ? 'Switch to English' : 'Ganti ke Indonesia'">
                <div class="absolute inset-0 flex items-center justify-between px-2 text-[9px] font-bold text-gray-400">
                    <span>ID</span>
                    <span>EN</span>
                </div>
                <div class="w-6 h-6 bg-[#1a1a1a] rounded-full shadow-md transform transition-transform duration-300 flex items-center justify-center text-[8px] font-bold text-white z-10"
                    :class="$store.lang.current === 'en' ? 'translate-x-8' : 'translate-x-0'">
                    <span x-text="$store.lang.current.toUpperCase()"></span>
                </div>
            </button>
        </div>
    </div>
</header>