<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metland School - Tentang Sekolah</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Tailwind Config warna -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af',
                        'primary-dark': '#006d6e',
                        'primary-light': '#00a7a8',
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

    <!-- Navbar -->
    <header x-data="{ scrolled: false, menuOpen: false }"
        @scroll.window="scrolled = (window.pageYOffset > 50)"
        class="fixed top-0 left-0 w-full z-50 transition-all duration-500 border-b border-transparent flex items-center"
        :class="scrolled ? 'bg-[#1a1a1a] shadow-lg border-white/10 h-16' : 'bg-[#1a1a1a] h-20'">

        <!-- Main Header Content -->
        <div class="max-w-[1400px] mx-auto h-20 flex items-center justify-between gap-16 relative z-50"
            :class="scrolled ? 'h-16' : 'h-24'">

            <!-- Logo area -->
            <a href="/" class="flex items-center gap-4 group transition-all duration-500"
                :class="menuOpen ? '-translate-y-10 opacity-0 pointer-events-none' : 'translate-y-0 opacity-100'">
                <div class="relative w-12 h-12">
                    <img src="{{ asset('image/logometland.png') }}" class="w-full h-full object-contain transition-transform group-hover:scale-110">
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
                    <a href="/" class="hover:text-blue-400 transition-colors uppercase">Beranda</a>
                    <a href="/about" class="hover:text-blue-400 transition-colors uppercase">Tentang Sekolah</a>
                    <a href="/prokeh" class="hover:text-blue-400 transition-colors uppercase">Program Keahlian</a>
                    <a href="/curriculum" class="hover:text-blue-400 transition-colors uppercase">Kurikulum</a>
                    <a href="/news" class="hover:text-blue-400 transition-colors uppercase">Berita Sekolah</a>
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
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <!-- Mega Menu Overlay -->
        <div class="fixed inset-0 bg-[#1E2188] z-40 transition-transform duration-700 ease-[cubic-bezier(0.16,1,0.3,1)]"
            :class="menuOpen ? 'translate-y-0' : '-translate-y-full'"
            style="top: 0;">

            <div class="max-w-[1400px] mx-auto px-6 pt-32 pb-12 h-full flex flex-col">
                <!-- Header in Menu -->
                <div class="flex items-center gap-4 mb-20 fade-in-up delay-100">
                    <img src="{{ asset('image/logometland.png') }}" class="w-16 h-16 object-contain brightness-0 invert">
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
    </header>

    <!-- Hero Section - Modern Cinematic Design -->
    <div x-data="{ active: 'sejarah' }" class="bg-gray-100 min-h-screen">

        <!-- HERO HEADER - Text Left, Large Photo -->
        <section class="relative h-[500px] w-full overflow-hidden">
            <!-- Background Image with Ken Burns Effect -->
            <div class="absolute inset-0">
                <img src="/image/sekolahsmkmetland.png" class="absolute inset-0 w-full h-full object-cover scale-110 animate-[kenBurns_20s_ease-in-out_infinite_alternate]">
            </div>
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-[#1a1a1a]/90 via-[#1a1a1a]/60 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#1a1a1a]/80 via-transparent to-transparent"></div>

            <!-- Content - Text on Left -->
            <div class="relative z-10 h-full max-w-7xl mx-auto px-6 flex items-center">
                <div class="max-w-2xl mt-20">
                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white text-xs font-medium mb-6">
                        <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                        SMK Pariwisata Terbaik
                    </div>

                    <h1 class="text-5xl md:text-6xl font-bold text-white mb-4 leading-tight">
                        Tentang<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">Sekolah Kami</span>
                    </h1>
                    <p class="text-lg text-gray-300 leading-relaxed max-w-xl">
                        Menyelami sejarah, nilai budaya, visi, dan misi Metland School dalam membentuk generasi unggul dan berkarakter.
                    </p>

                    <!-- Quick Stats -->
                    <div class="flex gap-8 mt-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white">2014</div>
                            <div class="text-xs text-gray-400 uppercase tracking-wider">Didirikan</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white">A</div>
                            <div class="text-xs text-gray-400 uppercase tracking-wider">Akreditasi</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CONTENT - Sidebar Left Layout -->
        <section class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-4 gap-10">

            <!-- SIDEBAR KIRI -->
            <div class="space-y-4">
                <!-- CARD 1 - Sejarah -->
                <div @click="active='sejarah'"
                    :class="active==='sejarah' ? 'ring-2 ring-blue-600 bg-blue-50' : 'bg-white hover:bg-gray-50'"
                    class="rounded-2xl shadow-lg cursor-pointer overflow-hidden transition-all duration-300 transform hover:scale-[1.02]">
                    <img src="/image/sekolahsmkmetland.png" class="h-36 w-full object-cover">
                    <div class="p-4">
                        <div class="flex items-center gap-2 mb-1">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-xs text-blue-600 font-semibold uppercase">History</span>
                        </div>
                        <h3 class="font-bold text-gray-900">Sejarah Sekolah</h3>
                    </div>
                </div>

                <!-- CARD 2 - Visi Misi -->
                <div @click="active='visi'"
                    :class="active==='visi' ? 'ring-2 ring-blue-600 bg-blue-50' : 'bg-white hover:bg-gray-50'"
                    class="rounded-2xl shadow-lg cursor-pointer overflow-hidden transition-all duration-300 transform hover:scale-[1.02]">
                    <img src="/image/sekolahsmkmetland4.png" class="h-36 w-full object-cover">
                    <div class="p-4">
                        <div class="flex items-center gap-2 mb-1">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <span class="text-xs text-indigo-600 font-semibold uppercase">Vision</span>
                        </div>
                        <h3 class="font-bold text-gray-900">Visi dan Misi</h3>
                    </div>
                </div>

                <!-- CARD 3 - Nilai Budaya -->
                <div @click="active='nilai'"
                    :class="active==='nilai' ? 'ring-2 ring-blue-600 bg-blue-50' : 'bg-white hover:bg-gray-50'"
                    class="rounded-2xl shadow-lg cursor-pointer overflow-hidden transition-all duration-300 transform hover:scale-[1.02]">
                    <img src="/image/gcp.png" class="h-36 w-full object-cover">
                    <div class="p-4">
                        <div class="flex items-center gap-2 mb-1">
                            <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span class="text-xs text-pink-600 font-semibold uppercase">Culture</span>
                        </div>
                        <h3 class="font-bold text-gray-900">Nilai Budaya</h3>
                    </div>
                </div>
            </div>

            <!-- MAIN CONTENT KANAN -->
            <div class="md:col-span-3">

                <!-- SEJARAH -->
                <div x-show="active==='sejarah'"
                    x-transition.opacity.duration.500ms
                    x-cloak
                    class="bg-white rounded-2xl shadow-xl p-8 md:p-10">

                    <span class="text-blue-600 font-semibold text-sm uppercase tracking-wider">Jejak Perjalanan</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2 mb-6">Sejarah Metland School</h2>

                    <!-- Image -->
                    <div class="relative mb-8 group">
                        <img src="/image/sekolahsmkmetland.png" class="w-full h-[300px] object-cover rounded-xl shadow-lg">
                        <div class="absolute bottom-4 right-4 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg">
                            <div class="text-xl font-bold">10+ Tahun</div>
                            <div class="text-xs opacity-80">Berdiri</div>
                        </div>
                    </div>

                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed space-y-4">
                        <p>SMK Metland berdiri pada 1 April 2014, oleh Yayasan Pendidikan Metland di kawasan perumahan Metland Transyogi, bermula dari 12 siswa pada tahun pertama dengan program studi Perhotelan.</p>

                        <p>Pada tahun 2015 bertambah menjadi 185 siswa. SMK Metland mengembangkan program studi Akuntansi, Multimedia dan Tata Boga, dengan fasilitas gedung sekolah berlantai lima.</p>

                        <p>SMK Metland mengalami kemajuan yang signifikan pada bulan Juli 2020, dengan jumlah siswa mencapai 659 yang terbagi dalam empat program studi. Berbagai macam penghargaan dan prestasi telah diraih baik tingkat Nasional maupun ASEAN.</p>

                        <p>Berbekal dengan akreditasi A (unggul) yang diperoleh pada tahun 2017 dan sertifikat ISO 9001:2015 pada tahun 2019, SMK Metland terus berkembang menjadi institusi pendidikan vokasi terdepan.</p>
                    </div>

                    <!-- Achievement Badges -->
                    <div class="flex flex-wrap gap-3 mt-8">
                        <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-medium">✓ Akreditasi A</span>
                        <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">✓ ISO 9001:2015</span>
                        <span class="px-4 py-2 bg-purple-100 text-purple-700 rounded-full text-sm font-medium">✓ LSP-P1 BNSP</span>
                    </div>
                </div>

                <!-- VISI MISI -->
                <div x-show="active==='visi'"
                    x-transition.opacity.duration.500ms
                    x-cloak
                    class="bg-white rounded-2xl shadow-xl p-8 md:p-10">

                    <span class="text-indigo-600 font-semibold text-sm uppercase tracking-wider">Visi & Misi</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2 mb-6">Visi dan Misi SMK Metland</h2>

                    <!-- Image -->
                    <div class="relative mb-8 group">
                        <img src="/image/sekolahsmkmetland4.png" class="w-full h-[300px] object-cover rounded-xl shadow-lg">
                        <div class="absolute bottom-4 right-4 bg-indigo-600 text-white px-4 py-2 rounded-lg shadow-lg">
                            <div class="text-xl font-bold">Visi Misi</div>
                            <div class="text-xs opacity-80">SMK Metland</div>
                        </div>
                    </div>

                    <!-- Visi Section -->
                    <div class="mb-8">
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <span class="text-blue-600 font-semibold text-sm uppercase tracking-wider">Visi Kami</span>
                        </div>
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border-l-4 border-blue-600">
                            <p class="text-lg md:text-xl text-gray-800 font-medium leading-relaxed italic">
                                "Menjadi SMK Yang Lulusannya Memiliki Performa Karakter Unggul Dan Berkompetensi Berstandar Internasional"
                            </p>
                        </div>
                    </div>

                    <!-- Misi Section -->
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            <span class="text-indigo-600 font-semibold text-sm uppercase tracking-wider">Misi Kami</span>
                        </div>

                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed space-y-4">
                            <div class="flex gap-4 p-5 bg-gradient-to-r from-blue-50 to-white rounded-xl border border-blue-100">
                                <div class="w-10 h-10 bg-blue-600 text-white rounded-lg flex items-center justify-center text-lg font-bold shrink-0">1</div>
                                <p class="text-gray-700 leading-relaxed m-0">Memberikan layanan pendidikan bagi peserta didik yang berorientasi pada pengembangan knowledge, skill, dan attitude berbasis industri 4.0, serta menguatkan karakter GENERASI CINTA PRESTASI.</p>
                            </div>

                            <div class="flex gap-4 p-5 bg-gradient-to-r from-indigo-50 to-white rounded-xl border border-indigo-100">
                                <div class="w-10 h-10 bg-indigo-600 text-white rounded-lg flex items-center justify-center text-lg font-bold shrink-0">2</div>
                                <p class="text-gray-700 leading-relaxed m-0">Mengembangkan profesionalisme guru berdasarkan nilai-nilai METLAND SCHOOL TEACHER'S VALUE dan mampu beradaptasi dengan tuntutan industri 4.0.</p>
                            </div>

                            <div class="flex gap-4 p-5 bg-gradient-to-r from-purple-50 to-white rounded-xl border border-purple-100">
                                <div class="w-10 h-10 bg-purple-600 text-white rounded-lg flex items-center justify-center text-lg font-bold shrink-0">3</div>
                                <p class="text-gray-700 leading-relaxed m-0">Mengembangkan jaringan kerjasama kemitraan dengan DUDI dan perguruan tinggi vokasi baik di dalam maupun di luar negeri untuk pengembangan program akademik.</p>
                            </div>

                            <div class="flex gap-4 p-5 bg-gradient-to-r from-cyan-50 to-white rounded-xl border border-cyan-100">
                                <div class="w-10 h-10 bg-cyan-600 text-white rounded-lg flex items-center justify-center text-lg font-bold shrink-0">4</div>
                                <p class="text-gray-700 leading-relaxed m-0">Mengembangkan jaringan kerjasama dengan DUDI di dalam dan di luar negeri untuk mewujudkan zero unemployment lulusan.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Achievement Badges -->
                    <div class="flex flex-wrap gap-3 mt-8">
                        <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">✓ Karakter Unggul</span>
                        <span class="px-4 py-2 bg-indigo-100 text-indigo-700 rounded-full text-sm font-medium">✓ Standar Internasional</span>
                        <span class="px-4 py-2 bg-purple-100 text-purple-700 rounded-full text-sm font-medium">✓ Industri 4.0</span>
                    </div>
                </div>

                <!-- NILAI BUDAYA -->
                <div x-show="active==='nilai'"
                    x-transition.opacity.duration.500ms
                    x-cloak
                    class="bg-white rounded-2xl shadow-xl p-8 md:p-10">

                    <div class="flex flex-col md:flex-row gap-8 items-center">
                        <!-- Image -->
                        <div class="md:w-1/3 flex-shrink-0">
                            <img src="/image/GCP2.png" class="w-full max-w-[250px] mx-auto">
                        </div>

                        <!-- Content -->
                        <div class="md:w-2/3">
                            <span class="text-pink-600 font-semibold text-sm uppercase tracking-wider">Budaya Sekolah</span>
                            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2 mb-2">Nilai Budaya Sekolah</h2>
                            <p class="text-gray-600 mb-6 text-lg">Generasi Cinta Prestasi</p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div class="flex items-center gap-3 p-3 bg-pink-50 rounded-lg">
                                    <span class="text-xl">❤️</span>
                                    <span class="text-gray-700 text-sm font-medium">Cinta Kepada Tuhan</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-rose-50 rounded-lg">
                                    <span class="text-xl">👨‍👩‍👧</span>
                                    <span class="text-gray-700 text-sm font-medium">Cinta Orang Tua</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-purple-50 rounded-lg">
                                    <span class="text-xl">👩‍🏫</span>
                                    <span class="text-gray-700 text-sm font-medium">Cinta Kepada Guru</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                                    <span class="text-xl">📚</span>
                                    <span class="text-gray-700 text-sm font-medium">Cinta Ilmu Pengetahuan</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-red-50 rounded-lg">
                                    <span class="text-xl">🇮🇩</span>
                                    <span class="text-gray-700 text-sm font-medium">Cinta Bangsa & Tanah Air</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-green-50 rounded-lg">
                                    <span class="text-xl">🌍</span>
                                    <span class="text-gray-700 text-sm font-medium">Cinta Lingkungan</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-yellow-50 rounded-lg">
                                    <span class="text-xl">🤝</span>
                                    <span class="text-gray-700 text-sm font-medium">Cinta Sahabat & Sesama</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-indigo-50 rounded-lg">
                                    <span class="text-xl">✨</span>
                                    <span class="text-gray-700 text-sm font-medium">Cinta Diri Sendiri</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </div>

    @include('components.footer')

    <script src="//unpkg.com/alpinejs" defer></script>

</body>

</html>