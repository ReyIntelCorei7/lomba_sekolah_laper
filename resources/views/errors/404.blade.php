<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | SMK Metland School</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        'primary-dark': '#1d4ed8',
                    }
                }
            }
        }
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .gradient-text {
            background: linear-gradient(135deg, #2563eb 0%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute w-72 h-72 bg-blue-500/10 rounded-full blur-3xl -top-20 -left-20"></div>
        <div class="absolute w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl -bottom-32 -right-32"></div>
        <div class="absolute w-64 h-64 bg-purple-500/5 rounded-full blur-3xl top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
    </div>

    <div class="relative z-10 text-center px-6 max-w-2xl mx-auto">
        <!-- 404 Number with Animation -->
        <div class="floating mb-8">
            <h1 class="text-[180px] md:text-[220px] font-extrabold leading-none gradient-text">404</h1>
        </div>

        <!-- Error Message -->
        <h2 class="text-2xl md:text-4xl font-bold text-white mb-4">Halaman Tidak Ditemukan</h2>
        <p class="text-slate-400 text-base md:text-lg mb-8 max-w-md mx-auto">
            Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan. Silakan kembali ke beranda atau jelajahi halaman lainnya.
        </p>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 text-white font-semibold px-8 py-3.5 rounded-xl transition-all duration-300 shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Kembali ke Beranda
            </a>
            <a href="/ppdb" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white hover:bg-white/20 font-semibold px-8 py-3.5 rounded-xl transition-all duration-300 hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Info PPDB
            </a>
        </div>

        <!-- Quick Links -->
        <div class="mt-12 pt-8 border-t border-white/10">
            <p class="text-slate-500 text-sm mb-4">Atau kunjungi halaman lainnya:</p>
            <div class="flex flex-wrap items-center justify-center gap-4 text-sm">
                <a href="/news" class="text-slate-400 hover:text-white transition-colors">Berita</a>
                <span class="text-slate-700">•</span>
                <a href="/prokeh" class="text-slate-400 hover:text-white transition-colors">Program Keahlian</a>
                <span class="text-slate-700">•</span>
                <a href="/about" class="text-slate-400 hover:text-white transition-colors">Tentang</a>
                <span class="text-slate-700">•</span>
                <a href="/kurikulum" class="text-slate-400 hover:text-white transition-colors">Kurikulum</a>
            </div>
        </div>

        <!-- School Branding -->
        <div class="mt-10 flex items-center justify-center gap-3 text-slate-500 text-sm">
            <img src="/image/logometland.png" alt="Logo" class="w-8 h-8 opacity-60">
            <span>SMK Metland School</span>
        </div>
    </div>
</body>

</html>