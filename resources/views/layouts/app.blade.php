<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div x-data="{ hovered: null }" class="flex w-[500px] h-[500px] gap-2 p-4 bg-[#0a3d34] overflow-hidden">

        <template
            x-for="(item, index) in [
        {id: 1, title: 'PPLG', img: 'link-gambar-1.jpg'},
        {id: 2, title: 'DKV', img: 'link-gambar-2.jpg'},
        {id: 3, title: 'AKUTANSI', img: 'link-gambar-3.jpg'},
        {id: 4, title: 'KULINER', img: 'link-gambar-4.jpg'},
        {id: 5, title: 'PERHOTELAN', img: 'link-gambar-5.jpg'}
    ]"
            :key="index">

            <div @mouseenter="hovered = item.id" @mouseleave="hovered = null"
                :class="hovered === item.id ? 'flex-[5]' : (hovered === null ? 'flex-1' : 'flex-[0.5]')"
                class="relative overflow-hidden transition-all duration-700 ease-in-out cursor-pointer rounded-lg">
                <img :src="item.img" class="absolute inset-0 object-cover w-full h-full transition duration-700"
                    :class="hovered === item.id ? 'brightness-100 scale-105' : 'brightness-50'">

                <div class="absolute transition-all duration-700 ease-in-out pointer-events-none"
                    :style="hovered === item.id ?
                        'left: 2rem; bottom: 2rem; transform: translate(0, 0) rotate(0deg);' :
                        'left: 50%; top: 50%; transform: translate(-50%, -50%) rotate(-90deg);'">
                    <h2 class="text-white font-bold whitespace-nowrap transition-all duration-700"
                        :class="hovered === item.id ? 'text-4xl' : 'text-xl'" x-text="item.title"></h2>
                </div>
            </div>
        </template>

    </div>
</body>

</html>
