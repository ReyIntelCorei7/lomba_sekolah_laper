@extends('admin.layouts.app')

@section('title', 'Homepage')

@section('content')
<div class="space-y-6">
    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-50 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400 dark:text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800 dark:text-green-400">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Homepage</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">
                Kelola gambar-gambar yang tampil di halaman utama website
            </p>
        </div>
        <a href="{{ url('/') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-500/30 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-500/10 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            Lihat Homepage
        </a>
    </div>

    @php
        $heroSetting1 = \App\Models\WebsiteSetting::where('key', 'hero_image_1')->first();
        $heroSetting2 = \App\Models\WebsiteSetting::where('key', 'hero_image_2')->first();
        $heroSetting3 = \App\Models\WebsiteSetting::where('key', 'hero_image_3')->first();
        $logoSetting = \App\Models\WebsiteSetting::where('key', 'logo_image')->first();

        $hero1Url = ($heroSetting1 && $heroSetting1->value) ? img_url($heroSetting1->value, 'website_settings', $heroSetting1->id, 'value') : null;
        $hero2Url = ($heroSetting2 && $heroSetting2->value) ? img_url($heroSetting2->value, 'website_settings', $heroSetting2->id, 'value') : null;
        $hero3Url = ($heroSetting3 && $heroSetting3->value) ? img_url($heroSetting3->value, 'website_settings', $heroSetting3->id, 'value') : null;
        $logoUrl = ($logoSetting && $logoSetting->value) ? img_url($logoSetting->value, 'website_settings', $logoSetting->id, 'value') : null;
    @endphp

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf

        <!-- PREVIEW SECTION: Homepage Layout Mockup -->
        <div class="bg-white dark:bg-slate-800/50 shadow rounded-xl border border-gray-200 dark:border-slate-700 mb-6 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/80">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    Preview & Upload Gambar
                </h3>
                <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">Klik "Choose File" pada bagian yang ingin Anda ganti gambarnya</p>
            </div>

            <div class="p-6 space-y-8">

                <!-- Logo Section -->
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-700 dark:bg-purple-500/20 dark:text-purple-400">NAVBAR</span>
                        <h4 class="text-sm font-bold text-gray-700 dark:text-slate-300">Logo Website</h4>
                        <span class="text-xs text-gray-400 dark:text-slate-500">— Tampil di pojok kiri atas navigasi</span>
                    </div>

                    <div class="flex items-center gap-6 p-4 bg-slate-900 rounded-xl border border-slate-700">
                        <!-- Preview: Navbar mockup -->
                        <div class="flex items-center gap-3">
                            @if($logoUrl)
                                <img src="{{ $logoUrl }}" alt="Logo" class="w-10 h-10 object-contain rounded-lg border border-slate-600">
                            @else
                                <div class="w-10 h-10 bg-slate-700 rounded-lg border-2 border-dashed border-slate-500 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <span class="text-white font-bold text-sm">SMK METLAND</span>
                            <div class="hidden sm:flex gap-4 ml-6 text-slate-400 text-xs">
                                <span>BERANDA</span>
                                <span>TENTANG</span>
                                <span>PROGRAM</span>
                                <span>BERITA</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <input type="file" name="settings[logo_image]" id="settings_logo_image" accept="image/*"
                               class="block w-full text-sm text-gray-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 dark:file:bg-purple-900/30 dark:file:text-purple-400 hover:file:bg-purple-100 dark:hover:file:bg-purple-900/50 transition-colors">
                        @if($logoUrl)
                            <span class="text-xs text-green-500 font-medium flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Sudah ada gambar
                            </span>
                        @else
                            <span class="text-xs text-amber-500 font-medium flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                Belum ada gambar
                            </span>
                        @endif
                    </div>
                </div>

                <hr class="border-gray-200 dark:border-slate-700">

                <!-- Hero Images Section -->
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-400">HERO</span>
                        <h4 class="text-sm font-bold text-gray-700 dark:text-slate-300">Gambar Hero Slider</h4>
                        <span class="text-xs text-gray-400 dark:text-slate-500">— 3 gambar yang berganti otomatis di bagian atas homepage</span>
                    </div>

                    <!-- Hero Preview: 3 images in a slider-like preview -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        @php
                            $heroImages = [
                                ['key' => 'hero_image_1', 'label' => 'Slide 1', 'url' => $hero1Url, 'color' => 'blue'],
                                ['key' => 'hero_image_2', 'label' => 'Slide 2', 'url' => $hero2Url, 'color' => 'indigo'],
                                ['key' => 'hero_image_3', 'label' => 'Slide 3', 'url' => $hero3Url, 'color' => 'violet'],
                            ];
                        @endphp

                        @foreach($heroImages as $i => $hero)
                        <div class="space-y-3">
                            <!-- Preview Card -->
                            <div class="relative rounded-xl overflow-hidden border-2 {{ $hero['url'] ? 'border-'.$hero['color'].'-500/30' : 'border-dashed border-gray-300 dark:border-slate-600' }} aspect-video bg-gray-100 dark:bg-slate-900 group">
                                @if($hero['url'])
                                    <img src="{{ $hero['url'] }}" alt="{{ $hero['label'] }}" class="w-full h-full object-cover">
                                    <!-- Overlay label -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent flex items-end p-3">
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-white/20 backdrop-blur-sm text-white">
                                                {{ $hero['label'] }}
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 dark:text-slate-500">
                                        <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span class="text-xs font-medium">{{ $hero['label'] }} — Kosong</span>
                                        <span class="text-[10px] mt-1">Upload gambar di bawah</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Upload Input -->
                            <div class="flex items-center gap-3">
                                <input type="file" name="settings[{{ $hero['key'] }}]" id="settings_{{ $hero['key'] }}" accept="image/*"
                                       class="block w-full text-xs text-gray-500 dark:text-slate-400 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 dark:file:bg-blue-900/30 dark:file:text-blue-400 hover:file:bg-blue-100 dark:hover:file:bg-blue-900/50 transition-colors">
                            </div>
                            <div class="flex items-center gap-1">
                                @if($hero['url'])
                                    <span class="text-[10px] text-green-500 font-medium flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        Sudah ada
                                    </span>
                                @else
                                    <span class="text-[10px] text-amber-500 font-medium flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        Belum ada
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- How it looks hint -->
                    <div class="flex items-start gap-2 p-3 bg-blue-50 dark:bg-blue-500/10 rounded-lg border border-blue-100 dark:border-blue-500/20">
                        <svg class="w-4 h-4 mt-0.5 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                        <p class="text-xs text-blue-700 dark:text-blue-300">
                            <strong>Tip:</strong> Gunakan gambar beresolusi tinggi (min. 1920×1080) untuk hasil terbaik. 
                            Ketiga gambar akan tampil sebagai slider otomatis di bagian hero homepage.
                            Jika tidak di-upload, homepage akan menampilkan gambar default.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="bg-white dark:bg-slate-800/50 shadow rounded-xl border border-gray-200 dark:border-slate-700 px-6 py-4">
            <div class="flex justify-end">
                <button type="submit" 
                        class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-lg shadow-blue-600/20 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection