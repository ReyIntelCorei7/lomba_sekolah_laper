<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metland School</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1E2188',
                        'primary-dark': '#1E2188',
                        'primary-light': '#1E2188'
                    }
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
            programDesc: 'Pilih jurusan sesuai minat dan bakatmu untuk masa depan yang lebih cerah'
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
            programDesc: 'Choose a major that matches your passion for a brighter future'
        }
    }
}" class="bg-gray-100 overflow-x-hidden">

    <!-- ================= NAVBAR ================= -->
    <header class="fixed top-0 left-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between text-white">

            <!-- Logo -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('image/logometland.png') }}" alt="Logo" class="w-8 h-auto">
                <span class="font-semibold tracking-wide">Metland School</span>
            </div>

            <!-- Menu -->
            <nav class="hidden md:flex gap-8 text-sm font-medium">
                <a href="#" class="hover:text-primary-light transition" x-text="t[lang].home"></a>
                <a href="#" class="hover:text-primary-light transition" x-text="t[lang].about"></a>
                <a href="#jurusan" class="hover:text-primary-light transition" x-text="t[lang].program"></a>
                <a href="#" class="hover:text-primary-light transition" x-text="t[lang].curriculum"></a>
                <a href="#" class="hover:text-primary-light transition" x-text="t[lang].news"></a>
            </nav>

            <!-- Language Toggle -->
            <div class="relative flex items-center bg-white/20 rounded-full p-1 text-xs w-20">
                <div class="absolute top-1 bottom-1 w-1/2 bg-primary rounded-full transition-all duration-300"
                    :class="lang === 'id' ? 'left-1' : 'left-[calc(50%+0.25rem)]'"></div>

                <button @click="lang = 'id'" class="relative z-10 w-1/2 text-center py-1 transition-colors"
                    :class="lang === 'id' ? 'text-white font-semibold' : 'text-gray-200'">ID</button>

                <button @click="lang = 'en'" class="relative z-10 w-1/2 text-center py-1 transition-colors"
                    :class="lang === 'en' ? 'text-white font-semibold' : 'text-gray-200'">EN</button>
            </div>
        </div>
    </header>

    <!-- ================= HERO ================= -->
    <section class="relative h-screen w-full overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-800 to-gray-900"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/50 to-primary-dark"></div>


        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-30"
            style="background-image: url('{{ asset('image/sekolahsmkmetland.png') }}')">
        </div>

        <div class="relative z-10 h-full flex items-center justify-center text-center px-6">
            <div class="max-w-3xl text-white">

                <img src="{{ asset('image/logometland.png') }}" alt="Logo" class="w-40 h-auto mx-auto mb-6">

                <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">
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
                        class="text-white font-semibold px-8 py-3 rounded-full hover:bg-primary-light transition"
                        x-text="t[lang].contact"></a>
                </div>
            </div>
        </div>
    </section>

    <!-- About School -->


    <!-- ================= PROGRAM KEAHLIAN ================= -->
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
                    { id: 1, title: 'PPLG', color: 'from-blue-600 to-blue-800' },
                    { id: 2, title: 'DKV', color: 'from-purple-600 to-purple-800' },
                    { id: 3, title: 'AKUNTANSI', color: 'from-green-600 to-green-800' },
                    { id: 4, title: 'KULINER', color: 'from-orange-600 to-orange-800' },
                    { id: 5, title: 'PERHOTELAN', color: 'from-red-600 to-red-800' }
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

                        <div class="absolute inset-0 bg-gradient-to-br transition-all duration-700"
                            :class="[item.color, active === item.id ? 'scale-105 brightness-100' : leaving === item.id ?
                                'brightness-75' : 'brightness-50'
                            ]">
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>

                        <div class="absolute pointer-events-none transition-all duration-700"
                            :style="active === item.id ?
                                'left:2rem;bottom:2rem;transform:none' :
                                'left:50%;top:50%;transform:translate(-50%,-50%) rotate(-90deg)'">
                            <h2 class="text-white font-bold transition-all duration-700"
                                :class="active === item.id ? 'text-5xl' : 'text-xl'" x-text="item.title"></h2>
                        </div>

                    </div>
                </template>

            </div>
        </div>
    </section>



</body>

</html>
