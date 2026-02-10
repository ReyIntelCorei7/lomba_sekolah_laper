<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perhotelan - SMK Metland School</title>
    <meta name="description" content="Program keahlian Perhotelan SMK Metland - Kuasai hospitality, front office, housekeeping, dan manajemen hotel">
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

<body x-data="{ 
    activeTab: 'materi',
    lang: localStorage.getItem('lang') || 'id',
    t: {
        id: {
            badge: 'Program Keahlian Hospitality',
            title1: 'Perhotelan',
            title2: '& Hospitality',
            subtitle: 'Pelajari hospitality, front office, housekeeping, F&B service, dan manajemen hotel bertaraf internasional untuk karir global.',
            register: 'Daftar Sekarang',
            learnMore: 'Pelajari Lebih Lanjut',
            stat1: 'Hotel Mitra',
            stat2: 'Karir Global',
            stat3: 'Praktik',
            aboutProgram: 'TENTANG PROGRAM',
            overviewTitle: 'Berkarir di Hotel Bintang Lima',
            overviewDesc: 'Program Perhotelan SMK Metland membekali siswa dengan hospitality skills bertaraf internasional. Belajar langsung dengan standar hotel bintang 5 dan praktik di hotel ternama seperti Kempinski, Marriott, dan Hyatt.',
            floatingTitle: 'Global',
            floatingDesc: 'Karir Internasional',
            sectionBadge: 'KURIKULUM & KARIR',
            sectionTitle: 'Apa yang Akan Kamu Pelajari?',
            tabMateri: 'Materi Pembelajaran',
            tabKarir: 'Peluang Karir',
            ctaTitle: 'Siap Berkarir di Industri Hospitality?',
            ctaDesc: 'Bergabunglah dengan program Perhotelan SMK Metland dan wujudkan karir internasionalmu!',
            ctaPpdb: 'Daftar PPDB Sekarang',
            ctaOther: 'Lihat Jurusan Lain'
        },
        en: {
            badge: 'Hospitality Skills Program',
            title1: 'Hospitality',
            title2: '& Hotel Management',
            subtitle: 'Learn hospitality, front office, housekeeping, F&B service, and international hotel management for a global career.',
            register: 'Register Now',
            learnMore: 'Learn More',
            stat1: 'Partner Hotels',
            stat2: 'Global Career',
            stat3: 'Practice',
            aboutProgram: 'ABOUT PROGRAM',
            overviewTitle: 'Career in 5-Star Hotels',
            overviewDesc: 'The Hotel Management program at SMK Metland equips students with international hospitality skills. Learn directly with 5-star hotel standards and practice at renowned hotels like Kempinski, Marriott, and Hyatt.',
            floatingTitle: 'Global',
            floatingDesc: 'International Career',
            sectionBadge: 'CURRICULUM & CAREERS',
            sectionTitle: 'What Will You Learn?',
            tabMateri: 'Learning Materials',
            tabKarir: 'Career Opportunities',
            ctaTitle: 'Ready for a Career in Hospitality?',
            ctaDesc: 'Join the Hotel Management program at SMK Metland and realize your international career!',
            ctaPpdb: 'Register for PPDB Now',
            ctaOther: 'View Other Programs'
        }
    }
}" 
x-init="$watch('$store.lang.current', value => lang = value); window.addEventListener('languageChanged', e => lang = e.detail.lang);" 
class="bg-gray-50">
    @include('components.navbar', ['solidBackground' => true, 'showOnScroll' => false])

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('image/hotel1.png') }}" alt="Perhotelan SMK Metland" class="w-full h-full object-cover">
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
                <span class="text-sm font-medium" x-text="t[lang].badge">Program Keahlian Hospitality</span>
            </div>

            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white mb-6 leading-tight">
                <span x-text="t[lang].title1">Perhotelan</span> <br class="hidden md:block">
                <span class="animated-gradient" x-text="t[lang].title2">& Hospitality</span>
            </h1>

            <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto mb-10 leading-relaxed" x-text="t[lang].subtitle">
                Pelajari hospitality, front office, housekeeping, F&B service, dan manajemen hotel bertaraf internasional untuk karir global.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                <a href="/ppdb" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-[#1E2188] font-bold rounded-xl hover:bg-blue-50 transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span x-text="t[lang].register">Daftar Sekarang</span>
                </a>
                <a href="#overview" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-transparent border-2 border-white/50 text-white font-semibold rounded-xl hover:bg-white/10 transition-all">
                    <span x-text="t[lang].learnMore">Pelajari Lebih Lanjut</span>
                </a>
            </div>

            <div class="grid grid-cols-3 gap-4 md:gap-8 max-w-2xl mx-auto">
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 md:p-6 border border-white/20">
                    <div class="text-3xl md:text-4xl font-bold text-white">5</div>
                    <div class="text-xs md:text-sm text-blue-200 uppercase tracking-wider" x-text="t[lang].stat1">Hotel Mitra</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 md:p-6 border border-white/20">
                    <div class="text-3xl md:text-4xl font-bold text-white">100%</div>
                    <div class="text-xs md:text-sm text-blue-200 uppercase tracking-wider" x-text="t[lang].stat2">Karir Global</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 md:p-6 border border-white/20">
                    <div class="text-3xl md:text-4xl font-bold text-white">100%</div>
                    <div class="text-xs md:text-sm text-blue-200 uppercase tracking-wider" x-text="t[lang].stat3">Praktik</div>
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
                    <span class="inline-block px-4 py-1.5 bg-blue-100 text-blue-700 text-sm font-semibold rounded-full mb-6" x-text="t[lang].aboutProgram">TENTANG PROGRAM</span>
                    <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        <span x-text="t[lang].overviewTitle">Berkarir di Hotel Bintang Lima</span>
                    </h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-8" x-text="t[lang].overviewDesc">
                        Program Perhotelan SMK Metland membekali siswa dengan hospitality skills bertaraf internasional. Belajar langsung dengan standar hotel bintang 5 dan praktik di hotel ternama seperti Kempinski, Marriott, dan Hyatt.
                    </p>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-[#1E2188]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Front Office Operations</h3>
                                <p class="text-gray-600">Check-in, reservasi, guest relations</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-[#1E2188]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Housekeeping</h3>
                                <p class="text-gray-600">Room management, laundry, public area</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-[#1E2188]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">F&B Service</h3>
                                <p class="text-gray-600">Table service, bar, banquet</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                        <img src="{{ asset('image/hotel 2.png') }}" alt="Siswa Perhotelan" class="w-full h-auto">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1E2188]/50 to-transparent"></div>
                    </div>

                    <div class="absolute -bottom-6 -left-6 md:-left-12 bg-white rounded-2xl shadow-xl p-4 md:p-6 border border-gray-100 pulse-glow">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#1E2188] to-blue-600 flex items-center justify-center">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">Global</div>
                                <div class="text-gray-500 text-sm">Karir Internasional</div>
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
                <span class="inline-block px-4 py-1.5 bg-blue-100 text-blue-700 text-sm font-semibold rounded-full mb-4" x-text="t[lang].sectionBadge">KURIKULUM & KARIR</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4" x-text="t[lang].sectionTitle">Apa yang Akan Kamu Pelajari?</h2>
            </div>

            <div class="flex justify-center mb-12">
                <div class="inline-flex bg-gray-100 rounded-xl p-1.5">
                    <button @click="activeTab = 'materi'"
                        :class="activeTab === 'materi' ? 'bg-white shadow-lg text-[#1E2188]' : 'text-gray-600 hover:text-gray-900'"
                        class="px-6 py-3 rounded-lg font-semibold transition-all" x-text="t[lang].tabMateri">
                        🏨 Materi Pembelajaran
                    </button>
                    <button @click="activeTab = 'karir'"
                        :class="activeTab === 'karir' ? 'bg-white shadow-lg text-[#1E2188]' : 'text-gray-600 hover:text-gray-900'"
                        class="px-6 py-3 rounded-lg font-semibold transition-all" x-text="t[lang].tabKarir">
                        ✈️ Peluang Karir
                    </button>
                </div>
            </div>

            <!-- Tab Content: Materi -->
            <div x-show="activeTab === 'materi'" x-transition>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#1E2188] to-blue-600 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Front Office</h3>
                        <p class="text-gray-600">Reservation, check-in/out, concierge, guest relations, dan telephone operator.</p>
                    </div>

                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Housekeeping</h3>
                        <p class="text-gray-600">Room service, laundry, public area, dan room inventory management.</p>
                    </div>

                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-700 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">F&B Service</h3>
                        <p class="text-gray-600">Restaurant service, bar, room service, banquet, dan buffet management.</p>
                    </div>

                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#1E2188] to-indigo-600 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Communication Skills</h3>
                        <p class="text-gray-600">Bahasa Inggris perhotelan, public speaking, dan guest handling.</p>
                    </div>

                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-600 to-[#1E2188] flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Hotel System</h3>
                        <p class="text-gray-600">Opera, Fidelio, dan berbagai software manajemen hotel.</p>
                    </div>

                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-600 to-blue-500 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Service Excellence</h3>
                        <p class="text-gray-600">Grooming, etiquette, complaint handling, dan hospitality mindset.</p>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Karir -->
            <div x-show="activeTab === 'karir'" x-transition>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="skill-card bg-gradient-to-br from-[#1E2188] to-blue-700 rounded-2xl p-6 text-white">
                        <div class="w-12 h-12 mb-4"><svg class="w-full h-full text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg></div>
                        <h3 class="text-xl font-bold mb-2">Receptionist</h3>
                        <p class="text-blue-100 text-sm">Front desk hotel bintang</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-6 text-white">
                        <div class="w-12 h-12 mb-4"><svg class="w-full h-full text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg></div>
                        <h3 class="text-xl font-bold mb-2">Room Division</h3>
                        <p class="text-blue-100 text-sm">Housekeeping supervisor</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-indigo-600 to-blue-800 rounded-2xl p-6 text-white">
                        <div class="w-12 h-12 mb-4"><svg class="w-full h-full text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg></div>
                        <h3 class="text-xl font-bold mb-2">F&B Staff</h3>
                        <p class="text-blue-100 text-sm">Waiter/waitress profesional</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-[#1E2188] to-indigo-600 rounded-2xl p-6 text-white">
                        <div class="w-12 h-12 mb-4"><svg class="w-full h-full text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg></div>
                        <h3 class="text-xl font-bold mb-2">Concierge</h3>
                        <p class="text-blue-100 text-sm">Guest services specialist</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-blue-700 to-[#1E2188] rounded-2xl p-6 text-white">
                        <div class="w-12 h-12 mb-4"><svg class="w-full h-full text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg></div>
                        <h3 class="text-xl font-bold mb-2">Flight Attendant</h3>
                        <p class="text-blue-100 text-sm">Pramugari/pramugara</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-indigo-700 to-blue-600 rounded-2xl p-6 text-white">
                        <div class="w-12 h-12 mb-4"><svg class="w-full h-full text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" /></svg></div>
                        <h3 class="text-xl font-bold mb-2">Cruise Ship</h3>
                        <p class="text-blue-100 text-sm">Karier di kapal pesiar</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-blue-600 to-[#1E2188] rounded-2xl p-6 text-white">
                        <div class="w-12 h-12 mb-4"><svg class="w-full h-full text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg></div>
                        <h3 class="text-xl font-bold mb-2">Event Organizer</h3>
                        <p class="text-blue-100 text-sm">Wedding & MICE planner</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl p-6 text-white">
                        <div class="w-12 h-12 mb-4"><svg class="w-full h-full text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg></div>
                        <h3 class="text-xl font-bold mb-2">Hotel Manager</h3>
                        <p class="text-slate-300 text-sm">Manajemen hotel</p>
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
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-6" x-text="t[lang].ctaTitle">Siap Berkarir di Industri Hospitality?</h2>
            <p class="text-xl text-blue-100 mb-10 max-w-2xl mx-auto" x-text="t[lang].ctaDesc">
                Bergabunglah dengan program Perhotelan SMK Metland dan wujudkan karir internasionalmu!
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/ppdb" class="inline-flex items-center justify-center gap-2 px-10 py-5 bg-white text-[#1E2188] font-bold text-lg rounded-xl hover:bg-gray-100 transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1">
                    <span x-text="t[lang].ctaPpdb">Daftar PPDB Sekarang</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
                <a href="/prokeh" class="inline-flex items-center justify-center gap-2 px-10 py-5 bg-transparent border-2 border-white text-white font-semibold text-lg rounded-xl hover:bg-white/10 transition-all">
                    ← <span x-text="t[lang].ctaOther">Lihat Jurusan Lain</span>
                </a>
            </div>
        </div>
    </section>

    @include('components.footer')
</body>

</html>