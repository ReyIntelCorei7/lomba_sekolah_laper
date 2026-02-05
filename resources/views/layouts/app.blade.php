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

    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Scrollbar Styles -->
    <style>
        /* Hide default scrollbar */
        ::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }

        /* Custom Scrollbar for desktop */
        .custom-scroll-track {
            position: fixed;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            width: 6px;
            height: 200px;
            background: rgba(30, 33, 136, 0.1);
            border-radius: 3px;
            z-index: 40;
            display: none;
        }

        .custom-scroll-thumb {
            position: absolute;
            width: 100%;
            background: linear-gradient(to bottom, #1E2188, #006d6e);
            border-radius: 3px;
            transition: height 0.2s ease;
        }

        .scroll-dots {
            position: fixed;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 24px;
            z-index: 41;
            display: none;
        }

        .scroll-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            border: 2px solid #1E2188;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .scroll-dot.active {
            background: #1E2188;
            transform: scale(1.2);
            box-shadow: 0 0 10px rgba(30, 33, 136, 0.5);
        }

        .scroll-dot:hover {
            background: #1E2188;
            transform: scale(1.3);
        }

        .scroll-dot::after {
            content: attr(data-label);
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: #1E2188;
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            opacity: 0;
            transition: opacity 0.3s ease;
            white-space: nowrap;
            pointer-events: none;
        }

        .scroll-dot:hover::after {
            opacity: 1;
        }

        @media (min-width: 1024px) {

            .custom-scroll-track,
            .scroll-dots {
                display: block;
            }
        }

        /* Scroll to Top Button */
        .scroll-top-btn {
            position: fixed;
            right: 20px;
            bottom: 20px;
            width: 50px;
            height: 50px;
            background: #1E2188;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
            z-index: 40;
            box-shadow: 0 4px 12px rgba(30, 33, 136, 0.3);
        }

        .scroll-top-btn.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .scroll-top-btn:hover {
            background: #006d6e;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(30, 33, 136, 0.4);
        }
    </style>

    <!-- Loading Styles -->
    <style>
        /* Hide content during loading */
        [x-cloak] {
            display: none !important;
        }

        /* Smooth transition for content */
        .main-content {
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        }

        .main-content.loaded {
            opacity: 1;
            transform: translateY(0);
        }

        /* Spin animation for logo */
        .animate-spin-slow {
            animation: spin 20s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* Custom styles for new loading screen */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1E2188 0%, #006d6e 100%);
            z-index: 9999;
            font-family: "Poppins", sans-serif;
            user-select: none;
            color: #fff;
            transition: opacity 0.5s ease-out;
        }

        .loading-spinner {
            width: 7rem;
            height: 7rem;
            border: 8px solid rgba(255, 255, 255, 0.3);
            border-top: 8px solid #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-bottom: 2rem;
        }

        .loading-spinner-inner {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loading-spinner svg {
            width: 3rem;
            height: 3rem;
            color: #60a5fa;
            animation: ping 1.5s ease-in-out infinite;
        }

        @keyframes ping {
            0% {
                transform: scale(0.8);
                opacity: 0.7;
            }

            50% {
                transform: scale(1.1);
                opacity: 1;
            }

            100% {
                transform: scale(0.8);
                opacity: 0.7;
            }
        }

        .loading-text {
            font-size: 1.5rem;
            font-weight: 600;
            color: white;
            margin-top: 1rem;
            letter-spacing: 2px;
            background: linear-gradient(90deg, #60a5fa, #93c5fd, #60a5fa);
            background-size: 200% 100%;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 2s infinite linear;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        .loading-progress-container {
            width: 200px;
            height: 4px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
            margin-top: 2rem;
            overflow: hidden;
        }

        .loading-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #60a5fa, #3b82f6, #60a5fa);
            width: 0%;
            transition: width 0.3s ease;
            border-radius: 2px;
        }

        .loading-logo {
            position: absolute;
            top: 2rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .loading-logo-img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        .loading-logo-text {
            font-size: 1rem;
            font-weight: 600;
            color: white;
            text-align: center;
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
<!-- Hero -->
<script>
function heroSlider() {
    return {
        images: [
            "{{ asset('image/sekolahsmkmetland4.png') }}",
            "{{ asset('image/sekolahsmkmetland3.png') }}",
            "{{ asset('image/sekolahsmkmetland.png') }}"
        ],
        index: 0,
        nextIndex: 1,
        showA: true,

    <!-- Hero -->
    <script>
        function heroSlider() {
            return {
                images: [
                    @php
                        $hero1 = $settings['hero_image_1'] ?? 'image/sekolahsmkmetland4.png';
                        $hero2 = $settings['hero_image_2'] ?? 'image/sekolahsmkmetland3.png';
                        $hero3 = $settings['hero_image_3'] ?? 'image/sekolahsmkmetland.png';
                        
                        $hero1Url = str_starts_with($hero1, 'settings/') ? asset('storage/' . $hero1) : asset($hero1);
                        $hero2Url = str_starts_with($hero2, 'settings/') ? asset('storage/' . $hero2) : asset($hero2);
                        $hero3Url = str_starts_with($hero3, 'settings/') ? asset('storage/' . $hero3) : asset($hero3);
                    @endphp
                    "{{ $hero1Url }}",
                    "{{ $hero2Url }}",
                    "{{ $hero3Url }}"
                ],
                index: 0,
                nextIndex: 1,
                showA: true,
                init() {
                    setInterval(() => {
                        this.showA = !this.showA;
                        setTimeout(() => {
                            this.index = this.nextIndex;
                            this.nextIndex = (this.nextIndex + 1) % this.images.length;
                        }, 2000);
                    }, 5000);
                }
            }
        }
    }
}
</script>

    <!-- Scroll Animation -->
    <script>
        function scrollAnim() {
            return {
                show: false,
                init() {
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                this.show = true;
                            }
                        });
                    }, {
                        threshold: 0.3
                    });
                    observer.observe(this.$el);
                }
            }
        }
    </script>

    <!-- Navbar -->
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

    <!-- Statistics -->
    <script>
        function statsSection() {
            return {
                show: false,
                students: 0,
                teachers: 0,
                staff: 0,
                targetStudents: {{ $settings['stat_students'] ?? 683 }},
                targetTeachers: {{ $settings['stat_teachers'] ?? 54 }},
                targetStaff: {{ $settings['stat_staff'] ?? 41 }},
                animateValue(key, target, duration = 1500) {
                    let startTime = null
                    const step = (timestamp) => {
                        if (!startTime) startTime = timestamp
                        const progress = Math.min((timestamp - startTime) / duration, 1)
                        this[key] = Math.floor(progress * target)
                        if (progress < 1) {
                            requestAnimationFrame(step)
                        }
                    }
                });
            }, { threshold: 0.3 });

            observer.observe(this.$el);
        }
    }
}
</script>

