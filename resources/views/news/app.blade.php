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
        [x-cloak] {
            display: none !important;
        }

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
                        primary: '#1e40af',
                        'primary-dark': '#006d6e',
                        'primary-light': '#00a7a8',
                        'secondary': '#f59e0b',
                    }
                }
            }
        }
    </script>
    <script>
        function navbar() {
            return {
                scrolled: false,
                init() {
                    const hero = document.getElementById('hero')
                    const observer = new IntersectionObserver(
                        ([entry]) => {
                            this.scrolled = !entry.isIntersecting
                        }, {
                            threshold: 0.1
                        }
                    )
                    if (hero) observer.observe(hero)
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
    class="bg-gray-50 overflow-x-hidden">

    <!-- ================= NAVBAR ================= -->
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
        <!-- ================= HERO NEWS ================= -->
        <section class="relative pt-32 pb-20 bg-cover bg-center overflow-hidden" style="background-image: url('image/sekolahsmkmetland.png');">
            <div class="absolute inset-0 bg-black opacity-80"></div>
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full -translate-y-48 translate-x-48"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-white rounded-full -translate-x-32 translate-y-32"></div>
            </div>

            <div class="relative z-10 max-w-7xl mx-auto px-6">
                <!-- Breadcrumb -->
                <div id="hero" class="flex items-center text-white/80 mb-8 text-sm">
                    <a href="index.html" class="hover:text-white transition" x-text="t[lang].home"></a>
                    <span class="breadcrumb-arrow"></span>
                    <span class="text-white font-semibold" x-text="t[lang].news"></span>
                </div>


                <h1 class="text-2xl md:text-7xl font-bold text-white mb-6 leading-tight">
                    <span class="block">CONGRATULATIONS</span>
                    <span class="block">INDONESIA</span>
                </h1>

                <p class="text-3xl md:text-4xl font-bold text-white/90 mb-8">
                    SCIENCE OLYMPICS
                </p>

                <p class="text-white/80 mx-auto text-lg"
                    x-text="t[lang].newsSubtitle"></p>
            </div>
            </div>
        </section>

        <section class="bg-gray-900 max-w-7xl mx-auto px-6 py-16">


        </section>

        <!-- ================= FOOTER ================= -->
        <footer class="bg-gray-900 text-white py-16">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                    <!-- Logo -->
                    <div class="flex items-center gap-4">
                        <img src="image/logometland.png" alt="Logo Metland School" class="w-16 h-16   flex items-center justify-center text-2xl font-bold shadow-lg">

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
            @click.self="showShareModal = false">
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
                        class="flex-1 bg-primary text-white py-3 rounded-lg font-semibold hover:bg-primary-dark transition flex items-center justify-center gap-3">
                        <i class="fas fa-copy"></i>
                        Salin Link
                    </button>

                    <a
                        href="https://wa.me/?text=Saya%20membaca%20artikel%20ini:%20" + encodeURIComponent(window.location.href)
                        target="_blank"
                        class="flex-1 bg-green-500 text-white py-3 rounded-lg font-semibold hover:bg-green-600 transition flex items-center justify-center gap-3">
                        <i class="fab fa-whatsapp"></i>
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>

</body>

</html>