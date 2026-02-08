<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Keahlian - SMK Metland School</title>
    <meta name="description" content="Pilih program keahlian sesuai minat dan bakatmu untuk masa depan yang cerah di SMK Metland">
    <link rel="icon" href="/image/logometland.png" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Animated Background Particles */
        .particle {
            position: absolute;
            width: 8px;
            height: 8px;
            background: rgba(59, 130, 246, 0.3);
            border-radius: 50%;
            animation: float 15s infinite ease-in-out;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0) rotate(0deg); opacity: 0.3; }
            25% { transform: translateY(-100px) translateX(50px) rotate(90deg); opacity: 0.6; }
            50% { transform: translateY(-50px) translateX(-30px) rotate(180deg); opacity: 0.4; }
            75% { transform: translateY(-150px) translateX(-50px) rotate(270deg); opacity: 0.7; }
        }

        /* 3D Card Effect */
        .program-card {
            perspective: 1000px;
            transform-style: preserve-3d;
        }
        
        .program-card-inner {
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            transform-style: preserve-3d;
            position: relative;
        }
        
        .program-card:hover .program-card-inner {
            transform: translateY(-15px) rotateX(5deg) rotateY(-2deg);
            box-shadow: 
                0 30px 60px -15px rgba(0, 0, 0, 0.4),
                0 20px 40px -10px rgba(59, 130, 246, 0.2);
        }
        
        /* Floating Icon Effect */
        .program-icon {
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }
        
        .program-card:hover .program-icon {
            transform: translateZ(30px) translateY(-10px) scale(1.1);
        }
        
        /* Glow effect */
        .glow-blue::before {
            content: '';
            position: absolute;
            inset: -3px;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6, #3b82f6);
            border-radius: 1.5rem;
            opacity: 0;
            transition: opacity 0.5s ease;
            z-index: -1;
            filter: blur(15px);
        }
        
        .program-card:hover .glow-blue::before {
            opacity: 0.6;
        }
        
        /* Stats counter animation */
        @keyframes countUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .stat-item {
            animation: countUp 0.8s ease-out forwards;
        }
        
        /* Text gradient animation */
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .animated-gradient {
            background: linear-gradient(135deg, #60a5fa, #a78bfa, #60a5fa, #34d399);
            background-size: 300% 300%;
            animation: gradient-shift 6s ease infinite;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* Hexagon pattern background */
        .hex-pattern {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='28' height='49' viewBox='0 0 28 49'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%233b82f6' fill-opacity='0.05'%3E%3Cpath d='M13.99 9.25l13 7.5v15l-13 7.5L1 31.75v-15l12.99-7.5zM3 17.9v12.7l10.99 6.34 11-6.35V17.9l-11-6.34L3 17.9zM0 15l12.98-7.5V0h-2v6.35L0 12.69v2.3zm0 18.5L12.98 41v8h-2v-6.85L0 35.81v-2.3zM15 0v7.5L27.99 15H28v-2.31h-.01L17 6.35V0h-2zm0 49v-8l12.99-7.5H28v2.31h-.01L17 42.15V49h-2z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>

<body x-data="{
    lang: localStorage.getItem('lang') || 'id',
    toggleLang() {
        this.lang = this.lang === 'id' ? 'en' : 'id';
        localStorage.setItem('lang', this.lang);
    },
    activeProgram: null
}" class="bg-gray-50">

    <!-- Navbar Component -->
    @include('components.navbar', ['solidBackground' => true, 'showOnScroll' => false])

    <!-- Hero Section with Animated Background -->
    <section class="relative min-h-[500px] md:min-h-[600px] w-full overflow-hidden mt-16">
        <!-- Animated Background -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-br from-[#1E2188] via-[#2a2d9e] to-[#0f1054]"></div>
            
            <!-- Hex Pattern -->
            <div class="absolute inset-0 hex-pattern opacity-50"></div>
            
            <!-- Floating Particles -->
            <div class="particle" style="left: 10%; top: 20%; animation-delay: 0s;"></div>
            <div class="particle" style="left: 20%; top: 60%; animation-delay: 2s; width: 12px; height: 12px;"></div>
            <div class="particle" style="left: 70%; top: 30%; animation-delay: 4s;"></div>
            <div class="particle" style="left: 80%; top: 70%; animation-delay: 6s; width: 10px; height: 10px;"></div>
            <div class="particle" style="left: 50%; top: 80%; animation-delay: 8s;"></div>
            <div class="particle" style="left: 30%; top: 10%; animation-delay: 10s; width: 6px; height: 6px;"></div>
            <div class="particle" style="left: 90%; top: 50%; animation-delay: 12s;"></div>
            
            <!-- Gradient Orbs -->
            <div class="absolute top-20 left-10 w-64 h-64 rounded-full bg-blue-500/20 blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-20 w-80 h-80 rounded-full bg-purple-500/20 blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 rounded-full bg-indigo-500/10 blur-3xl"></div>
        </div>
        
        <!-- Content -->
        <div class="relative z-10 h-full max-w-7xl mx-auto px-4 md:px-6 py-16 md:py-24 flex items-center justify-center text-center">
            <div>
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-sm font-medium mb-8 shadow-xl">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-400"></span>
                    </span>
                    5 Program Keahlian Unggulan
                </div>
                
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white mb-6 leading-tight">
                    Pilih <span class="animated-gradient">Masa Depanmu</span>
                </h1>
                <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed mb-10">
                    Temukan program keahlian yang sesuai dengan passion dan bakatmu. 
                    Kembangkan skill profesional untuk karir cemerlang di industri.
                </p>
                
                <!-- Stats -->
                <div class="flex flex-wrap justify-center gap-6 md:gap-12">
                    <div class="stat-item bg-white/10 backdrop-blur-md rounded-2xl px-6 py-4 border border-white/20" style="animation-delay: 0.2s">
                        <div class="text-3xl md:text-4xl font-bold text-white">5</div>
                        <div class="text-xs md:text-sm text-blue-200 uppercase tracking-wider">Program</div>
                    </div>
                    <div class="stat-item bg-white/10 backdrop-blur-md rounded-2xl px-6 py-4 border border-white/20" style="animation-delay: 0.4s">
                        <div class="text-3xl md:text-4xl font-bold text-white">100+</div>
                        <div class="text-xs md:text-sm text-blue-200 uppercase tracking-wider">Mitra Industri</div>
                    </div>
                    <div class="stat-item bg-white/10 backdrop-blur-md rounded-2xl px-6 py-4 border border-white/20" style="animation-delay: 0.6s">
                        <div class="text-3xl md:text-4xl font-bold text-white">95%</div>
                        <div class="text-xs md:text-sm text-blue-200 uppercase tracking-wider">Tingkat Kerja</div>
                    </div>
                </div>
                
                <!-- Scroll Indicator -->
                <div class="mt-12 animate-bounce">
                    <svg class="w-8 h-8 mx-auto text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Grid Section -->
    <section class="py-16 md:py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 bg-blue-100 text-blue-700 text-sm font-semibold rounded-full mb-4">PROGRAM KEAHLIAN</span>
                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">Jurusan Unggulan Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Setiap program dirancang untuk membekali siswa dengan skill praktis dan siap kerja
                </p>
            </div>
            
            <!-- Programs Grid with 3D Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                
                <!-- AKL - Akuntansi -->
                <a href="{{ route('prokeh.akuntansi') }}" class="program-card group">
                    <div class="program-card-inner glow-blue relative bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 h-full">
                        <!-- Top Gradient Bar -->
                        <div class="h-2 bg-gradient-to-r from-indigo-500 to-blue-600"></div>
                        
                        <!-- Icon Container -->
                        <div class="pt-8 pb-4 px-6">
                            <div class="program-icon w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-600 flex items-center justify-center shadow-lg shadow-blue-500/30">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="px-6 pb-8 text-center">
                            <span class="inline-block px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-bold rounded-full mb-3">AKL</span>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Akuntansi & Keuangan Lembaga</h3>
                            <p class="text-gray-600 text-sm mb-5 leading-relaxed">
                                Kuasai siklus akuntansi, komputer akuntansi, dan administrasi pajak untuk menjadi akuntan profesional.
                            </p>
                            
                            <!-- Skills Tags -->
                            <div class="flex flex-wrap justify-center gap-2 mb-5">
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">Akuntansi</span>
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">Pajak</span>
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">Excel</span>
                            </div>
                            
                            <!-- CTA -->
                            <div class="flex items-center justify-center gap-2 text-indigo-600 font-semibold group-hover:gap-4 transition-all">
                                <span>Lihat Detail</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- DKV - Desain Komunikasi Visual -->
                <a href="{{ route('prokeh.dkv') }}" class="program-card group">
                    <div class="program-card-inner glow-blue relative bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 h-full">
                        <div class="h-2 bg-gradient-to-r from-purple-500 to-pink-500"></div>
                        
                        <div class="pt-8 pb-4 px-6">
                            <div class="program-icon w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center shadow-lg shadow-purple-500/30">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                </svg>
                            </div>
                        </div>
                        
                        <div class="px-6 pb-8 text-center">
                            <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 text-xs font-bold rounded-full mb-3">DKV</span>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Desain Komunikasi Visual</h3>
                            <p class="text-gray-600 text-sm mb-5 leading-relaxed">
                                Kuasai desain grafis, multimedia, videografi, dan animasi untuk menjadi kreator visual profesional.
                            </p>
                            
                            <div class="flex flex-wrap justify-center gap-2 mb-5">
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">Photoshop</span>
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">Illustrator</span>
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">Video</span>
                            </div>
                            
                            <div class="flex items-center justify-center gap-2 text-purple-600 font-semibold group-hover:gap-4 transition-all">
                                <span>Lihat Detail</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- PPLG - Pengembangan Perangkat Lunak -->
                <a href="{{ route('prokeh.pplg') }}" class="program-card group">
                    <div class="program-card-inner glow-blue relative bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 h-full">
                        <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-500"></div>
                        
                        <div class="pt-8 pb-4 px-6">
                            <div class="program-icon w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/30">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                </svg>
                            </div>
                        </div>
                        
                        <div class="px-6 pb-8 text-center">
                            <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full mb-3">PPLG</span>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Pengembangan Perangkat Lunak & Gim</h3>
                            <p class="text-gray-600 text-sm mb-5 leading-relaxed">
                                Pelajari coding, pengembangan web, aplikasi mobile, dan game development dengan teknologi terkini.
                            </p>
                            
                            <div class="flex flex-wrap justify-center gap-2 mb-5">
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">Web Dev</span>
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">Mobile</span>
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">Game</span>
                            </div>
                            
                            <div class="flex items-center justify-center gap-2 text-emerald-600 font-semibold group-hover:gap-4 transition-all">
                                <span>Lihat Detail</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Kuliner / Tata Boga -->
                <a href="{{ route('prokeh.kuliner') }}" class="program-card group">
                    <div class="program-card-inner glow-blue relative bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 h-full">
                        <div class="h-2 bg-gradient-to-r from-orange-500 to-amber-500"></div>
                        
                        <div class="pt-8 pb-4 px-6">
                            <div class="program-icon w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500 flex items-center justify-center shadow-lg shadow-orange-500/30">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"/>
                                </svg>
                            </div>
                        </div>
                        
                        <div class="px-6 pb-8 text-center">
                            <span class="inline-block px-3 py-1 bg-orange-100 text-orange-700 text-xs font-bold rounded-full mb-3">KLN</span>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Kuliner / Tata Boga</h3>
                            <p class="text-gray-600 text-sm mb-5 leading-relaxed">
                                Kuasai teknik memasak profesional, pastry & bakery, dan manajemen dapur restoran bintang lima.
                            </p>
                            
                            <div class="flex flex-wrap justify-center gap-2 mb-5">
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">Cooking</span>
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">Pastry</span>
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">F&B</span>
                            </div>
                            
                            <div class="flex items-center justify-center gap-2 text-orange-600 font-semibold group-hover:gap-4 transition-all">
                                <span>Lihat Detail</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Perhotelan -->
                <a href="{{ route('prokeh.hotel') }}" class="program-card group md:col-span-2 lg:col-span-1">
                    <div class="program-card-inner glow-blue relative bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 h-full">
                        <div class="h-2 bg-gradient-to-r from-cyan-500 to-sky-500"></div>
                        
                        <div class="pt-8 pb-4 px-6">
                            <div class="program-icon w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-cyan-500 to-sky-500 flex items-center justify-center shadow-lg shadow-cyan-500/30">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                        </div>
                        
                        <div class="px-6 pb-8 text-center">
                            <span class="inline-block px-3 py-1 bg-cyan-100 text-cyan-700 text-xs font-bold rounded-full mb-3">HTL</span>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Perhotelan</h3>
                            <p class="text-gray-600 text-sm mb-5 leading-relaxed">
                                Pelajari hospitality, front office, housekeeping, dan manajemen hotel bertaraf internasional.
                            </p>
                            
                            <div class="flex flex-wrap justify-center gap-2 mb-5">
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">Front Office</span>
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">Housekeeping</span>
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">F&B Service</span>
                            </div>
                            
                            <div class="flex items-center justify-center gap-2 text-cyan-600 font-semibold group-hover:gap-4 transition-all">
                                <span>Lihat Detail</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </section>

    <!-- Industry Partners Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="text-center mb-12">
                <span class="inline-block px-4 py-1.5 bg-gray-100 text-gray-700 text-sm font-semibold rounded-full mb-4">KEMITRAAN INDUSTRI</span>
                <h2 class="text-2xl md:text-4xl font-bold text-gray-900">Dipercaya oleh Industri Terkemuka</h2>
            </div>
            
            <!-- Partner Logos Marquee -->
            <div class="relative overflow-hidden py-8">
                <div class="flex gap-12 items-center justify-center opacity-60 flex-wrap">
                    <div class="text-2xl font-bold text-gray-400">Hotel Indonesia Kempinski</div>
                    <div class="text-2xl font-bold text-gray-400">Marriott</div>
                    <div class="text-2xl font-bold text-gray-400">Bank BCA</div>
                    <div class="text-2xl font-bold text-gray-400">Telkom Indonesia</div>
                    <div class="text-2xl font-bold text-gray-400">Gojek</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section - Gradient with Glass Effect -->
    <section class="relative py-20 overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-[#1E2188] via-[#2a2d9e] to-[#4f46e5]"></div>
        <div class="absolute inset-0 hex-pattern opacity-30"></div>
        
        <!-- Floating Orbs -->
        <div class="absolute top-10 left-10 w-40 h-40 rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-60 h-60 rounded-full bg-purple-500/20 blur-3xl"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4 md:px-6">
            <!-- Glass Card -->
            <div class="bg-white/10 backdrop-blur-xl rounded-3xl p-8 md:p-12 border border-white/20 text-center shadow-2xl">
                <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-white/20 flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Siap Memulai Perjalananmu?</h2>
                <p class="text-blue-100 text-lg mb-8 max-w-2xl mx-auto">
                    Bergabunglah dengan ribuan siswa lainnya yang telah memilih SMK Metland School untuk masa depan cerah mereka.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/ppdb" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-[#1E2188] font-bold rounded-xl hover:bg-gray-100 transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Daftar PPDB Sekarang
                    </a>
                    <a href="/about" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-transparent border-2 border-white text-white font-semibold rounded-xl hover:bg-white/10 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('components.footer')

</body>
</html>