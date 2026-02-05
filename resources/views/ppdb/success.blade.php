<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pendaftaran Berhasil - PPDB SMK Metland</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navbar Component -->
    <x-navbar :solid-background="true" />

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="px-6 py-8 text-center">
                <!-- Success Icon -->
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-6">
                    <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mb-4">Pendaftaran Berhasil!</h1>
                <p class="text-lg text-gray-600 mb-8">
                    Terima kasih telah mendaftar di SMK Pariwisata Metland School
                </p>

                <!-- Registration Details -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Detail Pendaftaran</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nomor Pendaftaran</p>
                            <p class="text-lg font-bold text-blue-600">{{ $student->registration_number }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nama Lengkap</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $student->full_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Email</p>
                            <p class="text-lg text-gray-700">{{ $student->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Program Keahlian</p>
                            <p class="text-lg text-gray-700">{{ $student->program->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Status</p>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                Menunggu Verifikasi
                            </span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Tanggal Daftar</p>
                            <p class="text-lg text-gray-700">{{ $student->registered_at->format('d F Y, H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Important Information -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8 text-left">
                    <h3 class="text-lg font-medium text-blue-900 mb-4">Informasi Penting</h3>
                    <ul class="space-y-2 text-blue-800">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-blue-600 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <strong>Simpan nomor pendaftaran Anda:</strong> {{ $student->registration_number }}
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-blue-600 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Data Anda akan diverifikasi dalam 1-3 hari kerja
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-blue-600 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Hasil seleksi akan dikirim melalui email dan WhatsApp
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-blue-600 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Cek status pendaftaran secara berkala di website
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('ppdb.check') }}" 
                       class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Cek Status Pendaftaran
                    </a>
                    
                    <a href="{{ route('ppdb.index') }}" 
                       class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Kembali ke PPDB
                    </a>
                    
                    <a href="/" 
                       class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Kembali ke Website
                    </a>
                </div>

                <!-- Contact Information -->
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <p class="text-sm text-gray-600 mb-2">
                        <strong>Butuh bantuan?</strong> Hubungi kami:
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center text-sm text-gray-600">
                        <span>📞 +62 21 1234 5678</span>
                        <span>📧 ppdb@smkmetland.sch.id</span>
                        <span>💬 WhatsApp: +62 812 3456 7890</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>