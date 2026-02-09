<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/image/logometland.png" type="image/png">
    <title>Alumni - SMK Metland School</title>
    <meta name="description" content="Temui para alumni SMK Metland yang telah berhasil di berbagai bidang industri">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Translation System -->
    @include('partials.translations')

    <style>
        .alumni-card {
            perspective: 1000px;
            transform-style: preserve-3d;
        }

        .alumni-card-inner {
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            transform-style: preserve-3d;
        }

        .alumni-photo-container {
            position: relative;
            overflow: visible;
            z-index: 10;
        }

        .alumni-photo-wrapper {
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            transform-style: preserve-3d;
            border-radius: 1rem;
            overflow: hidden;
        }

        .alumni-photo {
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }

        /* Hover Effects */
        .alumni-card:hover .alumni-photo-wrapper {
            transform: translateZ(50px) translateY(-20px) rotateX(5deg);
            box-shadow:
                0 30px 60px -15px rgba(0, 0, 0, 0.4),
                0 50px 100px -20px rgba(59, 130, 246, 0.3);
        }

        .alumni-card:hover .alumni-photo {
            transform: scale(1.1);
        }

        .alumni-card:hover .alumni-card-inner {
            transform: translateY(-10px);
        }

        .alumni-card:hover .alumni-info {
            transform: translateY(-5px);
        }

        /* Background glow effect on hover */
        .alumni-card::before {
            content: '';
            position: absolute;
            inset: -10px;
            background: radial-gradient(circle at center, rgba(59, 130, 246, 0.2), transparent 70%);
            opacity: 0;
            transition: opacity 0.5s ease;
            z-index: 0;
            border-radius: 2rem;
        }

        .alumni-card:hover::before {
            opacity: 1;
        }

        /* Quote styling */
        .testimonial-quote {
            position: relative;
        }

        .testimonial-quote::before {
            content: '"';
            position: absolute;
            top: -20px;
            left: -10px;
            font-size: 4rem;
            color: rgba(59, 130, 246, 0.2);
            font-family: Georgia, serif;
            line-height: 1;
        }
    </style>
</head>

