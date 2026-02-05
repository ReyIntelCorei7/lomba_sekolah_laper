<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metland School - SMK Pariwisata</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

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
            0% { transform: scale(0.8); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(0.8); opacity: 0.5; }
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
            background: #0f172a; /* Dark Slate 900 */
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
            0% { transform: scale(1); }
            100% { transform: scale(1.15); }
        }

        /* Staggered Text Animations */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        
        .delay-100 { animation-delay: 0.2s; }
        .delay-200 { animation-delay: 0.4s; }
        .delay-300 { animation-delay: 0.6s; }
        
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
            border: 2px solid rgba(255,255,255,0.6);
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
            0% { opacity: 1; transform: translateX(-50%) translateY(0); }
            100% { opacity: 0; transform: translateX(-50%) translateY(12px); }
        }

        /* Utility */
        [x-cloak] { display: none !important; }
    </style>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#1e3a8a', /* Blue 900 */
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

    <!-- Navbar -->
    <header x-data="{ scrolled: false, menuOpen: false, headerVisible: false }" 
            @scroll.window="
                scrolled = (window.pageYOffset > 50);
                headerVisible = (window.pageYOffset > window.innerHeight * 0.7);
            "
            class="fixed top-0 left-0 w-full z-50 transition-all duration-1000 border-b border-transparent flex items-center"
            :class="[
                scrolled ? 'bg-[#1a1a1a] shadow-lg border-white/10 h-16' : 'bg-transparent h-24',
                headerVisible ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none'
            ]">
        
        <!-- Main Header Content -->
        <div class="max-w-[1400px] mx-auto h-20 flex items-center justify-between gap-16 relative z-50"
             :class="scrolled ? 'h-16' : 'h-24'">
             
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
                <!-- Text Links (Consolidated) -->
                <div class="flex items-center gap-10 text-[11px] font-bold tracking-[0.15em] text-white transition-all duration-500 delay-75"
                     :class="menuOpen ? '-translate-y-10 opacity-0 pointer-events-none' : 'translate-y-0 opacity-100'">
                    <a href="#" class="hover:text-blue-400 transition-colors uppercase">Beranda</a>
                    <a href="#about" class="hover:text-blue-400 transition-colors uppercase">Tentang Sekolah</a>
                    <a href="#jurusan" class="hover:text-blue-400 transition-colors uppercase">Program Keahlian</a>
                    <a href="#" class="hover:text-blue-400 transition-colors uppercase">Kurikulum</a>
                    <a href="#berita" class="hover:text-blue-400 transition-colors uppercase">Berita Sekolah</a>
                </div>

                <!-- Language Toggle -->
                <button @click="toggleLang()" 
                        class="flex items-center bg-white rounded-full px-1 py-1 w-16 h-8 relative shadow-inner transition-all duration-500 delay-100"
                        :class="menuOpen ? '-translate-y-10 opacity-0 pointer-events-none' : 'translate-y-0 opacity-100'"
                        :title="lang === 'id' ? 'Switch to English' : 'Ganti ke Indonesia'">
                    <div class="absolute inset-0 flex items-center justify-between px-2 text-[9px] font-bold text-gray-400">
                        <span>ID</span>
                        <span>EN</span>
                    </div>
                    <div class="w-6 h-6 bg-[#1a1a1a] rounded-full shadow-md transform transition-transform duration-300 flex items-center justify-center text-[8px] font-bold text-white z-10"
                         :class="lang === 'en' ? 'translate-x-8' : 'translate-x-0'">
                        <span x-text="lang.toUpperCase()"></span>
                    </div>
                </button>

                <!-- Blue Pull Ribbon (Toggle) -->
                <div class="relative group h-full flex items-start z-50 w-20 justify-end">
                    <button @click="menuOpen = !menuOpen" 
                       class="absolute w-16 bg-[#1E2188] hover:bg-blue-700 text-white flex flex-col items-center pb-4 transition-all duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)] shadow-2xl shadow-blue-900/50 cursor-pointer"
                       :class="menuOpen ? 'h-[500px] -top-0 bg-blue-700' : 'h-32 -top-0 hover:h-36'"
                       style="clip-path: polygon(0 0, 100% 0, 100% calc(100% - 20px), 50% 100%, 0 calc(100% - 20px)); right: 0;">
                        
                        <!-- Content Wrapper -->
                        <div class="h-full flex flex-col justify-end items-center pb-6 gap-2">
                            <!-- Arrow Icon (Rotating) -->
                            <div class="transition-transform duration-500"
                                 :class="menuOpen ? 'rotate-180 mb-2' : 'rotate-0'">
                                <svg class="w-5 h-5 text-white animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </button>
                </div>
            </nav>
            
            <!-- Mobile Toggle -->
            <button class="md:hidden text-white p-2" @click="menuOpen = !menuOpen">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
        </div>

        <!-- Mega Menu Overlay -->
        <div class="fixed inset-0 bg-[#1E2188] z-40 transition-transform duration-700 ease-[cubic-bezier(0.16,1,0.3,1)]"
             :class="menuOpen ? 'translate-y-0' : '-translate-y-full'"
             style="top: 0;">
             
             <div class="max-w-[1400px] mx-auto px-6 pt-32 pb-12 h-full flex flex-col">
                 <!-- Header in Menu -->
                 <div class="flex items-center gap-4 mb-20 fade-in-up delay-100">
                    <img src="{{ $logoUrl }}" class="w-16 h-16 object-contain brightness-0 invert">
                    <h2 class="text-3xl font-bold text-white tracking-widest uppercase">METLAND SCHOOL</h2>
                 </div>

                 <!-- Grid Content -->
                 <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-white">
                     <!-- Column 1 -->
                     <div class="space-y-8 fade-in-up delay-200">
                         <a href="#" class="block text-xl font-bold hover:text-blue-200 transition-colors">Profile Sekolah</a>
                         <a href="#" class="block text-xl font-bold hover:text-blue-200 transition-colors">Visi dan Misi</a>
                         <a href="#jurusan" @click="menuOpen=false" class="block text-xl font-bold hover:text-blue-200 transition-colors">Program Keahlian</a>
                     </div>
                     
                     <!-- Column 2 -->
                     <div class="space-y-8 fade-in-up delay-300">
                         <a href="#" class="block text-xl font-bold hover:text-blue-200 transition-colors">Ekstrakurikuler</a>
                         <a href="#" class="block text-xl font-bold hover:text-blue-200 transition-colors">Organisasi</a>
                         <a href="#" class="block text-xl font-bold hover:text-blue-200 transition-colors">Produk/Karya Siswa</a>
                     </div>

                     <!-- Column 3 -->
                     <div class="space-y-8 fade-in-up delay-400">
                         <a href="#" class="block text-xl font-bold hover:text-blue-200 transition-colors">Tentang Alumni</a>
                         <a href="#berita" @click="menuOpen=false" class="block text-xl font-bold hover:text-blue-200 transition-colors">Berita Sekolah</a>
                         <a href="#" class="block text-xl font-bold hover:text-blue-200 transition-colors">Kontak Sekolah</a>
                     </div>
                 </div>
                 
                 <div class="mt-auto border-t border-white/20 pt-8 flex justify-between text-white/60 text-sm">
                     <p>&copy; 2024 SMK Metland School</p>
                     <div class="flex gap-4">
                         <a href="#" class="hover:text-white">Instagram</a>
                         <a href="#" class="hover:text-white">Facebook</a>
                         <a href="#" class="hover:text-white">Youtube</a>
                     </div>
                 </div>
             </div>
        </div>
        
        <!-- Styles -->
        <style>
            .animate-bounce-slow { animation: softBounce 3s infinite ease-in-out; }
        </style>
    </header>

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
                <div class="relative z-30 w-full max-w-7xl mx-auto px-6 mt-32">
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
                                     <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
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
                                class="w-3 h-3 rounded-full transition-all duration-300"
                                :class="currentHeroIndex === idx ? 'bg-white scale-125' : 'bg-white/30 hover:bg-white/60'">
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
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-5xl font-bold text-gray-900 mb-2">
                        <span x-text="stats.students">0</span>
                    </h3>
                    <p class="text-gray-500 font-medium">Siswa Aktif</p>
                </div>

                <!-- Stat Card 2 -->
                <div class="p-8 rounded-3xl bg-white border border-gray-100 shadow-xl shadow-gray-200/50 text-center transform transition-all hover:-translate-y-2 duration-300 delay-100">
                    <div class="w-16 h-16 mx-auto mb-6 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-5xl font-bold text-gray-900 mb-2">
                        <span x-text="stats.teachers">0</span>
                    </h3>
                    <p class="text-gray-500 font-medium">Guru Profesional</p>
                </div>

                <!-- Stat Card 3 -->
                <div class="p-8 rounded-3xl bg-white border border-gray-100 shadow-xl shadow-gray-200/50 text-center transform transition-all hover:-translate-y-2 duration-300 delay-200">
                    <div class="w-16 h-16 mx-auto mb-6 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
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

    <!-- Berita Sekolah -->
    <section id="berita" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
                <div>
                    <span class="text-blue-600 font-bold tracking-wider uppercase text-sm">Latest Updates</span>
                    <h2 class="text-4xl font-bold text-gray-900 mt-2">{{ $settings['news_title'] ?? 'Berita Sekolah' }}</h2>
                </div>
                <a href="/news" class="hidden md:inline-flex items-center px-6 py-3 rounded-full bg-white border border-gray-200 text-gray-700 font-medium hover:bg-gray-50 hover:shadow-md transition-all">
                    Lihat Semua Berita
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
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
                                    <svg class="w-12 h-12 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-blue-600 shadow-sm">
                                {{ ucfirst($news->category) }}
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="text-sm text-gray-400 mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $news->formatted_date }}
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                <a href="#">{{ $news->title }}</a>
                            </h3>
                            <p class="text-gray-500 text-sm line-clamp-2 mb-4">
                                {{ $news->excerpt ?? Str::limit(strip_tags($news->content), 100) }}
                            </p>
                            <a href="#" class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-700">
                                Baca Selengkapnya
                                <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        Belum ada berita terbaru.
                    </div>
                @endforelse
            </div>
            
            <div class="mt-8 text-center md:hidden">
                 <a href="/news" class="inline-flex items-center px-6 py-3 rounded-full bg-white border border-gray-200 text-gray-700 font-medium hover:bg-gray-50">
                    Lihat Semua Berita
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-20 pb-10 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-12 mb-16">
                <div class="md:col-span-2">
                     <div class="flex items-center gap-3 mb-6">
                        <img src="{{ $logoUrl }}" class="w-12 h-12 object-contain bg-white/10 rounded-full p-2">
                        <span class="text-2xl font-bold">{{ $settings['site_name'] ?? 'SMK Metland' }}</span>
                     </div>
                     <p class="text-gray-400 leading-relaxed mb-6 max-w-sm">
                        {{ $settings['site_description'] ?? 'Mencetak lulusan unggul di bidang pariwisata yang siap bersaing di kancah nasional maupun internasional.' }}
                     </p>
                     <div class="flex gap-4">
                         @if(isset($settings['social_instagram']))
                         <a href="{{ $settings['social_instagram'] }}" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-blue-600 transition-colors">
                             <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.76-6.162 6.162s2.76 6.163 6.162 6.163 6.162-2.76 6.162-6.163c0-3.402-2.76-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg> 
                         </a>
                         @endif
                     </div>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-6">Quick Links</h4>
                    <ul class="space-y-4 text-gray-400">
                        <li><a href="#" class="hover:text-blue-400 transition-colors">Beranda</a></li>
                        <li><a href="#about" class="hover:text-blue-400 transition-colors">Tentang Sekolah</a></li>
                        <li><a href="#jurusan" class="hover:text-blue-400 transition-colors">Program Keahlian</a></li>
                        <li><a href="{{ route('ppdb.index') }}" class="hover:text-blue-400 transition-colors">Info PPDB</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-6">Kontak Kami</h4>
                    <ul class="space-y-4 text-gray-400">
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>{{ $settings['contact_address'] ?? 'Jl. Metland Cyber City, Cikupa, Tangerang' }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <span>{{ $settings['contact_phone'] ?? '(021) 1234-5678' }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} SMK Pariwisata Metland School. All rights reserved.</p>
            </div>
        </div>
    </footer>

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
                        
                        $hero1Url = str_starts_with($hero1, 'settings/') ? asset('storage/' . $hero1) : asset($hero1);
                        $hero2Url = str_starts_with($hero2, 'settings/') ? asset('storage/' . $hero2) : asset($hero2);
                        $hero3Url = str_starts_with($hero3, 'settings/') ? asset('storage/' . $hero3) : asset($hero3);
                    @endphp
                    "{{ $hero1Url }}",
                    "{{ $hero2Url }}",
                    "{{ $hero3Url }}"
                ],
                currentHeroIndex: 0,
                
                // Text Resources
                t: {
                    id: { home: 'Beranda', about: 'Tentang', program: 'Jurusan', news: 'Berita', ppdb: 'PPDB' },
                    en: { home: 'Home', about: 'About', program: 'Programs', news: 'News', ppdb: 'Admissions' }
                },

                init() {
                    // 1. Loading Simulation
                    let progressInterval = setInterval(() => {
                        this.loadingProgress += Math.random() * 15;
                        if (this.loadingProgress >= 100) {
                            this.loadingProgress = 100;
                            clearInterval(progressInterval);
                            setTimeout(() => {
                                this.isLoading = false;
                            }, 800);
                        }
                    }, 200);

                    // 2. Scroll Tracking
                    window.addEventListener('scroll', () => {
                        this.scrollY = window.pageYOffset;
                        
                        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                        this.scrollProgress = (winScroll / height) * 100;
                    });

                    // 3. Hero Auto Slide
                    setInterval(() => {
                        this.currentHeroIndex = (this.currentHeroIndex + 1) % this.heroImages.length;
                    }, 8000);
                },

                toggleLang() {
                    this.lang = this.lang === 'id' ? 'en' : 'id';
                },
                
                stats: { students: 0, teachers: 0, staff: 0 },
                
                startAnimation() {
                    const targets = { 
                        students: {{ $settings['stat_students'] ?? 683 }},
                        teachers: {{ $settings['stat_teachers'] ?? 54 }},
                        staff: {{ $settings['stat_staff'] ?? 41 }}
                    };
                    
                    this.animateValue('students', targets.students);
                    this.animateValue('teachers', targets.teachers);
                    this.animateValue('staff', targets.staff);
                },

                animateValue(key, target) {
                    let start = 0;
                    const duration = 2000;
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