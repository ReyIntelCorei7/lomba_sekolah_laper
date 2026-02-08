@props([
    'logoUrl' => asset('image/logometland.png'),
    'settings' => []
])

<!-- Mega Menu Overlay -->
<div class="fixed inset-0 bg-[#1E2188] z-40 transition-transform duration-700 ease-[cubic-bezier(0.16,1,0.3,1)]"
    :class="menuOpen ? 'translate-y-0' : '-translate-y-full'"
    style="top: 0;">

    <div class="max-w-[1400px] mx-auto px-6 pt-32 pb-12 h-full flex flex-col">
        <!-- Header in Menu -->
        <div class="flex items-center gap-4 mb-20">
            <img src="{{ $logoUrl }}" class="w-16 h-16 object-contain">
            <h2 class="text-3xl font-bold text-white tracking-widest uppercase">METLAND SCHOOL</h2>
        </div>

        <!-- Grid Content -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-white">
            <!-- Column 1 -->
            <div class="space-y-8">
                <a href="/about" @click="menuOpen=false" class="block text-xl font-bold hover:text-blue-200 transition-colors">Profile Sekolah</a>
                <a href="/about" @click="menuOpen=false" class="block text-xl font-bold hover:text-blue-200 transition-colors">Visi dan Misi</a>
                <a href="/prokeh" @click="menuOpen=false" class="block text-xl font-bold hover:text-blue-200 transition-colors">Program Keahlian</a>
                <a href="/" @click="menuOpen=false" class="block text-xl font-bold hover:text-blue-200 transition-colors">Home</a>
            </div>

            <!-- Column 2 -->
            <div class="space-y-8">
                <a href="/eskul" @click="menuOpen=false" class="block text-xl font-bold hover:text-blue-200 transition-colors">Ekstrakurikuler</a>
                <a href="/organisasi" @click="menuOpen=false" class="block text-xl font-bold hover:text-blue-200 transition-colors">Organisasi</a>
                <a href="/smile" @click="menuOpen=false" class="block text-xl font-bold hover:text-blue-200 transition-colors">Produk/Karya Siswa</a>
            </div>

            <!-- Column 3 -->
            <div class="space-y-8">
                <a href="#" class="block text-xl font-bold hover:text-blue-200 transition-colors">Tentang Alumni</a>
                <a href="/news" @click="menuOpen=false" class="block text-xl font-bold hover:text-blue-200 transition-colors">Berita Sekolah</a>
                <a href="/kurikulum" class="block text-xl font-bold hover:text-blue-200 transition-colors">Kurikulum</a>
            </div>
        </div>

        <div class="mt-auto border-t border-white/20 pt-8 flex justify-between text-white/60 text-sm">
            <p>&copy; {{ date('Y') }} SMK Metland School</p>
            <div class="flex gap-4">
                @if(isset($settings['social_instagram']))
                <a href="{{ $settings['social_instagram'] }}" class="hover:text-white">Instagram</a>
                @endif
                @if(isset($settings['social_facebook']))
                <a href="{{ $settings['social_facebook'] }}" class="hover:text-white">Facebook</a>
                @endif
                @if(isset($settings['social_youtube']))
                <a href="{{ $settings['social_youtube'] }}" class="hover:text-white">Youtube</a>
                @endif
            </div>
        </div>
    </div>
</div>

