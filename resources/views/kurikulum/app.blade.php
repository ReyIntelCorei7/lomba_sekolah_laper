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

    <!-- Navbar Component -->
    <x-navbar :solidBackground="true" :showOnScroll="false" />

<section class="bg-gray-50 min-h-screen">

    <!-- HERO -->
    <div class="bg-blue-900 text-white py-20">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 ml-60 mt-20">Kurikulum Sekolah</h1>
        <p class="max-w-2xl mx-auto text-gray-200 ml-60">
            Kurikulum yang dirancang untuk membentuk karakter, kompetensi, dan kesiapan masa depan peserta didik.
        </p>
    </div>

    <!-- TENTANG KURIKULUM -->
    <div class="max-w-6xl px-6 py-16">
        <div class="flex items-center mb-10">
            <img src="{{ $logoUrl }}" class="w-14 h-14 ml-60">
            <h2 class="text-3xl font-bold text-left mb-6 ml-6 mt-6">Kurikulum SMK Metland</h2>
        </div>
        <p class="text-gray-700 text-left max-w-3xl mx-auto leading-relaxed ml-60">
            SMK Metland menerapkan kurikulum yang dirancang untuk menjawab tantangan dunia kerja dan perkembangan industri masa kini.
            Proses pembelajaran tidak hanya berfokus pada teori, tetapi juga pada penguatan keterampilan, karakter, dan sikap profesional 
            peserta didik agar siap bersaing di dunia industri maupun melanjutkan pendidikan ke jenjang yang lebih tinggi.
        </p>
    </div>

    <!-- JENIS KURIKULUM -->
    <div class="bg-white py-16">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Jenis Kurikulum</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-xl p-6 shadow hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold mb-3">Kurikulum Merdeka</h3>
                    <p class="text-gray-600">
                        Memberikan kebebasan belajar bagi siswa dengan pendekatan
                        pembelajaran berbasis proyek dan penguatan karakter.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- METODE PEMBELAJARAN -->
    <div class="py-16">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Metode Pembelajaran</h2>

            <div class="grid md:grid-cols-2 gap-10">
                <ul class="space-y-4 text-gray-700">
                    <li>✔ Project Based Learning (PjBL)</li>
                    <li>✔ Praktik langsung dan studi kasus</li>
                    <li>✔ Kolaborasi dan presentasi</li>
                    <li>✔ Pemanfaatan teknologi digital</li>
                </ul>

                <div class="bg-blue-50 rounded-xl p-6">
                    <p class="text-gray-700 leading-relaxed">
                        Metode pembelajaran dirancang untuk mendorong siswa berpikir kritis,
                        kreatif, dan mampu memecahkan masalah nyata melalui pengalaman belajar langsung.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- INDUSTRI / KESIAPAN KERJA -->
    <div class="bg-blue-900 text-white py-16">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-6">Kurikulum Berbasis Dunia Industri</h2>
            <p class="max-w-3xl mx-auto text-gray-200 leading-relaxed">
                Khusus untuk jenjang SMK, kurikulum diselaraskan dengan kebutuhan dunia usaha dan industri
                melalui program magang, teaching factory, dan kerja sama mitra industri.
            </p>
        </div>
    </div>

</section>


</div>

@include('components.footer')

<script src="//unpkg.com/alpinejs" defer></script>

</body>

</html>