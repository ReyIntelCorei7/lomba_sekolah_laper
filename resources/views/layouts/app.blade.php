<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metland School - SMK Pariwisata</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js Intersect Plugin -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        /* Base Settings */
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Hide Scrollbar */
        ::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }

        /* Custom Scroll Progress */
        .scroll-progress {
            background: linear-gradient(90deg, #3b82f6, #06b6d4);
            height: 3px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999;
            transition: width 0.1s ease-out;
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
        }

        /* Loading Screen Animations */
        @keyframes pulse-ring {
            0% {
                transform: scale(0.8);
                opacity: 0.5;
            }

            50% {
                transform: scale(1.1);
                opacity: 1;
            }

            100% {
                transform: scale(0.8);
                opacity: 0.5;
            }
        }

        .animate-pulse-slow {
            animation: pulse-ring 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        .loading-screen {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0f172a;
            /* Dark Slate 900 */
            transition: opacity 0.8s ease-out, visibility 0.8s ease-out;
        }

        .loading-screen.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        /* Hero Parallax & Zoom Effects */
        .hero-bg-layer {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            will-change: transform, opacity;
            transition: opacity 1.5s ease-in-out;
        }

        .hero-zoom {
            animation: kenBurns 25s infinite alternate linear;
        }

        @keyframes kenBurns {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(1.15);
            }
        }

        /* Staggered Text Animations */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .delay-100 {
            animation-delay: 0.2s;
        }

        .delay-200 {
            animation-delay: 0.4s;
        }

        .delay-300 {
            animation-delay: 0.6s;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Modern Scroll Indicator */
        .mouse-scroll {
            width: 26px;
            height: 42px;
            border: 2px solid rgba(255, 255, 255, 0.6);
            border-radius: 20px;
            position: relative;
        }

        .mouse-wheel {
            width: 4px;
            height: 8px;
            background: #fff;
            border-radius: 2px;
            position: absolute;
            top: 6px;
            left: 50%;
            transform: translateX(-50%);
            animation: scrollWheel 2s infinite;
        }

        @keyframes scrollWheel {
            0% {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }

            100% {
                opacity: 0;
                transform: translateX(-50%) translateY(12px);
            }
        }

        /* Utility */
        [x-cloak] {
            display: none !important;
        }

        /* Infinite Marquee Animations */
        @keyframes scroll-left {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        @keyframes scroll-right {
            0% {
                transform: translateX(-50%);
            }
            100% {
                transform: translateX(0);
            }
        }

        .marquee-container {
            overflow: hidden;
            position: relative;
        }

        .marquee-container::before,
        .marquee-container::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100px;
            z-index: 10;
            pointer-events: none;
        }

        .marquee-container::before {
            left: 0;
            background: linear-gradient(to right, #ffffff, transparent);
        }

        .marquee-container::after {
            right: 0;
            background: linear-gradient(to left, #ffffff, transparent);
        }

        .marquee-track {
            display: flex;
            width: max-content;
        }

        .marquee-track-left {
            animation: scroll-left 30s linear infinite;
        }

        .marquee-track-right {
            animation: scroll-right 30s linear infinite;
        }

        .marquee-track:hover {
            animation-play-state: paused;
        }

        .marquee-item {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 1rem;
        }

        .marquee-item img {
            height: 96px;
            width: auto;
            opacity: 0.8;
            transition: all 0.3s ease;
        }

        .marquee-item:hover img {
            opacity: 1;
            transform: scale(1.1);
        }
    </style>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#1e3a8a',
                        /* Blue 900 */
                        secondary: '#005f73',
                        accent: '#3b82f6',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>

<body x-data="appData()" x-init="init()" class="bg-gray-50 text-gray-900 overflow-x-hidden antialiased">

    <!-- Loading Screen -->
    <div class="loading-screen" :class="{ 'hidden': !isLoading }">
        <div class="text-center relative z-10 flex flex-col items-center">
            @php
            $logoPath = $settings['logo_image'] ?? 'image/logometland.png';
            $logoUrl = str_starts_with($logoPath, 'settings/') ? asset('storage/' . $logoPath) : asset($logoPath);
            @endphp
            <!-- Logo Animation -->
            <div class="relative w-28 h-28 mb-8">
                <div class="absolute inset-0 border-4 border-blue-500/20 rounded-full animate-ping"></div>
                <div class="absolute inset-0 border-4 border-t-blue-500 rounded-full animate-spin"></div>
                <div class="absolute inset-4 rounded-full bg-white/5 backdrop-blur-sm flex items-center justify-center">
                    <img src="{{ $logoUrl }}" class="w-14 h-14 object-contain animate-pulse-slow">
                </div>
            </div>

            <!-- Text -->
            <h2 class="text-3xl font-bold tracking-[0.2em] text-white mb-2">METLAND</h2>
            <p class="text-blue-400 text-sm tracking-widest uppercase mb-8">Vocational School</p>

            <!-- Progress Bar -->
            <div class="w-48 h-1 bg-gray-800 rounded-full overflow-hidden">
                <div class="h-full bg-blue-500 transition-all duration-300 ease-out"
                    :style="`width: ${loadingProgress}%`"></div>
            </div>
        </div>

        <!-- Noise Texture Overlay -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
            style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noise%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noise)%22 opacity=%221%22/%3E%3C/svg%3E');"></div>
    </div>

    <!-- Scroll Progress Top Bar -->
    <div class="scroll-progress" :style="`width: ${scrollProgress}%`"></div>

    <!-- Navbar Component (shows on scroll for homepage) -->
    <x-navbar :solidBackground="false" :showOnScroll="true" />

    <!-- HERO SECTION with Parallax -->
    <!-- SCROLL REVEAL WRAPPER (200vh to allow scroll-based animation) -->
    <div class="relative h-[200vh]" x-data="{ scrollProgress: 0 }" @scroll.window="scrollProgress = Math.min(Math.max((window.pageYOffset) / (window.innerHeight), 0), 1.5)">

        <!-- STICKY HERO SECTION -->
        <section id="hero" class="sticky top-0 h-screen w-full overflow-hidden flex items-center justify-center bg-[#101010]">

            <!-- Outer Background Texture: Premium Yearbook Theme -->
            <!-- Leather/Binding Texture -->
            <div class="absolute inset-0 opacity-40 pointer-events-none bg-[url('https://www.transparenttextures.com/patterns/binding-dark.png')]"></div>

            <!-- Cinematic Vignette for Depth -->
            <div class="absolute inset-0 bg-radial-at-c from-transparent via-[#000]/40 to-[#000]/90 pointer-events-none"></div>

            <!-- Elegant Book Frame Borders -->
            <div class="absolute inset-6 border border-white/10 rounded-sm pointer-events-none"></div>
            <div class="absolute inset-8 border border-white/5 rounded-sm pointer-events-none"></div>

            <!-- Welcome Text (Book Title Style) - Straddling the Shield -->
            <div class="absolute inset-0 flex flex-col items-center justify-center z-0 transition-transform duration-500 will-change-transform pointer-events-none"
                :style="`opacity: ${1 - scrollProgress * 4}; transform: scale(${1 + scrollProgress});`">

                <!-- Top Text -->
                <div class="mb-24 md:mb-28 text-center">
                    <p class="text-blue-200/80 font-serif italic text-xl mb-4 tracking-widest">Welcome to</p>
                    <h1 class="text-5xl md:text-7xl font-bold text-white tracking-[0.2em] font-serif uppercase drop-shadow-2xl">
                        METLAND
                    </h1>
                </div>

                <!-- Bottom Text -->
                <div class="mt-24 md:mt-28 text-center">
                    <h1 class="text-4xl md:text-6xl font-bold text-transparent bg-clip-text bg-gradient-to-b from-white to-white/50 tracking-[0.2em] font-serif uppercase drop-shadow-2xl">
                        SCHOOL
                    </h1>
                    <div class="w-24 h-1 bg-blue-600/50 mx-auto mt-6 rounded-full"></div>
                </div>
            </div>

            <!-- Content Wrapper with MASK -->
            <!-- The mask starts small (logo size) and grows to cover viewport -->
            <div class="absolute inset-0 w-full h-full z-10 flex items-center justify-center transition-transform duration-75 ease-linear will-change-transform"
                :style="`
                    -webkit-mask-image: url('{{ $logoUrl }}');
                    -webkit-mask-repeat: no-repeat;
                    -webkit-mask-position: center;
                    -webkit-mask-size: ${150 + (scrollProgress * 4000)}px;
                    mask-image: url('{{ $logoUrl }}');
                    mask-repeat: no-repeat;
                    mask-position: center;
                    mask-size: ${150 + (scrollProgress * 4000)}px;
                 `">

                <!-- Parallax Background Group (Existing Logic) -->
                <div class="absolute inset-0 z-0 bg-gray-900 overflow-hidden"
                    x-data="{ 
                        mouseX: 50, 
                        mouseY: 50,
                        bgX: 0,
                        bgY: 0,
                        handleHeroMove(e) {
                            this.mouseX = (e.clientX / window.innerWidth) * 100;
                            this.mouseY = (e.clientY / window.innerHeight) * 100;
                            this.bgX = (e.clientX - window.innerWidth/2) / 50;
                            this.bgY = (e.clientY - window.innerHeight/2) / 50;
                        }
                     }"
                    @mousemove.window="handleHeroMove($event)">

                    <!-- Dynamic Background Images -->
                    <template x-for="(img, idx) in heroImages" :key="idx">
                        <div class="absolute inset-0 bg-cover bg-center transition-all duration-1000 ease-out will-change-transform"
                            :class="currentHeroIndex === idx ? 'opacity-100 z-10 scale-110' : 'opacity-0 z-0 scale-100'"
                            :style="`background-image: url('${img}'); 
                                      transform: scale(1.1) translate(${bgX * -1}px, ${bgY * -1}px);
                                      transition: opacity 1s ease, transform 0.1s linear;`">
                        </div>
                    </template>

                    <!-- Dynamic Spotlight Overlay -->
                    <div class="absolute inset-0 z-20 pointer-events-none mix-blend-overlay transition-opacity duration-500"
                        :style="`background: radial-gradient(circle 800px at ${mouseX}% ${mouseY}%, rgba(255,255,255,0.15), transparent 50%);`">
                    </div>

                    <!-- Cinematic Overlays -->
                    <div class="absolute inset-0 z-20 bg-gradient-to-t from-[#0a0a0a] via-[#0a0a0a]/40 to-transparent opacity-90"></div>
                    <div class="absolute inset-0 z-20 bg-gradient-to-r from-[#0a0a0a]/80 via-transparent to-transparent"></div>
                    <div class="absolute inset-0 z-20 opacity-[0.03] bg-[url('https://grainy-gradients.vercel.app/noise.svg')] mix-blend-overlay"></div>
                </div>

                <!-- Hero Content (Text & Buttons) -->
                <!-- Hidden when shield is closed, appears with fade-in when shield opens -->
                <div class="relative z-30 w-full max-w-7xl mx-auto px-6 mt-32 transition-all duration-700"
                    :style="`opacity: ${scrollProgress < 0.15 ? 0 : Math.min(1, (scrollProgress - 0.15) * 4)}; transform: translateY(${scrollProgress < 0.15 ? 40 : Math.max(0, 40 - (scrollProgress - 0.15) * 200)}px);`">
                    <div class="max-w-4xl" x-show="!isLoading">
                        <!-- Badge -->
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-xs font-medium mb-6 fade-in-up">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                            {{ $settings['hero_subtitle'] ?? 'The High Standard in Vocational Education' }}
                        </div>

                        <!-- Main Title -->
                        <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white leading-[1.1] tracking-tight mb-6 fade-in-up delay-100">
                            {{ $settings['hero_title'] ?? 'Bridging the Gap Between Education & Industry' }}
                        </h1>

                        <!-- Description -->
                        <p class="text-sm md:text-base text-gray-300 max-w-xl mb-10 leading-relaxed fade-in-up delay-200">
                            Mewujudkan generasi profesional yang siap kerja dengan kurikulum berstandar industri dan fasilitas pembelajaran modern.
                        </p>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-5 fade-in-up delay-300">
                            <a href="{{ route('ppdb.index') }}"
                                class="group relative px-8 py-4 bg-blue-600 text-white rounded-full font-semibold overflow-hidden transition-all hover:scale-105 hover:shadow-xl hover:shadow-blue-600/30">
                                <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                                <span class="relative flex items-center justify-center gap-2">
                                    <span x-text="t[lang].ppdb"></span>
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </span>
                            </a>

                            <a href="#about"
                                class="px-8 py-4 bg-white/5 backdrop-blur-sm border border-white/10 text-white rounded-full font-semibold hover:bg-white/10 hover:border-white/30 transition-all hover:scale-105"
                                x-text="t[lang].about">
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Simple Slider Indicators (Dots) -->
                <div class="absolute right-12 bottom-12 z-30 flex gap-4">
                    <template x-for="(img, idx) in heroImages" :key="idx">
                        <button @click="currentHeroIndex = idx"
                            class="w-1.5 h-12 rounded-full transition-all duration-500 ease-out relative overflow-hidden bg-white/20"
                            :class="currentHeroIndex === idx ? 'bg-white/20 scale-y-110' : 'hover:bg-white/40'">
                            <div class="absolute inset-0 bg-blue-500 -translate-y-full transition-transform duration-[8000ms] ease-linear"
                                :class="currentHeroIndex === idx ? 'translate-y-0' : ''"></div>
                        </button>
                    </template>
                </div>
            </div>

            <!-- Scroll Indicator (Visible when Shield is closed) -->
            <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-40 flex flex-col items-center gap-3 transition-opacity duration-300"
                :class="scrollProgress > 0.1 ? 'opacity-0' : 'opacity-60 hover:opacity-100'">
                <div class="mouse-scroll">
                    <div class="mouse-wheel"></div>
                </div>
                <span class="text-[10px] uppercase tracking-[0.2em] text-white">Scroll to Open</span>
            </div>
        </section>
    </div>

    <!-- CONTENT SECTIONS (Livewire & Others) -->

    <!-- About School -->
    @livewire('bawah-hero-section')

    <!-- Infografis -->
    <section id="stats" x-data="statsSection()" x-intersect="startAnimation()" class="py-24 bg-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-full blur-3xl opacity-60 -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-indigo-50 rounded-full blur-3xl opacity-60 translate-y-1/3 -translate-x-1/3"></div>

        <div class="max-w-6xl mx-auto px-6 relative z-10">
            <div class="grid md:grid-cols-3 gap-10">
                <!-- Stat Card 1 -->
                <div class="p-8 rounded-3xl bg-white border border-gray-100 shadow-xl shadow-gray-200/50 text-center transform transition-all hover:-translate-y-2 duration-300">
                    <div class="w-16 h-16 mx-auto mb-6 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-5xl font-bold text-gray-900 mb-2">
                        <span x-text="stats.students">0</span>
                    </h3>
                    <p class="text-gray-500 font-medium">Siswa Aktif</p>
                </div>

                <!-- Stat Card 2 -->
                <div class="p-8 rounded-3xl bg-white border border-gray-100 shadow-xl shadow-gray-200/50 text-center transform transition-all hover:-translate-y-2 duration-300 delay-100">
                    <div class="w-16 h-16 mx-auto mb-6 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-5xl font-bold text-gray-900 mb-2">
                        <span x-text="stats.teachers">0</span>
                    </h3>
                    <p class="text-gray-500 font-medium">Guru Profesional</p>
                </div>

                <!-- Stat Card 3 -->
                <div class="p-8 rounded-3xl bg-white border border-gray-100 shadow-xl shadow-gray-200/50 text-center transform transition-all hover:-translate-y-2 duration-300 delay-200">
                    <div class="w-16 h-16 mx-auto mb-6 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-5xl font-bold text-gray-900 mb-2">
                        <span x-text="stats.staff">0</span>
                    </h3>
                    <p class="text-gray-500 font-medium">Tenaga Kependidikan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Keahlian -->
    <section id="jurusan" class="py-20" style="background-color: {{ $settings['program_bg_color'] ?? '#1E2188' }};">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $settings['program_title'] ?? 'Program Keahlian' }}</h1>
                <p class="text-gray-300 max-w-xl mx-auto">{{ $settings['program_description'] ?? 'Pilih jurusan sesuai minat dan bakatmu untuk masa depan yang lebih cerah' }}</p>
            </div>

            <div x-data="{
                active: null,
                leaving: null,
                isMobile: window.innerWidth < 768,
                items: [
                    @foreach($programs as $program)
                    { 
                        id: {{ $program->id }}, 
                        title: '{{ $program->code }}', 
                        image: '{{ $program->image ? asset('storage/' . $program->image) : asset('image/' . strtolower($program->code) . '1.png') }}' 
                    },
                    @endforeach
                ]
            }" x-cloak class="flex flex-col md:flex-row gap-3 h-[700px] md:h-[420px]">
                <template x-for="item in items" :key="item.id">
                    <div @mouseenter="if (window.innerWidth >= 768) { leaving=null; active=item.id }"
                        @mouseleave="if (window.innerWidth >= 768) {
                        leaving=item.id;
                        setTimeout(()=>{ if(leaving===item.id){ active=null; leaving=null }},300)
                    }"
                        @click="active = active === item.id ? null : item.id"
                        class="relative overflow-hidden rounded-xl cursor-pointer transition-[flex,transform] duration-700 ease-in-out"
                        :class="active === item.id ? 'md:flex-[5]' : active === null ? 'md:flex-1' : 'md:flex-[0.6]'">
                        <!-- FOTO BACKGROUND -->
                        <div class="absolute inset-0 bg-cover bg-center transition-all duration-700"
                            :style="'background-image: url(' + item.image + ')'"
                            :class="active === item.id ? 'scale-105 brightness-100 grayscale-0' : 
                                'scale-100 grayscale brightness-50'">
                        </div>
                        <!-- OVERLAY -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent">
                        </div>
                        <!-- TITLE -->
                        <div class="absolute pointer-events-none transition-all duration-700"
                            :style="active === item.id ? 'left:2rem;bottom:2rem;transform:none' :
                                'left:50%;top:50%;transform:translate(-50%,-50%) rotate(-90deg)'">
                            <h2 class="text-white font-bold transition-all duration-700"
                                :class="active === item.id ? 'text-3xl' : 'text-xl'" x-text="item.title"></h2>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>

    <!-- Partners/Tech Marquee Section -->
    <section class="py-5 bg-white">
        @php
            // Get all images from industri folder
            $industriImages = glob(public_path('image/industri/*'));
            // Get all images from perguran folder
            $perguranImages = glob(public_path('image/perguran/*'));
        @endphp

        <!-- Row 1: Scrolls Left - Industri Images -->
        <div class="marquee-container mb-6">
            <div class="marquee-track marquee-track-left">
                <!-- First set of images -->
                @foreach($industriImages as $image)
                    <div class="marquee-item">
                        <img src="{{ asset('image/industri/' . basename($image)) }}" alt="Partner Logo" class="h-18 w-auto object-contain">
                    </div>
                @endforeach
                <!-- Duplicate set for seamless loop -->
                @foreach($industriImages as $image)
                    <div class="marquee-item">
                        <img src="{{ asset('image/industri/' . basename($image)) }}" alt="Partner Logo" class="h-18 w-auto object-contain">
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Row 2: Scrolls Right - Perguruan Images -->
        <div class="marquee-container">
            <div class="marquee-track marquee-track-right">
                <!-- First set of images -->
                @foreach($perguranImages as $image)
                    <div class="marquee-item">
                        <img src="{{ asset('image/perguran/' . basename($image)) }}" alt="Partner Logo" class="h-12 w-auto object-contain">
                    </div>
                @endforeach
                <!-- Duplicate set for seamless loop -->
                @foreach($perguranImages as $image)
                    <div class="marquee-item">
                        <img src="{{ asset('image/perguran/' . basename($image)) }}" alt="Partner Logo" class="h-12 w-auto object-contain">
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Berita Sekolah -->
    <section id="berita" class="py-24" style="background-color: #1E2188;">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div>
                    <span class="text-blue-300 font-bold tracking-wider uppercase text-sm">Latest Updates</span>
                    <h2 class="text-4xl font-bold text-white mt-2">{{ $settings['news_title'] ?? 'Berita Sekolah' }}</h2>
                </div>
                <a href="/news" class="hidden md:inline-flex items-center px-6 py-3 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white font-medium hover:bg-white/20 hover:shadow-md transition-all">
                    Lihat Semua Berita
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

            <!-- News Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($latestNews as $news)
                <article class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="relative h-56 overflow-hidden">
                        @if($news->image)
                        <img src="{{ asset('storage/' . $news->image) }}" class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                        @else
                        <div class="w-full h-full bg-blue-50 flex items-center justify-center">
                            <svg class="w-12 h-12 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        @endif
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-blue-600 shadow-sm">
                            {{ ucfirst($news->category) }}
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="text-sm text-gray-400 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $news->formatted_date }}
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors">
                            <a href="{{ route('news.show', $news->slug) }}">{{ $news->title }}</a>
                        </h3>
                        <p class="text-gray-500 text-sm line-clamp-2 mb-4">
                            {{ $news->excerpt ?? Str::limit(strip_tags($news->content), 100) }}
                        </p>
                        <a href="{{ route('news.show', $news->slug) }}" class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-700">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </article>
                @empty
                <div class="col-span-full text-center py-12 text-white/60">
                    Belum ada berita terbaru.
                </div>
                @endforelse
            </div>

            <div class="mt-8 text-center md:hidden">
                <a href="/news" class="inline-flex items-center px-6 py-3 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white font-medium hover:bg-white/20">
                    Lihat Semua Berita
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('components.footer')

    <!-- Logika Aplikasi -->
    <script>
        function appData() {
            return {
                isLoading: true,
                loadingProgress: 0,
                scrollProgress: 0,
                scrollY: 0,
                lang: 'id',
                heroImages: [
                    @php
                    $hero1 = $settings['hero_image_1'] ?? 'image/sekolahsmkmetland4.png';
                    $hero2 = $settings['hero_image_2'] ?? 'image/sekolahsmkmetland3.png';
                    $hero3 = $settings['hero_image_3'] ?? 'image/sekolahsmkmetland.png';

                    $hero1Url = str_starts_with($hero1, 'settings/') ? asset('storage/'.$hero1) : asset($hero1);
                    $hero2Url = str_starts_with($hero2, 'settings/') ? asset('storage/'.$hero2) : asset($hero2);
                    $hero3Url = str_starts_with($hero3, 'settings/') ? asset('storage/'.$hero3) : asset($hero3);
                    @endphp "{{ $hero1Url }}",
                    "{{ $hero2Url }}",
                    "{{ $hero3Url }}"
                ],
                currentHeroIndex: 0,

                // Text Resources
                t: {
                    id: {
                        home: 'Beranda',
                        about: 'Tentang',
                        program: 'Jurusan',
                        news: 'Berita',
                        ppdb: 'PPDB'
                    },
                    en: {
                        home: 'Home',
                        about: 'About',
                        program: 'Programs',
                        news: 'News',
                        ppdb: 'Admissions'
                    }
                },

                init() {
                    //  Loading Gimmick kwkwk
                    let progressInterval = setInterval(() => {
                        this.loadingProgress += Math.random() * 25 + 10;
                        if (this.loadingProgress >= 100) {
                            this.loadingProgress = 100;
                            clearInterval(progressInterval);
                            setTimeout(() => {
                                this.isLoading = false;
                            }, 300);
                        }
                    }, 80);

                    // Scroll Tracking
                    window.addEventListener('scroll', () => {
                        this.scrollY = window.pageYOffset;

                        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                        this.scrollProgress = (winScroll / height) * 100;
                    });

                    //  Hero Auto Slide
                    setInterval(() => {
                        this.currentHeroIndex = (this.currentHeroIndex + 1) % this.heroImages.length;
                    }, 8000);
                },

                toggleLang() {
                    this.lang = this.lang === 'id' ? 'en' : 'id';
                }
            }
        }


        function statsSection() {
            return {
                stats: {
                    students: 0,
                    teachers: 0,
                    staff: 0
                },
                startAnimation() {
                    const targets = {
                        students: @json($settings['stat_students'] ?? 683),
                        teachers: @json($settings['stat_teachers'] ?? 54),
                        staff: @json($settings['stat_staff'] ?? 41)
                    };

                    this.animateValue('students', targets.students);
                    this.animateValue('teachers', targets.teachers);
                    this.animateValue('staff', targets.staff);
                },
                animateValue(key, target) {
                    let start = 0;
                    const duration = 1500;
                    const step = timestamp => {
                        if (!start) start = timestamp;
                        const progress = Math.min((timestamp - start) / duration, 1);
                        this.stats[key] = Math.floor(progress * target);
                        if (progress < 1) requestAnimationFrame(step);
                    };
                    requestAnimationFrame(step);
                }
            }
        }
    </script>
</body>

</html>