<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metland School - Kurikulum</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Solid Blue Background */
        .gradient-animate {
            background: #1e3a8a;
        }

        /* Static styles - no animations */
        .float-animation {
            /* removed animation */
        }

        .pulse-glow {
            /* removed animation */
        }

        .slide-up {
            /* removed animation */
        }

        /* Static card - no hover effect */
        .card-3d {
            /* no hover transform */
        }

        /* Glass effect */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>

    <!-- Tailwind Config warna -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af',
                        'primary-dark': '#1e3a8a',
                        'primary-light': '#3b82f6',
                        'secondary': '#f59e0b',
                    }
                }
            }
        }
    </script>

</head>

<body
    x-data="{
    lang: 'id',
    t: {
        id: {
            home: 'Beranda',
            about: 'Tentang Sekolah',
            program: 'Program Keahlian',
            curriculum: 'Kurikulum',
            news: 'Berita Sekolah',
        },
        en: {
            home: 'Home',
            about: 'About School',
            program: 'Study Program',
            curriculum: 'Curriculum',
            news: 'School News',
        }
    },
    activeFilter: 'all',
    showShareModal: false,
    currentArticle: null,
    
    filterNews(category) {
        this.activeFilter = category;
    },
    
    shareArticle(title, description) {
        this.currentArticle = { title, description };
        this.showShareModal = true;
        
        if (navigator.share) {
            navigator.share({
                title: title,
                text: description,
                url: window.location.href,
            }).then(() => {
                this.showShareModal = false;
            });
        }
    },
    
    copyLink() {
        navigator.clipboard.writeText(window.location.href);
        alert('Link berhasil disalin ke clipboard!');
        this.showShareModal = false;
    },
    
    toggleLang() {
        this.lang = this.lang === 'id' ? 'en' : 'id';
    }
}"
    class="bg-gray-50 overflow-x-hidden">

    <!-- Navbar Component -->
    <x-navbar :solidBackground="true" :showOnScroll="false" />

