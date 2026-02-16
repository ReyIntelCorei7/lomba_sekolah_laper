<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/image/logometland.png" type="image/png">
    <title>{{ $program->name }} - SMK Metland</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Translation System -->
    @include('partials.translations')

    @php
    use Illuminate\Support\Facades\Storage;

    // Define color configurations
    $colorConfig = [
    'indigo' => [
    'hero_gradient' => 'from-indigo-900/90 via-slate-900/80 to-slate-900/90',
    'text_primary' => 'text-indigo-600',
    'bg_primary' => 'bg-indigo-100',
    'btn_gradient' => 'from-indigo-600 to-purple-600',
    'cta_gradient' => 'from-indigo-600 via-purple-600 to-indigo-700',
    ],
    'purple' => [
    'hero_gradient' => 'from-purple-900/90 via-slate-900/80 to-pink-900/90',
    'text_primary' => 'text-purple-600',
    'bg_primary' => 'bg-purple-100',
    'btn_gradient' => 'from-purple-600 to-pink-600',
    'cta_gradient' => 'from-purple-600 via-pink-600 to-purple-700',
    ],
    'emerald' => [
    'hero_gradient' => 'from-emerald-900/90 via-slate-900/80 to-teal-900/90',
    'text_primary' => 'text-emerald-600',
    'bg_primary' => 'bg-emerald-100',
    'btn_gradient' => 'from-emerald-600 to-teal-600',
    'cta_gradient' => 'from-emerald-600 via-teal-600 to-cyan-700',
    ],
    'orange' => [
    'hero_gradient' => 'from-orange-900/90 via-slate-900/80 to-amber-900/90',
    'text_primary' => 'text-orange-600',
    'bg_primary' => 'bg-orange-100',
    'btn_gradient' => 'from-orange-600 to-amber-600',
    'cta_gradient' => 'from-orange-600 via-amber-600 to-orange-700',
    ],
    'cyan' => [
    'hero_gradient' => 'from-cyan-900/90 via-slate-900/80 to-sky-900/90',
    'text_primary' => 'text-cyan-600',
    'bg_primary' => 'bg-cyan-100',
    'btn_gradient' => 'from-cyan-600 to-sky-600',
    'cta_gradient' => 'from-cyan-600 via-sky-600 to-blue-700',
    ],
    ];

    $colors = $colorConfig[$program->color_theme] ?? $colorConfig['indigo'];
    @endphp

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        @keyframes gradient-shift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
            }

            50% {
                box-shadow: 0 0 40px rgba(99, 102, 241, 0.6);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-delayed {
            animation: float 6s ease-in-out infinite 2s;
        }

        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient-shift 4s ease infinite;
        }

        .animate-pulse-glow {
            animation: pulse-glow 3s ease-in-out infinite;
        }
    </style>
</head>

