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
            latestNews: 'Berita Terbaru',
            loadMore: 'Muat Lebih Banyak',
            loading: 'Memuat...'
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
            latestNews: 'Latest News',
            loadMore: 'Load More',
            loading: 'Loading...'
        }
    },
    activeFilter: 'all',
    showShareModal: false,
    currentArticle: null,
    
    //muat lebih banyak
    loadedNews: [],
    newsOffset: {{ count($news) }},
    isLoading: false,
    hasMore: {{ $totalNews > count($news) ? 'true' : 'false' }},
    totalNews: {{ $totalNews }},
    categoryColors: {
        'academic': 'bg-blue-100 text-blue-700',
        'achievement': 'bg-blue-100 text-blue-700',
        'activity': 'bg-blue-100 text-blue-700',
        'workshop': 'bg-blue-100 text-blue-700',
        'extracurricular': 'bg-blue-100 text-blue-700',
        'scout': 'bg-blue-100 text-blue-700',
        'arts': 'bg-blue-100 text-blue-700',
        'alumni': 'bg-blue-100 text-blue-700',
    },
    
    filterNews(category) {
        this.activeFilter = category;
        this.loadedNews = [];
        this.newsOffset = {{ count($news) }};
        this.hasMore = {{ $totalNews > count($news) ? 'true' : 'false' }};
    },
    
    async loadMore() {
        if (this.isLoading || !this.hasMore) return;
        
        this.isLoading = true;
        
        try {
            const response = await fetch(`/news/load-more?offset=${this.newsOffset}&limit=9&category=${this.activeFilter}`);
            const data = await response.json();
            
            if (data.news && data.news.length > 0) {
                this.loadedNews = [...this.loadedNews, ...data.news];
                this.newsOffset += data.news.length;
            }
            
            this.hasMore = data.hasMore;
        } catch (error) {
            console.error('Error loading more news:', error);
        } finally {
            this.isLoading = false;
        }
    },
    
    getCategoryColor(category) {
        return this.categoryColors[category] || 'bg-gray-100 text-gray-700';
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

        <!-- Header Content -->
        <div class="max-w-[1400px] mx-auto h-20 flex items-center justify-between gap-16 relative z-50"
            :class="scrolled ? 'h-16' : 'h-24'">

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

                <!-- Blue Ribbon -->
                <div class="relative group h-full flex items-start z-50 w-20 justify-end">
                    <button @click="menuOpen = !menuOpen"
                        class="absolute w-16 bg-[#1E2188] hover:bg-blue-700 text-white flex flex-col items-center pb-4 transition-all duration-700 ease-[cubic-bezier(0.34,1.56,0.64,1)] shadow-2xl shadow-blue-900/50 cursor-pointer"
                        :class="menuOpen ? 'h-[500px] -top-0 bg-blue-700' : 'h-32 -top-0 hover:h-36'"
                        style="clip-path: polygon(0 0, 100% 0, 100% calc(100% - 20px), 50% 100%, 0 calc(100% - 20px)); right: 0;">

                        <div class="h-full flex flex-col justify-end items-center pb-6 gap-2">
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

            <!-- Mobile Breadcrump -->
            <button class="md:hidden text-white p-2" @click="menuOpen = !menuOpen">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <!-- Menu Overlay -->
        <div class="fixed inset-0 bg-[#1E2188] z-40 transition-transform duration-700 ease-[cubic-bezier(0.16,1,0.3,1)]"
            :class="menuOpen ? 'translate-y-0' : '-translate-y-full'"
            style="top: 0;">

            <div class="max-w-[1400px] mx-auto px-6 pt-32 pb-12 h-full flex flex-col">
                <div class="flex items-center gap-4 mb-20 fade-in-up delay-100">
                    <img src="{{ asset('image/logometland.png') }}" class="w-16 h-16 object-contain brightness-0 invert">
                    <h2 class="text-3xl font-bold text-white tracking-widest uppercase">METLAND SCHOOL</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-white">
                    <div class="space-y-8 fade-in-up delay-200">
                        <a href="#" class="block text-xl font-bold hover:text-blue-200 transition-colors">Profile Sekolah</a>
                        <a href="#" class="block text-xl font-bold hover:text-blue-200 transition-colors">Visi dan Misi</a>
                        <a href="/prokeh" @click="menuOpen=false" class="block text-xl font-bold hover:text-blue-200 transition-colors">Program Keahlian</a>
                    </div>

                    <div class="space-y-8 fade-in-up delay-300">
                        <a href="#" class="block text-xl font-bold hover:text-blue-200 transition-colors">Ekstrakurikuler</a>
                        <a href="#" class="block text-xl font-bold hover:text-blue-200 transition-colors">Organisasi</a>
                        <a href="#" class="block text-xl font-bold hover:text-blue-200 transition-colors">Produk/Karya Siswa</a>
                    </div>

                    <div class="space-y-8 fade-in-up delay-400">
                        <a href="#" class="block text-xl font-bold hover:text-blue-200 transition-colors">Tentang Alumni</a>
                        <a href="/news" @click="menuOpen=false" class="block text-xl font-bold hover:text-blue-200 transition-colors">Berita Sekolah</a>
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

    <!-- ================= HERO SECTION ================= -->
    <section class="relative min-h-[40vh] md:min-h-[50vh] lg:min-h-[60vh] bg-[#1a1a1a] flex items-center pt-20 md:pt-24">
        <div class="absolute inset-0">
            <img src="{{ asset('image/sekolahsmkmetland.png') }}" class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-r from-[#1a1a1a] via-[#1a1a1a]/80 to-transparent"></div>
        </div>

        <div class="relative z-10 w-full max-w-7xl mx-auto px-6 md:px-12 lg:px-20">
            <div id="hero" class="flex items-center text-white/80 mb-4 md:mb-8 text-xs md:text-sm">
                <a href="/" class="hover:text-white transition" x-text="t[lang].home"></a>
                <span class="breadcrumb-arrow"></span>
                <span class="text-white font-semibold" x-text="t[lang].news"></span>
            </div>

            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-bold text-white mb-4 md:mb-6 leading-tight">
                <span class="block">BERITA</span>
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">SEKOLAH</span>
            </h1>

            <p class="text-white/80 max-w-xl text-sm md:text-base lg:text-lg mb-6 md:mb-8" x-text="t[lang].newsSubtitle"></p>

        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 py-8 md:py-12 lg:py-16">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 md:gap-6 mb-6 md:mb-10">
            <div>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900" x-text="t[lang].latestNews">Berita Terbaru</h2>
                <p class="text-gray-500 mt-1 md:mt-2 text-sm md:text-base" x-text="t[lang].newsSubtitle"></p>
            </div>

            <!-- Category Filter -->
            <div class="flex flex-wrap gap-2 w-full md:w-auto">
                <button
                    @click="filterNews('all')"
                    :class="activeFilter === 'all' ? 'bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200'"
                    class="px-4 py-2 text-xs sm:text-sm font-medium transition-all duration-200 rounded-full"
                    x-text="t[lang].allCategories">
                </button>
                <button
                    @click="filterNews('academic')"
                    :class="activeFilter === 'academic' ? 'bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200'"
                    class="px-4 py-2 text-xs sm:text-sm font-medium transition-all duration-200 rounded-full"
                    x-text="t[lang].academic">
                </button>
                <button
                    @click="filterNews('achievement')"
                    :class="activeFilter === 'achievement' ? 'bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200'"
                    class="px-4 py-2 text-xs sm:text-sm font-medium transition-all duration-200 rounded-full"
                    x-text="t[lang].achievement">
                </button>
                <button
                    @click="filterNews('activity')"
                    :class="activeFilter === 'activity' ? 'bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200'"
                    class="px-4 py-2 text-xs sm:text-sm font-medium transition-all duration-200 rounded-full"
                    x-text="t[lang].activity">
                </button>
                <button
                    @click="filterNews('extracurricular')"
                    :class="activeFilter === 'extracurricular' ? 'bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200'"
                    class="px-4 py-2 text-xs sm:text-sm font-medium transition-all duration-200 rounded-full"
                    x-text="t[lang].extracurricular">
                </button>
                <button
                    @click="filterNews('workshop')"
                    :class="activeFilter === 'workshop' ? 'bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200'"
                    class="px-4 py-2 text-xs sm:text-sm font-medium transition-all duration-200 rounded-full"
                    x-text="t[lang].workshop">
                </button>
                <button
                    @click="filterNews('arts')"
                    :class="activeFilter === 'arts' ? 'bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200'"
                    class="px-4 py-2 text-xs sm:text-sm font-medium transition-all duration-200 rounded-full"
                    x-text="t[lang].arts">
                </button>
                <button
                    @click="filterNews('alumni')"
                    :class="activeFilter === 'alumni' ? 'bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200'"
                    class="px-4 py-2 text-xs sm:text-sm font-medium transition-all duration-200 rounded-full"
                    x-text="t[lang].alumni">
                </button>
                <button
                    @click="filterNews('scout')"
                    :class="activeFilter === 'scout' ? 'bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200'"
                    class="px-4 py-2 text-xs sm:text-sm font-medium transition-all duration-200 rounded-full"
                    x-text="t[lang].scout">
                </button>
            </div>
        </div>

        <!-- News Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5">
            @if($featuredNews)
            <a href="{{ route('news.show', $featuredNews->slug) }}" class="sm:col-span-2 lg:row-span-2 group relative overflow-hidden bg-white shadow-sm hover:shadow-xl transition-all duration-300 block" style="border-radius: 5px;">
                <div class="absolute inset-0">
                    @if($featuredNews->image)
                    <img src="{{ asset('storage/' . $featuredNews->image) }}" alt="{{ $featuredNews->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                    <img src="{{ asset('image/sekolahsmkmetland.png') }}" alt="{{ $featuredNews->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                </div>
                <div class="relative h-full min-h-[280px] sm:min-h-[350px] lg:min-h-[500px] p-4 sm:p-6 flex flex-col justify-end">
                    <span class="inline-block px-2 sm:px-3 py-1 bg-primary text-white text-[10px] sm:text-xs font-bold uppercase tracking-wide mb-2 sm:mb-3 w-fit" style="border-radius: 5px;">Featured</span>
                    <h3 class="text-lg sm:text-xl lg:text-2xl xl:text-3xl font-bold text-white mb-2 sm:mb-3 line-clamp-2 group-hover:text-blue-200 transition-colors">
                        {{ $featuredNews->title }}
                    </h3>
                    <p class="text-white/80 mb-3 sm:mb-4 line-clamp-2 text-sm sm:text-base">
                        {{ $featuredNews->excerpt ?? Str::limit(strip_tags($featuredNews->content), 120) }}
                    </p>
                    <div class="flex items-center justify-between">
                        <span class="text-white/60 text-xs sm:text-sm"><i class="far fa-calendar-alt mr-1 sm:mr-2"></i>{{ $featuredNews->formatted_date }}</span>
                        <span class="text-white font-semibold hover:text-blue-300 transition flex items-center gap-1 sm:gap-2 text-sm sm:text-base" x-text="t[lang].readMore + ' →'"></span>
                    </div>
                </div>
            </a>
            @else
            <!-- Fallback if no featured news -->
            <div class="sm:col-span-2 lg:row-span-2 group relative overflow-hidden bg-white shadow-sm transition-all duration-300" style="border-radius: 5px;">
                <div class="absolute inset-0">
                    <img src="{{ asset('image/sekolahsmkmetland.png') }}" alt="No Featured News" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                </div>
                <div class="relative h-full min-h-[280px] sm:min-h-[350px] lg:min-h-[500px] p-4 sm:p-6 flex flex-col justify-end">
                    <span class="inline-block px-2 sm:px-3 py-1 bg-gray-500 text-white text-[10px] sm:text-xs font-bold uppercase tracking-wide mb-2 sm:mb-3 w-fit" style="border-radius: 5px;">No Featured</span>
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-white mb-2">Tidak ada berita terbaru</h3>
                    <p class="text-white/80 text-sm">Tidak ada berita terbaru</p>
                </div>
            </div>
            @endif
            <!-- Regular News Cards - Loop from Database (already filtered by controller) -->
            @forelse($news as $item)
            <a href="{{ route('news.show', $item->slug) }}"
                class="group bg-white shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden block"
                style="border-radius: 5px;"
                x-show="activeFilter === 'all' || activeFilter === '{{ $item->category }}'"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100">
                <div class="h-40 overflow-hidden">
                    @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    @else
                    <img src="{{ asset('image/sekolahsmkmetland.png') }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    @endif
                </div>
                <div class="p-4">
                    @php
                    $categoryColors = [
                    'academic' => 'bg-green-100 text-green-700',
                    'achievement' => 'bg-yellow-100 text-yellow-700',
                    'activity' => 'bg-purple-100 text-purple-700',
                    'workshop' => 'bg-orange-100 text-orange-700',
                    'extracurricular' => 'bg-blue-100 text-blue-700',
                    'scout' => 'bg-red-100 text-red-700',
                    'arts' => 'bg-pink-100 text-pink-700',
                    'alumni' => 'bg-indigo-100 text-indigo-700',
                    ];
                    $colorClass = $categoryColors[$item->category] ?? 'bg-gray-100 text-gray-700';
                    @endphp
                    <span class="inline-block px-2 py-1 {{ $colorClass }} text-xs font-semibold mb-2" style="border-radius: 5px;">
                        {{ ucfirst($item->category) }}
                    </span>
                    <h4 class="font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-primary transition-colors">
                        {{ $item->title }}
                    </h4>
                    <p class="text-gray-500 text-sm line-clamp-2 mb-3">
                        {{ $item->excerpt ?? Str::limit(strip_tags($item->content), 80) }}
                    </p>
                    <div class="flex items-center justify-between text-xs text-gray-400">
                        <span><i class="far fa-calendar-alt mr-1"></i>{{ $item->formatted_date }}</span>
                        <span><i class="far fa-eye mr-1"></i>{{ $item->views ?? 0 }}</span>
                    </div>
                </div>
            </a>
            @empty
            <!-- No news available message -->
            <div class="sm:col-span-2 lg:col-span-4 text-center py-12">
                <div class="text-gray-400 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Berita</h3>
                <p class="text-gray-400">Belum ada berita terbaru</p>
            </div>
            @endforelse

            <!-- Dynamically Loaded News Cards via AJAX -->
            <template x-for="item in loadedNews" :key="item.id">
                <a :href="item.url"
                    class="group bg-white shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden block"
                    style="border-radius: 5px;"
                    x-show="activeFilter === 'all' || activeFilter === item.category"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100">
                    <div class="h-40 overflow-hidden">
                        <img :src="item.image" :alt="item.title" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <div class="p-4">
                        <span class="inline-block px-2 py-1 text-xs font-semibold mb-2"
                            style="border-radius: 5px;"
                            :class="getCategoryColor(item.category)"
                            x-text="item.category.charAt(0).toUpperCase() + item.category.slice(1)">
                        </span>
                        <h4 class="font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-primary transition-colors" x-text="item.title"></h4>
                        <p class="text-gray-500 text-sm line-clamp-2 mb-3" x-text="item.excerpt"></p>
                        <div class="flex items-center justify-between text-xs text-gray-400">
                            <span><i class="far fa-calendar-alt mr-1"></i><span x-text="item.formatted_date"></span></span>
                            <span><i class="far fa-eye mr-1"></i><span x-text="item.views"></span></span>
                        </div>
                    </div>
                </a>
            </template>

        </div>

        <!-- Load More Button -->
        <div class="text-center mt-8 md:mt-12" x-show="hasMore || loadedNews.length > 0">
            <button
                @click="loadMore()"
                :disabled="isLoading || !hasMore"
                x-show="hasMore"
                class="px-6 sm:px-8 py-2.5 sm:py-3 bg-primary text-white font-semibold hover:bg-primary-dark transition-all duration-200 shadow-lg hover:shadow-xl text-sm sm:text-base disabled:opacity-50 disabled:cursor-not-allowed"
                style="border-radius: 5px;">
                <template x-if="isLoading">
                    <span>
                        <i class="fas fa-spinner fa-spin mr-2"></i>
                        <span x-text="t[lang].loading"></span>
                    </span>
                </template>
                <template x-if="!isLoading">
                    <span>
                        <i class="fas fa-sync-alt mr-2"></i>
                        <span x-text="t[lang].loadMore"></span>
                    </span>
                </template>
            </button>

            <!-- No more news message -->
            <p x-show="!hasMore && (loadedNews.length > 0 || {{ count($news) }} > 0)"
                class="text-gray-500 text-sm mt-4">
                <i class="fas fa-check-circle mr-2 text-green-500"></i>
                Semua berita telah ditampilkan
            </p>
        </div>
    </section>

    <!-- FOOTER -->
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
    @include('components.footer')

</body>

</html>