<section class="bg-gray-50 min-h-screen">

    <!-- HERO SECTION with School Photo Background -->
    <div class="relative text-white min-h-[70vh] flex items-center overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('image/sekolahsmkmetland.png') }}" alt="SMK Metland" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-[#1a1a1a]/95 via-[#1a1a1a]/70 to-[#1a1a1a]/40 md:from-[#1a1a1a]/90 md:via-[#1a1a1a]/60 md:to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#1a1a1a]/80 via-transparent to-transparent"></div>
        </div>
        
        <div class="container mx-auto px-6 lg:px-16 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="slide-up">
                    <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur rounded-full text-sm font-medium mb-6 border border-white/20">
                        Kurikulum Unggulan SMK Metland
                    </span>
                    <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                        Kurikulum
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-cyan-400">Sekolah</span>
                    </h1>
                    <p class="text-lg md:text-xl text-white max-w-xl leading-relaxed mb-8">
                        Kurikulum yang dirancang untuk membentuk karakter, kompetensi, dan kesiapan masa depan peserta didik menghadapi tantangan industri 4.0.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#tentang-kurikulum" class="px-8 py-4 bg-white text-blue-900 font-semibold rounded-xl shadow-lg">
                            Pelajari Lebih Lanjut
                        </a>
                        <a href="#metode" class="px-8 py-4 bg-white/10 backdrop-blur border border-white/30 text-white font-semibold rounded-xl">
                            Metode Pembelajaran →
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- TENTANG KURIKULUM Section -->
    <div id="tentang-kurikulum" class="py-24 bg-white">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Image Side -->
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-r from-blue-600 to-blue-800 rounded-3xl blur-lg opacity-20"></div>
                    <div class="relative grid grid-cols-2 gap-4">
                        <img src="{{ asset('image/PPLG.png') }}" alt="Pembelajaran" class="rounded-2xl shadow-xl w-full h-48 object-cover">
                        <img src="{{ asset('image/hotel 1.png') }}" alt="Praktik" class="rounded-2xl shadow-xl w-full h-48 object-cover mt-8">
                        <img src="{{ asset('image/kuliner 1.png') }}" alt="Kelas" class="rounded-2xl shadow-xl w-full h-48 object-cover -mt-4">
                        <img src="{{ asset('image/DKV 1.png') }}" alt="Workshop" class="rounded-2xl shadow-xl w-full h-48 object-cover mt-4">
                    </div>
                </div>
                
                <!-- Text Content -->
                <div>
                    <div class="flex items-center gap-4 mb-6">
                        <img src="{{ $logoUrl }}" class="w-16 h-16 drop-shadow-lg">
                        <div>
                            <span class="text-blue-600 font-semibold text-sm uppercase tracking-wider">Tentang Kurikulum</span>
                            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Kurikulum SMK Metland</h2>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">
                        SMK Metland menerapkan kurikulum yang dirancang untuk menjawab tantangan dunia kerja dan perkembangan industri masa kini. Proses pembelajaran tidak hanya berfokus pada teori, tetapi juga pada penguatan keterampilan, karakter, dan sikap profesional peserta didik.
                    </p>
                    
                    <div class="space-y-4">
                        <div class="flex items-start gap-4 p-4 bg-blue-50 rounded-xl border border-blue-100">
                            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Siap Bersaing di Industri</h4>
                                <p class="text-gray-600 text-sm">Kurikulum diselaraskan dengan kebutuhan dunia usaha dan industri</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 bg-blue-50 rounded-xl border border-blue-100">
                            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Melanjutkan Pendidikan</h4>
                                <p class="text-gray-600 text-sm">Persiapan ideal untuk studi lanjut ke jenjang perguruan tinggi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JENIS KURIKULUM Section -->
    <div class="bg-gradient-to-b from-gray-50 to-white py-24">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-block px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold mb-4">Jenis Kurikulum</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Kurikulum yang Kami Terapkan</h2>
                <p class="text-gray-600 text-lg">Pendekatan pembelajaran modern yang mengutamakan pengembangan karakter dan kompetensi</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Kurikulum Merdeka Card -->
                <div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Kurikulum Merdeka</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Memberikan kebebasan belajar bagi siswa dengan pendekatan pembelajaran berbasis proyek dan penguatan karakter.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-gray-700">
                            <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </span>
                            Fleksibilitas Belajar
                        </li>
                        <li class="flex items-center gap-3 text-gray-700">
                            <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </span>
                            Fokus Pengembangan Karakter
                        </li>
                        <li class="flex items-center gap-3 text-gray-700">
                            <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </span>
                            Pembelajaran Berbasis Proyek
                        </li>
                    </ul>
                </div>
                
                <!-- Teaching Factory Card -->
                <div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Teaching Factory</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Model pembelajaran berbasis produksi/jasa yang mengacu pada standar dan prosedur industri nyata.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-gray-700">
                            <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </span>
                            Simulasi Industri Nyata
                        </li>
                        <li class="flex items-center gap-3 text-gray-700">
                            <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </span>
                            Produk/Jasa Berkualitas
                        </li>
                        <li class="flex items-center gap-3 text-gray-700">
                            <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </span>
                            Standar Industri
                        </li>
                    </ul>
                </div>
                
                <!-- Link & Match Card -->
                <div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Link & Match</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Kemitraan strategis dengan industri untuk memastikan lulusan sesuai kebutuhan pasar kerja.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-gray-700">
                            <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </span>
                            Kerja Sama Industri
                        </li>
                        <li class="flex items-center gap-3 text-gray-700">
                            <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </span>
                            Program Magang
                        </li>
                        <li class="flex items-center gap-3 text-gray-700">
                            <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </span>
                            Sertifikasi Kompetensi
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- METODE PEMBELAJARAN Section -->
    <div id="metode" class="py-24 bg-white">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Text Content -->
                <div>
                    <span class="inline-block px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold mb-4">Metode Pembelajaran</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Pendekatan Inovatif dalam Pembelajaran</h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-8">
                        Metode pembelajaran dirancang untuk mendorong siswa berpikir kritis, kreatif, dan mampu memecahkan masalah nyata melalui pengalaman belajar langsung.
                    </p>
                    
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="p-5 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl shadow-md border border-blue-200">
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                </svg>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-2">Project Based Learning</h4>
                            <p class="text-gray-600 text-sm">Pembelajaran berbasis proyek nyata</p>
                        </div>
                        
                        <div class="p-5 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl shadow-md border border-blue-200">
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-2">Praktik Langsung</h4>
                            <p class="text-gray-600 text-sm">Studi kasus dan hands-on experience</p>
                        </div>
                        
                        <div class="p-5 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl shadow-md border border-blue-200">
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-2">Kolaborasi & Presentasi</h4>
                            <p class="text-gray-600 text-sm">Kerja tim dan public speaking</p>
                        </div>
                        
                        <div class="p-5 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl shadow-md border border-blue-200">
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-2">Teknologi Digital</h4>
                            <p class="text-gray-600 text-sm">Pemanfaatan tools modern</p>
                        </div>
                    </div>
                </div>
                
                <!-- Image Side -->
                <div class="relative">
                    <div class="relative">
                        <img src="{{ asset('image/akuntansi1.png') }}" alt="Pembelajaran" class="rounded-3xl shadow-2xl w-full">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-3xl"></div>
                    </div>
                    
                    <!-- Stats Badge -->
                    <div class="absolute -bottom-8 left-8 right-8 bg-white rounded-2xl shadow-xl p-6 backdrop-blur">
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div>
                                <p class="text-3xl font-bold text-blue-600">5</p>
                                <p class="text-gray-600 text-sm">Jurusan</p>
                            </div>
                            <div class="border-x border-gray-200">
                                <p class="text-3xl font-bold text-blue-600">20+</p>
                                <p class="text-gray-600 text-sm">Mitra Industri</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- INDUSTRI / KESIAPAN KERJA Section -->
    <div class="relative gradient-animate text-white py-24 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-20 -left-20 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-blue-400/10 rounded-full blur-3xl"></div>
        </div>
        
        <div class="container mx-auto px-6 lg:px-16 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur rounded-full text-sm font-semibold mb-4 border border-white/20">🏭 Kesiapan Industri</span>
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Kurikulum Berbasis Dunia Industri</h2>
                    <p class="text-blue-100 text-lg leading-relaxed mb-8">
                        Khusus untuk jenjang SMK, kurikulum diselaraskan dengan kebutuhan dunia usaha dan industri melalui program magang, teaching factory, dan kerja sama mitra industri.
                    </p>
                    
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 p-4 glass rounded-xl">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold">Program Magang Industri</h4>
                                <p class="text-blue-200 text-sm">Pengalaman kerja langsung di perusahaan partner</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4 p-4 glass rounded-xl">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold">Sertifikasi Kompetensi</h4>
                                <p class="text-blue-200 text-sm">Pengakuan kompetensi berstandar nasional/internasional</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4 p-4 glass rounded-xl">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold">Teaching Factory</h4>
                                <p class="text-blue-200 text-sm">Pembelajaran produksi dengan standar industri</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Image Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <img src="{{ asset('image/hotel 2.png') }}" alt="Magang" class="rounded-2xl shadow-xl w-full h-48 object-cover">
                    <img src="{{ asset('image/kuliner 2.png') }}" alt="Praktik" class="rounded-2xl shadow-xl w-full h-48 object-cover mt-8">
                    <img src="{{ asset('image/DKV 2.png') }}" alt="Sertifikasi" class="rounded-2xl shadow-xl w-full h-48 object-cover -mt-4">
                    <img src="{{ asset('image/PPLG 1.png') }}" alt="Industri" class="rounded-2xl shadow-xl w-full h-48 object-cover mt-4">
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-20 bg-gray-50">
        <div class="container mx-auto px-6 lg:px-16">
            <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 rounded-3xl p-12 md:p-16 text-center text-white relative overflow-hidden">
                <!-- Decorative Elements -->
                <div class="absolute inset-0 overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="absolute -bottom-10 -left-10 w-60 h-60 bg-blue-400/10 rounded-full blur-2xl"></div>
                </div>
                
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Siap Bergabung dengan SMK Metland?</h2>
                    <p class="text-blue-100 text-lg mb-8 max-w-2xl mx-auto">
                        Daftarkan diri Anda dan jadilah bagian dari generasi unggul yang siap menghadapi tantangan industri masa depan.
                    </p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="/ppdb" class="px-8 py-4 bg-white text-blue-900 font-bold rounded-xl shadow-lg">
                            Daftar Sekarang
                        </a>
                        <a href="/prokeh" class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-xl">
                            Lihat Program Keahlian
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@include('components.footer')

<script src="//unpkg.com/alpinejs" defer></script>

</body>

</html>