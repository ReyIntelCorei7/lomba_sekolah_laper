<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    <div class="w-full relative bg-gray-900">
        <!-- Section 1 -->
        <div class="sticky top-0 h-screen w-full flex items-center justify-center overflow-hidden z-0">
            <!-- Gambar responsif -->
            <picture>
                <source media="(min-width: 768px)" srcset="{{ asset('image/1.png') }}">
                <source media="(min-width: 640px)" srcset="{{ asset('image/1 2.png') }}">
                <img src="{{ asset('image/1 3.png') }}"
                    class="absolute inset-0 w-full h-full object-cover brightness-[0.4]" alt="Background Image 1">
            </picture>

            <div class="relative z-50 w-full max-w-8xl px-4 sm:px-6 lg:px-8">
                <div
                    class="w-full h-[90vh] sm:h-[95vh] md:h-[90vh] border border-white/60 p-3 sm:p-4 transition-all opacity-100">
                    <div class="w-full h-full border relative p-4 sm:p-6 md:p-8 lg:p-12 flex flex-col justify-end">

                        <div class="max-w-2xl pb-4">
                            <h2
                                class="text-white font-bold text-lg sm:text-xl md:text-2xl mb-3 md:mb-4 uppercase drop-shadow-2xl">
                                Akuntansi dan Keuangan Lembaga
                            </h2>
                            <p class="text-white text-xs sm:text-sm md:text-base leading-relaxed font-normal">
                                Kompetensi keahlian akuntansi di SMK Metland meliputi pembelajaran Akuntansi Manual dan
                                Akutansi Komputer (MYOB, Zahir). Kompetensi Keahlian Akuntansi di SMK Metland bertujuan
                                agar siswa dapat mengetahui Akuntansi baik untuk perusahaan jasa, perusahaan dagang,
                                perusahaan manufaktur dan perhotelan. Siswa kompetensi Keahlian Akuntansi diharapkan
                                dapat melakukan Siklus Akuntansi minimal bagi dirinya sendiri dan perusahaan pada
                                umumnya dan sekaligus mampu menerapkan Sistem Perpajakan di Indonesia
                            </p>
                        </div>

                        <div
                            class="absolute bottom-3 right-4 sm:bottom-4 sm:right-6 md:bottom-6 md:right-10 opacity-30 
                                    text-2xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-8xl 
                                    font-black text-white italic select-none pointer-events-none uppercase">
                            MANAGER
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2 -->
        <div
            class="sticky top-0 h-screen w-full flex items-center justify-center overflow-hidden z-10 shadow-[0_-50px_100px_rgba(0,0,0,1)]">
            <!-- Gambar responsif -->
            <picture>
                <source media="(min-width: 768px)" srcset="{{ asset('image/2.png') }}">
                <source media="(min-width: 640px)" srcset="{{ asset('image/2 2.png') }}">
                <img src="{{ asset('image/2 3.png') }}"
                    class="absolute inset-0 w-full h-full object-cover brightness-[0.4]" alt="Background Image 2">
            </picture>

           <div class="relative z-50 w-full max-w-8xl px-4 sm:px-6 lg:px-8">
                <div
                    class="w-full h-[90vh] sm:h-[95vh] md:h-[90vh] border border-white/60 p-3 sm:p-4 transition-all opacity-100">
                    <div class="w-full h-full border relative p-4 sm:p-6 md:p-8 lg:p-12 flex flex-col justify-end">

                        <div class="max-w-2xl pb-4">
                            <h2
                                class="text-white font-bold text-lg sm:text-xl md:text-2xl mb-3 md:mb-4 uppercase drop-shadow-2xl">
                                Akuntansi dan Keuangan Lembaga
                            </h2>
                            <p class="text-white text-xs sm:text-sm md:text-base leading-relaxed font-normal">
                                Lulusan Kompetensi Keahlian Akuntansi SMK Metland , ada yang kuliah , bekerja dan tidak
                                sedikit yang melanjutkan kuliah sambil bekerja. Untuk Kompetensi Keahlian Akuntansi
                                belajar mengenai Siklus Akuntansi, maka tidak ada karya yang bersifat riil atau produk
                                nyata yang bisa di pamerkan. Tapi Laporan Keuangan merupakan produk jasa akuntansi
                            </p>
                        </div>

                        <div
                            class="absolute bottom-3 right-4 sm:bottom-4 sm:right-6 md:bottom-6 md:right-10 opacity-30 
                                    text-2xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-8xl 
                                    font-black text-white italic uppercase">
                            TELLER
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3 -->
        <div
            class="relative z-20 h-screen w-full flex items-center justify-center bg-gray-900 shadow-[0_-50px_100px_rgba(0,0,0,1)]">
            <!-- Gambar responsif -->
            <picture>
                <source media="(min-width: 768px)" srcset="{{ asset('image/3.png') }}">
                <source media="(min-width: 640px)" srcset="{{ asset('image/3 2.png') }}">
                <img src="{{ asset('image/3 3.png') }}"
                    class="absolute inset-0 w-full h-full object-cover brightness-[0.4]" alt="Background Image 3">
            </picture>

            <div class="relative z-50 w-full max-w-8xl px-4 sm:px-6 lg:px-8">
                <div
                    class="w-full h-[90vh] sm:h-[95vh] md:h-[90vh] border border-white/60 p-3 sm:p-4 transition-all opacity-100">
                    <div class="w-full h-full border relative p-4 sm:p-6 md:p-8 lg:p-12 flex flex-col justify-end">

                        <div class="max-w-2xl">
                            <h2
                                class="text-white font-bold text-lg sm:text-xl md:text-2xl mb-3 md:mb-4 uppercase drop-shadow-2xl">
                                Akuntansi dan Keuangan Lembaga
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 lg:gap-8">
                                <div>
                                    <h3
                                        class="flex items-center text-white font-bold text-sm md:text-base border-l-4 pl-3 uppercase mb-2">
                                        Kompetensi / Materi yang Diajarkan :
                                    </h3>
                                    <ul class="text-white text-xs sm:text-sm leading-normal font-normal space-y-1">
                                        <li>01. Pengantar Ekonomi dan Bisnis</li>
                                        <li>02. Pengantar Administrasi Perkantoran</li>
                                        <li>03. Akuntansi Keuangan</li>
                                        <li>04. Akuntansi Perusahaan Dagang</li>
                                        <li>05. Akuntansi Manufaktur</li>
                                        <li>06. Komputer Akuntansi</li>
                                        <li>07. Administrasi Pajak</li>
                                    </ul>
                                </div>

                                <div class="mt-4 md:mt-0">
                                    <h3
                                        class="flex items-center text-white font-bold text-sm md:text-base border-l-4 pl-3 uppercase mb-2">
                                        Profesi / Bidang Pekerjaan :
                                    </h3>
                                    <ul class="text-white text-xs sm:text-sm leading-normal font-normal space-y-1">
                                        <li>01. Penata Buku Muda dalam lingkup akuntan</li>
                                        <li>02. Kasir / Teller</li>
                                        <li>03. Juru Penggajian</li>
                                        <li>04. Operator Mesin Hitung</li>
                                        <li>05. Administrasi Gudang</li>
                                        <li>06. Menyusun Laporan Keuangan</li>
                                        <li>07. DLL</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div
                            class="absolute bottom-3 right-4 sm:bottom-4 sm:right-6 md:bottom-6 md:right-10 opacity-30 
                                    text-2xl sm:text-3xl md:text-5xl lg:text-6xl xl:text-8xl 
                                    font-black text-white italic uppercase">
                            LAB TKJ
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
