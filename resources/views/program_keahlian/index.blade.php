<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Keahlian - SMK Metland School</title>
    <meta name="description" content="Pilih program keahlian sesuai minat dan bakatmu untuk masa depan yang cerah di SMK Metland">
    <link rel="icon" href="/image/logometland.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Translation System -->
    @include('partials.translations')

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

<body 
    x-data="{ 
        lang: localStorage.getItem('lang') || 'id',
        t(key) { return $store.lang.t(key); }
    }" 
    x-init="
        $watch('$store.lang.current', value => { lang = value; });
        window.addEventListener('languageChanged', e => { lang = e.detail.lang; });
    "
    x-effect="lang"
    class="bg-gray-50">

    <!-- Navbar Component -->
    <x-navbar :solid-background="true" :show-on-scroll="false" />

    <!-- Hero Section with School Background -->
    <section class="relative h-[400px] md:h-[500px] w-full overflow-hidden">
        <!-- Background Image with Ken Burns Effect -->
        <div class="absolute inset-0">
            <img src="/image/sekolahsmkmetland.png" class="absolute inset-0 w-full h-full object-cover scale-110 animate-[kenBurns_20s_ease-in-out_infinite_alternate]">
        </div>
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#1a1a1a]/95 via-[#1a1a1a]/70 to-[#1a1a1a]/40 md:from-[#1a1a1a]/90 md:via-[#1a1a1a]/60 md:to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#1a1a1a]/80 via-transparent to-transparent"></div>

        <!-- Content - Text on Left -->
        <div class="relative z-10 h-full max-w-7xl mx-auto px-4 md:px-6 flex items-center">
            <div class="max-w-2xl mt-16 md:mt-20">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-3 md:px-4 py-1.5 md:py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white text-[10px] md:text-xs font-medium mb-4 md:mb-6 blur-fade-in-up">
                    <span class="w-1.5 h-1.5 md:w-2 md:h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    <span x-text="$store.lang.t('prokeh_badge')">5 Program Keahlian Unggulan</span>
                </div>

                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-3 md:mb-4 leading-tight blur-fade-in-up delay-100">
                    <span x-text="$store.lang.t('prokeh_title_1')">Program</span><br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400" x-text="$store.lang.t('prokeh_title_2')">Keahlian</span>
                </h1>
                <p class="text-sm md:text-lg text-gray-300 leading-relaxed max-w-xl blur-fade-in-up delay-200" x-text="$store.lang.t('prokeh_subtitle')">
                    Temukan program keahlian yang sesuai dengan passion dan bakatmu.
                    Kembangkan skill profesional untuk karir cemerlang di industri.
                </p>

                <!-- Quick Stats -->
                <div class="flex gap-6 md:gap-8 mt-6 md:mt-8 blur-fade-in-up delay-300">
                    <div class="text-center">
                        <div class="text-2xl md:text-3xl font-bold text-white">5</div>
                        <div class="text-[10px] md:text-xs text-gray-400 uppercase tracking-wider" x-text="$store.lang.t('prokeh_stats_program')">Program</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl md:text-3xl font-bold text-white">20+</div>
                        <div class="text-[10px] md:text-xs text-gray-400 uppercase tracking-wider" x-text="$store.lang.t('prokeh_stats_partners')">Mitra Industri</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Grid Section -->
    <section class="py-16 md:py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1.5 bg-blue-100 text-blue-700 text-sm font-semibold rounded-full mb-4 blur-fade-in-up" x-text="$store.lang.t('prokeh_section_badge')">PROGRAM KEAHLIAN</span>
                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4 blur-fade-in-up delay-100" x-text="$store.lang.t('prokeh_section_title')">Jurusan Unggulan Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg blur-fade-in-up delay-200" x-text="$store.lang.t('prokeh_section_desc')">
                    Setiap program dirancang untuk membekali siswa dengan skill praktis dan siap kerja
                </p>
            </div>

            <!-- Programs Grid - Static -->
            <div class="flex flex-wrap justify-center gap-8 lg:gap-10">

                <!-- Akuntansi -->
                <a href="{{ route('prokeh.akuntansi') }}" class="program-card group w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.666rem)]">
                    <div class="program-card-inner glow relative bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 h-full">
                        <div class="h-2 bg-gradient-to-r from-[#1E2188] to-blue-600"></div>
                        <div class="pt-8 pb-4 px-6">
                            <div class="program-icon w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-[#1E2188] to-blue-600 flex items-center justify-center shadow-lg shadow-blue-500/30">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="px-6 pb-8 text-center">
                            <div class="inline-block px-3 py-1 bg-blue-100/50 text-blue-700 text-xs font-bold rounded-full mb-3">AKT</div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#1E2188] transition-colors" x-text="$store.lang.t('prokeh_akuntansi_title')">Akuntansi</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3" x-text="$store.lang.t('prokeh_akuntansi_desc')">Menjadi ahli keuangan profesional dengan pemahaman akuntansi dan manajemen keuangan yang solid.</p>
                            <div class="flex items-center justify-center gap-1 text-[#1E2188] font-semibold text-sm">
                                <span x-text="$store.lang.t('prokeh_view_detail')">Lihat Detail</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- DKV -->
                <a href="{{ route('prokeh.dkv') }}" class="program-card group w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.666rem)]">
                    <div class="program-card-inner glow relative bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 h-full">
                        <div class="h-2 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                        <div class="pt-8 pb-4 px-6">
                            <div class="program-icon w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/30">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                </svg>
                            </div>
                        </div>
                        <div class="px-6 pb-8 text-center">
                            <div class="inline-block px-3 py-1 bg-blue-100/50 text-blue-700 text-xs font-bold rounded-full mb-3">DKV</div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#1E2188] transition-colors" x-text="$store.lang.t('prokeh_dkv_title')">Desain Komunikasi Visual</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3" x-text="$store.lang.t('prokeh_dkv_desc')">Ekspresikan kreativitasmu melalui desain grafis, multimedia, dan seni visual yang memukau.</p>
                            <div class="flex items-center justify-center gap-1 text-[#1E2188] font-semibold text-sm">
                                <span x-text="$store.lang.t('prokeh_view_detail')">Lihat Detail</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Perhotelan -->
                <a href="{{ route('prokeh.hotel') }}" class="program-card group w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.666rem)]">
                    <div class="program-card-inner glow relative bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 h-full">
                        <div class="h-2 bg-gradient-to-r from-indigo-500 to-blue-700"></div>
                        <div class="pt-8 pb-4 px-6">
                            <div class="program-icon w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-700 flex items-center justify-center shadow-lg shadow-indigo-500/30">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                        </div>
                        <div class="px-6 pb-8 text-center">
                            <div class="inline-block px-3 py-1 bg-blue-100/50 text-blue-700 text-xs font-bold rounded-full mb-3">HOTEL</div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#1E2188] transition-colors" x-text="$store.lang.t('prokeh_hotel_title')">Perhotelan</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3" x-text="$store.lang.t('prokeh_hotel_desc')">Kuasai industri hospitality dengan standar pelayanan internasional dan manajemen hotel.</p>
                            <div class="flex items-center justify-center gap-1 text-[#1E2188] font-semibold text-sm">
                                <span x-text="$store.lang.t('prokeh_view_detail')">Lihat Detail</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Kuliner -->
                <a href="{{ route('prokeh.kuliner') }}" class="program-card group w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.666rem)]">
                    <div class="program-card-inner glow relative bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 h-full">
                        <div class="h-2 bg-gradient-to-r from-blue-600 to-[#1E2188]"></div>
                        <div class="pt-8 pb-4 px-6">
                            <div class="program-icon w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-blue-600 to-[#1E2188] flex items-center justify-center shadow-lg shadow-blue-500/30">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>
                        <div class="px-6 pb-8 text-center">
                            <div class="inline-block px-3 py-1 bg-blue-100/50 text-blue-700 text-xs font-bold rounded-full mb-3">KULINER</div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#1E2188] transition-colors" x-text="$store.lang.t('prokeh_kuliner_title')">Kuliner</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3" x-text="$store.lang.t('prokeh_kuliner_desc')">Jadilah chef profesional dengan menguasai seni memasak dan manajemen dapur modern.</p>
                            <div class="flex items-center justify-center gap-1 text-[#1E2188] font-semibold text-sm">
                                <span x-text="$store.lang.t('prokeh_view_detail')">Lihat Detail</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- PPLG -->
                <a href="{{ route('prokeh.pplg') }}" class="program-card group w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.666rem)]">
                    <div class="program-card-inner glow relative bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 h-full">
                        <div class="h-2 bg-gradient-to-r from-indigo-600 to-blue-600"></div>
                        <div class="pt-8 pb-4 px-6">
                            <div class="program-icon w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-indigo-600 to-blue-600 flex items-center justify-center shadow-lg shadow-blue-500/30">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                </svg>
                            </div>
                        </div>
                        <div class="px-6 pb-8 text-center">
                            <div class="inline-block px-3 py-1 bg-blue-100/50 text-blue-700 text-xs font-bold rounded-full mb-3">PPLG</div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#1E2188] transition-colors" x-text="$store.lang.t('prokeh_pplg_title')">Pengembangan Perangkat Lunak & Gim</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3" x-text="$store.lang.t('prokeh_pplg_desc')">Kuasai pemrograman dan pengembangan software untuk menjadi developer profesional.</p>
                            <div class="flex items-center justify-center gap-1 text-[#1E2188] font-semibold text-sm">
                                <span x-text="$store.lang.t('prokeh_view_detail')">Lihat Detail</span>
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
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-6" x-text="$store.lang.t('prokeh_cta_title')">
                Siap Memulai Perjalananmu?
            </h2>
            <p class="text-xl text-blue-200 mb-10 max-w-2xl mx-auto" x-text="$store.lang.t('prokeh_cta_desc')">
                Daftar sekarang dan jadilah bagian dari SMK Metland untuk masa depan yang cerah
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('ppdb.index') }}" class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-white text-[#1E2188] font-bold rounded-2xl hover:bg-blue-50 transition-all duration-300 shadow-2xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span x-text="$store.lang.t('prokeh_cta_ppdb')">Daftar PPDB Online</span>
                </a>
                <a href="{{ route('about') }}" class="inline-flex items-center justify-center gap-3 px-8 py-4 border-2 border-white/30 text-white font-bold rounded-2xl hover:bg-white/10 transition-all duration-300">
                    <span x-text="$store.lang.t('prokeh_cta_about')">Tentang Sekolah</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('components.footer')
</body>

</html>