<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akuntansi & Keuangan Lembaga - SMK Metland School</title>
    <meta name="description" content="Program keahlian Akuntansi dan Keuangan Lembaga SMK Metland - Kuasai siklus akuntansi dan menjadi akuntan profesional">
    <link rel="icon" href="/image/logometland.png" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Translation System -->
    @include('partials.translations')

    <style>
        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Gradient text animation */
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
            animation: gradient-shift 4s ease infinite;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Floating animation */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        .floating-delay {
            animation: float 6s ease-in-out infinite;
            animation-delay: 2s;
        }

        /* Card hover effects */
        .skill-card {
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .skill-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(30, 33, 136, 0.25);
        }

        /* Pulse glow effect */
        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
            }

            50% {
                box-shadow: 0 0 40px rgba(59, 130, 246, 0.6);
            }
        }

        .pulse-glow {
            animation: pulse-glow 3s ease-in-out infinite;
        }

        /* Marquee animation */
        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .marquee-content {
            animation: marquee 30s linear infinite;
        }
    </style>
</head>

<body x-data="{ 
    activeTab: 'materi',
    showVideo: false
}" class="bg-gray-50">

    <!-- Navbar Component -->
    @include('components.navbar', ['solidBackground' => true, 'showOnScroll' => false])

    <!-- Hero Section - Full Screen with Parallax -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0">
            <img src="{{ asset('image/1.png') }}" alt="Akuntansi SMK Metland"
                class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-br from-[#1E2188]/90 via-slate-900/80 to-[#1E2188]/90"></div>
        </div>

        <!-- Floating Decorative Elements -->
        <div class="absolute top-20 left-10 w-32 h-32 rounded-full bg-blue-500/20 blur-3xl floating"></div>
        <div class="absolute bottom-40 right-20 w-48 h-48 rounded-full bg-indigo-500/20 blur-3xl floating-delay"></div>
        <div class="absolute top-1/2 left-1/4 w-20 h-20 rounded-full bg-blue-400/10 blur-2xl"></div>

        <!-- Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 md:px-6 py-32 text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white mb-8">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-400"></span>
                </span>
                <span class="text-sm font-medium">Program Keahlian Unggulan</span>
            </div>

            <!-- Main Title -->
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white mb-6 leading-tight">
                Akuntansi & <br class="hidden md:block">
                <span class="animated-gradient">Keuangan Lembaga</span>
            </h1>

            <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto mb-10 leading-relaxed">
                Kuasai siklus akuntansi, komputer akuntansi, dan administrasi pajak untuk menjadi akuntan profesional yang handal dan siap kerja.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                <a href="/ppdb" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-[#1E2188] font-bold rounded-xl hover:bg-blue-50 transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Daftar Sekarang
                </a>
                <a href="#overview" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-transparent border-2 border-white/50 text-white font-semibold rounded-xl hover:bg-white/10 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Pelajari Lebih Lanjut
                </a>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-3 gap-4 md:gap-8 max-w-2xl mx-auto">
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 md:p-6 border border-white/20">
                    <div class="text-3xl md:text-4xl font-bold text-white stat-number">7+</div>
                    <div class="text-xs md:text-sm text-blue-200 uppercase tracking-wider">Kompetensi</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 md:p-6 border border-white/20">
                    <div class="text-3xl md:text-4xl font-bold text-white stat-number">95%</div>
                    <div class="text-xs md:text-sm text-blue-200 uppercase tracking-wider">Kerja/Kuliah</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 md:p-6 border border-white/20">
                    <div class="text-3xl md:text-4xl font-bold text-white stat-number">10+</div>
                    <div class="text-xs md:text-sm text-blue-200 uppercase tracking-wider">Mitra Industri</div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
            <a href="#overview" class="text-white/60 hover:text-white transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </a>
        </div>
    </section>

    <!-- Overview Section -->
    <section id="overview" class="py-20 md:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <!-- Left Content -->
                <div>
                    <span class="inline-block px-4 py-1.5 bg-blue-100 text-blue-700 text-sm font-semibold rounded-full mb-6">TENTANG PROGRAM</span>
                    <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        Menjadi <span class="text-[#1E2188]">Akuntan Profesional</span> Dimulai dari Sini
                    </h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-8">
                        Kompetensi keahlian Akuntansi di SMK Metland meliputi pembelajaran Akuntansi Manual dan Akuntansi Komputer (MYOB, Zahir). Program ini bertujuan agar siswa dapat menguasai akuntansi untuk berbagai jenis perusahaan - jasa, dagang, manufaktur, hingga perhotelan.
                    </p>

                    <!-- Key Features -->
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-[#1E2188]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Kurikulum Industri</h3>
                                <p class="text-gray-600">Materi sesuai standar industri terkini</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-[#1E2188]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Praktik Langsung</h3>
                                <p class="text-gray-600">Simulasi di lab komputer modern</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-[#1E2188]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Sertifikasi Profesi</h3>
                                <p class="text-gray-600">Lulus dengan sertifikat kompetensi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Image -->
                <div class="relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                        <img src="{{ asset('image/2.png') }}" alt="Siswa Akuntansi" class="w-full h-auto">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1E2188]/50 to-transparent"></div>
                    </div>

                    <!-- Floating Card -->
                    <div class="absolute -bottom-6 -left-6 md:-left-12 bg-white rounded-2xl shadow-xl p-4 md:p-6 border border-gray-100 pulse-glow">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#1E2188] to-blue-600 flex items-center justify-center">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">Rp 5-15 Jt</div>
                                <div class="text-gray-500 text-sm">Gaji Awal Lulusan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tab Section - Curriculum & Careers -->
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <span class="inline-block px-4 py-1.5 bg-blue-100 text-blue-700 text-sm font-semibold rounded-full mb-4">KURIKULUM & KARIR</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Apa yang Akan Kamu Pelajari?</h2>
            </div>

            <!-- Tab Navigation -->
            <div class="flex justify-center mb-12">
                <div class="inline-flex bg-gray-100 rounded-xl p-1.5">
                    <button @click="activeTab = 'materi'"
                        :class="activeTab === 'materi' ? 'bg-white shadow-lg text-[#1E2188]' : 'text-gray-600 hover:text-gray-900'"
                        class="px-6 py-3 rounded-lg font-semibold transition-all">
                        📚 Materi Pembelajaran
                    </button>
                    <button @click="activeTab = 'karir'"
                        :class="activeTab === 'karir' ? 'bg-white shadow-lg text-[#1E2188]' : 'text-gray-600 hover:text-gray-900'"
                        class="px-6 py-3 rounded-lg font-semibold transition-all">
                        💼 Peluang Karir
                    </button>
                </div>
            </div>

            <!-- Tab Content: Materi -->
            <div x-show="activeTab === 'materi'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Skill Card 1 -->
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#1E2188] to-blue-600 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Akuntansi Keuangan</h3>
                        <p class="text-gray-600">Dasar-dasar siklus akuntansi, jurnal, buku besar, dan penyusunan laporan keuangan.</p>
                    </div>

                    <!-- Skill Card 2 -->
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Komputer Akuntansi</h3>
                        <p class="text-gray-600">Penguasaan software MYOB, Zahir, dan aplikasi spreadsheet untuk akuntansi modern.</p>
                    </div>

                    <!-- Skill Card 3 -->
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-700 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Administrasi Pajak</h3>
                        <p class="text-gray-600">Pemahaman sistem perpajakan Indonesia, perhitungan, dan pelaporan pajak.</p>
                    </div>

                    <!-- Skill Card 4 -->
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#1E2188] to-indigo-600 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Akuntansi Perusahaan Dagang</h3>
                        <p class="text-gray-600">Perlakuan akuntansi khusus untuk transaksi jual-beli dan persediaan barang.</p>
                    </div>

                    <!-- Skill Card 5 -->
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-600 to-[#1E2188] flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Akuntansi Manufaktur</h3>
                        <p class="text-gray-600">Perhitungan biaya produksi dan akuntansi untuk perusahaan industri.</p>
                    </div>

                    <!-- Skill Card 6 -->
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-600 to-blue-500 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Ekonomi & Bisnis</h3>
                        <p class="text-gray-600">Dasar-dasar ekonomi, manajemen bisnis, dan kewirausahaan.</p>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Karir -->
            <div x-show="activeTab === 'karir'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Career Card 1 -->
                    <div class="skill-card bg-gradient-to-br from-[#1E2188] to-blue-700 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">💰</div>
                        <h3 class="text-xl font-bold mb-2">Staff Akuntansi</h3>
                        <p class="text-blue-100 text-sm">Mengelola pembukuan dan laporan keuangan perusahaan</p>
                    </div>

                    <!-- Career Card 2 -->
                    <div class="skill-card bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">🏦</div>
                        <h3 class="text-xl font-bold mb-2">Teller Bank</h3>
                        <p class="text-blue-100 text-sm">Melayani transaksi nasabah di perbankan</p>
                    </div>

                    <!-- Career Card 3 -->
                    <div class="skill-card bg-gradient-to-br from-indigo-600 to-blue-800 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">📊</div>
                        <h3 class="text-xl font-bold mb-2">Tax Officer</h3>
                        <p class="text-blue-100 text-sm">Mengurus administrasi perpajakan perusahaan</p>
                    </div>

                    <!-- Career Card 4 -->
                    <div class="skill-card bg-gradient-to-br from-[#1E2188] to-indigo-600 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">📝</div>
                        <h3 class="text-xl font-bold mb-2">Kasir / Cashier</h3>
                        <p class="text-blue-100 text-sm">Mengelola transaksi penjualan harian</p>
                    </div>

                    <!-- Career Card 5 -->
                    <div class="skill-card bg-gradient-to-br from-blue-700 to-[#1E2188] rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">💳</div>
                        <h3 class="text-xl font-bold mb-2">Finance Admin</h3>
                        <p class="text-blue-100 text-sm">Administrasi keuangan dan pembayaran</p>
                    </div>

                    <!-- Career Card 6 -->
                    <div class="skill-card bg-gradient-to-br from-indigo-700 to-blue-600 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">🧮</div>
                        <h3 class="text-xl font-bold mb-2">Juru Penggajian</h3>
                        <p class="text-blue-100 text-sm">Menghitung dan mengelola payroll karyawan</p>
                    </div>

                    <!-- Career Card 7 -->
                    <div class="skill-card bg-gradient-to-br from-blue-600 to-[#1E2188] rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">📦</div>
                        <h3 class="text-xl font-bold mb-2">Admin Gudang</h3>
                        <p class="text-blue-100 text-sm">Mengelola stok dan inventaris barang</p>
                    </div>

                    <!-- Career Card 8 -->
                    <div class="skill-card bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">🎓</div>
                        <h3 class="text-xl font-bold mb-2">Kuliah S1</h3>
                        <p class="text-slate-300 text-sm">Lanjut ke Akuntansi, Manajemen, Ekonomi</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-20 bg-gray-900 text-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 md:px-6 mb-12 text-center">
            <span class="inline-block px-4 py-1.5 bg-white/10 text-white text-sm font-semibold rounded-full mb-4">GALERI KEGIATAN</span>
            <h2 class="text-3xl md:text-4xl font-bold">Suasana Belajar di Jurusan Akuntansi</h2>
        </div>

        <!-- Image Marquee -->
        <div class="relative overflow-hidden">
            <div class="flex gap-6 marquee-content" style="width: max-content;">
                <img src="{{ asset('image/1.png') }}" alt="Kegiatan 1" class="h-64 md:h-80 w-auto rounded-2xl object-cover">
                <img src="{{ asset('image/2.png') }}" alt="Kegiatan 2" class="h-64 md:h-80 w-auto rounded-2xl object-cover">
                <img src="{{ asset('image/3.png') }}" alt="Kegiatan 3" class="h-64 md:h-80 w-auto rounded-2xl object-cover">
                <img src="{{ asset('image/1.png') }}" alt="Kegiatan 4" class="h-64 md:h-80 w-auto rounded-2xl object-cover">
                <img src="{{ asset('image/2.png') }}" alt="Kegiatan 5" class="h-64 md:h-80 w-auto rounded-2xl object-cover">
                <img src="{{ asset('image/3.png') }}" alt="Kegiatan 6" class="h-64 md:h-80 w-auto rounded-2xl object-cover">
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-20 overflow-hidden bg-gradient-to-br from-[#1E2188] via-blue-800 to-[#1E2188]">
        <!-- Pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,<svg xmlns=\" http://www.w3.org/2000/svg\" viewBox=\"0 0 80 80\">
            <circle cx=\"40\" cy=\"40\" r=\"2\" fill=\"white\" /></svg>'); background-size: 40px 40px;">
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 md:px-6 text-center">
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Siap Menjadi Akuntan Profesional?</h2>
            <p class="text-xl text-blue-100 mb-10 max-w-2xl mx-auto">
                Bergabunglah dengan program Akuntansi & Keuangan Lembaga SMK Metland dan wujudkan karirmu!
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/ppdb" class="inline-flex items-center justify-center gap-2 px-10 py-5 bg-white text-[#1E2188] font-bold text-lg rounded-xl hover:bg-gray-100 transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1">
                    Daftar PPDB Sekarang
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
                <a href="/prokeh" class="inline-flex items-center justify-center gap-2 px-10 py-5 bg-transparent border-2 border-white text-white font-semibold text-lg rounded-xl hover:bg-white/10 transition-all">
                    ← Lihat Jurusan Lain
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('components.footer')

</body>

</html>