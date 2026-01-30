@extends('layouts.app')

@section('title', 'Berita Sekolah - Metland School')

@section('content')
<!-- ================= HERO NEWS ================= -->
<section class="relative pt-32 pb-20 bg-gradient-to-br from-primary-dark to-primary overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full -translate-y-48 translate-x-48"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-white rounded-full -translate-x-32 translate-y-32"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <!-- Breadcrumb -->
        <div class="flex items-center text-white/80 mb-8 text-sm">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span class="breadcrumb-arrow"></span>
            <span class="text-white font-semibold">Berita Sekolah</span>
        </div>
        
        <div class="text-center mb-12">
            <div class="inline-block px-6 py-2 bg-white/20 rounded-full text-white mb-6">
                <i class="fas fa-newspaper mr-2"></i>
                Berita Sekolah
            </div>
            
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                <span class="block">CONGRATULATIONS</span>
                <span class="text-secondary">INDONESIA</span>
            </h1>
            
            <p class="text-3xl md:text-4xl font-bold text-white/90 mb-8">
                SCIENCE OLYMPICS
            </p>
            
            <p class="text-white/80 max-w-2xl mx-auto text-lg">
                Ikuti perkembangan terbaru dari Metland School
            </p>
        </div>
    </div>
</section>

<!-- ================= MAIN CONTENT ================= -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- ================= SIDEBAR ================= -->
            <aside class="lg:w-1/3">
                <div class="sticky top-32">
                    <!-- Popular News -->
                    <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-fire text-secondary mr-3"></i>
                            Berita Terpopuler
                        </h2>
                        
                        <div class="space-y-6">
                            @foreach($popularNews as $news)
                            <div class="group cursor-pointer">
                                <div class="flex items-center gap-3 mb-2">
                                    @php
                                        $categoryColors = [
                                            'academic' => 'bg-blue-100 text-blue-800',
                                            'activity' => 'bg-green-100 text-green-800',
                                            'extracurricular' => 'bg-purple-100 text-purple-800',
                                            'arts' => 'bg-pink-100 text-pink-800',
                                            'alumni' => 'bg-indigo-100 text-indigo-800',
                                            'workshop' => 'bg-orange-100 text-orange-800',
                                            'achievement' => 'bg-red-100 text-red-800',
                                            'scout' => 'bg-yellow-100 text-yellow-800'
                                        ];
                                        $categoryLabels = [
                                            'academic' => 'Akademik',
                                            'activity' => 'Kegiatan',
                                            'extracurricular' => 'Ekstrakurikuler',
                                            'arts' => 'Seni & Budaya',
                                            'alumni' => 'Alumni',
                                            'workshop' => 'Workshop',
                                            'achievement' => 'Prestasi',
                                            'scout' => 'Kepramukaan'
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 {{ $categoryColors[$news->category] ?? 'bg-gray-100 text-gray-800' }} text-xs font-semibold rounded-full">
                                        <i class="fas fa-{{ $news->category == 'academic' ? 'graduation-cap' : ($news->category == 'activity' ? 'briefcase' : ($news->category == 'extracurricular' ? 'futbol' : ($news->category == 'arts' ? 'palette' : ($news->category == 'alumni' ? 'user-graduate' : ($news->category == 'workshop' ? 'laptop-code' : ($news->category == 'achievement' ? 'trophy' : 'campground')))))) }} mr-1"></i>
                                        {{ $categoryLabels[$news->category] ?? $news->category }}
                                    </span>
                                    <span class="text-gray-500 text-sm">{{ $news->published_at->diffForHumans() }}</span>
                                </div>
                                <a href="{{ route('news.show', $news->slug) }}">
                                    <h3 class="font-bold text-lg group-hover:text-primary transition">
                                        {{ Str::limit($news->title, 70) }}
                                    </h3>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Category Filter -->
                    <div class="bg-white rounded-2xl shadow-xl p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Filter Kategori</h3>
                        <div class="space-y-3">
                            <a href="{{ route('news.index') }}"
                               class="w-full text-left px-4 py-3 rounded-lg transition-all bg-primary text-white">
                                <i class="fas fa-layer-group mr-3"></i>
                                Semua Kategori
                            </a>
                            
                            @foreach($categories as $key => $category)
                            <a href="{{ route('news.category', $key) }}"
                               class="w-full text-left px-4 py-3 rounded-lg transition-all bg-gray-100 hover:bg-gray-200">
                                <i class="fas fa-{{ $key == 'academic' ? 'graduation-cap' : ($key == 'activity' ? 'briefcase' : ($key == 'extracurricular' ? 'futbol' : ($key == 'arts' ? 'palette' : ($key == 'alumni' ? 'user-graduate' : ($key == 'workshop' ? 'laptop-code' : ($key == 'achievement' ? 'trophy' : 'campground')))))) }} mr-3"></i>
                                {{ $category }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </aside>
            
            <!-- ================= MAIN NEWS CONTENT ================= -->
            <main class="lg:w-2/3">
                <!-- Featured Article -->
                @if($featuredNews->count() > 0)
                <article class="bg-white rounded-2xl shadow-xl overflow-hidden mb-12">
                    <div class="p-10">
                        @php $featured = $featuredNews->first(); @endphp
                        <div class="flex flex-wrap items-center justify-between mb-8">
                            <span class="px-5 py-2 bg-gradient-to-r from-red-500 to-orange-500 text-white font-bold rounded-full text-sm">
                                <i class="fas fa-star mr-2"></i>
                                Featured
                            </span>
                            <span class="text-gray-500 font-medium">{{ $featured->published_at->format('d F Y') }}</span>
                        </div>
                        
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                            {{ $featured->title }}
                        </h1>
                        
                        <p class="text-gray-700 text-lg leading-relaxed mb-8">
                            {{ $featured->excerpt }}
                        </p>
                        
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-6 pt-8 border-t border-gray-200">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-primary to-primary-dark rounded-full flex items-center justify-center text-white font-bold text-xl">
                                    {{ substr($featured->author, 0, 2) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">{{ $featured->author }}</p>
                                    <p class="text-gray-600">{{ $featured->reading_time }}</p>
                                </div>
                            </div>
                            
                            <a href="{{ route('news.show', $featured->slug) }}"
                               class="px-8 py-3 bg-primary text-white font-semibold rounded-full hover:bg-primary-dark transition flex items-center gap-3">
                                Baca Selengkapnya
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </article>
                @endif
                
                <!-- Latest News Section -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center">
                        <i class="fas fa-clock mr-4 text-primary"></i>
                        Berita Terbaru
                    </h2>
                </div>
                
                <!-- News Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($news as $item)
                    <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        @if($item->image)
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . $item->image) }}" 
                                 alt="{{ $item->title }}"
                                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                        @endif
                        
                        <div class="p-8">
                            <div class="flex items-center justify-between mb-6">
                                @php
                                    $categoryColors = [
                                        'academic' => 'bg-blue-100 text-blue-800',
                                        'activity' => 'bg-green-100 text-green-800',
                                        'extracurricular' => 'bg-purple-100 text-purple-800',
                                        'arts' => 'bg-pink-100 text-pink-800',
                                        'alumni' => 'bg-indigo-100 text-indigo-800',
                                        'workshop' => 'bg-orange-100 text-orange-800',
                                        'achievement' => 'bg-red-100 text-red-800',
                                        'scout' => 'bg-yellow-100 text-yellow-800'
                                    ];
                                @endphp
                                <span class="px-4 py-2 {{ $categoryColors[$item->category] ?? 'bg-gray-100 text-gray-800' }} font-semibold rounded-full text-sm">
                                    {{ $categoryLabels[$item->category] ?? $item->category }}
                                </span>
                                <span class="text-gray-500 font-medium">{{ $item->published_at->format('d M Y') }}</span>
                            </div>
                            
                            <h3 class="text-2xl font-bold text-gray-900 mb-4 hover:text-primary transition">
                                <a href="{{ route('news.show', $item->slug) }}">
                                    {{ Str::limit($item->title, 70) }}
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                {{ Str::limit(strip_tags($item->excerpt), 150) }}
                            </p>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-eye mr-1"></i> {{ $item->views }} views
                                </span>
                                <a href="{{ route('news.show', $item->slug) }}" 
                                   class="inline-flex items-center text-primary font-semibold hover:text-primary-dark transition group">
                                    Baca Selengkapnya
                                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                @if($news->hasPages())
                <div class="mt-12">
                    {{ $news->links() }}
                </div>
                @endif
            </main>
        </div>
    </div>
</section>
@endsection