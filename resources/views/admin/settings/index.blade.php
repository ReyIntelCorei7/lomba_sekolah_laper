@extends('admin.layouts.app')

@section('title', 'Homepage')

@section('content')
<div class="space-y-6">

    {{-- Success Message --}}
    @if(session('success'))
        <div class="p-4 bg-green-500/10 border border-green-500/20 rounded-xl text-green-400 flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Homepage</h1>
            <p class="mt-1 text-sm text-slate-400">Kelola gambar-gambar yang tampil di halaman utama website</p>
        </div>
        <a href="{{ url('/') }}" target="_blank"
           class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-blue-400 border border-blue-500/30 rounded-lg hover:bg-blue-500/10 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
            Lihat Homepage
        </a>
    </div>

    @php
        $heroSetting1 = \App\Models\WebsiteSetting::where('key', 'hero_image_1')->first();
        $heroSetting2 = \App\Models\WebsiteSetting::where('key', 'hero_image_2')->first();
        $heroSetting3 = \App\Models\WebsiteSetting::where('key', 'hero_image_3')->first();
        $heroSetting1 = \App\Models\WebsiteSetting::where('key', 'hero_image_1')->first();
        $heroSetting2 = \App\Models\WebsiteSetting::where('key', 'hero_image_2')->first();
        $heroSetting3 = \App\Models\WebsiteSetting::where('key', 'hero_image_3')->first();

        $hero1Url = ($heroSetting1 && $heroSetting1->value) ? img_url($heroSetting1->value, 'website_settings', $heroSetting1->id, 'value') : null;
        $hero2Url = ($heroSetting2 && $heroSetting2->value) ? img_url($heroSetting2->value, 'website_settings', $heroSetting2->id, 'value') : null;
        $hero3Url = ($heroSetting3 && $heroSetting3->value) ? img_url($heroSetting3->value, 'website_settings', $heroSetting3->id, 'value') : null;
    @endphp

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf



        {{-- ============================================================ --}}
        {{-- HERO SLIDER SECTION --}}
        {{-- ============================================================ --}}
        <div class="bg-slate-800/50 rounded-2xl border border-slate-700 overflow-hidden mb-6">
            {{-- Card Header --}}
            <div class="px-6 py-4 border-b border-slate-700 flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-500/20 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-white">Gambar Hero Slider</h3>
                    <p class="text-xs text-slate-400">3 gambar yang berganti otomatis di bagian atas homepage</p>
                </div>
            </div>

            <div class="p-6">
                {{-- Info Box --}}
                <div class="flex items-start gap-3 p-4 bg-blue-500/10 border border-blue-500/20 rounded-xl mb-6">
                    <svg class="w-4 h-4 mt-0.5 text-blue-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-xs text-blue-300 leading-relaxed">
                        Gunakan gambar beresolusi tinggi <strong>(min. 1920×1080)</strong> untuk hasil terbaik.
                        Ketiga gambar akan tampil sebagai slider otomatis. Jika belum diupload, homepage akan menampilkan gambar default.
                    </p>
                </div>

                {{-- 3 Hero Image Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @php
                        $heroImages = [
                            ['key' => 'hero_image_1', 'label' => 'Slide 1', 'url' => $hero1Url, 'color' => 'blue'],
                            ['key' => 'hero_image_2', 'label' => 'Slide 2', 'url' => $hero2Url, 'color' => 'indigo'],
                            ['key' => 'hero_image_3', 'label' => 'Slide 3', 'url' => $hero3Url, 'color' => 'violet'],
                        ];
                    @endphp

                    @foreach($heroImages as $i => $hero)
                    <div class="space-y-3">
                        {{-- Image Preview --}}
                        <div class="relative rounded-xl overflow-hidden border-2 aspect-video bg-slate-900
                            {{ $hero['url'] ? 'border-'.$hero['color'].'-500/40' : 'border-dashed border-slate-600' }} group">
                            @if($hero['url'])
                                <img src="{{ $hero['url'] }}" alt="{{ $hero['label'] }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent flex items-end p-3">
                                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-[10px] font-bold bg-white/20 backdrop-blur-sm text-white">
                                        <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        {{ $hero['label'] }}
                                    </span>
                                </div>
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center gap-2 text-slate-500">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-xs font-medium">{{ $hero['label'] }} — Kosong</span>
                                    <span class="text-[10px]">Upload gambar di bawah</span>
                                </div>
                            @endif
                        </div>

                        {{-- Upload + Status --}}
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <label class="text-xs font-medium text-slate-400">{{ $hero['label'] }}</label>
                                @if($hero['url'])
                                    <span class="inline-flex items-center gap-1 text-[10px] text-green-400 font-medium">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        Sudah ada
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[10px] text-amber-400 font-medium">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        Belum ada
                                    </span>
                                @endif
                            </div>
                            <input type="file"
                                   name="settings[{{ $hero['key'] }}]"
                                   id="settings_{{ $hero['key'] }}"
                                   accept="image/*"
                                   class="block w-full text-xs text-slate-400
                                          file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0
                                          file:text-xs file:font-semibold file:bg-blue-500/20 file:text-blue-400
                                          hover:file:bg-blue-500/30 transition-colors">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ============================================================ --}}
        {{-- SUBMIT BUTTON --}}
        {{-- ============================================================ --}}
        <div class="flex justify-end">
            <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-600/20 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>
@endsection