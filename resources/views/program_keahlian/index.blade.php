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
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
     <div class="w-full relative bg-gray-900">

        <div class="sticky top-0 h-screen w-full flex items-center justify-center overflow-hidden z-0">
            <img src="{{ asset('image/1.png') }}" class="absolute inset-0 w-full h-full object-cover brightness-[0.4]">

            <div class="relative z-50 w-full max-w-7xl px-6">
                <div class="w-full h-[90vh] md:h-[80vh] border border-white/60 p-4 transition-all opacity-100">
                    <div class="w-full h-full border relative p-8 md:p-12 flex flex-col justify-end ">

                        <div class="absolute top-8 left-8 bg-white rounded-full p-2 shadow-2xl">
                            <img src="{{ asset('image/logo_metland.png') }}" class="w-12 h-12 object-contain"
                                alt="Logo">
                        </div>

                        <div class="max-w-2xl pb-4">
                            <h2 class="text-white font-bold text-4xl mb-4 uppercase drop-shadow-2xl">AKUNTANSI</h2>
                            <p class="text-white text-sm md:text-lg leading-relaxed font-medium">
                                Kompetensi keahlian akuntansi mencakup pembelajaran Akuntansi Manual dan Komputer.
                                Mempersiapkan siswa mengelola keuangan perusahaan jasa, dagang, dan manufaktur.
                            </p>
                        </div>

                        <div
                            class="absolute bottom-6 right-10 opacity-30 text-6xl md:text-8xl font-black text-white italic select-none pointer-events-none uppercase">
                            MANAGER
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="sticky top-0 h-screen w-full flex items-center justify-center overflow-hidden z-10 shadow-[0_-50px_100px_rgba(0,0,0,1)]">
            <img src="{{ asset('image/2.png') }}" class="absolute inset-0 w-full h-full object-cover brightness-[0.4]">

            <div class="relative z-50 w-full max-w-7xl px-6">
                <div class="w-full h-[90vh] md:h-[80vh] border border-white/60 p-4 transition-all opacity-100">
                    <div class="w-full h-full border relative p-8 md:p-12 flex flex-col justify-end ">

                        <div class="absolute top-8 left-8 bg-white rounded-full p-2">
                            <img src="{{ asset('image/logo_metland.png') }}" class="w-12 h-12 object-contain"
                                alt="Logo">
                        </div>

                        <div class="max-w-2xl pb-4">
                            <h2 class="text-white font-bold text-4xl mb-4 uppercase">LAYANAN PERBANKAN</h2>
                            <p class="text-white text-sm md:text-lg leading-relaxed font-medium">
                                Mencetak tenaga kerja yang terampil dalam layanan perbankan, kasir,
                                dan administrasi keuangan yang siap terjun langsung ke dunia industri.
                            </p>
                        </div>

                        <div
                            class="absolute bottom-6 right-10 opacity-30 text-6xl md:text-8xl font-black text-white italic uppercase">
                            TELLER 2
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="relative z-20 h-screen w-full flex items-center justify-center bg-gray-900 shadow-[0_-50px_100px_rgba(0,0,0,1)]">
            <img src="{{ asset('image/3.png') }}"
                class="absolute inset-0 w-full h-full object-cover brightness-[0.4]">

            <div class="relative z-50 w-full max-w-7xl px-6">
                <div class="w-full h-[90vh] md:h-[80vh] border border-white/60 p-4 transition-all opacity-100">
                    <div class="w-full h-full border relative p-8 md:p-12 flex flex-col justify-end ">

                        <div class="absolute top-8 left-8 bg-white rounded-full p-2">
                            <img src="{{ asset('image/logo_metland.png') }}" class="w-12 h-12 object-contain"
                                alt="Logo">
                        </div>

                        <div class="max-w-2xl pb-4">
                            <h2 class="text-white font-bold text-4xl mb-4 uppercase">TEKNIK KOMPUTER</h2>
                            <p class="text-white text-sm md:text-lg leading-relaxed font-medium">
                                Fokus pada pengembangan perangkat lunak, jaringan komputer, dan keamanan siber
                                untuk menjawab tantangan transformasi digital global.
                            </p>
                        </div>

                        <div
                            class="absolute bottom-6 right-10 opacity-30 text-6xl md:text-8xl font-black text-white italic uppercase">
                            LAB TKJ
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>