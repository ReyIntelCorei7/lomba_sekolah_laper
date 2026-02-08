<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Keahlian - SMK Metland</title>
    <link rel="icon" href="/image/logometland.png" type="image/png">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body x-data="{ lang: 'id', toggleLang() { this.lang = this.lang === 'id' ? 'en' : 'id'; } }" class="bg-gray-900 text-white">
    <!-- Navbar Component -->
    <x-navbar :solidBackground="true" :showOnScroll="false" />

    <!-- Hero Section -->
    <section class="relative pt-24 pb-16">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Program Keahlian</h1>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                Pilih program keahlian sesuai minat dan bakatmu untuk masa depan yang lebih cerah di SMK Metland School
            </p>
        </div>
    </section>

    <!-- Programs Grid -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- AKL -->
                <a href="{{ route('prokeh.akuntansi') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 to-blue-800 h-80 transform hover:scale-105 transition-all duration-300 shadow-xl">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
                    <div class="relative z-10 h-full flex flex-col justify-end p-6">
                        <span class="text-blue-200 text-sm font-semibold tracking-wider mb-2">AKL</span>
                        <h3 class="text-2xl font-bold mb-2">Akuntansi & Keuangan Lembaga</h3>
                        <p class="text-gray-300 text-sm line-clamp-2">Mempelajari siklus akuntansi, komputer akuntansi, dan administrasi pajak untuk menjadi akuntan profesional.</p>
                        <span class="mt-4 text-blue-300 group-hover:translate-x-2 transition-transform inline-flex items-center gap-2">
                            Lihat Detail →
                        </span>
                    </div>
                </a>

                <!-- DKV -->
                <a href="{{ route('prokeh.dkv') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-600 to-purple-800 h-80 transform hover:scale-105 transition-all duration-300 shadow-xl">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
                    <div class="relative z-10 h-full flex flex-col justify-end p-6">
                        <span class="text-purple-200 text-sm font-semibold tracking-wider mb-2">DKV</span>
                        <h3 class="text-2xl font-bold mb-2">Desain Komunikasi Visual</h3>
                        <p class="text-gray-300 text-sm line-clamp-2">Menguasai desain grafis, multimedia, dan animasi untuk menjadi desainer kreatif yang handal.</p>
                        <span class="mt-4 text-purple-300 group-hover:translate-x-2 transition-transform inline-flex items-center gap-2">
                            Lihat Detail →
                        </span>
                    </div>
                </a>

                <!-- PPLG -->
                <a href="{{ route('prokeh.pplg') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-green-600 to-green-800 h-80 transform hover:scale-105 transition-all duration-300 shadow-xl">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
                    <div class="relative z-10 h-full flex flex-col justify-end p-6">
                        <span class="text-green-200 text-sm font-semibold tracking-wider mb-2">PPLG</span>
                        <h3 class="text-2xl font-bold mb-2">Pengembangan Perangkat Lunak & Gim</h3>
                        <p class="text-gray-300 text-sm line-clamp-2">Belajar pemrograman, pengembangan aplikasi web, mobile, dan game development.</p>
                        <span class="mt-4 text-green-300 group-hover:translate-x-2 transition-transform inline-flex items-center gap-2">
                            Lihat Detail →
                        </span>
                    </div>
                </a>

                <!-- Kuliner -->
                <a href="{{ route('prokeh.kuliner') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-orange-600 to-orange-800 h-80 transform hover:scale-105 transition-all duration-300 shadow-xl">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
                    <div class="relative z-10 h-full flex flex-col justify-end p-6">
                        <span class="text-orange-200 text-sm font-semibold tracking-wider mb-2">KLN</span>
                        <h3 class="text-2xl font-bold mb-2">Kuliner</h3>
                        <p class="text-gray-300 text-sm line-clamp-2">Menguasai teknik memasak, pastry, dan manajemen dapur untuk karir di industri kuliner.</p>
                        <span class="mt-4 text-orange-300 group-hover:translate-x-2 transition-transform inline-flex items-center gap-2">
                            Lihat Detail →
                        </span>
                    </div>
                </a>

                <!-- Hotel -->
                <a href="{{ route('prokeh.hotel') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-cyan-600 to-cyan-800 h-80 transform hover:scale-105 transition-all duration-300 shadow-xl">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors"></div>
                    <div class="relative z-10 h-full flex flex-col justify-end p-6">
                        <span class="text-cyan-200 text-sm font-semibold tracking-wider mb-2">HTL</span>
                        <h3 class="text-2xl font-bold mb-2">Perhotelan</h3>
                        <p class="text-gray-300 text-sm line-clamp-2">Mempelajari manajemen hotel, front office, housekeeping, dan hospitality industry.</p>
                        <span class="mt-4 text-cyan-300 group-hover:translate-x-2 transition-transform inline-flex items-center gap-2">
                            Lihat Detail →
                        </span>
                    </div>
                </a>

            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-blue-600 to-indigo-700">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Tertarik Bergabung?</h2>
            <p class="text-blue-100 mb-8">Daftarkan dirimu sekarang dan wujudkan masa depan cerahmu bersama SMK Metland School</p>
            <a href="{{ route('ppdb.create') }}" class="inline-block bg-white text-blue-600 font-bold px-8 py-4 rounded-xl hover:bg-gray-100 transition shadow-xl">
                Daftar PPDB Sekarang
            </a>
        </div>
    </section>

    <!-- Footer Component -->
    @include('components.footer')
</body>

</html>