<body class="antialiased bg-slate-50" x-data="{ menuOpen: false }">
    @include('components.navbar', ['solidBackground' => true, 'showOnScroll' => false])
    @include('components.mega-menu')

    <!-- Hero Section - Full Screen with Parallax -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0">
            @if($program->hero_image)
            <img src="{{ Storage::url($program->hero_image) }}" alt="{{ $program->name }}"
                class="w-full h-full object-cover">
            @else
            <img src="{{ asset('image/1.png') }}" alt="{{ $program->name }}"
                class="w-full h-full object-cover">
            @endif
            <div class="absolute inset-0 bg-gradient-to-br {{ $colors['hero_gradient'] }}"></div>
        </div>

        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-72 h-72 bg-gradient-to-r {{ $colors['btn_gradient'] }} opacity-30 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-gradient-to-r {{ $colors['btn_gradient'] }} opacity-20 rounded-full blur-3xl animate-float-delayed"></div>

        <!-- Hero Content -->
        <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 backdrop-blur-md rounded-full text-white/90 text-sm font-medium mb-8 border border-white/20">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-400"></span>
                </span>
                Program Keahlian Unggulan
            </div>

            <h1 class="text-5xl md:text-7xl font-black text-white mb-6 leading-tight">
                {{ $program->name }}
            </h1>

            <p class="text-xl text-white/80 mb-10 max-w-3xl mx-auto leading-relaxed">
                {{ $program->description }}
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                <a href="{{ route('ppdb.index') }}" class="group inline-flex items-center gap-3 px-8 py-4 bg-white {{ $colors['text_primary'] }} font-bold rounded-2xl hover:bg-opacity-90 transition-all duration-300 shadow-2xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Daftar Sekarang
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
                <a href="#overview" class="inline-flex items-center gap-3 px-8 py-4 border-2 border-white/30 text-white font-bold rounded-2xl hover:bg-white/10 transition-all duration-300 backdrop-blur-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Pelajari Lebih Lanjut
                </a>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-3 gap-4 max-w-2xl mx-auto">
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20">
                    <div class="text-3xl font-black text-white">{{ $program->stat_competencies }}+</div>
                    <div class="text-white/70 text-sm">{{ $program->stat_label_1 }}</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20">
                    <div class="text-3xl font-black text-white">{{ $program->stat_employment }}%</div>
                    <div class="text-white/70 text-sm">{{ $program->stat_label_2 }}</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20">
                    <div class="text-3xl font-black text-white">{{ $program->stat_partners }}+</div>
                    <div class="text-white/70 text-sm">{{ $program->stat_label_3 }}</div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <a href="#overview" class="text-white/60 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </a>
        </div>
    </section>

    <!-- Overview Section -->
    <section id="overview" class="py-20 md:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="inline-block px-4 py-2 {{ $colors['bg_primary'] }} {{ $colors['text_primary'] }} rounded-full text-sm font-semibold mb-6">
                        {{ $program->short_name }}
                    </span>
                    <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-6">
                        Mengapa Memilih <span class="{{ $colors['text_primary'] }}">{{ $program->short_name }}</span>?
                    </h2>
                    <p class="text-lg text-slate-600 mb-8 leading-relaxed">
                        {{ $program->overview_content ?? $program->description }}
                    </p>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="flex items-start gap-4 p-4 rounded-xl bg-slate-50">
                            <div class="w-10 h-10 flex items-center justify-center rounded-lg {{ $colors['bg_primary'] }} {{ $colors['text_primary'] }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900">Kurikulum Industri</h4>
                                <p class="text-sm text-slate-600">Sesuai kebutuhan dunia kerja</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 rounded-xl bg-slate-50">
                            <div class="w-10 h-10 flex items-center justify-center rounded-lg {{ $colors['bg_primary'] }} {{ $colors['text_primary'] }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900">Praktik Langsung</h4>
                                <p class="text-sm text-slate-600">Fasilitas lengkap & modern</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 rounded-xl bg-slate-50">
                            <div class="w-10 h-10 flex items-center justify-center rounded-lg {{ $colors['bg_primary'] }} {{ $colors['text_primary'] }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900">Magang Industri</h4>
                                <p class="text-sm text-slate-600">Pengalaman kerja nyata</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 rounded-xl bg-slate-50">
                            <div class="w-10 h-10 flex items-center justify-center rounded-lg {{ $colors['bg_primary'] }} {{ $colors['text_primary'] }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900">Sertifikasi LSP</h4>
                                <p class="text-sm text-slate-600">Diakui secara nasional</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-r {{ $colors['btn_gradient'] }} rounded-3xl blur-2xl opacity-20 animate-pulse-glow"></div>
                    @if($program->overview_image)
                    <img src="{{ Storage::url($program->overview_image) }}" alt="{{ $program->name }}"
                        class="relative rounded-3xl shadow-2xl w-full object-cover aspect-[4/3]">
                    @else
                    <img src="{{ asset('image/1.png') }}" alt="{{ $program->name }}"
                        class="relative rounded-3xl shadow-2xl w-full object-cover aspect-[4/3]">
                    @endif

                    @if($program->salary_range)
                    <!-- Floating Card -->
                    <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl shadow-xl p-4 border border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-gradient-to-r {{ $colors['btn_gradient'] }} text-white text-xl">
                                💰
                            </div>
                            <div>
                                <div class="text-sm text-slate-500">{{ $program->salary_label }}</div>
                                <div class="text-lg font-bold text-slate-900">{{ $program->salary_range }}</div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Tab Section - Curriculum & Careers -->
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white" x-data="{ activeTab: 'materi' }">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
                    Jelajahi <span class="{{ $colors['text_primary'] }}">Program Kami</span>
                </h2>
                <p class="text-lg text-slate-600">Materi pembelajaran dan peluang karir yang menanti</p>
            </div>

            <!-- Tab Navigation -->
            <div class="flex justify-center mb-12">
                <div class="inline-flex bg-slate-100 rounded-2xl p-1.5">
                    <button @click="activeTab = 'materi'"
                        :class="activeTab === 'materi' ? 'bg-white {{ $colors['text_primary'] }} shadow-lg' : 'text-slate-600 hover:text-slate-900'"
                        class="px-8 py-3 rounded-xl font-semibold transition-all duration-300">
                        📚 Materi Pembelajaran
                    </button>
                    <button @click="activeTab = 'karir'"
                        :class="activeTab === 'karir' ? 'bg-white {{ $colors['text_primary'] }} shadow-lg' : 'text-slate-600 hover:text-slate-900'"
                        class="px-8 py-3 rounded-xl font-semibold transition-all duration-300">
                        💼 Peluang Karir
                    </button>
                </div>
            </div>

            <!-- Tab Content: Materi -->
            <div x-show="activeTab === 'materi'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
                @if($program->skills->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($program->skills as $skill)
                    @php
                    $skillGradient = 'from-' . $skill->gradient_from . ' to-' . $skill->gradient_to;
                    // Fallback for Tailwind - use inline style instead
                    @endphp
                    <div class="group bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-slate-100 hover:-translate-y-1">
                        <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-gradient-to-r from-blue-500 to-indigo-600 text-white text-2xl mb-4 group-hover:scale-110 transition-transform">
                            {{ $skill->icon ?? '📚' }}
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $skill->name }}</h3>
                        <p class="text-slate-600">{{ $skill->description }}</p>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12 text-slate-500">
                    <p>Belum ada data materi pembelajaran</p>
                </div>
                @endif
            </div>

            <!-- Tab Content: Karir -->
            <div x-show="activeTab === 'karir'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
                @if($program->careers->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($program->careers as $career)
                    <div class="group text-center p-6 rounded-2xl bg-slate-50 hover:bg-slate-100 transition-all duration-300 border border-slate-100">
                        <div class="w-16 h-16 flex items-center justify-center mx-auto rounded-2xl bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-2xl mb-4 group-hover:scale-110 transition-transform">
                            {{ $career->icon ?? '💼' }}
                        </div>
                        <h4 class="font-bold text-slate-900 mb-2">{{ $career->name }}</h4>
                        <p class="text-sm text-slate-600">{{ $career->description }}</p>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12 text-slate-500">
                    <p>Belum ada data peluang karir</p>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-20 overflow-hidden bg-gradient-to-br {{ $colors['cta_gradient'] }}">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 80 80&quot;><circle cx=&quot;40&quot; cy=&quot;40&quot; r=&quot;2&quot; fill=&quot;white&quot;/></svg>'); background-size: 40px 40px;"></div>
        </div>

        <div class="relative max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">
                Siap Bergabung dengan Kami?
            </h2>
            <p class="text-xl text-white/80 mb-10 max-w-2xl mx-auto">
                Jadilah bagian dari program {{ $program->short_name }} SMK Metland dan wujudkan karir impianmu!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('ppdb.index') }}" class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-white {{ $colors['text_primary'] }} font-bold rounded-2xl hover:bg-opacity-90 transition-all duration-300 shadow-2xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Daftar PPDB Online
                </a>
                <a href="{{ route('prokeh.index') }}" class="inline-flex items-center justify-center gap-3 px-8 py-4 border-2 border-white text-white font-bold rounded-2xl hover:bg-white/10 transition-all duration-300">
                    Lihat Program Lainnya
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('components.footer')
</body>

</html>