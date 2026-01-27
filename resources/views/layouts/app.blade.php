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

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        [x-cloak] { display: none !important; }
        .breadcrumb-arrow::after {
            content: '›';
            margin: 0 8px;
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#008D8E',
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
            tagline: 'Metland School: The High Standard in Vocational Education',
            ppdb: 'PPDB',
            contact: 'Hubungi Kami',
            programTitle: 'Program Keahlian',
            programDesc: 'Pilih jurusan sesuai minat dan bakatmu untuk masa depan yang lebih cerah',
            newsTitle: 'Berita Sekolah',
            newsSubtitle: 'Ikuti perkembangan terbaru dari Metland School',
            popularNews: 'Berita Terpopuler',
            readMore: 'Baca Selengkapnya',
            allCategories: 'Semua Kategori',
            academic: 'Akademik',
            activity: 'Kegiatan',
            extracurricular: 'Ekstrakurikuler',
            arts: 'Seni & Budaya',
            alumni: 'Alumni',
            scout: 'Kepramukaan',
            workshop: 'Workshop',
            achievement: 'Prestasi',
            share: 'Bagikan',
            filter: 'Filter Kategori',
            latestNews: 'Berita Terbaru'
        },
        en: {
            home: 'Home',
            about: 'About School',
            program: 'Study Program',
            curriculum: 'Curriculum',
            news: 'School News',
            tagline: 'Metland School: The High Standard in Vocational Education',
            ppdb: 'Admissions',
            contact: 'Contact Support',
            programTitle: 'Study Programs',
            programDesc: 'Choose a major that matches your passion for a brighter future',
            newsTitle: 'School News',
            newsSubtitle: 'Stay updated with the latest news from Metland School',
            popularNews: 'Popular News',
            readMore: 'Read More',
            allCategories: 'All Categories',
            academic: 'Academic',
            activity: 'Activity',
            extracurricular: 'Extracurricular',
            arts: 'Arts & Culture',
            alumni: 'Alumni',
            scout: 'Scouting',
            workshop: 'Workshop',
            achievement: 'Achievement',
            share: 'Share',
            filter: 'Filter Categories',
            latestNews: 'Latest News'
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

<!-- ================= NAVBAR ================= -->
<header class="fixed top-0 left-0 w-full z-50 bg-gradient-to-b from-black/80 to-transparent backdrop-blur-sm">
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between text-white">

        <!-- Logo -->
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center font-bold">M</div>
            <span class="font-semibold tracking-wide">Metland School</span>
        </div>

        <!-- Menu -->
        <nav class="hidden md:flex gap-8 text-sm font-medium">
            <a href="index.html" class="hover:text-primary-light transition" x-text="t[lang].home"></a>
            <a href="#" class="hover:text-primary-light transition" x-text="t[lang].about"></a>
            <a href="index.html#jurusan" class="hover:text-primary-light transition" x-text="t[lang].program"></a>
            <a href="#" class="hover:text-primary-light transition" x-text="t[lang].curriculum"></a>
            <a href="news.html" class="text-primary-light font-semibold transition" x-text="t[lang].news"></a>
        </nav>

        <!-- Language Toggle -->
        <div class="relative flex items-center bg-white/20 rounded-full p-1 text-xs w-20">
            <div
                class="absolute top-1 bottom-1 w-1/2 bg-primary rounded-full transition-all duration-300"
                :class="lang === 'id' ? 'left-1' : 'left-[calc(50%+0.25rem)]'"
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

<!-- ================= HERO NEWS ================= -->
<section class="relative pt-32 pb-20 bg-gradient-to-br from-primary-dark to-primary overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full -translate-y-48 translate-x-48"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-white rounded-full -translate-x-32 translate-y-32"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <!-- Breadcrumb -->
        <div class="flex items-center text-white/80 mb-8 text-sm">
            <a href="index.html" class="hover:text-white transition" x-text="t[lang].home"></a>
            <span class="breadcrumb-arrow"></span>
            <span class="text-white font-semibold" x-text="t[lang].news"></span>
        </div>
        
        <div class="text-center mb-12">
            <div class="inline-block px-6 py-2 bg-white/20 rounded-full text-white mb-6">
                <i class="fas fa-newspaper mr-2"></i>
                <span x-text="t[lang].newsTitle"></span>
            </div>
            
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                <span class="block">CONGRATULATIONS</span>
                <span class="text-secondary">INDONESIA</span>
            </h1>
            
            <p class="text-3xl md:text-4xl font-bold text-white/90 mb-8">
                SCIENCE OLYMPICS
            </p>
            
            <p class="text-white/80 max-w-2xl mx-auto text-lg"
               x-text="t[lang].newsSubtitle"></p>
        </div>
    </div>
</section>

<!-- ================= MAIN CONTENT ================= -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- ================= SIDEBAR ================= -->
            <aside class="lg:w-1/3">
                <div class="sticky top-32">
                    <!-- Popular News -->
                    <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-fire text-secondary mr-3"></i>
                            <span x-text="t[lang].popularNews"></span>
                        </h2>
                        
                        <div class="space-y-6">
                            <!-- Popular News 1 -->
                            <div class="group cursor-pointer">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
                                        <i class="fas fa-graduation-cap mr-1"></i>
                                        <span x-text="t[lang].academic"></span>
                                    </span>
                                    <span class="text-gray-500 text-sm">2 hari lalu</span>
                                </div>
                                <h3 class="font-bold text-lg group-hover:text-primary transition">
                                    Penerimaan Peserta Didik Baru (PPDB) Tahun Ajaran 2024/2025 Segera Dibuka
                                </h3>
                            </div>
                            
                            <!-- Popular News 2 -->
                            <div class="group cursor-pointer">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                                        <i class="fas fa-briefcase mr-1"></i>
                                        <span x-text="t[lang].activity"></span>
                                    </span>
                                    <span class="text-gray-500 text-sm">5 hari lalu</span>
                                </div>
                                <h3 class="font-bold text-lg group-hover:text-primary transition">
                                    Kunjungan Industri ke PT Astra Honda Motor: Membuka Wawasan Dunia Kerja
                                </h3>
                            </div>
                            
                            <!-- Popular News 3 -->
                            <div class="group cursor-pointer">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs font-semibold rounded-full">
                                        <i class="fas fa-futbol mr-1"></i>
                                        <span x-text="t[lang].extracurricular"></span>
                                    </span>
                                    <span class="text-gray-500 text-sm">1 minggu lalu</span>
                                </div>
                                <h3 class="font-bold text-lg group-hover:text-primary transition">
                                    Tim Futsal Sekolah Lolos ke Babak Final Kejuaraan Walikota Cup
                                </h3>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Category Filter -->
                    <div class="bg-white rounded-2xl shadow-xl p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6" x-text="t[lang].filter"></h3>
                        <div class="space-y-3">
                            <button
                                @click="filterNews('all')"
                                class="w-full text-left px-4 py-3 rounded-lg transition-all"
                                :class="activeFilter === 'all' ? 'bg-primary text-white' : 'bg-gray-100 hover:bg-gray-200'"
                            >
                                <i class="fas fa-layer-group mr-3"></i>
                                <span x-text="t[lang].allCategories"></span>
                            </button>
                            
                            <button
                                @click="filterNews('academic')"
                                class="w-full text-left px-4 py-3 rounded-lg transition-all"
                                :class="activeFilter === 'academic' ? 'bg-blue-600 text-white' : 'bg-gray-100 hover:bg-gray-200'"
                            >
                                <i class="fas fa-graduation-cap mr-3"></i>
                                <span x-text="t[lang].academic"></span>
                            </button>
                            
                            <button
                                @click="filterNews('activity')"
                                class="w-full text-left px-4 py-3 rounded-lg transition-all"
                                :class="activeFilter === 'activity' ? 'bg-green-600 text-white' : 'bg-gray-100 hover:bg-gray-200'"
                            >
                                <i class="fas fa-briefcase mr-3"></i>
                                <span x-text="t[lang].activity"></span>
                            </button>
                            
                            <button
                                @click="filterNews('extracurricular')"
                                class="w-full text-left px-4 py-3 rounded-lg transition-all"
                                :class="activeFilter === 'extracurricular' ? 'bg-purple-600 text-white' : 'bg-gray-100 hover:bg-gray-200'"
                            >
                                <i class="fas fa-futbol mr-3"></i>
                                <span x-text="t[lang].extracurricular"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </aside>
            
            <!-- ================= MAIN NEWS CONTENT ================= -->
            <main class="lg:w-2/3">
                <!-- Featured Article -->
                <article class="bg-white rounded-2xl shadow-xl overflow-hidden mb-12">
                    <div class="p-10">
                        <div class="flex flex-wrap items-center justify-between mb-8">
                            <span class="px-5 py-2 bg-gradient-to-r from-red-500 to-orange-500 text-white font-bold rounded-full text-sm">
                                <i class="fas fa-trophy mr-2"></i>
                                <span x-text="t[lang].achievement"></span>
                            </span>
                            <span class="text-gray-500 font-medium">September 2023</span>
                        </div>
                        
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                            Siswa Metland School Raih Medali Emas di Olimpiade Sains Nasional 2023
                        </h1>
                        
                        <p class="text-gray-700 text-lg leading-relaxed mb-8">
                            Tim sains sekolah berhasil mengalahkan ratusan peserta dari seluruh Indonesia dalam ajang bergengsi tahunan. Prestasi ini membuktikan dedikasi siswa dan kualitas pengajaran di Metland School.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-6 pt-8 border-t border-gray-200">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-primary to-primary-dark rounded-full flex items-center justify-center text-white font-bold text-xl">
                                    MS
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">Tim Redaksi Metland</p>
                                    <p class="text-gray-600">Sekolah Menengah Kejuruan</p>
                                </div>
                            </div>
                            
                            <button
                                @click="shareArticle(
                                    'Siswa Metland School Raih Medali Emas di Olimpiade Sains Nasional 2023',
                                    'Tim sains sekolah berhasil mengalahkan ratusan peserta dari seluruh Indonesia dalam ajang bergengsi tahunan.'
                                )"
                                class="px-8 py-3 bg-primary text-white font-semibold rounded-full hover:bg-primary-dark transition flex items-center gap-3"
                            >
                                <i class="fas fa-share-alt"></i>
                                <span x-text="t[lang].share"></span>
                            </button>
                        </div>
                    </div>
                </article>
                
                <!-- Latest News Section -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center">
                        <i class="fas fa-clock mr-4 text-primary"></i>
                        <span x-text="t[lang].latestNews"></span>
                    </h2>
                </div>
                
                <!-- News Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- News Card 1 - Workshop -->
                    <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="p-8">
                            <div class="flex items-center justify-between mb-6">
                                <span class="px-4 py-2 bg-orange-100 text-orange-800 font-semibold rounded-full text-sm">
                                    <i class="fas fa-laptop-code mr-2"></i>
                                    <span x-text="t[lang].workshop"></span>
                                </span>
                                <span class="text-gray-500 font-medium">15 September 2023</span>
                            </div>
                            
                            <h3 class="text-2xl font-bold text-gray-900 mb-4 hover:text-primary transition">
                                Workshop Coding Dasar untuk Siswa Baru: Siap Hadapi Era Digital
                            </h3>
                            
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                Kenalkan wawasan kepada siswa kelas X untuk mengenal dunia pemrograman dan teknologi digital sebagai bekal menghadapi revolusi industri 4.0.
                            </p>
                            
                            <a href="#" class="inline-flex items-center text-primary font-semibold hover:text-primary-dark transition group">
                                <span x-text="t[lang].readMore"></span>
                                <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform"></i>
                            </a>
                        </div>
                    </article>
                    
                    <!-- News Card 2 - Arts & Culture -->
                    <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="p-8">
                            <div class="flex items-center justify-between mb-6">
                                <span class="px-4 py-2 bg-purple-100 text-purple-800 font-semibold rounded-full text-sm">
                                    <i class="fas fa-palette mr-2"></i>
                                    <span x-text="t[lang].arts"></span>
                                </span>
                                <span class="text-gray-500 font-medium">10 September 2023</span>
                            </div>
                            
                            <h3 class="text-2xl font-bold text-gray-900 mb-4 hover:text-primary transition">
                                Pentas Seni Tahunan 'Metland Art Fest' Pukau Ratusan Penonton
                            </h3>
                            
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                Menampilkan bakat-bakat terbaik siswa dalam bidang seni dan budaya dengan berbagai pertunjukan spektakuler yang memukau penonton.
                            </p>
                            
                            <a href="#" class="inline-flex items-center text-primary font-semibold hover:text-primary-dark transition group">
                                <span x-text="t[lang].readMore"></span>
                                <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform"></i>
                            </a>
                        </div>
                    </article>
                    
                    <!-- News Card 3 - Alumni -->
                    <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="p-8">
                            <div class="flex items-center justify-between mb-6">
                                <span class="px-4 py-2 bg-green-100 text-green-800 font-semibold rounded-full text-sm">
                                    <i class="fas fa-user-graduate mr-2"></i>
                                    <span x-text="t[lang].alumni"></span>
                                </span>
                                <span class="text-gray-500 font-medium">2 minggu lalu</span>
                            </div>
                            
                            <h3 class="text-2xl font-bold text-gray-900 mb-4 hover:text-primary transition">
                                Kisah Sukses: Alumni 2018 Kini Menjadi Manajer IT di Startup Unicorn
                            </h3>
                            
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                Inspirasi dari lulusan yang berhasil mencapai karir gemilang di dunia teknologi dengan menjadi manajer IT di perusahaan startup unicorn Indonesia.
                            </p>
                            
                            <a href="#" class="inline-flex items-center text-primary font-semibold hover:text-primary-dark transition group">
                                <span x-text="t[lang].readMore"></span>
                                <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform"></i>
                            </a>
                        </div>
                    </article>
                    
                    <!-- News Card 4 - Scouting -->
                    <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="p-8">
                            <div class="flex items-center justify-between mb-6">
                                <span class="px-4 py-2 bg-yellow-100 text-yellow-800 font-semibold rounded-full text-sm">
                                    <i class="fas fa-campground mr-2"></i>
                                    <span x-text="t[lang].scout"></span>
                                </span>
                                <span class="text-gray-500 font-medium">01 September 2023</span>
                            </div>
                            
                            <h3 class="text-2xl font-bold text-gray-900 mb-4 hover:text-primary transition">
                                Perkemahan Sabtu Minggu (Persami) Melatih Kemandirian Siswa
                            </h3>
                            
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                Kegiatan rutin tahunan yang wajib diikuti oleh siswa untuk melatih kemandirian, kerja sama tim, dan kepemimpinan di alam terbuka.
                            </p>
                            
                            <a href="#" class="inline-flex items-center text-primary font-semibold hover:text-primary-dark transition group">
                                <span x-text="t[lang].readMore"></span>
                                <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform"></i>
                            </a>
                        </div>
                    </article>
                </div>
            </main>
        </div>
    </div>
