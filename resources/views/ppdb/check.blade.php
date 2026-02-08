<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cek Status Pendaftaran - PPDB SMK Metland</title>

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
    <x-navbar :solid-background="true" />

    <!-- Main Content -->
    <div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="px-6 py-8">
                <div class="text-center mb-8">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mb-4">
                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900">Cek Status Pendaftaran</h1>
                    <p class="mt-2 text-gray-600">Masukkan nomor pendaftaran dan email untuk melihat status</p>
                </div>

                <form method="POST" action="{{ route('ppdb.status') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="registration_number" class="block text-sm font-medium text-gray-700">Nomor Pendaftaran</label>
                        <input type="text" name="registration_number" id="registration_number" required
                            value="{{ old('registration_number') }}"
                            placeholder="Contoh: 20260001"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('registration_number') border-red-500 @enderror">
                        @error('registration_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" required
                            value="{{ old('email') }}"
                            placeholder="email@example.com"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
                        @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cek Status
                        </button>
                    </div>
                </form>

                <!-- Information -->
                <div class="mt-8 bg-gray-50 border border-gray-200 rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi</h3>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-gray-400 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Nomor pendaftaran diberikan setelah menyelesaikan formulir pendaftaran
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-gray-400 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Gunakan email yang sama dengan saat mendaftar
                        </li>
                        <li class="flex items-start">
                            <svg class="h-4 w-4 text-gray-400 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Status akan diperbarui secara berkala oleh tim admin
                        </li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Belum mendaftar?
                        <a href="{{ route('ppdb.create') }}" class="text-blue-600 hover:text-blue-500 font-medium">
                            Daftar sekarang
                        </a>
                    </p>
                    <p class="text-sm text-gray-600 mt-2">
                        Butuh bantuan? Hubungi kami di
                        <a href="tel:+6221234567" class="text-blue-600 hover:text-blue-500">+62 21 1234 5678</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @include('components.footer')
</body>

</html>