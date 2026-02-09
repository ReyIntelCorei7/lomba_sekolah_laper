<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/image/logometland.png" type="image/png">
    <title>{{ $extracurricular->name }} - SMK Metland School</title>

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
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-900 text-gray-100 min-h-screen">
    <!-- Navbar -->
    @include('components.navbar', ['solidBackground' => true, 'showOnScroll' => false])

    <!-- Hero with Image -->
    <section class="pt-16 relative">
        <div class="h-[50vh] relative overflow-hidden">
            @if($extracurricular->image)
            <img src="{{ asset('storage/' . $extracurricular->image) }}" alt="{{ $extracurricular->name }}"
                class="w-full h-full object-cover">
            @else
            <div class="w-full h-full bg-gradient-to-br from-[#1E2188] to-blue-900"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent"></div>
        </div>

        <!-- Content Overlay -->
        <div class="absolute bottom-0 left-0 right-0 pb-12">
            <div class="max-w-5xl mx-auto px-6">
                <a href="{{ route('eskul.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white mb-4 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Daftar Eskul
                </a>

                <span class="inline-block px-4 py-1.5 {{ $extracurricular->category_color }} text-white text-sm font-bold rounded-full mb-4">
                    {{ $extracurricular->category_label }}
                </span>

                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $extracurricular->name }}</h1>

                <div class="flex flex-wrap gap-6 text-gray-300">
                    @if($extracurricular->coach)
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span>Pembina: {{ $extracurricular->coach }}</span>
                    </div>
                    @endif

                    @if($extracurricular->schedule)
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ $extracurricular->schedule }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="py-16 bg-gray-900">
        <div class="max-w-5xl mx-auto px-6">
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    @if($extracurricular->description)
                    <div class="bg-gray-800/50 rounded-2xl p-8 border border-gray-700">
                        <h2 class="text-xl font-bold text-white mb-4">Tentang Eskul</h2>
                        <p class="text-gray-300 leading-relaxed whitespace-pre-line">{{ $extracurricular->description }}</p>
                    </div>
                    @endif

                    @if($extracurricular->achievements)
                    <div class="bg-gradient-to-br from-amber-900/30 to-amber-800/20 rounded-2xl p-8 border border-amber-700/30">
                        <h2 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                            <span class="text-2xl">🏆</span> Prestasi
                        </h2>
                        <div class="text-gray-300 space-y-2">
                            @foreach(explode("\n", $extracurricular->achievements) as $achievement)
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
                                <div class="w-10 h-10 rounded-lg bg-blue-600/20 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Kategori</p>
                                    <p class="font-medium">{{ $extracurricular->category_label }}</p>
                                </div>
                            </li>
                            @if($extracurricular->coach)
                            <li class="flex items-center gap-3 text-gray-300">
                                <div class="w-10 h-10 rounded-lg bg-purple-600/20 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Pembina</p>
                                    <p class="font-medium">{{ $extracurricular->coach }}</p>
                                </div>
                            </li>
                            @endif
                            @if($extracurricular->schedule)
                            <li class="flex items-center gap-3 text-gray-300">
                                <div class="w-10 h-10 rounded-lg bg-green-600/20 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Jadwal</p>
                                    <p class="font-medium">{{ $extracurricular->schedule }}</p>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>

                    <!-- CTA -->
                    <div class="bg-gradient-to-br from-[#1E2188] to-blue-900 rounded-2xl p-6 text-center">
                        <h3 class="text-lg font-bold text-white mb-2">Tertarik Bergabung?</h3>
                        <p class="text-gray-300 text-sm mb-4">Daftar menjadi siswa SMK Metland dan ikuti eskul ini!</p>
                        <a href="{{ route('ppdb.index') }}"
                            class="inline-block w-full py-3 bg-white text-[#1E2188] font-bold rounded-xl hover:bg-gray-100 transition-colors">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Eskul -->
    @if($related->count() > 0)
    <section class="py-16 bg-gray-800/30">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-2xl font-bold text-white mb-8">Eskul Lainnya</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($related as $item)
                <a href="{{ route('eskul.show', $item->slug) }}"
                    class="group bg-gray-800/50 rounded-xl overflow-hidden border border-gray-700 hover:border-blue-500/50 transition-all">
                    <div class="h-40 relative overflow-hidden">
                        @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                        <div class="w-full h-full bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center">
                            <span class="text-4xl">{{ substr($item->category_label, 0, 2) }}</span>
                        </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-lg font-bold text-white">{{ $item->name }}</h3>
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