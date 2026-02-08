<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $organization->name }} - SMK Metland School</title>

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
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>

<body class="bg-gray-900 text-gray-100 min-h-screen">
    <!-- Navbar -->
    @include('components.navbar', ['solidBackground' => true, 'showOnScroll' => false])

    <!-- Hero with Image -->
    <section class="pt-16 relative">
        <div class="h-[50vh] relative overflow-hidden">
            @if($organization->image)
            <img src="{{ asset('storage/' . $organization->image) }}" alt="{{ $organization->name }}" 
                class="w-full h-full object-cover">
            @else
            <div class="w-full h-full bg-gradient-to-br from-purple-900 to-indigo-900"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent"></div>
        </div>
        
        <!-- Content Overlay -->
        <div class="absolute bottom-0 left-0 right-0 pb-12">
            <div class="max-w-5xl mx-auto px-6">
                <a href="{{ route('organisasi.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white mb-4 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Daftar Organisasi
                </a>
                
                <div class="flex items-center gap-6 mb-4">
                    <!-- Logo -->
                    @if($organization->logo)
                    <div class="w-20 h-20 bg-white rounded-2xl shadow-2xl p-2 flex items-center justify-center flex-shrink-0">
                        <img src="{{ asset('storage/' . $organization->logo) }}" alt="{{ $organization->abbreviation ?? $organization->name }}" class="w-full h-full object-contain">
                    </div>
                    @else
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-2xl shadow-2xl flex items-center justify-center flex-shrink-0">
                        <span class="text-2xl font-bold text-white">{{ $organization->abbreviation ? substr($organization->abbreviation, 0, 3) : substr($organization->name, 0, 3) }}</span>
                    </div>
                    @endif
                    
                    <div>
                        <span class="inline-block px-4 py-1.5 {{ $organization->category_color }} text-white text-sm font-bold rounded-full mb-2">
                            {{ $organization->category_label }}
                        </span>
                        <h1 class="text-3xl md:text-4xl font-bold text-white">{{ $organization->name }}</h1>
                        @if($organization->abbreviation)
                        <p class="text-purple-400 font-semibold text-lg">{{ $organization->abbreviation }}</p>
                        @endif
                    </div>
                </div>
                
                @if($organization->advisor)
                <div class="flex items-center gap-2 text-gray-300">
                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span>Pembina: {{ $organization->advisor }}</span>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="py-16 bg-gray-900">
        <div class="max-w-5xl mx-auto px-6">
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    @if($organization->description)
                    <div class="bg-gray-800/50 rounded-2xl p-8 border border-gray-700">
                        <h2 class="text-xl font-bold text-white mb-4">Tentang Organisasi</h2>
                        <p class="text-gray-300 leading-relaxed whitespace-pre-line">{{ $organization->description }}</p>
                    </div>
                    @endif
                    
                    @if($organization->vision || $organization->mission)
                    <div class="grid md:grid-cols-2 gap-6">
                        @if($organization->vision)
                        <div class="bg-gradient-to-br from-purple-900/30 to-indigo-900/30 rounded-2xl p-6 border border-purple-700/30">
                            <h3 class="text-lg font-bold text-white mb-3 flex items-center gap-2">
                                <span class="text-xl">🎯</span> Visi
                            </h3>
                            <p class="text-gray-300 text-sm leading-relaxed">{{ $organization->vision }}</p>
                        </div>
                        @endif
                        
                        @if($organization->mission)
                        <div class="bg-gradient-to-br from-blue-900/30 to-cyan-900/30 rounded-2xl p-6 border border-blue-700/30">
                            <h3 class="text-lg font-bold text-white mb-3 flex items-center gap-2">
                                <span class="text-xl">🚀</span> Misi
                            </h3>
                            <div class="text-gray-300 text-sm space-y-2">
                                @foreach(explode("\n", $organization->mission) as $item)
                                @if(trim($item))
                                <div class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>{{ trim($item) }}</span>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                    
                    @if($organization->achievements)
                    <div class="bg-gradient-to-br from-amber-900/30 to-amber-800/20 rounded-2xl p-8 border border-amber-700/30">
                        <h2 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                            <span class="text-2xl">🏆</span> Prestasi
                        </h2>
                        <div class="text-gray-300 space-y-2">
                            @foreach(explode("\n", $organization->achievements) as $achievement)
                            @if(trim($achievement))
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-amber-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>{{ trim($achievement) }}</span>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                
                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Info Card -->
                    <div class="bg-gray-800/50 rounded-2xl p-6 border border-gray-700">
                        <h3 class="text-lg font-bold text-white mb-4">Informasi</h3>
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3 text-gray-300">
                                <div class="w-10 h-10 rounded-lg bg-purple-600/20 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Kategori</p>
                                    <p class="font-medium">{{ $organization->category_label }}</p>
                                </div>
                            </li>
                            @if($organization->advisor)
                            <li class="flex items-center gap-3 text-gray-300">
                                <div class="w-10 h-10 rounded-lg bg-pink-600/20 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Pembina</p>
                                    <p class="font-medium">{{ $organization->advisor }}</p>
                                </div>
                            </li>
                            @endif
                            @if($organization->abbreviation)
                            <li class="flex items-center gap-3 text-gray-300">
                                <div class="w-10 h-10 rounded-lg bg-cyan-600/20 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Singkatan</p>
                                    <p class="font-medium">{{ $organization->abbreviation }}</p>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                    
                    <!-- CTA -->
                    <div class="bg-gradient-to-br from-purple-900 to-indigo-900 rounded-2xl p-6 text-center">
                        <h3 class="text-lg font-bold text-white mb-2">Tertarik Bergabung?</h3>
                        <p class="text-gray-300 text-sm mb-4">Daftar menjadi siswa SMK Metland dan ikuti organisasi ini!</p>
                        <a href="{{ route('ppdb.index') }}" 
                            class="inline-block w-full py-3 bg-white text-purple-900 font-bold rounded-xl hover:bg-gray-100 transition-colors">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Organizations -->
    @if($related->count() > 0)
    <section class="py-16 bg-gray-800/30">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-2xl font-bold text-white mb-8">Organisasi Lainnya</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($related as $item)
                <a href="{{ route('organisasi.show', $item->slug) }}" 
                    class="group bg-gray-800/50 rounded-xl overflow-hidden border border-gray-700 hover:border-purple-500/50 transition-all">
                    <div class="h-40 relative overflow-hidden">
                        @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" 
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                        <div class="w-full h-full bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center">
                            <span class="text-4xl">{{ substr($item->category_label, 0, 2) }}</span>
                        </div>
                        @endif
                        
                        <!-- Logo Badge -->
                        @if($item->logo)
                        <div class="absolute top-3 left-3 w-10 h-10 bg-white rounded-lg shadow-lg p-1 flex items-center justify-center">
                            <img src="{{ asset('storage/' . $item->logo) }}" alt="{{ $item->abbreviation ?? $item->name }}" class="w-full h-full object-contain">
                        </div>
                        @endif
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-lg font-bold text-white">{{ $item->name }}</h3>
                            @if($item->abbreviation)
                            <p class="text-purple-400 text-sm font-medium">{{ $item->abbreviation }}</p>
                            @endif
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @include('components.footer')
</body>

</html>
