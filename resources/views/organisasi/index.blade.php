<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organisasi - SMK Metland School</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
        body { font-family: 'Poppins', sans-serif; }
        
        /* Card hover animation */
        .org-card {
            transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94), box-shadow 0.4s ease;
        }
        .org-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px -12px rgba(59, 130, 246, 0.25);
        }

        /* Logo pulse animation */
        .logo-badge {
            animation: pulse-glow 2s ease-in-out infinite;
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(255, 255, 255, 0.3); }
            50% { box-shadow: 0 0 30px rgba(255, 255, 255, 0.5); }
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

<body class="bg-gray-900 text-gray-100 min-h-screen">
    <!-- Navbar -->
    @include('components.navbar', ['solidBackground' => true, 'showOnScroll' => false])

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0 bg-gradient-to-b from-purple-900/50 via-gray-900 to-gray-900"></div>
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%239C92AC\' fill-opacity=\'0.1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        
        <div class="relative max-w-7xl mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white text-sm font-medium mb-6">
                <span class="w-2 h-2 rounded-full bg-purple-400 animate-pulse"></span>
                {{ $organizations->count() }} Organisasi Aktif
            </div>
            
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 tracking-tight">
                Organi<span class="text-purple-400">sasi</span>
            </h1>
            
            <p class="text-gray-300 text-lg md:text-xl max-w-2xl mx-auto mb-12">
                Wadah pengembangan karakter dan kepemimpinan siswa melalui berbagai organisasi sekolah
            </p>

            <!-- Category Filter Pills -->
            <div class="flex flex-wrap justify-center gap-3">
                <a href="{{ route('organisasi.index') }}" 
                    class="px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300
                        {{ !request('category') ? 'bg-purple-600 text-white shadow-lg shadow-purple-600/30' : 'bg-white/10 text-gray-300 hover:bg-white/20' }}">
                    🌟 Semua
                </a>
                @foreach($categories as $key => $label)
                <a href="{{ route('organisasi.index', ['category' => $key]) }}" 
                    class="px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300
                        {{ request('category') === $key ? 'bg-purple-600 text-white shadow-lg shadow-purple-600/30' : 'bg-white/10 text-gray-300 hover:bg-white/20' }}">
                    {{ $label }}
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Organizations Grid -->
    <section class="py-20 bg-gray-900">
        <div class="max-w-7xl mx-auto px-6">
            @if($organizations->count() > 0)
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($organizations as $index => $org)
                <a href="{{ route('organisasi.show', $org->slug) }}" 
                    class="org-card group relative bg-gray-800/50 rounded-2xl overflow-hidden border border-gray-700 hover:border-purple-500/50 animate-fade-in-up"
                    style="animation-delay: {{ $index * 0.1 }}s">
                    
                    <!-- Image -->
                    <div class="h-52 relative overflow-hidden">
                        @if($org->image)
                        <img src="{{ asset('storage/' . $org->image) }}" alt="{{ $org->name }}" 
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                        <div class="w-full h-full bg-gradient-to-br from-purple-900 to-indigo-900 flex items-center justify-center">
                            <span class="text-6xl opacity-50">{{ substr($org->category_label, 0, 2) }}</span>
                        </div>
                        @endif
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent"></div>
                        
                        <!-- Logo Badge (Top Left) -->
                        @if($org->logo)
                        <div class="logo-badge absolute top-4 left-4 w-14 h-14 bg-white rounded-xl shadow-2xl p-2 flex items-center justify-center">
                            <img src="{{ asset('storage/' . $org->logo) }}" alt="{{ $org->abbreviation ?? $org->name }}" class="w-full h-full object-contain">
                        </div>
                        @else
                        <div class="absolute top-4 left-4 w-14 h-14 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-xl shadow-2xl flex items-center justify-center">
                            <span class="text-xl font-bold text-white">{{ $org->abbreviation ? substr($org->abbreviation, 0, 2) : substr($org->name, 0, 2) }}</span>
                        </div>
                        @endif

                        <!-- Category Badge -->
                        <span class="absolute top-4 right-4 inline-block px-3 py-1 {{ $org->category_color }} text-white text-xs font-bold rounded-full">
                            {{ $org->category_label }}
                        </span>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-6">
                        <div class="flex items-start justify-between gap-4 mb-3">
                            <div>
                                <h3 class="text-xl font-bold text-white group-hover:text-purple-400 transition-colors">{{ $org->name }}</h3>
                                @if($org->abbreviation)
                                <p class="text-purple-400 font-semibold text-sm">{{ $org->abbreviation }}</p>
                                @endif
                            </div>
                        </div>
                        
                        @if($org->description)
                        <p class="text-gray-400 text-sm line-clamp-2 mb-4">{{ $org->description }}</p>
                        @endif
                        
                        <div class="flex items-center justify-between">
                            @if($org->advisor)
                            <p class="text-gray-500 text-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ $org->advisor }}
                            </p>
                            @endif
                            
                            <span class="text-purple-400 font-medium text-sm flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                                Detail
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @else
            <div class="text-center py-20">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gray-800 flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Belum Ada Organisasi</h3>
                <p class="text-gray-400">Organisasi sedang dalam persiapan</p>
            </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-b from-gray-900 to-purple-900/50">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                Jadilah Bagian dari Kami!
            </h2>
            <p class="text-gray-300 text-lg mb-8">
                Bergabung dengan organisasi siswa dan kembangkan jiwa kepemimpinanmu
            </p>
            <a href="{{ route('ppdb.index') }}" 
                class="inline-flex items-center gap-2 px-8 py-4 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-full transition-all hover:scale-105 shadow-lg shadow-purple-600/30">
                Daftar PPDB
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