<!-- Navbar -->
<script>
function navbar() {
    return {
        scrolled: false,
        init() {
            const hero = document.getElementById('hero')

            const observer = new IntersectionObserver(
                ([entry]) => {
                    this.scrolled = !entry.isIntersecting
                },
                { threshold: 0.1 }
            )

            if (hero) observer.observe(hero)
        }
    }
}
</script>

<!-- statistik -->
<script>
function statsSection() {
    return {
        show: false,
        students: 0,
        teachers: 0,
        staff: 0,

        targetStudents: 683,
        targetTeachers: 54,
        targetStaff: 41,

        animateValue(key, target, duration = 1500) {
            let start = 0
            let startTime = null

            const step = (timestamp) => {
                if (!startTime) startTime = timestamp
                const progress = Math.min((timestamp - startTime) / duration, 1)
                this[key] = Math.floor(progress * target)

                if (progress < 1) {
                    requestAnimationFrame(step)
                }
            }
            requestAnimationFrame(step)
        },

        init() {
            const section = document.getElementById('stats')

            const observer = new IntersectionObserver(([entry]) => {
                if (entry.isIntersecting && !this.show) {
                    this.show = true

                    this.animateValue('students', this.targetStudents)
                    this.animateValue('teachers', this.targetTeachers)
                    this.animateValue('staff', this.targetStaff)
                }
            }, { threshold: 0.4 })

            observer.observe(section)
        }
    }
}
</script>