</section>

<!-- ================= FOOTER ================= -->
<footer class="bg-gray-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-8">
            <!-- Logo -->
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-2xl font-bold">
                    M
                </div>
                <div>
                    <h3 class="text-2xl font-bold">Metland School</h3>
                    <p class="text-gray-400">Sekolah Menengah Kejuruan</p>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="flex gap-12">
                <div>
                    <h4 class="font-bold text-lg mb-4">Tautan Cepat</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="index.html" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="#" class="hover:text-white transition">Tentang Sekolah</a></li>
                        <li><a href="index.html#jurusan" class="hover:text-white transition">Program Keahlian</a></li>
                        <li><a href="news.html" class="hover:text-white transition">Berita Sekolah</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold text-lg mb-4">Kontak</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-center gap-3">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                            <span>Jl. Pendidikan No. 123, Jakarta</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-phone text-primary"></i>
                            <span>(021) 1234-5678</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-envelope text-primary"></i>
                            <span>info@metlandschool.sch.id</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="mt-12 pt-8 border-t border-gray-800 text-center text-gray-500">
            <p>&copy; 2024 Metland School. All rights reserved.</p>
        </div>
    </div>
</footer>


<div
    x-show="showShareModal"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-6"
    style="display: none;"
    @click.self="showShareModal = false"
>
    <div class="bg-white rounded-2xl max-w-md w-full p-8">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-gray-900">Bagikan Berita</h3>
            <button @click="showShareModal = false" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>
        
        <template x-if="currentArticle">
            <div class="mb-6">
                <h4 class="font-bold text-lg mb-2" x-text="currentArticle.title"></h4>
                <p class="text-gray-600 text-sm" x-text="currentArticle.description"></p>
            </div>
        </template>
        
        <div class="flex gap-4">
            <button
                @click="copyLink()"
                class="flex-1 bg-primary text-white py-3 rounded-lg font-semibold hover:bg-primary-dark transition flex items-center justify-center gap-3"
            >
                <i class="fas fa-copy"></i>
                Salin Link
            </button>
            
            <a
                href="https://wa.me/?text=Saya%20membaca%20artikel%20ini:%20" + encodeURIComponent(window.location.href)
                target="_blank"
                class="flex-1 bg-green-500 text-white py-3 rounded-lg font-semibold hover:bg-green-600 transition flex items-center justify-center gap-3"
            >
                <i class="fab fa-whatsapp"></i>
                WhatsApp
            </a>
        </div>
    </div>
</div>

</body>
</html>