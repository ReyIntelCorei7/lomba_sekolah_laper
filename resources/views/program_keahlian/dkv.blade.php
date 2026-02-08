<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desain Komunikasi Visual - SMK Metland School</title>
    <meta name="description" content="Program keahlian Desain Komunikasi Visual SMK Metland - Kuasai desain grafis, multimedia, dan animasi">
    <link rel="icon" href="/image/logometland.png" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html { scroll-behavior: smooth; }
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animated-gradient {
            background: linear-gradient(135deg, #a855f7, #ec4899, #a855f7);
            background-size: 300% 300%;
            animation: gradient-shift 4s ease infinite;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .floating { animation: float 6s ease-in-out infinite; }
        .floating-delay { animation: float 6s ease-in-out infinite; animation-delay: 2s; }
        .skill-card {
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        }
        .skill-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(168, 85, 247, 0.25);
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(168, 85, 247, 0.3); }
            50% { box-shadow: 0 0 40px rgba(168, 85, 247, 0.6); }
        }
        .pulse-glow { animation: pulse-glow 3s ease-in-out infinite; }
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .marquee-content { animation: marquee 30s linear infinite; }
    </style>
</head>

<body x-data="{ activeTab: 'materi' }" class="bg-gray-50">
    @include('components.navbar', ['solidBackground' => true, 'showOnScroll' => false])

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('image/dkv1.png') }}" alt="DKV SMK Metland" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-900/90 via-slate-900/80 to-pink-900/90"></div>
        </div>
        
        <div class="absolute top-20 left-10 w-32 h-32 rounded-full bg-purple-500/20 blur-3xl floating"></div>
        <div class="absolute bottom-40 right-20 w-48 h-48 rounded-full bg-pink-500/20 blur-3xl floating-delay"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 md:px-6 py-32 text-center">
            <div class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white mb-8">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-purple-400"></span>
                </span>
                <span class="text-sm font-medium">Program Keahlian Kreatif</span>
            </div>
            
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white mb-6 leading-tight">
                Desain <br class="hidden md:block">
                <span class="animated-gradient">Komunikasi Visual</span>
            </h1>
            
            <p class="text-lg md:text-xl text-purple-100 max-w-3xl mx-auto mb-10 leading-relaxed">
                Kuasai desain grafis, multimedia, videografi, dan animasi untuk menjadi kreator visual profesional yang kreatif dan inovatif.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                <a href="/ppdb" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-purple-700 font-bold rounded-xl hover:bg-purple-50 transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Daftar Sekarang
                </a>
                <a href="#overview" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-transparent border-2 border-white/50 text-white font-semibold rounded-xl hover:bg-white/10 transition-all">
                    Pelajari Lebih Lanjut
                </a>
            </div>
            
            <div class="grid grid-cols-3 gap-4 md:gap-8 max-w-2xl mx-auto">
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 md:p-6 border border-white/20">
                    <div class="text-3xl md:text-4xl font-bold text-white">6+</div>
                    <div class="text-xs md:text-sm text-purple-200 uppercase tracking-wider">Software</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 md:p-6 border border-white/20">
                    <div class="text-3xl md:text-4xl font-bold text-white">100%</div>
                    <div class="text-xs md:text-sm text-purple-200 uppercase tracking-wider">Praktik</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 md:p-6 border border-white/20">
                    <div class="text-3xl md:text-4xl font-bold text-white">∞</div>
                    <div class="text-xs md:text-sm text-purple-200 uppercase tracking-wider">Kreativitas</div>
                </div>
            </div>
        </div>
        
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
            <a href="#overview" class="text-white/60 hover:text-white transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </a>
        </div>
    </section>

    <!-- Overview Section -->
    <section id="overview" class="py-20 md:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <div>
                    <span class="inline-block px-4 py-1.5 bg-purple-100 text-purple-700 text-sm font-semibold rounded-full mb-6">TENTANG PROGRAM</span>
                    <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        Wujudkan <span class="text-purple-600">Imajinasi</span> Menjadi Karya Visual
                    </h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-8">
                        Program DKV SMK Metland membekali siswa dengan kemampuan desain grafis, multimedia, fotografi, videografi, dan animasi. Siswa akan belajar menggunakan software industri dan mengembangkan portofolio profesional.
                    </p>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Adobe Creative Suite</h3>
                                <p class="text-gray-600">Photoshop, Illustrator, Premiere Pro, After Effects</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Produksi Konten Digital</h3>
                                <p class="text-gray-600">Fotografi, videografi, editing profesional</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Creative Thinking</h3>
                                <p class="text-gray-600">Pengembangan konsep dan ide kreatif</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                        <img src="{{ asset('image/dkv2.png') }}" alt="Siswa DKV" class="w-full h-auto">
                        <div class="absolute inset-0 bg-gradient-to-t from-purple-900/50 to-transparent"></div>
                    </div>
                    
                    <div class="absolute -bottom-6 -left-6 md:-left-12 bg-white rounded-2xl shadow-xl p-4 md:p-6 border border-gray-100 pulse-glow">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">Freelance</div>
                                <div class="text-gray-500 text-sm">Bisa Kerja Remote</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tab Section -->
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="text-center mb-12">
                <span class="inline-block px-4 py-1.5 bg-purple-100 text-purple-700 text-sm font-semibold rounded-full mb-4">KURIKULUM & KARIR</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Apa yang Akan Kamu Pelajari?</h2>
            </div>
            
            <div class="flex justify-center mb-12">
                <div class="inline-flex bg-gray-100 rounded-xl p-1.5">
                    <button @click="activeTab = 'materi'" 
                            :class="activeTab === 'materi' ? 'bg-white shadow-lg text-purple-600' : 'text-gray-600 hover:text-gray-900'"
                            class="px-6 py-3 rounded-lg font-semibold transition-all">
                        🎨 Materi Pembelajaran
                    </button>
                    <button @click="activeTab = 'karir'" 
                            :class="activeTab === 'karir' ? 'bg-white shadow-lg text-purple-600' : 'text-gray-600 hover:text-gray-900'"
                            class="px-6 py-3 rounded-lg font-semibold transition-all">
                        💼 Peluang Karir
                    </button>
                </div>
            </div>
            
            <!-- Tab Content: Materi -->
            <div x-show="activeTab === 'materi'" x-transition>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Desain Grafis</h3>
                        <p class="text-gray-600">Prinsip desain, tipografi, layout, dan branding dengan Adobe Photoshop & Illustrator.</p>
                    </div>
                    
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Videografi</h3>
                        <p class="text-gray-600">Teknik pengambilan gambar, editing video, dan produksi konten dengan Premiere Pro.</p>
                    </div>
                    
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Motion Graphics</h3>
                        <p class="text-gray-600">Animasi 2D, motion design, dan visual effects dengan After Effects.</p>
                    </div>
                    
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Fotografi</h3>
                        <p class="text-gray-600">Teknik fotografi, lighting, komposisi, dan photo editing profesional.</p>
                    </div>
                    
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">UI/UX Design</h3>
                        <p class="text-gray-600">Desain antarmuka dan pengalaman pengguna untuk aplikasi & website.</p>
                    </div>
                    
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-pink-500 to-rose-600 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Ilustrasi Digital</h3>
                        <p class="text-gray-600">Menggambar digital, character design, dan ilustrasi untuk berbagai media.</p>
                    </div>
                </div>
            </div>
            
            <!-- Tab Content: Karir -->
            <div x-show="activeTab === 'karir'" x-transition>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="skill-card bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">🎨</div>
                        <h3 class="text-xl font-bold mb-2">Graphic Designer</h3>
                        <p class="text-purple-100 text-sm">Merancang visual untuk brand dan marketing</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-blue-500 to-cyan-600 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">🎬</div>
                        <h3 class="text-xl font-bold mb-2">Video Editor</h3>
                        <p class="text-blue-100 text-sm">Editing video untuk konten digital</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">✨</div>
                        <h3 class="text-xl font-bold mb-2">Motion Designer</h3>
                        <p class="text-orange-100 text-sm">Animasi dan efek visual</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-green-500 to-teal-600 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">📸</div>
                        <h3 class="text-xl font-bold mb-2">Photographer</h3>
                        <p class="text-green-100 text-sm">Fotografi produk, portrait, event</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-indigo-500 to-violet-600 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">📱</div>
                        <h3 class="text-xl font-bold mb-2">UI/UX Designer</h3>
                        <p class="text-indigo-100 text-sm">Desain aplikasi dan website</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-pink-500 to-rose-600 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">📣</div>
                        <h3 class="text-xl font-bold mb-2">Content Creator</h3>
                        <p class="text-pink-100 text-sm">Kreator konten sosial media</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-amber-500 to-yellow-600 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">🖌️</div>
                        <h3 class="text-xl font-bold mb-2">Illustrator</h3>
                        <p class="text-amber-100 text-sm">Ilustrasi buku, game, dan media</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">💻</div>
                        <h3 class="text-xl font-bold mb-2">Freelancer</h3>
                        <p class="text-slate-300 text-sm">Kerja remote dari mana saja</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-20 overflow-hidden bg-gradient-to-br from-purple-600 via-pink-600 to-purple-700">
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 80 80\"><circle cx=\"40\" cy=\"40\" r=\"2\" fill=\"white\"/></svg>'); background-size: 40px 40px;"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4 md:px-6 text-center">
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Siap Menjadi Kreator Visual?</h2>
            <p class="text-xl text-purple-100 mb-10 max-w-2xl mx-auto">
                Bergabunglah dengan program DKV SMK Metland dan wujudkan kreativitasmu!
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/ppdb" class="inline-flex items-center justify-center gap-2 px-10 py-5 bg-white text-purple-700 font-bold text-lg rounded-xl hover:bg-gray-100 transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1">
                    Daftar PPDB Sekarang
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="/prokeh" class="inline-flex items-center justify-center gap-2 px-10 py-5 bg-transparent border-2 border-white text-white font-semibold text-lg rounded-xl hover:bg-white/10 transition-all">
                    ← Lihat Jurusan Lain
                </a>
            </div>
        </div>
    </section>

    @include('components.footer')
</body>
</html>
