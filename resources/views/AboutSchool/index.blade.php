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

    <x-navbar :solid-background="true" />

    <!-- Hero Section - Modern Cinematic Design -->
    <div x-data="{ active: 'sejarah' }" class="bg-gray-100 min-h-screen">

        <!-- HERO HEADER - Text Left, Large Photo -->
        <section class="relative h-[400px] md:h-[500px] w-full overflow-hidden">
            <!-- Background Image with Ken Burns Effect -->
            <div class="absolute inset-0">
                <img src="/image/sekolahsmkmetland.png" class="absolute inset-0 w-full h-full object-cover scale-110 animate-[kenBurns_20s_ease-in-out_infinite_alternate]">
            </div>
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-[#1a1a1a]/95 via-[#1a1a1a]/70 to-[#1a1a1a]/40 md:from-[#1a1a1a]/90 md:via-[#1a1a1a]/60 md:to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#1a1a1a]/80 via-transparent to-transparent"></div>

            <!-- Content - Text on Left -->
            <div class="relative z-10 h-full max-w-7xl mx-auto px-4 md:px-6 flex items-center">
                <div class="max-w-2xl mt-16 md:mt-20">
                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 px-3 md:px-4 py-1.5 md:py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white text-[10px] md:text-xs font-medium mb-4 md:mb-6">
                        <span class="w-1.5 h-1.5 md:w-2 md:h-2 rounded-full bg-blue-500 animate-pulse"></span>
                        SMK Pariwisata Terbaik
                    </div>

                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-3 md:mb-4 leading-tight">
                        Tentang<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">Sekolah Kami</span>
                    </h1>
                    <p class="text-sm md:text-lg text-gray-300 leading-relaxed max-w-xl">
                        Menyelami sejarah, nilai budaya, visi, dan misi Metland School dalam membentuk generasi unggul dan berkarakter.
                    </p>

                    <!-- Quick Stats -->
                    <div class="flex gap-6 md:gap-8 mt-6 md:mt-8">
                        <div class="text-center">
                            <div class="text-2xl md:text-3xl font-bold text-white">2014</div>
                            <div class="text-[10px] md:text-xs text-gray-400 uppercase tracking-wider">Didirikan</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl md:text-3xl font-bold text-white">A</div>
                            <div class="text-[10px] md:text-xs text-gray-400 uppercase tracking-wider">Akreditasi</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CONTENT - Sidebar Left Layout -->
        <section class="max-w-7xl mx-auto px-4 md:px-6 py-8 md:py-16">
            
            <!-- MOBILE: Horizontal Scrollable Tabs -->
            <div class="md:hidden mb-6 -mx-4 px-4">
                <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-hide">
                    <!-- Tab 1 - Sejarah -->
                    <button @click="active='sejarah'"
                        :class="active==='sejarah' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700'"
                        class="flex-shrink-0 px-4 py-2 rounded-full text-sm font-semibold shadow transition-all">
                        Sejarah
                    </button>
                    <!-- Tab 2 - Visi Misi -->
                    <button @click="active='visi'"
                        :class="active==='visi' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700'"
                        class="flex-shrink-0 px-4 py-2 rounded-full text-sm font-semibold shadow transition-all">
                        Visi & Misi
                    </button>
                    <!-- Tab 3 - Nilai Budaya -->
                    <button @click="active='nilai'"
                        :class="active==='nilai' ? 'bg-blue-600 text-white' : 'bg-white text-gray-700'"
                        class="flex-shrink-0 px-4 py-2 rounded-full text-sm font-semibold shadow transition-all">
                        Nilai Budaya
                    </button>
                </div>
            </div>
            
            <div class="grid md:grid-cols-4 gap-6 md:gap-10">

            <!-- SIDEBAR KIRI (Hidden on Mobile) -->
            <div class="hidden md:block space-y-4">
                <!-- CARD 1 - Sejarah -->
                <div @click="active='sejarah'"
                    :class="active==='sejarah' ? 'ring-2 ring-blue-600 bg-blue-50' : 'bg-white hover:bg-gray-50'"
                    class="rounded-2xl shadow-lg cursor-pointer overflow-hidden transition-all duration-300 transform hover:scale-[1.02]">
                    <img src="/image/sekolahsmkmetland.png" class="h-36 w-full object-cover">
                    <div class="p-4">
                        <div class="flex items-center gap-2 mb-1">
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
                            <span class="text-xs text-blue-600 font-semibold uppercase">Vision & Mission</span>
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
                            <span class="text-xs text-blue-600 font-semibold uppercase">Culture</span>
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
                    class="bg-white rounded-2xl shadow-xl p-5 md:p-8 lg:p-10">

                    <span class="text-blue-600 font-semibold text-xs md:text-sm uppercase tracking-wider">History</span>
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mt-2 mb-4 md:mb-6">Sejarah Metland School</h2>

                    <!-- Image -->
                    <div class="relative mb-6 md:mb-8 group">
                        <img src="/image/sekolahsmkmetland.png" class="w-full h-[200px] md:h-[300px] object-cover rounded-xl shadow-lg">
                        <div class="absolute bottom-3 right-3 md:bottom-4 md:right-4 bg-blue-600 text-white px-3 py-1.5 md:px-4 md:py-2 rounded-lg shadow-lg">
                            <div class="text-base md:text-xl font-bold">10+ Tahun</div>
                            <div class="text-[10px] md:text-xs opacity-80">Berdiri</div>
                        </div>
                    </div>

                    <div class="prose prose-sm md:prose-lg max-w-none text-gray-700 leading-relaxed space-y-3 md:space-y-4">
                        <p class="text-sm md:text-base">SMK Metland berdiri pada 1 April 2014, oleh Yayasan Pendidikan Metland di kawasan perumahan Metland Transyogi, bermula dari 12 siswa pada tahun pertama dengan program studi Perhotelan.</p>

                        <p class="text-sm md:text-base">Pada tahun 2015 bertambah menjadi 185 siswa. SMK Metland mengembangkan program studi Akuntansi, Multimedia dan Tata Boga, dengan fasilitas gedung sekolah berlantai lima.</p>

                        <p class="text-sm md:text-base">SMK Metland mengalami kemajuan yang signifikan pada bulan Juli 2020, dengan jumlah siswa mencapai 659 yang terbagi dalam empat program studi. Berbagai macam penghargaan dan prestasi telah diraih baik tingkat Nasional maupun ASEAN.</p>

                        <p class="text-sm md:text-base">Berbekal dengan akreditasi A (unggul) yang diperoleh pada tahun 2017 dan sertifikat ISO 9001:2015 pada tahun 2019, SMK Metland terus berkembang menjadi institusi pendidikan vokasi terdepan.</p>
                    </div>

                    <!-- Achievement Badges -->
                    <div class="flex flex-wrap gap-2 md:gap-3 mt-6 md:mt-8">
                        <span class="px-3 py-1.5 md:px-4 md:py-2 bg-blue-600 text-white rounded-full text-xs md:text-sm font-medium">✓ Akreditasi A</span>
                        <span class="px-3 py-1.5 md:px-4 md:py-2 bg-blue-600 text-white rounded-full text-xs md:text-sm font-medium">✓ ISO 9001:2015</span>
                        <span class="px-3 py-1.5 md:px-4 md:py-2 bg-blue-600 text-white rounded-full text-xs md:text-sm font-medium">✓ LSP-P1 BNSP</span>
                    </div>
                </div>

                <!-- VISI MISI -->
                <div x-show="active==='visi'"
                    x-transition.opacity.duration.500ms
                    x-cloak
                    class="bg-white rounded-2xl shadow-xl p-5 md:p-8 lg:p-10">

                    <span class="text-indigo-600 font-semibold text-xs md:text-sm uppercase tracking-wider">Vision & Mission</span>
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mt-2 mb-4 md:mb-6">Visi dan Misi SMK Metland</h2>

                    <!-- Image -->
                    <div class="relative mb-6 md:mb-8 group">
                        <img src="/image/sekolahsmkmetland4.png" class="w-full h-[200px] md:h-[300px] object-cover rounded-xl shadow-lg">
                        <div class="absolute bottom-3 right-3 md:bottom-4 md:right-4 bg-indigo-600 text-white px-3 py-1.5 md:px-4 md:py-2 rounded-lg shadow-lg">
                            <div class="text-base md:text-xl font-bold">Visi Misi</div>
                            <div class="text-[10px] md:text-xs opacity-80">SMK Metland</div>
                        </div>
                    </div>

                    <!-- Visi Section -->
                    <div class="mb-8">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-blue-600 font-semibold text-sm uppercase tracking-wider">Visi Kami</span>
                        </div>
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 md:p-6 border-l-4 border-blue-600">
                            <p class="text-base md:text-lg lg:text-xl text-gray-800 font-medium leading-relaxed">
                                " Menjadi SMK Yang Lulusannya Memiliki Performa Karakter Unggul Dan Berkompetensi Berstandar Internasional "
                            </p>
                        </div>
                    </div>

                    <!-- Misi Section -->
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-blue-600 font-semibold text-sm uppercase tracking-wider">Misi Kami</span>
                        </div>

                        <div class="prose prose-sm md:prose-lg max-w-none text-gray-700 leading-relaxed space-y-3 md:space-y-4">
                            <div class="flex gap-3 md:gap-4 p-3 md:p-5 bg-gradient-to-r from-blue-50 to-white rounded-xl border border-blue-100">
                                <div class="w-8 h-8 md:w-10 md:h-10 bg-transparent text-blue-600 rounded-lg flex items-center justify-center text-base md:text-lg font-bold shrink-0">1</div>
                                <p class="text-sm md:text-base text-gray-700 leading-relaxed m-0">Memberikan layanan pendidikan bagi peserta didik yang berorientasi pada pengembangan knowledge, skill, dan attitude berbasis industri 4.0, serta menguatkan karakter GENERASI CINTA PRESTASI.</p>
                            </div>

                            <div class="flex gap-3 md:gap-4 p-3 md:p-5 bg-gradient-to-r from-blue-50 to-white rounded-xl border border-blue-100">
                                <div class="w-8 h-8 md:w-10 md:h-10 bg-transparent text-blue-600 rounded-lg flex items-center justify-center text-base md:text-lg font-bold shrink-0">2</div>
                                <p class="text-sm md:text-base text-gray-700 leading-relaxed m-0">Mengembangkan profesionalisme guru berdasarkan nilai-nilai METLAND SCHOOL TEACHER'S VALUE dan mampu beradaptasi dengan tuntutan industri 4.0.</p>
                            </div>

                            <div class="flex gap-3 md:gap-4 p-3 md:p-5 bg-gradient-to-r from-blue-50 to-white rounded-xl border border-blue-100">
                                <div class="w-8 h-8 md:w-10 md:h-10 bg-transparent text-blue-600 rounded-lg flex items-center justify-center text-base md:text-lg font-bold shrink-0">3</div>
                                <p class="text-sm md:text-base text-gray-700 leading-relaxed m-0">Mengembangkan jaringan kerjasama kemitraan dengan DUDI dan perguruan tinggi vokasi baik di dalam maupun di luar negeri untuk pengembangan program akademik.</p>
                            </div>

                            <div class="flex gap-3 md:gap-4 p-3 md:p-5 bg-gradient-to-r from-blue-50 to-white rounded-xl border border-blue-100">
                                <div class="w-8 h-8 md:w-10 md:h-10 bg-transparent text-blue-600 rounded-lg flex items-center justify-center text-base md:text-lg font-bold shrink-0">4</div>
                                <p class="text-sm md:text-base text-gray-700 leading-relaxed m-0">Mengembangkan jaringan kerjasama dengan DUDI di dalam dan di luar negeri untuk mewujudkan zero unemployment lulusan.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- NILAI BUDAYA -->
                <div x-show="active==='nilai'"
                    x-transition.opacity.duration.500ms
                    x-cloak
                    class="bg-white rounded-2xl shadow-xl p-5 md:p-8 lg:p-10">

                    <div class="flex flex-col md:flex-row gap-6 md:gap-8 items-center">
                        <!-- Image -->
                        <div class="w-full md:w-1/3 flex-shrink-0">
                            <img src="/image/GCP2.png" class="w-full max-w-[180px] md:max-w-[250px] mx-auto">
                        </div>

                        <!-- Content -->
                        <div class="w-full md:w-2/3">
                            <span class="text-pink-600 font-semibold text-xs md:text-sm uppercase tracking-wider">Culture</span>
                            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mt-2 mb-2">Nilai Budaya Sekolah</h2>
                            <p class="text-gray-600 mb-4 md:mb-6 text-base md:text-lg">Generasi Cinta Prestasi</p>
                            <div class="flex items-center gap-2 mb-4 md:mb-6">
                                <div class="w-1 h-5 md:h-6 bg-primary rounded-full"></div>
                                <p class="text-gray-600 text-base md:text-lg font-bold">Cinta</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                                    <span class="text-xl"></span>
                                    <span class="text-gray-700 text-sm font-medium">Cinta Kepada Tuhan</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                                    <span class="text-xl"></span>
                                    <span class="text-gray-700 text-sm font-medium">Cinta Orang Tua</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                                    <span class="text-xl"></span>
                                    <span class="text-gray-700 text-sm font-medium">Cinta Kepada Guru</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                                    <span class="text-xl"></span>
                                    <span class="text-gray-700 text-sm font-medium">Cinta Ilmu Pengetahuan</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                                    <span class="text-xl"></span>
                                    <span class="text-gray-700 text-sm font-medium">Cinta Bangsa & Tanah Air</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                                    <span class="text-xl"></span>
                                    <span class="text-gray-700 text-sm font-medium">Cinta Lingkungan</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                                    <span class="text-xl"></span>
                                    <span class="text-gray-700 text-sm font-medium">Cinta Sahabat & Sesama</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                                    <span class="text-xl"></span>
                                    <span class="text-gray-700 text-sm font-medium">Cinta Diri Sendiri</span>
                                </div>
                            </div>
                        </div>
                    </div>
<!-- PRESTASI -->
<div class="mt-10">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-1 h-6 bg-primary rounded-full"></div>
        <h2 class="text-xl font-bold text-gray-800">Prestasi</h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <!-- Item -->
        <div class="p-4 bg-blue-50 rounded-lg transition-colors">
            <p class="text-gray-700 font-medium">
                Percaya Diri yang Kuat
            </p>
        </div>

        <div class="p-4 bg-blue-50 rounded-lg transition-colors">
            <p class="text-gray-700 font-medium">
                Riang dan Selalu Optimis
            </p>
        </div>

        <div class="p-4 bg-blue-50 rounded-lg transition-colors">
            <p class="text-gray-700 font-medium">
                Empati
            </p>
        </div>

        <div class="p-4 bg-blue-50 rounded-lg transition-colors">
            <p class="text-gray-700 font-medium">
                Sehat Jiwa dan Raga
            </p>
        </div>

        <div class="p-4 bg-blue-50 rounded-lg transition-colors">
            <p class="text-gray-700 font-medium">
                Tidak Mudah Menyerah dan Putus Asa
            </p>
        </div>

        <div class="p-4 bg-blue-50 rounded-lg transition-colors">
            <p class="text-gray-700 font-medium">
                Amanah Sebagai Pemimpin
            </p>
        </div>

        <div class="p-4 bg-blue-50 rounded-lg transition-colors">
            <p class="text-gray-700 font-medium">
                Siap Menjadi Pribadi Mandiri
            </p>
        </div>

        <div class="p-4 bg-blue-50 rounded-lg transition-colors">
            <p class="text-gray-700 font-medium">
                Inovatif Dalam Karya yang Bermanfaat
            </p>
        </div>
    </div>
</div>

<!-- Foto Teacher Value sama 8 Golden Rules -->

<div class="mt-10">
    <div class="flex items-center gap-3 mb-6">
        <div class="w-1 h-6 bg-primary rounded-full"></div>
        <h2 class="text-xl font-bold text-gray-800">Foto Teacher Value & 8 Golden Rules</h2>
    </div>


<div class="flex flex-col sm:flex-row items-center gap-4 md:gap-6 mb-6 mt-6">
    <img src="/image/teachervalue.jpeg" class="w-full max-w-[200px] md:max-w-[350px] mx-auto rounded-lg shadow-md">
    <img src="/image/8goldenrules.jpeg" class="w-full max-w-[200px] md:max-w-[350px] mx-auto rounded-lg shadow-md">
</div>

</div>
</div>
</section>

</div>

@include('components.footer')

<script src="//unpkg.com/alpinejs" defer></script>

</body>

</html>