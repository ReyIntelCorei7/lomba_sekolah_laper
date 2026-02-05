<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metland School - Berita Sekolah</title>

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
    }
}"
class="bg-gray-50 overflow-x-hidden"
>

<!-- Header -->
<header 
    x-data="navbar()" 
    x-init="init()"
    class="fixed top-0 left-0 w-full z-50 transition-all duration-500 ease-out bg-[#1E2188] text-white shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between transition-colors duration-300">


    <!-- Logo -->
        <div class="flex items-center gap-3">
            <img src="{{ asset('image/logometland.png') }}" class="h-8">
            <span class="font-semibold tracking-wide">Metland School</span>
        </div>
            
            <!-- Menu -->
            <nav class="hidden md:flex gap-8 text-sm mr-20 font-medium">
                <a href="/" class="hover:text-primary-light transition" x-text="t[lang].home"></a>
                <a href="/about" class="hover:text-primary-light transition" x-text="t[lang].about"></a>
                <a href="/prokeh" class="hover:text-primary-light transition" x-text="t[lang].program"></a>
                <a href="#" class="hover:text-primary-light transition" x-text="t[lang].curriculum"></a>
                <a href="/news" class="hover:text-primary-light font-semibold transition" x-text="t[lang].news"></a>
            </nav>

             <!-- Language Toggle -->
        <div class="relative flex items-center bg-white/20 rounded-full p-1 text-xs w-20">
            <div
                class="absolute top-1 bottom-1 w-1/2 bg-primary rounded-full transition-all duration-300"
                :class="lang === 'id' ? 'left-1' : 'left-[calc(40%+0.25rem)]'"
            ></div>

            <button
                @click="lang = 'id'"
                class="relative z-10 w-1/2 text-center py-1 transition-colors"
                :class="lang === 'id' ? 'text-white font-semibold' : 'text-gray-200'"
            >ID</button>

            <button
                @click="lang = 'en'"
                class="relative z-10 w-1/2 text-center py-1 transition-colors"
                :class="lang === 'en' ? 'text-white font-semibold' : 'text-gray-200'"
            >EN</button>
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