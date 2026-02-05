<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Alpine -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>

<body x-data="{
    lang: 'id',
    isLoading: true,
    loadingProgress: 0,
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
    },
    initLoading() {
        // Simulasi progress loading
        const interval = setInterval(() => {
            this.loadingProgress += Math.random() * 15;
            if (this.loadingProgress >= 100) {
                this.loadingProgress = 100;
                clearInterval(interval);

                // Tunggu semua konten siap
                window.addEventListener('load', () => {
                    setTimeout(() => {
                        this.isLoading = false;
                    }, 00);
                });

                // Fallback jika window.load terlalu lama
                setTimeout(() => {
                    this.isLoading = false;
                }, 100);
            }
        }, 100);
    }
}" x-init="initLoading()" class="bg-gray-50 overflow-x-hidden">

    <header x-data="navbar()" x-init="init()"
        :class="scrolled ? 'bg-[#1E2188] shadow-md' : 'bg-transparent'"
        class="fixed top-0 left-0 w-full z-50 transition-all duration-500 ease-out">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between transition-colors duration-300"
            :class="scrolled ? 'text-white' : 'text-white'">
            <!-- Logo -->
            <div class="relative flex items-center justify-center w-20 h-20">

                <div
                    class="absolute z-10 flex items-center justify-center w-16 h-16 rounded-full overflow-hidden shadow-sm">
                    <img src="{{ asset('image/logometland.png') }}" alt="Logo" class="w-10 h-10 object-contain">
                </div>

                <svg class="absolute top-0 left-0 w-full h-full text-white animate-spin-slow hover:animate-none cursor-pointer"
                    viewBox="0 0 300 300" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <path id="textCircle" d="M 150, 150 m -100, 0 a 100,100 0 1,1 200,0 a 100,100 0 1,1 -200,0" />
                    </defs>

                    <text font-size="25" font-family="Arial, sans-serif" font-weight="bold" fill="currentColor">
                        <textPath xlink:href="#textCircle" textLength="800">
                            METLAND SCHOOL THE HIGH STANDARD IN VOCATIONAL EDUCATION •
                        </textPath>
                    </text>
                </svg>
            </div>
            <!-- Menu -->
            <nav class="hidden md:flex gap-8 text-sm mr-20 font-medium">
                <a href="#" class="hover:text-primary-light transition" x-text="t[lang].home"></a>
                <a href="#" class="hover:text-primary-light transition" x-text="t[lang].about"></a>
                <a href="/prokeh" class="hover:text-primary-light transition" x-text="t[lang].program"></a>
                <a href="#" class="hover:text-primary-light transition" x-text="t[lang].curriculum"></a>
                <a href="news.html" class="text-primary-light font-semibold transition" x-text="t[lang].news"></a>
            </nav>

            <!-- Language Toggle -->
            <div class="relative flex items-center bg-white/20 rounded-full p-1 text-xs w-20">
                <div class="absolute top-1 bottom-1 w-1/2 bg-primary rounded-full transition-all duration-300"
                    :class="lang === 'id' ? 'left-1' : 'left-[calc(40%+0.25rem)]'"></div>
                <button @click="lang = 'id'" class="relative z-10 w-1/2 text-center py-1 transition-colors"
                    :class="lang === 'id' ? 'text-white font-semibold' : 'text-gray-200'">ID</button>
                <button @click="lang = 'en'" class="relative z-10 w-1/2 text-center py-1 transition-colors"
                    :class="lang === 'en' ? 'text-white font-semibold' : 'text-gray-200'">EN</button>
            </div>
        </div>

    </header>
</body>

</html>
