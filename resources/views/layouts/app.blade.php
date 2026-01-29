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
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>


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
                    }, {
                        threshold: 0.4
                    })
                    observer.observe(section)
                }
            }
        }
    </script>
</head>

<body x-data="{
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
}" class="bg-gray-50 overflow-x-hidden">

    <!-- Header -->
    <header x-data="navbar()" x-init="init()"
        :class="scrolled ? 'bg-[#1E2188] shadow-md' : 'bg-transparent'"
        class="fixed top-0 left-0 w-full z-50 transition-all duration-500 ease-out">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between transition-colors duration-300"
            :class="scrolled ? 'text-white' : 'text-white'">
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('image/logometland.png') }}" class="h-8">
                <span class="font-semibold tracking-wide">Metland School</span>
            </div>

            <!-- Menu -->
            <nav class="hidden md:flex gap-8 text-sm mr-20 font-medium">
                <a href="#" class="hover:text-primary-light transition" x-text="t[lang].home"></a>
                <a href="#" class="hover:text-primary-light transition" x-text="t[lang].about"></a>
                <a href="#" class="hover:text-primary-light transition" x-text="t[lang].program"></a>
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
            :class="showA ? 'opacity-40 scale-105 transition-all duration-2000 ease-in-out' :
                'opacity-0 scale-100 transition-all duration-2000 ease-in-out'">
        </div>

        <!-- Layer 2 -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat will-change-transform will-change-opacity"
            :style="'background-image: url(' + images[nextIndex] + ')'"
            :class="!showA ? 'opacity-40 scale-105 transition-all duration-2000 ease-in-out' :
                'opacity-0 scale-100 transition-all duration-2000 ease-in-out'">
        </div>

        <!-- Content -->
        <div class="relative z-10 h-full flex items-center justify-center text-center px-6">
            <div class="max-w-3xl text-white">
                <img src="{{ asset('image/logometland.png') }}" class="w-40 mx-auto mb-6 mt-40">
                <h1 class="text-4xl md:text-3xl font-bold leading-tight mb-4">
                    Bridging the Gap Between
                    <span class="text-blue-600">Education</span> and
                    <span class="text-blue-600">Industry</span>
                </h1>
                <p class="text-gray-200 mb-10 transition-all duration-300" x-text="t[lang].tagline"></p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#" style="color: #1E2188;"
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
    {{-- <section id="about" class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-6 space-y-24">
            <!-- ITEM 1 -->
            <div x-data="scrollAnim()" x-init="init()" class="grid md:grid-cols-2 gap-12 items-center">
                <!-- TEXT -->
                <div :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                    class="transition-all duration-1000 ease-out">
                    <h2 class="text-3xl font-bold mb-4">About Our School</h2>
                    <p class="text-gray-600 leading-relaxed">
                        SMK Metland didirikan oleh Yayasan Pendidikan Metland (YPM), berada di bawah naungan PT
                        Metropolitan Land, Tbk. Keberhasilan pengembangan SMK Metland di kawasan Metland Transyogi Bogor
                        (dalam kurun waktu 10 tahun) sebagai SMK dengan standar internasional mendorong Yayasan
                        Pendidikan Metland untuk mengembangkan SMK Metland di kawasan Perumahan Metland Cibitung yang
                        dimulai pada tahun 2021. Hal ini ditandai dengan didirikannya bangunan sekolah dengan fasilitas
                        lengkap pada tahun 2022 di lokasi yang strategis.
                    </p>
                </div>
                <!-- IMAGE -->
                <div :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 -translate-y-16'"
                    class="transition-all duration-1000 ease-out">
                    <img src="{{ asset('image/sekolahsmkmetland.png') }}" class="rounded-xl shadow-lg w-full">
                </div>
            </div>

            <!-- ITEM 2 -->
            <div x-data="scrollAnim()" x-init="init()" class="grid md:grid-cols-2 gap-12 items-center">
                <div :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                    class="transition-all duration-1000 ease-out order-2 md:order-1">
                    <h2 class="text-3xl font-bold mb-4">Industry Based Learning</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Program Industry Based Learning di sekolah kami dirancang untuk menjembatani pendidikan dengan
                        kebutuhan industri nyata. Siswa tidak hanya mempelajari teori di kelas, tetapi juga mendapatkan
                        pengalaman praktik berbasis standar dunia kerja sehingga lebih siap menghadapi tantangan
                        profesional setelah lulus. Siswa dibimbing langsung oleh mentor profesional agar siap masuk
                        dunia kerja.
                    </p>
                </div>
                <div :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 -translate-y-16'"
                    class="transition-all duration-1000 ease-out order-1 md:order-2">
                    <img src="{{ asset('image/sekolahsmkmetland3.png') }}" class="rounded-xl shadow-lg w-full">
                </div>
            </div>

            <!-- ITEM 3 -->
            <div x-data="scrollAnim()" x-init="init()" class="grid md:grid-cols-2 gap-12 items-center">
                <div :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                    class="transition-all duration-1000 ease-out">
                    <h2 class="text-3xl font-bold mb-4">Generasi Cinta Prestasi</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Generasi Cinta Prestasi (GCP) adalah program unggulan di SMK Pariwisata Metland School Cileungsi
                        yang dirancang untuk menyambut siswa baru sekaligus menanamkan budaya prestasi dalam diri setiap
                        peserta didik. Program ini memberikan pengalaman edukatif yang memotivasi siswa untuk
                        mengembangkan kemampuan akademik, kreativitas, karakter, dan soft skills sejak awal masa
                        sekolah.
                    </p>
                </div>
                <div :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 -translate-y-16'"
                    class="transition-all duration-1000 ease-out">
                    <img src="{{ asset('image/sekolahsmkmetland4.png') }}" class="rounded-xl shadow-lg w-full">
                </div>
            </div>
        </div>
    </section> --}}

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
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" x-text="t[lang].programTitle"></h1>
                <p class="text-gray-300 max-w-xl mx-auto" x-text="t[lang].programDesc"></p>
            </div>

            <div x-data="{
                active: null,
                leaving: null,
                items: [
                    { id: 1, title: 'PPLG', image: '{{ asset('image/pplg1.png') }}' },
                    { id: 2, title: 'DKV', image: '{{ asset('image/dkv1.png') }}' },
                    { id: 3, title: 'AKUNTANSI', image: '{{ asset('image/akuntansi1.png') }}' },
                    { id: 4, title: 'KULINER', image: '{{ asset('image/kuliner1.png') }}' },
                    { id: 5, title: 'PERHOTELAN', image: '{{ asset('image/perhotelan1.png') }}' }
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
                            :class="active === item.id ? 'scale-105 brightness-100' : leaving === item.id ? 'brightness-75' :
                                'brightness-50'">
                        </div>
                        <!-- OVERLAY -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
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
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Judul -->
            <div class="text-center mb-14">
                <h2 class="text-3xl md:text-4xl font-bold text-[#1E2188]">Berita Sekolah</h2>
                <p class="text-gray-600 mt-2">Informasi dan kegiatan terbaru dari sekolah SMK Metland</p>
            </div>

            <!-- Grid Card -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div
                    class="bg-white rounded-2xl shadow-md overflow-hidden group transition-all duration-500 hover:shadow-xl">
                    <div class="overflow-hidden">
                        <img src="/image/berita1.png"
                            class="h-52 w-full object-cover transition-transform duration-700 group-hover:scale-110">
                    </div>
                    <div class="p-6">
                        <span class="text-xs text-[#1E2188] font-semibold">Event</span>
                        <h3 class="font-bold text-lg mt-2 group-hover:text-[#1E2188] transition">
                            SMK Pariwisata Metland School Gelar Perayaan Hari Ibu Sekaligus Penganugerahan Yuva & Yuvati
                            Abhipraya Nawasena
                        </h3>
                        <p class="text-sm text-gray-600 mt-2">
                            Suasana khidmat dan penuh kehangatan menyelimuti Aula SMK Pariwisata Metland School. Sekolah
                            kejuruan pariwisata ternama ini menggelar peringatan Hari Ibu yang dirangkaikan dengan
                            pemberian apresiasi bergengsi bagi siswa-siswi berprestasi dalam tajuk Yuva & Yuvati
                            Abhipraya Nawasena.
                        </p>
                        <a href="#"
                            class="inline-block mt-4 text-sm font-semibold text-[#1E2188] hover:underline">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-white rounded-2xl shadow-md overflow-hidden group transition-all duration-500 hover:shadow-xl">
                    <div class="overflow-hidden">
                        <img src="/image/berita2.png"
                            class="h-52 w-full object-cover transition-transform duration-700 group-hover:scale-110">
                    </div>
                    <div class="p-6">
                        <span class="text-xs text-[#1E2188] font-semibold">Event</span>
                        <h3 class="font-bold text-lg mt-2 group-hover:text-[#1E2188] transition">
                            Kemilau Kreativitas Muda: Gen Z Outfit 2026 Guncang Mal Ciputra Cibubur
                        </h3>
                        <p class="text-sm text-gray-600 mt-2">
                            Suasana Mal Ciputra Cibubur mendadak meriah pada tanggal 20 Desember saat ratusan pasang
                            mata tertuju pada perhelatan “Gen Z Outfit”. Acara yang dirancang untuk mewadahi bakat-bakat
                            kreatif generasi masa kini ini menyuguhkan kolaborasi apik antara fashion, seni musik, dan
                            kuliner dalam satu panggung spektakuler.
                        </p>
                        <a href="#"
                            class="inline-block mt-4 text-sm font-semibold text-[#1E2188] hover:underline">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div
                    class="bg-white rounded-2xl shadow-md overflow-hidden group transition-all duration-500 hover:shadow-xl">
                    <div class="overflow-hidden">
                        <img src="/image/sekolahsmkmetland.png"
                            class="h-52 w-full object-cover transition-transform duration-700 group-hover:scale-110">
                    </div>
                    <div class="p-6">
                        <span class="text-xs text-[#1E2188] font-semibold">Event</span>
                        <h3 class="font-bold text-lg mt-2 group-hover:text-[#1E2188] transition">
                            Wisuda Angkatan 2026 Berlangsung Meriah
                        </h3>
                        <p class="text-sm text-gray-600 mt-2">
                            Momen kelulusan penuh kebanggaan bersama orang tua dan guru...
                        </p>
                        <a href="#"
                            class="inline-block mt-4 text-sm font-semibold text-[#1E2188] hover:underline">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
