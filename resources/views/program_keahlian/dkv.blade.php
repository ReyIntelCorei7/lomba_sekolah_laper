<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Desain Komunikasi Visual - SMK Metland</title>
    <link rel="icon" href="/image/logometland.png" type="image/png"> <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body x-data="{ menuOpen: false, lang: 'id', toggleLang() { this.lang = this.lang === 'id' ? 'en' : 'id'; } }" class="bg-gray-900">

    <!-- Navbar Component -->
    <x-navbar :solidBackground="true" :showOnScroll="false" />

    <div class="w-full relative bg-gray-900">
        <!-- Section 1 -->
        <div class="sticky top-0 h-screen w-full flex items-center justify-center overflow-hidden z-0">
            <!-- Gambar responsif -->
            <picture>
                <source media="(min-width: 768px)" srcset="{{ asset('image/DKV 1.png') }}">
                <source media="(min-width: 640px)" srcset="{{ asset('image/DKV 1 (1).png') }}">
                <img src="{{ asset('image/DKV 1 (2).png') }}"
                    class="absolute inset-0 w-full h-full object-cover brightness-[0.4]" alt="Background Image 1">
            </picture>

            <div class="relative z-50 w-full max-w-8xl px-4 sm:px-6 lg:px-8">
                <div
                    class="w-full h-[90vh] sm:h-[95vh] md:h-[90vh] border border-white/60 p-3 sm:p-4 transition-all opacity-100">
                    <div class="w-full h-full border relative p-4 sm:p-6 md:p-8 lg:p-12 flex flex-col justify-end">

                        <div class="max-w-2xl pb-4">
                            <h2
                                class="text-white font-bold text-lg sm:text-xl md:text-2xl mb-3 md:mb-4 uppercase drop-shadow-2xl">
                                Desain Komunikasi Visual
                            </h2>
                            <p class="text-white text-xs sm:text-sm md:text-base leading-relaxed font-normal">
                                Desain Komunikasi Visual mempelajari tentang ruang lingkup desain komunikasi visual,
                                unsur-unsur desain komunikasi visual, tata letak unsur-unsur, jenis dan karakter media
                                menurut penempatannya (indoor dan outdoor), jenis dan karakter media menurut temanya
                                (sosial dan komersial), jenis dan karakter media menurut bentuknya (2 dan 3 dimensi),
                                serta prosedur pembuatan media 2 dan 3 dimensi.
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
                <source media="(min-width: 768px)" srcset="{{ asset('image/DKV 2.png') }}">
                <source media="(min-width: 640px)" srcset="{{ asset('image/DKV 2 (1).png') }}">
                <img src="{{ asset('image/DKV 2.png') }}"
                    class="absolute inset-0 w-full h-full object-cover brightness-[0.4]" alt="Background Image 1">
            </picture>

            <div class="relative z-50 w-full max-w-8xl px-4 sm:px-6 lg:px-8">
                <div
                    class="w-full h-[90vh] sm:h-[95vh] md:h-[90vh] border border-white/60 p-3 sm:p-4 transition-all opacity-100">
                    <div class="w-full h-full border relative p-4 sm:p-6 md:p-8 lg:p-12 flex flex-col justify-end">

                        <div class="max-w-2xl pb-4">
                            <h2
                                class="text-white font-bold text-lg sm:text-xl md:text-2xl mb-3 md:mb-4 uppercase drop-shadow-2xl">
                                Desain Komunikasi Visual
                            </h2>
                            <p class="text-white text-xs sm:text-sm md:text-base leading-relaxed font-normal">
                                Bertujuan untuk membentuk karakteristik siswa sebagai siswa yang mensyukuri anugerah
                                Tuhan, dengan berfikir secara saintifik dalam membuat karya seni rupa dan kriya yang
                                ramah lingkungan serta berbasis sosial budaya bangsa.
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
                <source media="(min-width: 768px)" srcset="{{ asset('image/DKV 3.png') }}">
                <source media="(min-width: 640px)" srcset="{{ asset('image/DKV 3 (1).png') }}">
                <img src="{{ asset('image/DKV 3 (2).png') }}"
                    class="absolute inset-0 w-full h-full object-cover brightness-[0.4]" alt="Background Image 1">
            </picture>

            <div class="relative z-50 w-full max-w-8xl px-4 sm:px-6 lg:px-8">
                <div
                    class="w-full h-[90vh] sm:h-[95vh] md:h-[90vh] border border-white/60 p-3 sm:p-4 transition-all opacity-100">
                    <div class="w-full h-full border relative p-4 sm:p-6 md:p-8 lg:p-12 flex flex-col justify-end">

                        <div class="max-w-2xl">
                            <h2
                                class="text-white font-bold text-lg sm:text-xl md:text-2xl mb-3 md:mb-4 uppercase drop-shadow-2xl">
                                Desain Komunikasi Visual
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 lg:gap-8">
                                <div>
                                    <h3
                                        class="flex items-center text-white font-bold text-sm md:text-base border-l-4 pl-3 uppercase mb-2">
                                        Kompetensi / Materi yang Diajarkan :
                                    </h3>
                                    <ul class="text-white text-xs sm:text-sm leading-normal font-normal space-y-1">
                                        <li>01. Ruang lingkup desain komunikasi visual</li>
                                        <li>02. Unsur-unsur desain komunikasi visual</li>
                                        <li>03. Jenis dan karakter media menurut penempatannya (indoor dan outdoor)</li>
                                        <li>04. Jenis dan karakter media menurut temanya (social dan komersial)</li>
                                        <li>05. Jenis dan karakter media menurut bentuknya (2d & 3d)</li>
                                        <li>06. Tata letak unsur-unsur desain komunikasi visual</li>
                                        <li>07. Prosedur pembuatan media 2 dan 3 dimensi.</li>
                                    </ul>
                                </div>

                                <div class="mt-4 md:mt-0">
                                    <h3
                                        class="flex items-center text-white font-bold text-sm md:text-base border-l-4 pl-3 uppercase mb-2">
                                        Profesi / Bidang Pekerjaan :
                                    </h3>
                                    <ul class="text-white text-xs sm:text-sm leading-normal font-normal space-y-1">
                                        <li>01. Graphic Designer</li>
                                        <li>02. Ilustrator</li>
                                        <li>03. Artist</li>
                                        <li>04. Videographer</li>
                                        <li>05. Photograapher </li>
                                        <li>06. Event Organizer (EO)</li>
                                        <li>07. Advertising</li>
                                        <li>08. Percetakan & Penerbitan</li>
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

    <!-- Footer Component -->
    @include('components.footer')
</body>

</html>
