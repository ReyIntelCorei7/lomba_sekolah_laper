<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/image/logometland.png" type="image/png">
    <title>Ekstrakurikuler - SMK Metland School</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Translation System -->
    @include('partials.translations')

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Card flip animation */
        .flip-card {
            perspective: 1000px;
        }

        .flip-card-inner {
            transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transform-style: preserve-3d;
        }

        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg);
        }

        .flip-card-front,
        .flip-card-back {
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }

        .flip-card-back {
            transform: rotateY(180deg);
        }

        /* Glow effect */
        .glow-effect:hover {
            box-shadow: 0 0 30px rgba(59, 130, 246, 0.3);
        }

        /* Stagger animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
    </style>
</head>

<body class="bg-gray-900 text-gray-100 min-h-screen" x-data>
    <!-- Navbar -->
    @include('components.navbar', ['solidBackground' => true, 'showOnScroll' => false])

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0 bg-gradient-to-b from-[#1E2188] via-gray-900 to-gray-900"></div>
        <div class="absolute inset-0 opacity-20" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%239C92AC\' fill-opacity=\'0.1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

        <div class="relative max-w-7xl mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white text-sm font-medium mb-6">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                {{ $extracurriculars->count() }}+ <span x-text="$store.lang.t('eskul_active')">Kegiatan Aktif</span>
            </div>

            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 tracking-tight">
                Ekstra<span class="text-blue-400">kurikuler</span>
            </h1>

            <p class="text-gray-300 text-lg md:text-xl max-w-2xl mx-auto mb-12" x-text="$store.lang.t('eskul_subtitle')">
                Kembangkan bakat dan minatmu melalui berbagai kegiatan ekstrakurikuler yang menarik dan berprestasi
            </p>

            <!-- Category Filter Pills -->
            <div class="flex flex-wrap justify-center gap-3">
                <a href="{{ route('eskul.index') }}"
                    class="px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300
                        {{ !request('category') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'bg-white/10 text-gray-300 hover:bg-white/20' }}">
                    🌟 <span x-text="$store.lang.t('eskul_all')">Semua</span>
                </a>
                <a href="{{ route('eskul.index', ['category' => 'sports']) }}"
                    class="px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300
                        {{ request('category') === 'sports' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'bg-white/10 text-gray-300 hover:bg-white/20' }}">
                    ⚽ <span x-text="$store.lang.t('eskul_cat_sports')">Olahraga</span>
                </a>
                <a href="{{ route('eskul.index', ['category' => 'arts']) }}"
                    class="px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300
                        {{ request('category') === 'arts' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'bg-white/10 text-gray-300 hover:bg-white/20' }}">
                    🎨 <span x-text="$store.lang.t('eskul_cat_arts')">Seni</span>
                </a>
                <a href="{{ route('eskul.index', ['category' => 'academic']) }}"
                    class="px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300
                        {{ request('category') === 'academic' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'bg-white/10 text-gray-300 hover:bg-white/20' }}">
                    📚 <span x-text="$store.lang.t('eskul_cat_academic')">Akademik</span>
                </a>
                <a href="{{ route('eskul.index', ['category' => 'technology']) }}"
                    class="px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300
                        {{ request('category') === 'technology' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'bg-white/10 text-gray-300 hover:bg-white/20' }}">
                    💻 <span x-text="$store.lang.t('eskul_cat_technology')">Teknologi</span>
                </a>
                <a href="{{ route('eskul.index', ['category' => 'other']) }}"
                    class="px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300
                        {{ request('category') === 'other' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'bg-white/10 text-gray-300 hover:bg-white/20' }}">
                    🎯 <span x-text="$store.lang.t('eskul_cat_other')">Lainnya</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Extracurriculars Grid -->
    <section class="py-20 bg-gray-900">
        <div class="max-w-7xl mx-auto px-6">
            @if($extracurriculars->count() > 0)
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($extracurriculars as $index => $eskul)
                <div class="flip-card h-[380px] animate-fade-in-up" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="flip-card-inner relative w-full h-full">
                        <!-- Front -->
                        <div class="flip-card-front absolute inset-0 rounded-2xl overflow-hidden glow-effect transition-all duration-300">
                            <!-- Image -->
                            <div class="relative h-full">
                                @if($eskul->image)
                                <img src="{{ asset('storage/' . $eskul->image) }}" alt="{{ $eskul->name }}"
                                    class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full bg-gradient-to-br from-[#1E2188] to-blue-900 flex items-center justify-center">
                                    <span class="text-6xl">{{ substr($eskul->category_label, 0, 2) }}</span>
                                </div>
                                @endif

                                <!-- Overlay Gradient -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>

                                <!-- Content -->
                                <div class="absolute bottom-0 left-0 right-0 p-6">
                                    <!-- Category Badge -->
                                    <span class="inline-block px-3 py-1 {{ $eskul->category_color }} text-white text-xs font-bold rounded-full mb-3">
                                        {{ $eskul->category_label }}
                                    </span>

                                    <h3 class="text-xl font-bold text-white mb-2">{{ $eskul->name }}</h3>

                                    @if($eskul->schedule)
                                    <p class="text-gray-300 text-sm flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $eskul->schedule }}
                                    </p>
                                    @endif
                                </div>

                                <!-- Flip Indicator -->
                                <div class="absolute top-4 right-4 w-10 h-10 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Back -->
                        <div class="flip-card-back absolute inset-0 rounded-2xl overflow-hidden bg-gradient-to-br from-[#1E2188] to-blue-900 p-6 flex flex-col">
                            <h3 class="text-xl font-bold text-white mb-4">{{ $eskul->name }}</h3>

                            @if($eskul->description)
                            <p class="text-gray-300 text-sm flex-grow line-clamp-4 mb-4">
                                {{ $eskul->description }}
                            </p>
                            @endif

                            <div class="space-y-3 text-sm">
                                @if($eskul->coach)
                                <div class="flex items-center gap-3 text-gray-300">
                                    <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <span>{{ $eskul->coach }}</span>
                                </div>
                                @endif

                                @if($eskul->schedule)
                                <div class="flex items-center gap-3 text-gray-300">
                                    <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <span>{{ $eskul->schedule }}</span>
                                </div>
                                @endif
                            </div>

                            @if($eskul->achievements)
                            <div class="mt-4 pt-4 border-t border-white/20">
                                <p class="text-xs text-blue-300 font-medium mb-2">🏆 <span x-text="$store.lang.t('eskul_achievements')">Prestasi</span></p>
                                <p class="text-gray-300 text-xs line-clamp-2">{{ $eskul->achievements }}</p>
                            </div>
                            @endif

                            <a href="{{ route('eskul.show', $eskul->slug) }}"
                                class="mt-4 block text-center py-2.5 bg-white/10 hover:bg-white/20 text-white rounded-lg font-medium transition-colors">
                                <span x-text="$store.lang.t('eskul_view_detail')">Lihat Detail →</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-20">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gray-800 flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2" x-text="$store.lang.t('eskul_no_eskul')">Belum Ada Eskul</h3>
                <p class="text-gray-400" x-text="$store.lang.t('eskul_no_eskul_desc')">Ekstrakurikuler sedang dalam persiapan</p>
            </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-b from-gray-900 to-[#1E2188]">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6" x-text="$store.lang.t('eskul_cta_title')">
                Siap Bergabung?
            </h2>
            <p class="text-gray-300 text-lg mb-8" x-text="$store.lang.t('eskul_cta_desc')">
                Daftar sekarang dan kembangkan potensimu bersama kami!
            </p>
            <a href="{{ route('ppdb.index') }}"
                class="inline-flex items-center gap-2 px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-full transition-all hover:scale-105 shadow-lg shadow-blue-600/30">
                <span x-text="$store.lang.t('org_register_ppdb')">Daftar PPDB</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </section>

    <!-- Footer -->
    @include('components.footer')
</body>

</html>