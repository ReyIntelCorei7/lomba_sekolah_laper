<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Keahlian - SMK Metland</title>
    <link rel="icon" href="/image/logometland.png" type="image/png">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body x-data="{ lang: 'id', toggleLang() { this.lang = this.lang === 'id' ? 'en' : 'id'; } }" class="bg-gray-900 text-white">
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

    <!-- Hero Section -->
    <section class="relative pt-24 pb-16">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Program Keahlian</h1>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                Pilih program keahlian sesuai minat dan bakatmu untuk masa depan yang lebih cerah di SMK Metland School
            </p>
        </div>
    </section>

    <!-- Programs Grid -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- AKL -->
                <a href="{{ route('prokeh.akuntansi') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 to-blue-800 h-80 transform hover:scale-105 transition-all duration-300 shadow-xl">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
                    <div class="relative z-10 h-full flex flex-col justify-end p-6">
                        <span class="text-blue-200 text-sm font-semibold tracking-wider mb-2">AKL</span>
                        <h3 class="text-2xl font-bold mb-2">Akuntansi & Keuangan Lembaga</h3>
                        <p class="text-gray-300 text-sm line-clamp-2">Mempelajari siklus akuntansi, komputer akuntansi, dan administrasi pajak untuk menjadi akuntan profesional.</p>
                        <span class="mt-4 text-blue-300 group-hover:translate-x-2 transition-transform inline-flex items-center gap-2">
                            Lihat Detail →
                        </span>
                    </div>
                </a>

                <!-- DKV -->
                <a href="{{ route('prokeh.dkv') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-600 to-purple-800 h-80 transform hover:scale-105 transition-all duration-300 shadow-xl">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
                    <div class="relative z-10 h-full flex flex-col justify-end p-6">
                        <span class="text-purple-200 text-sm font-semibold tracking-wider mb-2">DKV</span>
                        <h3 class="text-2xl font-bold mb-2">Desain Komunikasi Visual</h3>
                        <p class="text-gray-300 text-sm line-clamp-2">Menguasai desain grafis, multimedia, dan animasi untuk menjadi desainer kreatif yang handal.</p>
                        <span class="mt-4 text-purple-300 group-hover:translate-x-2 transition-transform inline-flex items-center gap-2">
                            Lihat Detail →
                        </span>
                    </div>
                </a>

                <!-- PPLG -->
                <a href="{{ route('prokeh.pplg') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-green-600 to-green-800 h-80 transform hover:scale-105 transition-all duration-300 shadow-xl">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
                    <div class="relative z-10 h-full flex flex-col justify-end p-6">
                        <span class="text-green-200 text-sm font-semibold tracking-wider mb-2">PPLG</span>
                        <h3 class="text-2xl font-bold mb-2">Pengembangan Perangkat Lunak & Gim</h3>
                        <p class="text-gray-300 text-sm line-clamp-2">Belajar pemrograman, pengembangan aplikasi web, mobile, dan game development.</p>
                        <span class="mt-4 text-green-300 group-hover:translate-x-2 transition-transform inline-flex items-center gap-2">
                            Lihat Detail →
                        </span>
                    </div>
                </a>

                <!-- Kuliner -->
                <a href="{{ route('prokeh.kuliner') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-orange-600 to-orange-800 h-80 transform hover:scale-105 transition-all duration-300 shadow-xl">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
                    <div class="relative z-10 h-full flex flex-col justify-end p-6">
                        <span class="text-orange-200 text-sm font-semibold tracking-wider mb-2">KLN</span>
                        <h3 class="text-2xl font-bold mb-2">Kuliner</h3>
                        <p class="text-gray-300 text-sm line-clamp-2">Menguasai teknik memasak, pastry, dan manajemen dapur untuk karir di industri kuliner.</p>
                        <span class="mt-4 text-orange-300 group-hover:translate-x-2 transition-transform inline-flex items-center gap-2">
                            Lihat Detail →
                        </span>
                    </div>
                </a>

                <!-- Hotel -->
                <a href="{{ route('prokeh.hotel') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-cyan-600 to-cyan-800 h-80 transform hover:scale-105 transition-all duration-300 shadow-xl">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
                    <div class="relative z-10 h-full flex flex-col justify-end p-6">
                        <span class="text-cyan-200 text-sm font-semibold tracking-wider mb-2">HTL</span>
                        <h3 class="text-2xl font-bold mb-2">Perhotelan</h3>
                        <p class="text-gray-300 text-sm line-clamp-2">Mempelajari manajemen hotel, front office, housekeeping, dan hospitality industry.</p>
                        <span class="mt-4 text-cyan-300 group-hover:translate-x-2 transition-transform inline-flex items-center gap-2">
                            Lihat Detail →
                        </span>
                    </div>
                </a>

            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-indigo-700">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Tertarik Bergabung?</h2>
            <p class="text-blue-100 mb-8">Daftarkan dirimu sekarang dan wujudkan masa depan cerahmu bersama SMK Metland School</p>
            <a href="{{ route('ppdb.create') }}" class="inline-block bg-white text-blue-600 font-bold px-8 py-4 rounded-xl hover:bg-gray-100 transition shadow-xl">
                Daftar PPDB Sekarang
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-950 py-8">
        <div class="max-w-7xl mx-auto px-6 text-center text-gray-500">
            <p>&copy; 2024 SMK Metland School. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>