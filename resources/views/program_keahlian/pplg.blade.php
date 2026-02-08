<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPLG - Pengembangan Perangkat Lunak & Gim - SMK Metland School</title>
    <meta name="description" content="Program keahlian PPLG SMK Metland - Kuasai coding, web development, mobile apps, dan game development">
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
            background: linear-gradient(135deg, #10b981, #06b6d4, #10b981);
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
            box-shadow: 0 25px 50px -12px rgba(16, 185, 129, 0.25);
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(16, 185, 129, 0.3); }
            50% { box-shadow: 0 0 40px rgba(16, 185, 129, 0.6); }
        }
        .pulse-glow { animation: pulse-glow 3s ease-in-out infinite; }
        /* Code typing animation */
        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }
        .code-line {
            overflow: hidden;
            white-space: nowrap;
            animation: typing 2s steps(40) forwards;
        }
    </style>
</head>

<body x-data="{ activeTab: 'materi' }" class="bg-gray-50">
    @include('components.navbar', ['solidBackground' => true, 'showOnScroll' => false])

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('image/pplg1.png') }}" alt="PPLG SMK Metland" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-900/90 via-slate-900/85 to-teal-900/90"></div>
        </div>
        
        <div class="absolute top-20 left-10 w-32 h-32 rounded-full bg-emerald-500/20 blur-3xl floating"></div>
        <div class="absolute bottom-40 right-20 w-48 h-48 rounded-full bg-cyan-500/20 blur-3xl floating-delay"></div>
        
        <!-- Code Rain Effect -->
        <div class="absolute inset-0 opacity-5 select-none pointer-events-none font-mono text-emerald-400 text-xs overflow-hidden">
            <div class="animate-pulse">01001000 01100101 01101100 01101100 01101111 00100000 01010111 01101111 01110010 01101100 01100100</div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 md:px-6 py-32 text-center">
            <div class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white mb-8">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-400"></span>
                </span>
                <span class="text-sm font-medium font-mono">&lt;/&gt; Program Keahlian Teknologi</span>
            </div>
            
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white mb-6 leading-tight">
                Pengembangan <br class="hidden md:block">
                <span class="animated-gradient">Perangkat Lunak & Gim</span>
            </h1>
            
            <p class="text-lg md:text-xl text-emerald-100 max-w-3xl mx-auto mb-10 leading-relaxed">
                Kuasai coding, web development, aplikasi mobile, dan game development dengan teknologi terkini. Bangun masa depan digital bersama kami.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                <a href="/ppdb" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-emerald-700 font-bold rounded-xl hover:bg-emerald-50 transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                    Daftar Sekarang
                </a>
                <a href="#overview" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-transparent border-2 border-white/50 text-white font-semibold rounded-xl hover:bg-white/10 transition-all">
                    Pelajari Lebih Lanjut
                </a>
            </div>
            
            <div class="grid grid-cols-3 gap-4 md:gap-8 max-w-2xl mx-auto">
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 md:p-6 border border-white/20">
                    <div class="text-3xl md:text-4xl font-bold text-white font-mono">5+</div>
                    <div class="text-xs md:text-sm text-emerald-200 uppercase tracking-wider">Languages</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 md:p-6 border border-white/20">
                    <div class="text-3xl md:text-4xl font-bold text-white font-mono">∞</div>
                    <div class="text-xs md:text-sm text-emerald-200 uppercase tracking-wider">Projects</div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 md:p-6 border border-white/20">
                    <div class="text-3xl md:text-4xl font-bold text-white font-mono">100%</div>
                    <div class="text-xs md:text-sm text-emerald-200 uppercase tracking-wider">Praktik</div>
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
                    <span class="inline-block px-4 py-1.5 bg-emerald-100 text-emerald-700 text-sm font-semibold rounded-full mb-6">TENTANG PROGRAM</span>
                    <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        Bangun <span class="text-emerald-600">Teknologi</span> Masa Depan
                    </h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-8">
                        Program PPLG SMK Metland membekali siswa dengan kemampuan pemrograman, pengembangan web, aplikasi mobile, dan game development. Siswa akan belajar berbagai bahasa pemrograman dan framework modern yang digunakan industri.
                    </p>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Multi-Language</h3>
                                <p class="text-gray-600">PHP, JavaScript, Python, Java, C#</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Full-Stack Development</h3>
                                <p class="text-gray-600">Frontend, Backend, Database, API</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Game Development</h3>
                                <p class="text-gray-600">Unity, Godot, Game Design</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                        <img src="{{ asset('image/pplg2.png') }}" alt="Siswa PPLG" class="w-full h-auto">
                        <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/50 to-transparent"></div>
                    </div>
                    
                    <div class="absolute -bottom-6 -left-6 md:-left-12 bg-white rounded-2xl shadow-xl p-4 md:p-6 border border-gray-100 pulse-glow">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center">
                                <span class="text-2xl">💻</span>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">Rp 10-25 Jt</div>
                                <div class="text-gray-500 text-sm">Gaji Developer</div>
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
                <span class="inline-block px-4 py-1.5 bg-emerald-100 text-emerald-700 text-sm font-semibold rounded-full mb-4">KURIKULUM & KARIR</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Apa yang Akan Kamu Pelajari?</h2>
            </div>
            
            <div class="flex justify-center mb-12">
                <div class="inline-flex bg-gray-100 rounded-xl p-1.5">
                    <button @click="activeTab = 'materi'" 
                            :class="activeTab === 'materi' ? 'bg-white shadow-lg text-emerald-600' : 'text-gray-600 hover:text-gray-900'"
                            class="px-6 py-3 rounded-lg font-semibold transition-all">
                        💻 Materi Pembelajaran
                    </button>
                    <button @click="activeTab = 'karir'" 
                            :class="activeTab === 'karir' ? 'bg-white shadow-lg text-emerald-600' : 'text-gray-600 hover:text-gray-900'"
                            class="px-6 py-3 rounded-lg font-semibold transition-all">
                        🚀 Peluang Karir
                    </button>
                </div>
            </div>
            
            <!-- Tab Content: Materi -->
            <div x-show="activeTab === 'materi'" x-transition>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center mb-4">
                            <span class="text-2xl">🌐</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Web Development</h3>
                        <p class="text-gray-600">HTML, CSS, JavaScript, PHP, Laravel, dan framework modern.</p>
                    </div>
                    
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center mb-4">
                            <span class="text-2xl">📱</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Mobile Development</h3>
                        <p class="text-gray-600">Flutter, React Native, dan pengembangan aplikasi Android/iOS.</p>
                    </div>
                    
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-violet-600 flex items-center justify-center mb-4">
                            <span class="text-2xl">🎮</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Game Development</h3>
                        <p class="text-gray-600">Unity, Godot, game design, dan pemrograman game 2D/3D.</p>
                    </div>
                    
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-orange-500 to-red-600 flex items-center justify-center mb-4">
                            <span class="text-2xl">🗄️</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Database & Backend</h3>
                        <p class="text-gray-600">MySQL, PostgreSQL, MongoDB, RESTful API, dan cloud services.</p>
                    </div>
                    
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center mb-4">
                            <span class="text-2xl">🔧</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">DevOps & Tools</h3>
                        <p class="text-gray-600">Git, GitHub, Docker, deployment, dan version control.</p>
                    </div>
                    
                    <div class="skill-card bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-pink-500 to-rose-600 flex items-center justify-center mb-4">
                            <span class="text-2xl">🧠</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Problem Solving</h3>
                        <p class="text-gray-600">Algoritma, data structure, dan computational thinking.</p>
                    </div>
                </div>
            </div>
            
            <!-- Tab Content: Karir -->
            <div x-show="activeTab === 'karir'" x-transition>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="skill-card bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">👨‍💻</div>
                        <h3 class="text-xl font-bold mb-2">Web Developer</h3>
                        <p class="text-emerald-100 text-sm">Membangun website dan aplikasi web</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">📱</div>
                        <h3 class="text-xl font-bold mb-2">Mobile Developer</h3>
                        <p class="text-blue-100 text-sm">Membuat aplikasi Android & iOS</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-purple-500 to-violet-600 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">🎮</div>
                        <h3 class="text-xl font-bold mb-2">Game Developer</h3>
                        <p class="text-purple-100 text-sm">Membuat game PC & mobile</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">⚙️</div>
                        <h3 class="text-xl font-bold mb-2">Backend Engineer</h3>
                        <p class="text-orange-100 text-sm">Membangun server & API</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-cyan-500 to-sky-600 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">🔒</div>
                        <h3 class="text-xl font-bold mb-2">IT Support</h3>
                        <p class="text-cyan-100 text-sm">Maintenance sistem & jaringan</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-pink-500 to-rose-600 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">🎯</div>
                        <h3 class="text-xl font-bold mb-2">QA Tester</h3>
                        <p class="text-pink-100 text-sm">Testing & quality assurance</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-amber-500 to-yellow-600 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">🚀</div>
                        <h3 class="text-xl font-bold mb-2">Startup Founder</h3>
                        <p class="text-amber-100 text-sm">Membangun startup teknologi</p>
                    </div>
                    <div class="skill-card bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl p-6 text-white">
                        <div class="text-4xl mb-4">💻</div>
                        <h3 class="text-xl font-bold mb-2">Freelancer</h3>
                        <p class="text-slate-300 text-sm">Remote work dari mana saja</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-20 overflow-hidden bg-gradient-to-br from-emerald-600 via-teal-600 to-cyan-700">
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 80 80\"><circle cx=\"40\" cy=\"40\" r=\"2\" fill=\"white\"/></svg>'); background-size: 40px 40px;"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4 md:px-6 text-center">
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Siap Menjadi Developer?</h2>
            <p class="text-xl text-emerald-100 mb-10 max-w-2xl mx-auto">
                Bergabunglah dengan program PPLG SMK Metland dan bangun teknologi masa depan!
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/ppdb" class="inline-flex items-center justify-center gap-2 px-10 py-5 bg-white text-emerald-700 font-bold text-lg rounded-xl hover:bg-gray-100 transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1">
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