<!-- Berita -->





</head>

<body
x-data="{
    lang: 'id',
    isLoading: true,
    loadingProgress: 0,
    scrollProgress: 0,
    showScrollTop: false,
    activeSection: 'hero',
    sections: ['hero', 'about', 'stats', 'jurusan', 'berita'],
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
            loading: 'Memuat'
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
            loading: 'Loading'
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
    scrollToSection(sectionId) {
        const element = document.getElementById(sectionId);
        if (element) {
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    },
    scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
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
                        // Add loaded class to main content
                        const mainContent = document.querySelector('.main-content');
                        if (mainContent) {
                            mainContent.classList.add('loaded');
                        }
                    }, 500);
                });

                // Fallback jika window.load terlalu lama
                setTimeout(() => {
                    this.isLoading = false;
                    const mainContent = document.querySelector('.main-content');
                    if (mainContent) {
                        mainContent.classList.add('loaded');
                    }
                }, 2000);
            }
        }, 100);

        // Setup scroll listener
        window.addEventListener('scroll', () => {
            // Calculate scroll progress
            const winHeight = window.innerHeight;
            const docHeight = document.documentElement.scrollHeight;
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const trackLength = docHeight - winHeight;
            this.scrollProgress = trackLength > 0 ? Math.floor((scrollTop / trackLength) * 100) : 0;

            // Show/hide scroll to top button
            this.showScrollTop = scrollTop > 300;

            // Update active section
            this.sections.forEach(section => {
                const element = document.getElementById(section);
                if (element) {
                    const rect = element.getBoundingClientRect();
                    if (rect.top <= 150 && rect.bottom >= 150) {
                        this.activeSection = section;
                    }
                }
            });
        });

        // Initialize section observer
        this.$nextTick(() => {
            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('opacity-100', 'translate-y-0');
                            entry.target.classList.remove('opacity-0', 'translate-y-10');
                        }
                    });
                }, { threshold: 0.1 }
            );

            document.querySelectorAll('section').forEach(section => {
                observer.observe(section);
            });
        });
    }
}" x-init="initLoading()" class="bg-gray-50 overflow-x-hidden">

    <!-- Loading Screen Baru -->
    <div x-show="isLoading" x-cloak class="loading-screen">
        <div class="loading-logo">
            {{-- <img src="{{ asset('image/logometland.png') }}" alt="Metland School Logo" class="loading-logo-img">
            <div class="loading-logo-text">METLAND SCHOOL</div> --}}
        </div>

        <!-- From Uiverse.io by TamaniPhiri -->
        <div class="flex-col gap-4 w-full flex items-center justify-center">
            <div
                class="w-28 h-28 border-8 text-blue-400 text-4xl animate-spin border-gray-300 flex items-center justify-center border-t-blue-800 rounded-full">
                @php
                    $logoPath = $settings['logo_image'] ?? 'image/logometland.png';
                    $logoUrl = str_starts_with($logoPath, 'settings/') ? asset('storage/' . $logoPath) : asset($logoPath);
                @endphp
                <img src="{{ $logoUrl }}" viewBox="0 0 24 24" fill="currentColor" height="30em"
                    width="30em" class="animate-ping">
                </img>
            </div>
        </div>

        <div class="loading-text" x-text="t[lang].loading + '...'"></div>

        <!-- Loading progress bar -->
        <div class="loading-progress-container">
            <div class="loading-progress-bar" :style="'width: ' + loadingProgress + '%'"></div>
        </div>
    </div>

    <!-- Konten Utama (Sembunyikan saat loading) -->
    <div x-show="!isLoading" x-cloak class="contents scroll-smooth main-content">
        <!-- Custom Scroller -->
        <div class="custom-scroll-track">
            <div class="custom-scroll-thumb"
                :style="'height: ' + (scrollProgress * 2) + 'px; top: ' + (scrollProgress * 1.5) + 'px'"></div>
        </div>

        <!-- Scroll Navigation Dots -->
        <div class="scroll-dots">
            <div class="scroll-dot" :class="{ 'active': activeSection === 'hero' }" @click="scrollToSection('hero')"
                data-label="Beranda"></div>
            <div class="scroll-dot" :class="{ 'active': activeSection === 'about' }"
                @click="scrollToSection('about')" data-label="Tentang"></div>
            <div class="scroll-dot" :class="{ 'active': activeSection === 'stats' }"
                @click="scrollToSection('stats')" data-label="Statistik"></div>
            <div class="scroll-dot" :class="{ 'active': activeSection === 'jurusan' }"
                @click="scrollToSection('jurusan')" data-label="Jurusan"></div>
            <div class="scroll-dot" :class="{ 'active': activeSection === 'berita' }"
                @click="scrollToSection('berita')" data-label="Berita"></div>
        </div>

        <!-- Scroll to Top Button -->
        <div class="scroll-top-btn" :class="{ 'visible': showScrollTop }" @click="scrollToTop()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </div>

        <!-- Header -->
        <header x-data="navbar()" x-init="init()"
            :class="scrolled ? 'bg-[#1E2188] shadow-md' : 'bg-transparent'"
            class="fixed top-0 left-0 w-full z-50 transition-all duration-500 ease-out">
            <div class="max-w-7xl mx-auto px-6 py-1 flex items-center justify-between transition-colors duration-300"
                :class="scrolled ? 'text-white' : 'text-white'">
                <!-- Logo -->
                <div class="relative flex items-center justify-center w-20 h-20">

                    <div
                        class="absolute z-10 flex items-center justify-center w-16 h-16 rounded-full overflow-hidden shadow-sm">
                        @php
                            $logoPath = $settings['logo_image'] ?? 'image/logometland.png';
                            $logoUrl = str_starts_with($logoPath, 'settings/') ? asset('storage/' . $logoPath) : asset($logoPath);
                        @endphp
                        <img src="{{ $logoUrl }}" alt="Logo" class="w-10 h-10 object-contain">
                    </div>

                    <svg class="absolute top-0 left-0 w-full h-full text-white animate-spin-slow hover:animate-none cursor-pointer"
                        viewBox="0 0 300 300" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <path id="textCircle"
                                d="M 150, 150 m -100, 0 a 100,100 0 1,1 200,0 a 100,100 0 1,1 -200,0" />
                        </defs>

                        <text font-size="30" font-family="Arial, sans-serif" font-weight="bold" fill="currentColor">
                            <textPath xlink:href="#textCircle" textLength="600">
                                SMK PARIWISATA METLAND SCHOOL
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

        <!-- Hero -->
        <section id="hero" x-data="heroSlider()" x-init="init()"
            class="relative h-screen w-full overflow-hidden">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-gray-900/90 to-gray-800/90"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-black/60 via-black/50 to-primary-dark"></div>

            <!-- Layer 1 -->
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat will-change-transform will-change-opacity"
                :style="'background-image: url(' + images[index] + ')'"
                :class="showA ? 'opacity-40 scale-105 transition-all duration-100 ease-in-out' :
                    'opacity-0 scale-100 transition-all duration-100 ease-in-out'">
            </div>

            <!-- Layer 2 -->
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat will-change-transform will-change-opacity"
                :style="'background-image: url(' + images[nextIndex] + ')'"
                :class="!showA ? 'opacity-40 scale-105 transition-all duration-100 ease-in-out' :
                    'opacity-0 scale-100 transition-all duration-100 ease-in-out'">
            </div>

            <!-- Content -->
            <div class="relative z-10 h-full flex items-center justify-center text-center px-6">
                <div class="max-w-3xl text-white">
                    @php
                        $logoPath = $settings['logo_image'] ?? 'image/logometland.png';
                        $logoUrl = str_starts_with($logoPath, 'settings/') ? asset('storage/' . $logoPath) : asset($logoPath);
                    @endphp
                    <img src="{{ $logoUrl }}" class="w-40 mx-auto mb-6 mt-40">
                    <h1 class="text-4xl md:text-3xl font-bold leading-tight mb-4">
                        {{ $settings['hero_title'] ?? 'Bridging the Gap Between Education and Industry' }}
                    </h1>
                    <p class="text-gray-200 mb-10 transition-all duration-300">{{ $settings['hero_subtitle'] ?? 'Metland School: The High Standard in Vocational Education' }}</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('ppdb.index') }}" style="color: #1E2188;"
                            class="bg-white font-semibold px-8 py-3 rounded-full hover:scale-105 transition"
                            x-text="t[lang].ppdb"></a>
                        <a href="#" style="background-color: #1E2188;"
                            class="text-white font-semibold px-8 py-3 rounded-full hover:scale-105 hover:bg-primary-light transition"
                            x-text="t[lang].contact"></a>
                    </div>
                </div>
            </div>

            <!-- Dot Indicators -->
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-3 z-20">
                <template x-for="(img, i) in images" :key="i">
                    <div @click="index = i; nextIndex = (i + 1) % images.length; showA = true;"
                        class="w-3 h-3 rounded-full cursor-pointer transition-all duration-300"
                        :class="i === index ? 'bg-white scale-125' : 'bg-white/40 hover:bg-white/70'"></div>
                </template>
            </div>
        </section>

        <!-- About School -->
        @livewire('bawah-hero-section')

        <!-- Infografis -->
        <section id="stats" x-data="statsSection()" x-init="init()" class="py-24 bg-gray-50">
            <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 gap-10 text-center">
                <!-- Siswa -->
                <div class="p-8 bg-white rounded-2xl shadow-md transition-all duration-700"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                    <h3 class="text-4xl font-bold text-[#1E2188]">
                        <span x-text="students"></span>
                    </h3>
                    <p class="mt-2 text-gray-600">Siswa</p>
                </div>

                <!-- Guru -->
                <div class="p-8 bg-white rounded-2xl shadow-md transition-all duration-700 delay-150"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                    <h3 class="text-4xl font-bold text-[#1E2188]">
                        <span x-text="teachers"></span>
                    </h3>
                    <p class="mt-2 text-gray-600">Guru</p>
                </div>

                <!-- Staff -->
                <div class="p-8 bg-white rounded-2xl shadow-md transition-all duration-700 delay-300"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'">
                    <h3 class="text-4xl font-bold text-[#1E2188]">
                        <span x-text="staff"></span>
                    </h3>
                    <p class="mt-2 text-gray-600">Tendik</p>
                </div>
            </div>
        </section>

        <!-- Program Keahlian -->
        <section id="jurusan" class="py-20" style="background-color: #1E2188;">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-12">
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $settings['program_title'] ?? 'Program Keahlian' }}</h1>
                    <p class="text-gray-300 max-w-xl mx-auto">{{ $settings['program_description'] ?? 'Pilih jurusan sesuai minat dan bakatmu untuk masa depan yang lebih cerah' }}</p>
                </div>

                <div x-data="{
                    active: null,
                    leaving: null,
                    items: [
                        @foreach($programs as $program)
                        { 
                            id: {{ $program->id }}, 
                            title: '{{ $program->code }}', 
                            image: '{{ $program->image ? asset('storage/' . $program->image) : asset('image/' . strtolower($program->code) . '1.png') }}' 
                        },
                        @endforeach
                    ]
                }" x-cloak class="flex flex-col md:flex-row gap-3 h-[700px] md:h-[420px]">
                    <template x-for="item in items" :key="item.id">
                        <div @mouseenter="if (window.innerWidth >= 768) { leaving=null; active=item.id }"
                            @mouseleave="if (window.innerWidth >= 768) {
                            leaving=item.id;
                            setTimeout(()=>{ if(leaving===item.id){ active=null; leaving=null }},300)
                        }"
                            @click="active = active === item.id ? null : item.id"
                            class="relative overflow-hidden rounded-xl cursor-pointer transition-[flex,transform] duration-700 ease-in-out"
                            :class="active === item.id ? 'md:flex-[5]' : active === null ? 'md:flex-1' : 'md:flex-[0.6]'">
                            <!-- FOTO BACKGROUND -->
                            <div class="absolute inset-0 bg-cover bg-center transition-all duration-700"
                                :style="'background-image: url(' + item.image + ')'"
                                :class="active === item.id ? 'scale-105 brightness-100' : leaving === item.id ?
                                    'brightness-75' :
                                    'brightness-50'">
                            </div>
                            <!-- OVERLAY -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent">
                            </div>
                            <!-- TITLE -->
                            <div class="absolute pointer-events-none transition-all duration-700"
                                :style="active === item.id ? 'left:2rem;bottom:2rem;transform:none' :
                                    'left:50%;top:50%;transform:translate(-50%,-50%) rotate(-90deg)'">
                                <h2 class="text-white font-bold transition-all duration-700"
                                    :class="active === item.id ? 'text-3xl' : 'text-xl'" x-text="item.title"></h2>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </section>

        <!-- Berita Sekolah -->
        <section id="berita" class="py-24 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6">
                <!-- Judul -->
                <div class="text-center mb-14">
                    <h2 class="text-3xl md:text-4xl font-bold text-[#1E2188]">{{ $settings['news_title'] ?? 'Berita Sekolah' }}</h2>
                    <p class="text-gray-600 mt-2">{{ $settings['news_description'] ?? 'Informasi dan kegiatan terbaru dari sekolah SMK Metland' }}</p>
                </div>

                <!-- Grid Card -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($latestNews as $news)
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden group transition-all duration-500 hover:shadow-xl">
                            <div class="overflow-hidden">
                                @if($news->image)
                                    <img src="{{ asset('storage/' . $news->image) }}"
                                        class="h-52 w-full object-cover transition-transform duration-700 group-hover:scale-110"
                                        alt="{{ $news->title }}">
                                @else
                                    <div class="h-52 w-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-6">
                                <span class="text-xs text-[#1E2188] font-semibold">{{ ucfirst($news->category) }}</span>
                                <h3 class="font-bold text-lg mt-2 group-hover:text-[#1E2188] transition">
                                    {{ $news->title }}
                                </h3>
                                <p class="text-sm text-gray-600 mt-2">
                                    {{ $news->excerpt ?? Str::limit(strip_tags($news->content), 120) }}
                                </p>
                                <div class="flex items-center justify-between mt-4">
                                    <span class="text-xs text-gray-500">{{ $news->formatted_date }}</span>
                                    <a href="#" class="inline-block text-sm font-semibold text-[#1E2188] hover:underline">
                                        Baca Selengkapnya →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Default news cards if no news available -->
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden group transition-all duration-500 hover:shadow-xl">
                            <div class="overflow-hidden">
                                <img src="{{ asset('image/berita1.png') }}"
                                    class="h-52 w-full object-cover transition-transform duration-700 group-hover:scale-110">
                            </div>
                            <div class="p-6">
                                <span class="text-xs text-[#1E2188] font-semibold">Event</span>
                                <h3 class="font-bold text-lg mt-2 group-hover:text-[#1E2188] transition">
                                    SMK Pariwisata Metland School Gelar Perayaan Hari Ibu
                                </h3>
                                <p class="text-sm text-gray-600 mt-2">
                                    Suasana khidmat dan penuh kehangatan menyelimuti Aula SMK Pariwisata Metland School...
                                </p>
                                <a href="#" class="inline-block mt-4 text-sm font-semibold text-[#1E2188] hover:underline">
                                    Baca Selengkapnya →
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- View All News Button -->
                @if($latestNews->count() > 0)
                    <div class="text-center mt-12">
                        <a href="/news" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#1E2188] hover:bg-blue-700 transition-colors duration-200">
                            Lihat Semua Berita
                            <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-[#1E2188] text-white py-16">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid md:grid-cols-4 gap-8">
                    <!-- School Info -->
                    <div class="md:col-span-2">
                        @php
                            $logoPath = $settings['logo_image'] ?? 'image/logometland.png';
                            $logoUrl = str_starts_with($logoPath, 'settings/') ? asset('storage/' . $logoPath) : asset($logoPath);
                        @endphp
                        <div class="flex items-center mb-4">
                            <img src="{{ $logoUrl }}" alt="Logo" class="w-12 h-12 mr-3">
                            <h3 class="text-xl font-bold">{{ $settings['site_name'] ?? 'SMK Pariwisata Metland School' }}</h3>
                        </div>
                        <p class="text-gray-300 mb-4">{{ $settings['site_description'] ?? 'Sekolah Menengah Kejuruan Pariwisata terbaik dengan fasilitas modern dan tenaga pengajar profesional.' }}</p>
                        <p class="text-gray-300">
                            <strong>Alamat:</strong><br>
                            {{ $settings['contact_address'] ?? 'Jl. Metland Cyber City, Cikupa, Tangerang, Banten' }}
                        </p>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                        <div class="space-y-2 text-gray-300">
                            <p><strong>Telepon:</strong><br>{{ $settings['contact_phone'] ?? '+62 21 1234 5678' }}</p>
                            <p><strong>Email:</strong><br>{{ $settings['contact_email'] ?? 'info@smkmetland.sch.id' }}</p>
                            @if(isset($settings['social_whatsapp']))
                                <p><strong>WhatsApp:</strong><br>{{ $settings['social_whatsapp'] }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Ikuti Kami</h4>
                        <div class="flex space-x-4">
                            @if(isset($settings['social_facebook']))
                                <a href="{{ $settings['social_facebook'] }}" target="_blank" class="text-gray-300 hover:text-white transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>
                            @endif
                            @if(isset($settings['social_instagram']))
                                <a href="{{ $settings['social_instagram'] }}" target="_blank" class="text-gray-300 hover:text-white transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C4.198 14.895 3.708 13.744 3.708 12.447s.49-2.448 1.297-3.323c.875-.807 2.026-1.297 3.323-1.297s2.448.49 3.323 1.297c.807.875 1.297 2.026 1.297 3.323s-.49 2.448-1.297 3.323c-.875.807-2.026 1.297-3.323 1.297zm7.718-1.297c-.875.807-2.026 1.297-3.323 1.297s-2.448-.49-3.323-1.297c-.807-.875-1.297-2.026-1.297-3.323s.49-2.448 1.297-3.323c.875-.807 2.026-1.297 3.323-1.297s2.448.49 3.323 1.297c.807.875 1.297 2.026 1.297 3.323s-.49 2.448-1.297 3.323z"/>
                                    </svg>
                                </a>
                            @endif
                            @if(isset($settings['social_youtube']))
                                <a href="{{ $settings['social_youtube'] }}" target="_blank" class="text-gray-300 hover:text-white transition-colors">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="border-t border-gray-600 mt-8 pt-8 text-center text-gray-300">
                    <p>&copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'SMK Pariwisata Metland School' }}. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Optional: Loading Script untuk handling smooth transition -->
    <script>
        // Pastikan Alpine.js sudah selesai dimuat
        document.addEventListener('alpine:init', () => {
            // Alpine sudah siap
        });
    </script>
</body>
</html>