@extends('admin.layouts.app')

@section('title', 'Tambah Program Keahlian')
@section('page-title', 'Tambah Program Keahlian')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Back Button -->
    <a href="{{ route('admin.program-keahlian.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-white transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>

    <form action="{{ route('admin.program-keahlian.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Basic Info -->
        <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl border border-slate-700/50 p-6">
            <h3 class="text-lg font-semibold text-white mb-6">Informasi Dasar</h3>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Nama Program *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Akuntansi & Keuangan Lembaga">
                    @error('name')<span class="text-red-400 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Nama Singkat *</label>
                    <input type="text" name="short_name" value="{{ old('short_name') }}" required
                           class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="AKL">
                    @error('short_name')<span class="text-red-400 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Slug URL *</label>
                    <div class="flex items-center gap-2">
                        <span class="text-slate-400">/prokeh/</span>
                        <input type="text" name="slug" value="{{ old('slug') }}" required
                               class="flex-1 px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="akuntansi">
                    </div>
                    @error('slug')<span class="text-red-400 text-sm mt-1">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Tema Warna</label>
                    <select name="color_theme" 
                            class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @foreach($colorThemes as $value => $label)
                            <option value="{{ $value }}" {{ old('color_theme') == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Icon (Emoji)</label>
                    <input type="text" name="icon" value="{{ old('icon') }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="💰">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Urutan</label>
                    <input type="number" name="order" value="{{ old('order', 0) }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-slate-300 mb-2">Deskripsi Singkat * (untuk card)</label>
                <textarea name="short_description" rows="2" required
                          class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                          placeholder="Deskripsi singkat untuk ditampilkan di card...">{{ old('short_description') }}</textarea>
                @error('short_description')<span class="text-red-400 text-sm mt-1">{{ $message }}</span>@enderror
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-slate-300 mb-2">Deskripsi Lengkap *</label>
                <textarea name="description" rows="4" required
                          class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                          placeholder="Deskripsi lengkap program keahlian...">{{ old('description') }}</textarea>
                @error('description')<span class="text-red-400 text-sm mt-1">{{ $message }}</span>@enderror
            </div>
        </div>

        <!-- Images -->
        <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl border border-slate-700/50 p-6">
            <h3 class="text-lg font-semibold text-white mb-6">Gambar</h3>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Hero Image</label>
                    <input type="file" name="hero_image" accept="image/*"
                           class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-600 file:text-white file:cursor-pointer">
                    <p class="text-slate-400 text-sm mt-1">Gambar latar hero section (max 5MB)</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Overview Image</label>
                    <input type="file" name="overview_image" accept="image/*"
                           class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-600 file:text-white file:cursor-pointer">
                    <p class="text-slate-400 text-sm mt-1">Gambar section overview (max 5MB)</p>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl border border-slate-700/50 p-6">
            <h3 class="text-lg font-semibold text-white mb-6">Statistik</h3>
            
            <div class="grid md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Jumlah Kompetensi</label>
                    <input type="number" name="stat_competencies" value="{{ old('stat_competencies', 7) }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Persentase Kerja/Kuliah</label>
                    <input type="number" name="stat_employment" value="{{ old('stat_employment', 95) }}" min="0" max="100"
                           class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Jumlah Mitra</label>
                    <input type="number" name="stat_partners" value="{{ old('stat_partners', 10) }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Range Gaji</label>
                    <input type="text" name="salary_range" value="{{ old('salary_range') }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Rp 5-15 Jt">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-300 mb-2">Label Gaji</label>
                    <input type="text" name="salary_label" value="{{ old('salary_label', 'Gaji Awal Lulusan') }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>
        </div>

        <!-- Overview Content -->
        <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl border border-slate-700/50 p-6">
            <h3 class="text-lg font-semibold text-white mb-6">Konten Overview</h3>
            
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Konten Overview (untuk halaman detail)</label>
                <textarea name="overview_content" rows="4"
                          class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                          placeholder="Konten tambahan untuk section overview...">{{ old('overview_content') }}</textarea>
            </div>
        </div>

        <!-- Status & Submit -->
        <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl border border-slate-700/50 p-6">
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked
                           class="w-5 h-5 rounded border-slate-600 bg-slate-700 text-blue-600 focus:ring-blue-500 focus:ring-offset-0">
                    <span class="text-white font-medium">Aktifkan Program</span>
                </label>

                <div class="flex gap-3">
                    <a href="{{ route('admin.program-keahlian.index') }}" 
                       class="px-6 py-3 rounded-xl border border-slate-600 text-slate-300 hover:bg-slate-700 transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition-colors">
                        Simpan Program
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
