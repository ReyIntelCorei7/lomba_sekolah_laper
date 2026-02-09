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
        .particle {
            position: absolute;
            width: 8px;
            height: 8px;
            background: rgba(59, 130, 246, 0.3);
            border-radius: 50%;
            animation: float 15s infinite ease-in-out;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) translateX(0) rotate(0deg);
                opacity: 0.3;
            }

            25% {
                transform: translateY(-100px) translateX(50px) rotate(90deg);
                opacity: 0.6;
            }

            50% {
                transform: translateY(-50px) translateX(-30px) rotate(180deg);
                opacity: 0.4;
            }

            75% {
                transform: translateY(-150px) translateX(-50px) rotate(270deg);
                opacity: 0.7;
            }
        }

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

        .program-icon {
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .program-card:hover .program-icon {
            transform: translateZ(30px) translateY(-10px) scale(1.1);
        }

        .glow::before {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 1.5rem;
            opacity: 0;
            transition: opacity 0.5s ease;
            z-index: -1;
            filter: blur(15px);
        }

        .program-card:hover .glow::before {
            opacity: 0.6;
        }

        @keyframes gradient-shift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .animated-gradient {
            background: linear-gradient(135deg, #60a5fa, #3b82f6, #60a5fa);
            background-size: 300% 300%;
            animation: gradient-shift 6s ease infinite;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hex-pattern {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='28' height='49' viewBox='0 0 28 49'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%233b82f6' fill-opacity='0.05'%3E%3Cpath d='M13.99 9.25l13 7.5v15l-13 7.5L1 31.75v-15l12.99-7.5zM3 17.9v12.7l10.99 6.34 11-6.35V17.9l-11-6.34L3 17.9zM0 15l12.98-7.5V0h-2v6.35L0 12.69v2.3zm0 18.5L12.98 41v8h-2v-6.85L0 35.81v-2.3zM15 0v7.5L27.99 15H28v-2.31h-.01L17 6.35V0h-2zm0 49v-8l12.99-7.5H28v2.31h-.01L17 42.15V49h-2z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- Navbar Component -->
    <x-navbar :solid-background="true" :show-on-scroll="false" />

    <!-- Hero Section with Animated Background -->
    <section class="relative min-h-[500px] md:min-h-[600px] w-full overflow-hidden mt-16">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-br from-[#1E2188] via-[#2a2d9e] to-[#0f1054]"></div>

            <div class="absolute inset-0 hex-pattern opacity-50"></div>

            <div class="particle" style="left: 10%; top: 20%; animation-delay: 0s;"></div>
            <div class="particle" style="left: 20%; top: 60%; animation-delay: 2s; width: 12px; height: 12px;"></div>
            <div class="particle" style="left: 70%; top: 30%; animation-delay: 4s;"></div>
            <div class="particle" style="left: 80%; top: 70%; animation-delay: 6s; width: 10px; height: 10px;"></div>
            <div class="particle" style="left: 50%; top: 80%; animation-delay: 8s;"></div>

            <div class="absolute top-20 left-10 w-64 h-64 rounded-full bg-blue-500/20 blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-20 w-80 h-80 rounded-full bg-purple-500/20 blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
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
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl px-6 py-4 border border-white/20">
                        <div class="text-3xl md:text-4xl font-bold text-white">5</div>
                        <div class="text-xs md:text-sm text-blue-200 uppercase tracking-wider">Program</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl px-6 py-4 border border-white/20">
                        <div class="text-3xl md:text-4xl font-bold text-white">100+</div>
                        <div class="text-xs md:text-sm text-blue-200 uppercase tracking-wider">Mitra Industri</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl px-6 py-4 border border-white/20">
                        <div class="text-3xl md:text-4xl font-bold text-white">95%</div>
                        <div class="text-xs md:text-sm text-blue-200 uppercase tracking-wider">Tingkat Kerja</div>
                    </div>
                </div>

                <!-- Scroll Indicator -->
                <div class="mt-12 animate-bounce">
                    <svg class="w-8 h-8 mx-auto text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
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

            <!-- Programs Grid - Static -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">

                <!-- Akuntansi -->
                <a href="{{ route('prokeh.akuntansi') }}" class="program-card group">
                    <div class="program-card-inner glow relative bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 h-full">
                        <div class="h-2 bg-gradient-to-r from-[#1E2188] to-blue-600"></div>
                        <div class="pt-8 pb-4 px-6">
                            <div class="program-icon w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-[#1E2188] to-blue-600 flex items-center justify-center shadow-lg shadow-blue-500/30 text-3xl">
                                💰
                            </div>
                        </div>
                        <div class="px-6 pb-8 text-center">
                            <div class="inline-block px-3 py-1 bg-blue-100/50 text-blue-700 text-xs font-bold rounded-full mb-3">AKL</div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#1E2188] transition-colors">Akuntansi & Keuangan Lembaga</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">Menjadi ahli keuangan profesional dengan pemahaman akuntansi dan manajemen keuangan yang solid.</p>
                            <div class="flex items-center justify-center gap-1 text-[#1E2188] font-semibold text-sm">
                                Lihat Detail
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- DKV -->
                <a href="{{ route('prokeh.dkv') }}" class="program-card group">
                    <div class="program-card-inner glow relative bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 h-full">
                        <div class="h-2 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                        <div class="pt-8 pb-4 px-6">
                            <div class="program-icon w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/30 text-3xl">
                                🎨
                            </div>
                        </div>
                        <div class="px-6 pb-8 text-center">
                            <div class="inline-block px-3 py-1 bg-blue-100/50 text-blue-700 text-xs font-bold rounded-full mb-3">DKV</div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#1E2188] transition-colors">Desain Komunikasi Visual</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">Ekspresikan kreativitasmu melalui desain grafis, multimedia, dan seni visual yang memukau.</p>
                            <div class="flex items-center justify-center gap-1 text-[#1E2188] font-semibold text-sm">
                                Lihat Detail
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Perhotelan -->
                <a href="{{ route('prokeh.hotel') }}" class="program-card group">
                    <div class="program-card-inner glow relative bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 h-full">
                        <div class="h-2 bg-gradient-to-r from-indigo-500 to-blue-700"></div>
                        <div class="pt-8 pb-4 px-6">
                            <div class="program-icon w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-700 flex items-center justify-center shadow-lg shadow-indigo-500/30 text-3xl">
                                🏨
                            </div>
                        </div>
                        <div class="px-6 pb-8 text-center">
                            <div class="inline-block px-3 py-1 bg-blue-100/50 text-blue-700 text-xs font-bold rounded-full mb-3">HOTEL</div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#1E2188] transition-colors">Perhotelan</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">Kuasai industri hospitality dengan standar pelayanan internasional dan manajemen hotel.</p>
                            <div class="flex items-center justify-center gap-1 text-[#1E2188] font-semibold text-sm">
                                Lihat Detail
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Kuliner -->
                <a href="{{ route('prokeh.kuliner') }}" class="program-card group">
                    <div class="program-card-inner glow relative bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 h-full">
                        <div class="h-2 bg-gradient-to-r from-blue-600 to-[#1E2188]"></div>
                        <div class="pt-8 pb-4 px-6">
                            <div class="program-icon w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-blue-600 to-[#1E2188] flex items-center justify-center shadow-lg shadow-blue-500/30 text-3xl">
                                👨‍🍳
                            </div>
                        </div>
                        <div class="px-6 pb-8 text-center">
                            <div class="inline-block px-3 py-1 bg-blue-100/50 text-blue-700 text-xs font-bold rounded-full mb-3">KULINER</div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#1E2188] transition-colors">Kuliner</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">Jadilah chef profesional dengan menguasai seni memasak dan manajemen dapur modern.</p>
                            <div class="flex items-center justify-center gap-1 text-[#1E2188] font-semibold text-sm">
                                Lihat Detail
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- PPLG -->
                <a href="{{ route('prokeh.pplg') }}" class="program-card group">
                    <div class="program-card-inner glow relative bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 h-full">
                        <div class="h-2 bg-gradient-to-r from-indigo-600 to-blue-600"></div>
                        <div class="pt-8 pb-4 px-6">
                            <div class="program-icon w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-indigo-600 to-blue-600 flex items-center justify-center shadow-lg shadow-blue-500/30 text-3xl">
                                💻
                            </div>
                        </div>
                        <div class="px-6 pb-8 text-center">
                            <div class="inline-block px-3 py-1 bg-blue-100/50 text-blue-700 text-xs font-bold rounded-full mb-3">PPLG</div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#1E2188] transition-colors">Pengembangan Perangkat Lunak & Gim</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">Kuasai pemrograman dan pengembangan software untuk menjadi developer profesional.</p>
                            <div class="flex items-center justify-center gap-1 text-[#1E2188] font-semibold text-sm">
                                Lihat Detail
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-20 bg-gradient-to-br from-[#1E2188] to-[#0f1054] overflow-hidden">
        <div class="absolute inset-0 hex-pattern opacity-30"></div>
        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>

        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">
                Siap Memulai Perjalananmu?
            </h2>
            <p class="text-xl text-blue-200 mb-10 max-w-2xl mx-auto">
                Daftar sekarang dan jadilah bagian dari SMK Metland untuk masa depan yang cerah
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('ppdb.index') }}" class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-white text-[#1E2188] font-bold rounded-2xl hover:bg-blue-50 transition-all duration-300 shadow-2xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Daftar PPDB Online
                </a>
                <a href="{{ route('about') }}" class="inline-flex items-center justify-center gap-3 px-8 py-4 border-2 border-white/30 text-white font-bold rounded-2xl hover:bg-white/10 transition-all duration-300">
                    Tentang Sekolah
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('components.footer')
</body>

</html>