<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Metland School')</title>
    
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
                        primary: '#1E2188',
                        'primary-dark': '#151767',
                        'primary-light': '#2A2DB5',
                        'secondary': '#f59e0b',
                    }
                }
            }
        }
    </script>
    
    @stack('styles')
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
            contact: 'Hubungi Kami'
        },
        en: {
            home: 'Home',
            about: 'About School',
            program: 'Study Program',
            curriculum: 'Curriculum',
            news: 'School News',
            tagline: 'Metland School: The High Standard in Vocational Education',
            ppdb: 'Admissions',
            contact: 'Contact Support'
        }
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

<!-- ================= MAIN CONTENT ================= -->
<main>
    @yield('content')
</main>

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
            <p>&copy; {{ date('Y') }} Metland School. All rights reserved.</p>
        </div>
    </div>
</footer>

@stack('scripts')
</body>
</html>