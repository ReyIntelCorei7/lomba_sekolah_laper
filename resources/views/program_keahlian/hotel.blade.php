<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perhotelan - SMK Metland School</title>
    <meta name="description" content="Program keahlian Perhotelan SMK Metland - Kuasai hospitality, front office, housekeeping, dan manajemen hotel">
    <link rel="icon" href="/image/logometland.png" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
                <span class="text-sm font-medium">🏨 Program Keahlian Hospitality</span>
            </div>

            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white mb-6 leading-tight">
                Perhotelan <br class="hidden md:block">
                <span class="animated-gradient">& Hospitality</span>
            </h1>

            <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto mb-10 leading-relaxed">
                Pelajari hospitality, front office, housekeeping, F&B service, dan manajemen hotel bertaraf internasional untuk karir global.
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
                    <div class="text-3xl md:text-4xl font-bold text-white">⭐5</div>
                    <div class="text-xs md:text-sm text-blue-200 uppercase tracking-wider">Hotel Mitra</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 md:p-6 border border-white/20">
                    <div class="text-3xl md:text-4xl font-bold text-white">🌍</div>
                    <div class="text-xs md:text-sm text-blue-200 uppercase tracking-wider">Karir Global</div>
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
                        Berkarir di <span class="text-[#1E2188]">Hotel Bintang Lima</span>
                    </h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-8">
                        Program Perhotelan SMK Metland membekali siswa dengan hospitality skills bertaraf internasional. Belajar langsung dengan standar hotel bintang 5 dan praktik di hotel ternama seperti Kempinski, Marriott, dan Hyatt.
                    </p>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <span class="text-2xl">🛎️</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Front Office Operations</h3>
                                <p class="text-gray-600">Check-in, reservasi, guest relations</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <span class="text-2xl">🛏️</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Housekeeping</h3>
                                <p class="text-gray-600">Room management, laundry, public area</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <span class="text-2xl">🍽️</span>
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
                        <img src="{{ asset('image/hotel2.png') }}" alt="Siswa Perhotelan" class="w-full h-auto">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1E2188]/50 to-transparent"></div>
                    </div>

                    <div class="absolute -bottom-6 -left-6 md:-left-12 bg-white rounded-2xl shadow-xl p-4 md:p-6 border border-gray-100 pulse-glow">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-[#1E2188] to-blue-600 flex items-center justify-center">
                                <span class="text-2xl">🌍</span>
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
                <span class="inline-block px-4 py-1.5 bg-blue-100 text-blue-700 text-sm font-semibold rounded-full mb-4">KURIKULUM & KARIR</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Apa yang Akan Kamu Pelajari?</h2>
            </div>

            <div class="flex justify-center mb-12">
                <div class="inline-flex bg-gray-100 rounded-xl p-1.5">
                    <button @click="activeTab = 'materi'"
                        :class="activeTab === 'materi' ? 'bg-white shadow-lg text-[#1E2188]' : 'text-gray-600 hover:text-gray-900'"
                        class="px-6 py-3 rounded-lg font-semibold transition-all">
                        🏨 Materi Pembelajaran
                    </button>
                    <button @click="activeTab = 'karir'"
                        :class="activeTab === 'karir' ? 'bg-white shadow-lg text-[#1E2188]' : 'text-gray-600 hover:text-gray-900'"
                        class="px-6 py-3 rounded-lg font-semibold transition-all">
                        ✈️ Peluang Karir
                    </button>
                </div>
            </div>

            <!-- Tab Content: Materi -->
            <div x-show="activeTab === 'materi'" x-transition>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#1E2188] to-blue-600 flex items-center justify-center mb-4">
                            <span class="text-2xl">🛎️</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Front Office</h3>
                        <p class="text-gray-600">Reservation, check-in/out, concierge, guest relations, dan telephone operator.</p>
                    </div>

                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center mb-4">
                            <span class="text-2xl">🛏️</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Housekeeping</h3>
                        <p class="text-gray-600">Room service, laundry, public area, dan room inventory management.</p>
                    </div>

                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-700 flex items-center justify-center mb-4">
                            <span class="text-2xl">🍽️</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">F&B Service</h3>
                        <p class="text-gray-600">Restaurant service, bar, room service, banquet, dan buffet management.</p>
                    </div>

                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#1E2188] to-indigo-600 flex items-center justify-center mb-4">
                            <span class="text-2xl">💼</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Communication Skills</h3>
                        <p class="text-gray-600">Bahasa Inggris perhotelan, public speaking, dan guest handling.</p>
                    </div>

                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-600 to-[#1E2188] flex items-center justify-center mb-4">
                            <span class="text-2xl">💻</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Hotel System</h3>
                        <p class="text-gray-600">Opera, Fidelio, dan berbagai software manajemen hotel.</p>
                    </div>

                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-600 to-blue-500 flex items-center justify-center mb-4">
                            <span class="text-2xl">⭐</span>
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
                        <div class="text-4xl mb-4">🛎️</div>
                        <h3 class="text-xl font-bold mb-2">Receptionist</h3>
                        <p class="text-blue-100 text-sm">Front desk hotel bintang</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">🛏️</div>
                        <h3 class="text-xl font-bold mb-2">Room Division</h3>
                        <p class="text-blue-100 text-sm">Housekeeping supervisor</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-indigo-600 to-blue-800 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">🍷</div>
                        <h3 class="text-xl font-bold mb-2">F&B Staff</h3>
                        <p class="text-blue-100 text-sm">Waiter/waitress profesional</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-[#1E2188] to-indigo-600 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">🧳</div>
                        <h3 class="text-xl font-bold mb-2">Concierge</h3>
                        <p class="text-blue-100 text-sm">Guest services specialist</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-blue-700 to-[#1E2188] rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">✈️</div>
                        <h3 class="text-xl font-bold mb-2">Flight Attendant</h3>
                        <p class="text-blue-100 text-sm">Pramugari/pramugara</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-indigo-700 to-blue-600 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">🚢</div>
                        <h3 class="text-xl font-bold mb-2">Cruise Ship</h3>
                        <p class="text-blue-100 text-sm">Karier di kapal pesiar</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-blue-600 to-[#1E2188] rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">🎯</div>
                        <h3 class="text-xl font-bold mb-2">Event Organizer</h3>
                        <p class="text-blue-100 text-sm">Wedding & MICE planner</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">🏨</div>
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
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Siap Berkarir di Industri Hospitality?</h2>
            <p class="text-xl text-blue-100 mb-10 max-w-2xl mx-auto">
                Bergabunglah dengan program Perhotelan SMK Metland dan wujudkan karir internasionalmu!
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