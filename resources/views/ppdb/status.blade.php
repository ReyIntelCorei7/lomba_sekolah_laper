<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Status Pendaftaran - PPDB SMK Metland</title>

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
    <div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <!-- Status Header -->
            <div class="px-6 py-8 text-center border-b border-gray-200">
                @php
                $statusConfig = [
                'pending' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'icon' => 'bg-yellow-500', 'label' => 'Menunggu Verifikasi'],
                'accepted' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'icon' => 'bg-green-500', 'label' => 'Diterima'],
                'rejected' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'icon' => 'bg-red-500', 'label' => 'Tidak Diterima'],
                'waiting' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'icon' => 'bg-blue-500', 'label' => 'Waiting List'],
                ];
                $config = $statusConfig[$student->status] ?? $statusConfig['pending'];
                @endphp

                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full {{ $config['icon'] }} mb-6">
                    @if($student->status === 'accepted')
                    <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    @elseif($student->status === 'rejected')
                    <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    @elseif($student->status === 'waiting')
                    <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    @else
                    <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    @endif
                </div>

                <h1 class="text-3xl font-bold text-gray-900">Status Pendaftaran</h1>
                <div class="mt-4">
                    <span class="inline-flex items-center px-6 py-2 rounded-full text-lg font-semibold {{ $config['bg'] }} {{ $config['text'] }}">
                        {{ $config['label'] }}
                    </span>
                </div>
            </div>

            <!-- Student Information -->
            <div class="px-6 py-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Data Pendaftaran</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Registration Info -->
                    <div class="space-y-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-sm text-gray-500">Nomor Pendaftaran</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $student->registration_number }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-sm text-gray-500">Nama Lengkap</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $student->full_name }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $student->email }}</p>
                        </div>
                    </div>

                    <!-- Program Info -->
                    <div class="space-y-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-sm text-gray-500">Program Keahlian</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $student->program->name ?? '-' }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-sm text-gray-500">Tanggal Pendaftaran</p>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $student->registered_at ? $student->registered_at->format('d F Y, H:i') : '-' }}
                            </p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-sm text-gray-500">Tipe Pendaftaran</p>
                            <p class="text-lg font-semibold text-gray-900 capitalize">{{ $student->registration_type ?? 'Online' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Status Message -->
                <div class="mt-6 p-4 rounded-lg {{ $config['bg'] }} border border-{{ explode('-', $config['text'])[1] }}-200">
                    @if($student->status === 'pending')
                    <p class="{{ $config['text'] }}">
                        <strong>Pendaftaran Anda sedang diproses.</strong> Tim kami sedang memverifikasi data dan dokumen yang Anda kirim. Mohon tunggu beberapa hari kerja untuk hasil verifikasi.
                    </p>
                    @elseif($student->status === 'accepted')
                    <p class="{{ $config['text'] }}">
                        <strong>Selamat! Pendaftaran Anda diterima.</strong> Silakan lakukan daftar ulang sesuai dengan jadwal yang telah ditentukan. Informasi lebih lanjut akan dikirim ke email Anda.
                    </p>
                    @elseif($student->status === 'rejected')
                    <p class="{{ $config['text'] }}">
                        <strong>Mohon maaf, pendaftaran Anda tidak dapat kami terima.</strong> Untuk informasi lebih lanjut, silakan hubungi bagian PPDB kami.
                    </p>
                    @elseif($student->status === 'waiting')
                    <p class="{{ $config['text'] }}">
                        <strong>Anda berada dalam waiting list.</strong> Jika ada kuota yang tersedia, kami akan menghubungi Anda melalui email atau telepon.
                    </p>
                    @endif
                </div>

                @if($student->notes)
                <div class="mt-4 p-4 rounded-lg bg-gray-100 border border-gray-200">
                    <p class="text-sm text-gray-500 mb-1">Catatan Admin:</p>
                    <p class="text-gray-700">{{ $student->notes }}</p>
                </div>
                @endif
            </div>

            <!-- Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('ppdb.check') }}"
                        class="flex-1 text-center px-4 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        Cek Pendaftaran Lain
                    </a>
                    <a href="{{ route('ppdb.index') }}"
                        class="flex-1 text-center px-4 py-3 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                        Kembali ke PPDB
                    </a>
                </div>
            </div>
        </div>

        <!-- Contact -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Ada pertanyaan? Hubungi kami di
                <a href="tel:+6221234567" class="text-blue-600 hover:text-blue-500">+62 21 1234 5678</a>
                atau email
                <a href="mailto:ppdb@smkmetland.sch.id" class="text-blue-600 hover:text-blue-500">ppdb@smkmetland.sch.id</a>
            </p>
        </div>
    </div>
    @include('components.footer')
</body>

</html>