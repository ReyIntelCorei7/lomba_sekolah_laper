z
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/image/logometland.png" type="image/png">
    <title>PPDB - SMK Pariwisata Metland School</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navbar Component -->
    <x-navbar :solidBackground="true" :showOnScroll="false" />

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 mt-10">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-white sm:text-5xl">
                    Penerimaan Peserta Didik Baru
                </h1>
                <p class="mt-4 text-xl text-blue-100">
                    SMK Pariwisata Metland School 2026/2027
                </p>
                <p class="mt-2 text-lg text-blue-200">
                    Bergabunglah dengan kami dan raih masa depan gemilang di industri pariwisata
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Registration Form Card -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                    <div class="px-6 py-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Daftar Sekarang</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <a href="{{ route('ppdb.create') }}"
                                class="group relative bg-gradient-to-r from-blue-500 to-blue-600 p-6 rounded-lg text-white hover:from-blue-600 hover:to-blue-700 transition-all duration-200 transform hover:scale-105">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium">Pendaftaran Online</h3>
                                        <p class="text-blue-100">Daftar melalui website</p>
                                    </div>
                                </div>
                                <div class="absolute top-4 right-4">
                                    <svg class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </a>

                            <div class="bg-gradient-to-r from-gray-500 to-gray-600 p-6 rounded-lg text-white">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium">Pendaftaran Offline</h3>
                                        <p class="text-gray-100">Datang langsung ke sekolah</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Information -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                            <h3 class="text-lg font-medium text-blue-900 mb-4">Informasi Penting</h3>
                            <ul class="space-y-2 text-blue-800">
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-blue-600 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Pendaftaran gratis dan tidak dipungut biaya apapun
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-blue-600 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Siapkan dokumen: Ijazah/SKHUN, Kartu Keluarga, Akta Kelahiran
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-blue-600 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Foto 3x4 terbaru dan pas foto digital
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-blue-600 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Hasil akan diumumkan melalui website dan WhatsApp
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Programs -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b">
                        <h3 class="text-lg font-medium text-gray-900">Program Keahlian</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($programs as $program)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <h4 class="font-medium text-gray-900">{{ $program->name }}</h4>
                                <p class="text-sm text-gray-600 mt-1">{{ $program->code }}</p>
                                <p class="text-xs text-gray-500 mt-2">Kapasitas: {{ $program->capacity }} siswa</p>
                                <div class="mt-2">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $program->occupancy_percentage }}%"></div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">{{ $program->current_students }}/{{ $program->capacity }} terdaftar</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b">
                        <h3 class="text-lg font-medium text-gray-900">Kontak</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start">
                            <svg class="h-5 w-5 text-gray-400 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Telepon</p>
                                <p class="text-sm text-gray-600">+62 21 1234 5678</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <svg class="h-5 w-5 text-gray-400 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Email</p>
                                <p class="text-sm text-gray-600">ppdb@smkmetland.sch.id</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <svg class="h-5 w-5 text-gray-400 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Alamat</p>
                                <p class="text-sm text-gray-600">Jl. Metland Cyber City, Cikupa, Tangerang, Banten</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b">
                        <h3 class="text-lg font-medium text-gray-900">Cek Status Pendaftaran</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-sm text-gray-600 mb-4">Sudah mendaftar? Cek status pendaftaran Anda di sini.</p>
                        <a href="{{ route('ppdb.check') }}"
                            class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                            Cek Status
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('components.footer')
</body>

</html>