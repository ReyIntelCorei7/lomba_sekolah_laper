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
    [x-cloak] { display: none !important; }
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
class="bg-gray-50 overflow-x-hidden"
>

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
     <div x-data="{ active: 'sejarah' }" class="bg-gray-100 min-h-screen">

    <!-- HERO HEADER -->
    <section class="relative h-[320px] w-full">
        <img src="/image/sekolahsmkmetland.png" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50"></div>

        <div class="relative z-10 h-full flex flex-col justify-center items-center text-white text-center">
            <h1 class="text-4xl font-bold mb-2">Tentang Sekolah</h1>
            <p class="text-sm text-gray-200">
                Menyelami sejarah, nilai budaya, visi, dan misi Metland School
            </p>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-4 gap-10">

        <!-- SIDEBAR -->
        <div class="space-y-6">

            <!-- CARD 1 -->
            <div @click="active='sejarah'"
                 :class="active==='sejarah' ? 'ring-2 ring-blue-600' : ''"
                 class="bg-white rounded-xl shadow hover:shadow-lg transition cursor-pointer overflow-hidden ease-in-out duration-1000">

                <img src="/image/sekolahsmkmetland.png" class="h-32 w-full object-cover">
                <div class="p-4 text-center font-semibold">Sejarah Sekolah</div>
            </div>
            
            <!-- CARD 2 -->
            <div @click="active='visi'"
                 :class="active==='visi' ? 'ring-2 ring-blue-600' : ''"
                 class="bg-white rounded-xl shadow hover:shadow-lg transition cursor-pointer overflow-hidden ease-in-out duration-1000">

                <img src="/image/sekolahsmkmetland4.png" class="h-32 w-full object-cover">
                <div class="p-4 text-center font-semibold">Visi dan Misi</div>
            </div>

            <!-- CARD 3 -->
            <div @click="active='nilai'"
                 :class="active==='nilai' ? 'ring-2 ring-blue-600' : ''"
                 class="bg-white rounded-xl shadow hover:shadow-lg transition cursor-pointer overflow-hidden ease-in-out duration-1000">

                <img src="/image/gcp.png" class="h-32 w-full object-cover">
                <div class="p-4 text-center font-semibold">Nilai Budaya</div>
            </div>


        </div>

        <!-- MAIN CONTENT -->
        <div class="md:col-span-3">

            <!-- SEJARAH -->
            <div x-show="active==='sejarah'"
                 x-transition:enter="transition-all duration-500 ease-out"
                 x-transition:enter-start="opacity-0 translate-y-6 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition-all duration-300 ease-in"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
                 x-cloak
                 class="bg-white rounded-xl shadow-lg p-10 relative overflow-hidden">

                <div class="relative">
                    <h2 class="text-2xl font-bold mb-2">Sejarah Metland School</h2>
                    <p class="text-sm text-gray-600 mb-6">
                        Membangun generasi unggul melalui pendidikan vokasi yang berkualitas sejak tahun 2010.
                    </p>

                    <p class="text-gray-700 leading-relaxed mb-4">
                        SMK Metland berdiri pada 1 April 2014, oleh Yayasan Pendidikan Metland di kawasan perumahan Metland Transyogi, 
                        bermula dari 12 siswa pada tahun pertama dengan program studi Perhotelan. Pada tahun 2015 bertambah menjadi 185 siswa. 
                        SMK Metland mengembangkan program studi Akuntansi. Multimedia dan Tata Boga, dengan fasilitas gedung sekolah berlantai lima. 
                        SMK Metland mengalami kemajuan yang signifikan pada bulan Juli 2020, dengan jumlah siswa mencapai 659 yang terbagi dalam empat program studi. 
                        Berbagai macam penghargaan dan prestasi telah diraih baik tingkat Nasional maupun ASEAN. Berbekal dengan akreditasi A (unggul) yang diperoleh pada tahun 2017, 
                        untuk seluruh program studi dan institusi, SMK Metland dengan penuh rasa percaya diri mengembangkan jaringan kerjasama dengan lembaga pendidikan dan industri di kawasan ASEAN dan Nasional. 
                        Pada tahun 2019 SMK Metland berhasil mendapatkan sertifikat ISO 9001:2015 dalam pengelolaan sekolah. Hal ini membuktikan bahwa SMK Metland dikelola oleh sebuah manajemen yang profesional. 
                        Pada April 2020 BNSP (Badan Nasional Sertifikasi Profesi) telah menerbitkan sertifikat lisensi LSP-P1 yang diberikan kepada SMK Metland untuk menjadi penyelenggaraan uji kompetensi dengan standar BNSP dan industri untuk bidang Perhotelan, Tata Boga, Multimedia, Desain Grafis dan Akuntansi.
                    </p>
                </div>
            </div>

            <!-- NILAI BUDAYA -->
            <div x-show="active==='nilai'"
                 x-transition:enter="transition-all duration-500 ease-out"
                 x-transition:enter-start="opacity-0 translate-y-6 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition-all duration-300 ease-in"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
                 x-cloak
                 class="bg-white rounded-xl shadow-lg p-10">
 
    
        <div class="grid md:grid-cols-2 gap-6 items-center">
            <div>
                <h2 class="text-2xl font-bold mb-2">Nilai Budaya Sekolah</h2>
                    <p class="text-sm text-gray-600 mb-6">Generasi CInta Prestasi</p>
                    <p class="text-gray-700 mb-2">Cinta Kepada Tuhan</p>
                    <p class="text-gray-700 mb-2">Cinta Dan Hormat kepada orang tua</p>
                    <p class="text-gray-700 mb-2">Cinta Dan Hormat Kepada Guru</p>
                    <p class="text-gray-700 mb-2">Cinta Ilmu Pengetahuan</p>
                    <p class="text-gray-700 mb-2">Cinta Bangsa Dan Tanah Air</p>
                    <p class="text-gray-700 mb-2">Cinta Alam, Lingkungan Dan Budaya</p>
                    <p class="text-gray-700 mb-2">Cinta Sahabat Dan Sesama</p>
                    <p class="text-gray-700 mb-2">Cinta Diri Sendiri</p>
            </div>
            <div>
                <img src="image/GCP2.png" alt="" width="200" height="200" class="mx-auto">
            </div>
        </div>
        
            </div>

            <!-- VISI MISI -->
            <div x-show="active==='visi'"
                 x-transition:enter="transition-all duration-500 ease-out"
                 x-transition:enter-start="opacity-0 translate-y-6 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition-all duration-300 ease-in"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
                 x-cloak
                 class="bg-white rounded-xl shadow-lg p-10">

                <h2 class="text-2xl font-bold mb-4">Visi dan Misi</h2>
                <p class="text-sm text-gray-600 mb-6">Visi Smk Metland</p>
                <p class="text-gray-700 leading-relaxed">
                    "Menjadi SMK Yang Lulusannya Memiliki Performa Karakter Unggul Dan Berkompetensi Berstandar Internasional"
                </p>
                <p class="text-sm text-gray-600 mb-6">Misi Smk Metland</p>
                <p class="text-gray-700 leading-relaxed">
                    1. Memberikan layanan pendidikan bagi peserta didik yang berorientasi pada pengembangan knowledge, skill, dan attitude berbasis industri 4.0, serta menguatkan karakter GENERASI CINTA PRESTASI yang sesuai dengan tuntutan dunia industri
                </p>
                <p class="text-gray-700 leading-relaxed">
                    2. Mengembangkan profesionalisme guru berdasarkan nilai-nilai METLAND SCHOOL TEACHER’S VALUE dan mampu beradaptasi dengan tuntutan industri 4.0
                </p>
                <p class="text-gray-700 leading-relaxed">
                    3. Mengembangkan jaringan kerjasama kemitraan dengan DUDI dan perguruan tinggi vokasi baik di dalam maupun di luar negeri untuk pengembangan program akademik
                </p>
                <p class="text-gray-700 leading-relaxed">
                    4. Mengembangkan jaringan kerjasama dengan DUDI di dalam dan di luar negeri untuk mewujudkan zero unemployment lulusan
                </p>
            </div>

        </div>
    </section>

</div>

<script src="//unpkg.com/alpinejs" defer></script>

</body>
</html>