<body x-data="{
    lang: localStorage.getItem('lang') || 'id',
    toggleLang() {
        this.lang = this.lang === 'id' ? 'en' : 'id';
        localStorage.setItem('lang', this.lang);
    }
}" class="bg-gray-50">

    <!-- Navbar Component -->
    <x-navbar :solid-background="true" />

    <!-- Hero Section -->
    <section class="relative h-[350px] md:h-[450px] w-full overflow-hidden mt-16">
        <!-- Background -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-br from-[#1E2188] via-[#2a2d9e] to-[#1a1a6e]"></div>
            <!-- Pattern Overlay -->
            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,<svg xmlns=\" http://www.w3.org/2000/svg\" viewBox=\"0 0 80 80\">
                <circle cx=\"40\" cy=\"40\" r=\"2\" fill=\"white\" /></svg>'); background-size: 40px 40px;">
            </div>
        </div>

        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 rounded-full bg-blue-400/20 blur-2xl animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-32 h-32 rounded-full bg-purple-400/20 blur-3xl animate-pulse" style="animation-delay: 1s;"></div>

        <!-- Content -->
        <div class="relative z-10 h-full max-w-7xl mx-auto px-4 md:px-6 flex items-center justify-center text-center">
            <div>
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white text-xs font-medium mb-6">
                    <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                    <span x-text="$store.lang.t('alumni_success_story')">Cerita Sukses Alumni</span>
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-300 via-cyan-300 to-blue-300">Alumni</span> <span x-text="$store.lang.t('nav_home')==='Home' ? '' : 'Kami'">Kami</span>
                </h1>
                <p class="text-base md:text-lg text-blue-100 max-w-2xl mx-auto leading-relaxed" x-text="$store.lang.t('alumni_subtitle')">
                    Temui para alumni SMK Metland yang telah sukses berkarir di berbagai industri, membuktikan kualitas pendidikan kami.
                </p>

                <!-- Stats -->
                <div class="flex justify-center gap-8 md:gap-12 mt-8">
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white">{{ $alumni->total() }}+</div>
                        <div class="text-xs md:text-sm text-blue-200 uppercase tracking-wider" x-text="$store.lang.t('alumni_stats')">Alumni</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white">5</div>
                        <div class="text-xs md:text-sm text-blue-200 uppercase tracking-wider" x-text="$store.lang.t('alumni_programs')">Jurusan</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white">10+</div>
                        <div class="text-xs md:text-sm text-blue-200 uppercase tracking-wider" x-text="$store.lang.t('alumni_years')">Tahun</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="bg-white border-b sticky top-16 z-30 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-4">
            <form method="GET" class="flex flex-wrap items-center gap-4">
                <span class="text-gray-600 font-medium text-sm hidden md:inline">Filter:</span>

                <select name="year" onchange="this.form.submit()"
                    class="px-4 py-2 bg-gray-100 border border-gray-200 rounded-full text-gray-700 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="" x-text="$store.lang.t('alumni_all_years')">Semua Tahun</option>
                    @foreach($years as $year)
                    <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>

                <select name="program" onchange="this.form.submit()"
                    class="px-4 py-2 bg-gray-100 border border-gray-200 rounded-full text-gray-700 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="" x-text="$store.lang.t('alumni_all_programs')">Semua Jurusan</option>
                    @foreach($programs as $key => $label)
                    <option value="{{ $key }}" {{ request('program') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>

                @if(request()->hasAny(['year', 'program']))
                <a href="{{ route('alumni.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium" x-text="$store.lang.t('alumni_reset_filter')">
                    Reset Filter
                </a>
                @endif
            </form>
        </div>
    </section>

    <!-- Alumni Grid -->
    <section class="py-12 md:py-20">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            @if($alumni->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
                @foreach($alumni as $person)
                <!-- Alumni Card with 3D Effect -->
                <div class="alumni-card relative group">
                    <div class="alumni-card-inner bg-white rounded-2xl shadow-lg overflow-visible transition-all duration-500">

                        <!-- Photo Container with 3D Pop Effect -->
                        <div class="alumni-photo-container p-4 pb-0">
                            <div class="alumni-photo-wrapper relative aspect-[4/5] rounded-xl overflow-hidden">
                                <!-- Photo -->
                                <img src="{{ $person->photo_url }}"
                                    alt="{{ $person->name }}"
                                    class="alumni-photo w-full h-full object-cover">

                                <!-- Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                                <!-- Year Badge -->
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-gray-800 text-sm font-bold rounded-full shadow-lg">
                                        {{ $person->graduation_year }}
                                    </span>
                                </div>

                                <!-- Featured Badge -->
                                @if($person->is_featured)
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 bg-yellow-400 text-yellow-900 text-xs font-bold rounded-full shadow-lg flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        Featured
                                    </span>
                                </div>
                                @endif

                                <!-- Name on Photo -->
                                <div class="absolute bottom-4 left-4 right-4">
                                    <h3 class="text-xl md:text-2xl font-bold text-white drop-shadow-lg">
                                        {{ $person->name }}
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <!-- Info Section -->
                        <div class="alumni-info p-5 pt-4 transition-all duration-500">
                            <!-- Program Badge -->
                            <span class="inline-block px-3 py-1 {{ $person->program_color }} text-white text-xs font-semibold rounded-full mb-3">
                                {{ $person->program_label }}
                            </span>

                            <!-- Position & Company -->
                            @if($person->current_position || $person->company_or_university)
                            <div class="space-y-1 mb-4">
                                @if($person->current_position)
                                <p class="text-gray-800 font-semibold">{{ $person->current_position }}</p>
                                @endif
                                @if($person->company_or_university)
                                <p class="text-gray-500 text-sm flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    {{ $person->company_or_university }}
                                </p>
                                @endif
                            </div>
                            @endif

                            <!-- Testimonial -->
                            @if($person->testimonial)
                            <div class="testimonial-quote relative bg-gray-50 rounded-xl p-4 mt-4">
                                <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
                                    {{ $person->testimonial }}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $alumni->links() }}
            </div>
            @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13-5.803a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2" x-text="$store.lang.t('alumni_no_alumni')">Belum Ada Alumni</h3>
                <p class="text-gray-500" x-text="$store.lang.t('alumni_no_alumni_desc')">Data alumni belum tersedia untuk filter yang dipilih.</p>
            </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-[#1E2188] to-[#2a2d9e] py-16">
        <div class="max-w-4xl mx-auto px-4 md:px-6 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-4" x-text="$store.lang.t('alumni_cta_title')">Jadilah Bagian dari Alumni Sukses!</h2>
            <p class="text-blue-100 mb-8 max-w-2xl mx-auto" x-text="$store.lang.t('alumni_cta_desc')">
                Bergabunglah dengan SMK Metland dan bangun karir impianmu bersama kami.
            </p>
            <a href="/ppdb" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-[#1E2188] font-bold rounded-full hover:bg-blue-50 transition-colors shadow-lg hover:shadow-xl">
                <span x-text="$store.lang.t('btn_register')">Daftar Sekarang</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </section>

    <!-- Footer -->
    @include('components.footer')

</body>

</html>