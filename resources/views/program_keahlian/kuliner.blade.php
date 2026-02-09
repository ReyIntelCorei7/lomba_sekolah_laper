<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuliner / Tata Boga - SMK Metland School</title>
    <meta name="description" content="Program keahlian Kuliner SMK Metland - Kuasai teknik memasak profesional, pastry, dan manajemen dapur">
    <link rel="icon" href="/image/logometland.png" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Translation System -->
    @include('partials.translations')


    <style>
        html {
            scroll-behavior: smooth;
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
            animation: gradient-shift 4s ease infinite;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

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

        .skill-card {
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .skill-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(30, 33, 136, 0.25);
        }

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
    </style>
</head>

<body x-data="{ activeTab: 'materi' }" class="bg-gray-50">
    @include('components.navbar', ['solidBackground' => true, 'showOnScroll' => false])

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('image/kuliner1.png') }}" alt="Kuliner SMK Metland" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-br from-[#1E2188]/90 via-slate-900/80 to-[#1E2188]/90"></div>
        </div>

        <div class="absolute top-20 left-10 w-32 h-32 rounded-full bg-blue-500/20 blur-3xl floating"></div>
        <div class="absolute bottom-40 right-20 w-48 h-48 rounded-full bg-indigo-500/20 blur-3xl floating-delay"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 md:px-6 py-32 text-center">
            <div class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white mb-8">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-400"></span>
                </span>
                <span class="text-sm font-medium">🍳 Program Keahlian Kuliner</span>
            </div>

            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white mb-6 leading-tight">
                Kuliner / <br class="hidden md:block">
                <span class="animated-gradient">Tata Boga</span>
            </h1>

            <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto mb-10 leading-relaxed">
                Kuasai teknik memasak profesional, pastry & bakery, dan manajemen dapur untuk berkarir di industri kuliner kelas dunia.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                <a href="/ppdb" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-[#1E2188] font-bold rounded-xl hover:bg-blue-50 transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Daftar Sekarang
                </a>
                <a href="#overview" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-transparent border-2 border-white/50 text-white font-semibold rounded-xl hover:bg-white/10 transition-all">
                    Pelajari Lebih Lanjut
                </a>
            </div>

            <div class="grid grid-cols-3 gap-4 md:gap-8 max-w-2xl mx-auto">
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 md:p-6 border border-white/20">
                    <div class="text-3xl md:text-4xl font-bold text-white">100+</div>
                    <div class="text-xs md:text-sm text-blue-200 uppercase tracking-wider">Resep</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 md:p-6 border border-white/20">
                    <div class="text-3xl md:text-4xl font-bold text-white">⭐5</div>
                    <div class="text-xs md:text-sm text-blue-200 uppercase tracking-wider">Hotel Mitra</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 md:p-6 border border-white/20">
                    <div class="text-3xl md:text-4xl font-bold text-white">100%</div>
                    <div class="text-xs md:text-sm text-blue-200 uppercase tracking-wider">Praktik</div>
                </div>
            </div>
        </div>

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
                <div>
                    <span class="inline-block px-4 py-1.5 bg-blue-100 text-blue-700 text-sm font-semibold rounded-full mb-6">TENTANG PROGRAM</span>
                    <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        Menjadi <span class="text-[#1E2188]">Chef Profesional</span> Kelas Dunia
                    </h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-8">
                        Program Kuliner SMK Metland membekali siswa dengan kemampuan memasak profesional, pastry & bakery, food presentation, dan manajemen dapur. Belajar langsung dari chef berpengalaman dengan standar hotel bintang lima.
                    </p>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-[#1E2188]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Chef Profesional</h3>
                                <p class="text-gray-600">Belajar dari chef berpengalaman</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-[#1E2188]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" /></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Pastry & Bakery</h3>
                                <p class="text-gray-600">Kue, roti, dessert profesional</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-[#1E2188]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Magang Hotel</h3>
                                <p class="text-gray-600">Praktik di hotel bintang 4-5</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                        <img src="{{ asset('image/kuliner2.png') }}" alt="Siswa Kuliner" class="w-full h-auto">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1E2188]/50 to-transparent"></div>
                    </div>

                    <div class="absolute -bottom-6 -left-6 md:-left-12 bg-white rounded-2xl shadow-xl p-4 md:p-6 border border-gray-100 pulse-glow">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#1E2188] to-blue-600 flex items-center justify-center">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">Rp 8-20 Jt</div>
                                <div class="text-gray-500 text-sm">Gaji Chef Hotel</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tab Section -->
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="text-center mb-12">
                <span class="inline-block px-4 py-1.5 bg-blue-100 text-blue-700 text-sm font-semibold rounded-full mb-4">KURIKULUM & KARIR</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Apa yang Akan Kamu Pelajari?</h2>
            </div>

            <div class="flex justify-center mb-12">
                <div class="inline-flex bg-gray-100 rounded-xl p-1.5">
                    <button @click="activeTab = 'materi'"
                        :class="activeTab === 'materi' ? 'bg-white shadow-lg text-[#1E2188]' : 'text-gray-600 hover:text-gray-900'"
                        class="px-6 py-3 rounded-lg font-semibold transition-all">
                        🍳 Materi Pembelajaran
                    </button>
                    <button @click="activeTab = 'karir'"
                        :class="activeTab === 'karir' ? 'bg-white shadow-lg text-[#1E2188]' : 'text-gray-600 hover:text-gray-900'"
                        class="px-6 py-3 rounded-lg font-semibold transition-all">
                        👨‍🍳 Peluang Karir
                    </button>
                </div>
            </div>

            <!-- Tab Content: Materi -->
            <div x-show="activeTab === 'materi'" x-transition>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#1E2188] to-blue-600 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 15.536c-1.171 1.952-3.07 1.952-4.242 0-1.172-1.953-1.172-5.119 0-7.072 1.171-1.952 3.07-1.952 4.242 0M8 10.5h4m-4 3h4m9-1.5a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Teknik Memasak</h3>
                        <p class="text-gray-600">Knife skill, teknik dasar memasak: sautéing, grilling, roasting, braising.</p>
                    </div>

                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Pastry & Bakery</h3>
                        <p class="text-gray-600">Pembuatan roti, kue, dessert, dan berbagai hidangan penutup.</p>
                    </div>

                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-700 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Food Safety & Hygiene</h3>
                        <p class="text-gray-600">Standar kebersihan makanan dan keamanan dapur profesional.</p>
                    </div>

                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#1E2188] to-indigo-600 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Food Presentation</h3>
                        <p class="text-gray-600">Plating, garnishing, dan seni penyajian makanan menarik.</p>
                    </div>

                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-600 to-[#1E2188] flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Kitchen Management</h3>
                        <p class="text-gray-600">Manajemen dapur, food cost, dan operasional restoran.</p>
                    </div>

                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-600 to-blue-500 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Internasional Cuisine</h3>
                        <p class="text-gray-600">Masakan Indonesia, Asia, dan Western dengan standar internasional.</p>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Karir -->
            <div x-show="activeTab === 'karir'" x-transition>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="skill-card bg-gradient-to-br from-[#1E2188] to-blue-700 rounded-2xl p-6 text-white">
                        <div class="w-12 h-12 mb-4"><svg class="w-full h-full text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg></div>
                        <h3 class="text-xl font-bold mb-2">Chef de Partie</h3>
                        <p class="text-blue-100 text-sm">Chef di bagian khusus restoran</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-6 text-white">
                        <div class="w-12 h-12 mb-4"><svg class="w-full h-full text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" /></svg></div>
                        <h3 class="text-xl font-bold mb-2">Pastry Chef</h3>
                        <p class="text-blue-100 text-sm">Spesialis kue dan dessert</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-indigo-600 to-blue-800 rounded-2xl p-6 text-white">
                        <div class="w-12 h-12 mb-4"><svg class="w-full h-full text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg></div>
                        <h3 class="text-xl font-bold mb-2">Hotel Chef</h3>
                        <p class="text-blue-100 text-sm">Chef di hotel bintang 4-5</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-[#1E2188] to-indigo-600 rounded-2xl p-6 text-white">
                        <div class="w-12 h-12 mb-4"><svg class="w-full h-full text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" /></svg></div>
                        <h3 class="text-xl font-bold mb-2">Restaurant Owner</h3>
                        <p class="text-blue-100 text-sm">Pemilik restoran sendiri</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-blue-700 to-[#1E2188] rounded-2xl p-6 text-white">
                        <div class="w-12 h-12 mb-4"><svg class="w-full h-full text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" /></svg></div>
                        <h3 class="text-xl font-bold mb-2">Cake Shop Owner</h3>
                        <p class="text-blue-100 text-sm">Usaha kue dan bakery</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-indigo-700 to-blue-600 rounded-2xl p-6 text-white">
                        <div class="w-12 h-12 mb-4"><svg class="w-full h-full text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg></div>
                        <h3 class="text-xl font-bold mb-2">Food Blogger</h3>
                        <p class="text-blue-100 text-sm">Content creator kuliner</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-blue-600 to-[#1E2188] rounded-2xl p-6 text-white">
                        <div class="w-12 h-12 mb-4"><svg class="w-full h-full text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg></div>
                        <h3 class="text-xl font-bold mb-2">Cruise Ship Chef</h3>
                        <p class="text-blue-100 text-sm">Chef di kapal pesiar</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl p-6 text-white">
                        <div class="w-12 h-12 mb-4"><svg class="w-full h-full text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg></div>
                        <h3 class="text-xl font-bold mb-2">Catering Service</h3>
                        <p class="text-slate-300 text-sm">Usaha catering premium</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-20 overflow-hidden bg-gradient-to-br from-[#1E2188] via-blue-800 to-[#1E2188]">
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,<svg xmlns=\" http://www.w3.org/2000/svg\" viewBox=\"0 0 80 80\">
            <circle cx=\"40\" cy=\"40\" r=\"2\" fill=\"white\" /></svg>'); background-size: 40px 40px;">
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 md:px-6 text-center">
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Siap Menjadi Chef Profesional?</h2>
            <p class="text-xl text-blue-100 mb-10 max-w-2xl mx-auto">
                Bergabunglah dengan program Kuliner SMK Metland dan wujudkan karirmu di dapur profesional!
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

    @include('components.footer')
</body>

</html>