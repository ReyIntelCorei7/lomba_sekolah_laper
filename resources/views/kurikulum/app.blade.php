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
                    <img src="{{ $logoUrl }}" class="w-16 h-16 object-contain">
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

<section class="bg-gray-50 min-h-screen">

    <!-- HERO -->
    <div class="bg-blue-900 text-white py-20">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 ml-60 mt-20">Kurikulum Sekolah</h1>
        <p class="max-w-2xl mx-auto text-gray-200 ml-60">
            Kurikulum yang dirancang untuk membentuk karakter, kompetensi, dan kesiapan masa depan peserta didik.
        </p>
    </div>

    <!-- TENTANG KURIKULUM -->
    <div class="max-w-6xl px-6 py-16">
        <div class="flex items-center mb-10">
            <img src="{{ $logoUrl }}" class="w-14 h-14 ml-60">
            <h2 class="text-3xl font-bold text-left mb-6 ml-6 mt-6">Kurikulum SMK Metland</h2>
        </div>
        <p class="text-gray-700 text-left max-w-3xl mx-auto leading-relaxed ml-60">
            SMK Metland menerapkan kurikulum yang dirancang untuk menjawab tantangan dunia kerja dan perkembangan industri masa kini.
            Proses pembelajaran tidak hanya berfokus pada teori, tetapi juga pada penguatan keterampilan, karakter, dan sikap profesional 
            peserta didik agar siap bersaing di dunia industri maupun melanjutkan pendidikan ke jenjang yang lebih tinggi.
        </p>
    </div>

    <!-- JENIS KURIKULUM -->
    <div class="bg-white py-16">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Jenis Kurikulum</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-xl p-6 shadow hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold mb-3">Kurikulum Merdeka</h3>
                    <p class="text-gray-600">
                        Memberikan kebebasan belajar bagi siswa dengan pendekatan
                        pembelajaran berbasis proyek dan penguatan karakter.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- METODE PEMBELAJARAN -->
    <div class="py-16">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Metode Pembelajaran</h2>

            <div class="grid md:grid-cols-2 gap-10">
                <ul class="space-y-4 text-gray-700">
                    <li>✔ Project Based Learning (PjBL)</li>
                    <li>✔ Praktik langsung dan studi kasus</li>
                    <li>✔ Kolaborasi dan presentasi</li>
                    <li>✔ Pemanfaatan teknologi digital</li>
                </ul>

                <div class="bg-blue-50 rounded-xl p-6">
                    <p class="text-gray-700 leading-relaxed">
                        Metode pembelajaran dirancang untuk mendorong siswa berpikir kritis,
                        kreatif, dan mampu memecahkan masalah nyata melalui pengalaman belajar langsung.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- INDUSTRI / KESIAPAN KERJA -->
    <div class="bg-blue-900 text-white py-16">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-6">Kurikulum Berbasis Dunia Industri</h2>
            <p class="max-w-3xl mx-auto text-gray-200 leading-relaxed">
                Khusus untuk jenjang SMK, kurikulum diselaraskan dengan kebutuhan dunia usaha dan industri
                melalui program magang, teaching factory, dan kerja sama mitra industri.
            </p>
        </div>
    </div>

</section>


</div>

@include('components.footer')

<script src="//unpkg.com/alpinejs" defer></script>

</body>

</html>