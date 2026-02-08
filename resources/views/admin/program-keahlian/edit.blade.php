@extends('admin.layouts.app')

@section('title', 'Edit Program Keahlian')
@section('page-title', 'Edit Program Keahlian')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Back Button -->
    <a href="{{ route('admin.program-keahlian.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-white transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar
    </a>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-500/20 border border-green-500/50 rounded-xl p-4 text-green-300">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Main Form -->
        <div class="lg:col-span-2 space-y-6">
            <form action="{{ route('admin.program-keahlian.update', $program_keahlian) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Basic Info -->
                <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl border border-slate-700/50 p-6">
                    <h3 class="text-lg font-semibold text-white mb-6">Informasi Dasar</h3>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Nama Program *</label>
                            <input type="text" name="name" value="{{ old('name', $program_keahlian->name) }}" required
                                   class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white">
                            @error('name')<span class="text-red-400 text-sm mt-1">{{ $message }}</span>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Nama Singkat *</label>
                            <input type="text" name="short_name" value="{{ old('short_name', $program_keahlian->short_name) }}" required
                                   class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Slug URL *</label>
                            <div class="flex items-center gap-2">
                                <span class="text-slate-400">/prokeh/</span>
                                <input type="text" name="slug" value="{{ old('slug', $program_keahlian->slug) }}" required
                                       class="flex-1 px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Tema Warna</label>
                            <select name="color_theme" class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white">
                                @foreach($colorThemes as $value => $label)
                                    <option value="{{ $value }}" {{ (old('color_theme', $program_keahlian->color_theme) == $value) ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Icon (Emoji)</label>
                            <input type="text" name="icon" value="{{ old('icon', $program_keahlian->icon) }}"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Urutan</label>
                            <input type="number" name="order" value="{{ old('order', $program_keahlian->order) }}"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-slate-300 mb-2">Deskripsi Singkat *</label>
                        <textarea name="short_description" rows="2" required
                                  class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white">{{ old('short_description', $program_keahlian->short_description) }}</textarea>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-slate-300 mb-2">Deskripsi Lengkap *</label>
                        <textarea name="description" rows="4" required
                                  class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white">{{ old('description', $program_keahlian->description) }}</textarea>
                    </div>
                </div>

                <!-- Images -->
                <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl border border-slate-700/50 p-6">
                    <h3 class="text-lg font-semibold text-white mb-6">Gambar</h3>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Hero Image</label>
                            @if($program_keahlian->hero_image)
                                <img src="{{ Storage::url($program_keahlian->hero_image) }}" class="w-full h-32 object-cover rounded-lg mb-2">
                            @endif
                            <input type="file" name="hero_image" accept="image/*"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-600 file:text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Overview Image</label>
                            @if($program_keahlian->overview_image)
                                <img src="{{ Storage::url($program_keahlian->overview_image) }}" class="w-full h-32 object-cover rounded-lg mb-2">
                            @endif
                            <input type="file" name="overview_image" accept="image/*"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-600 file:text-white">
                        </div>
                    </div>
                </div>

                <!-- Stats -->
                <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl border border-slate-700/50 p-6">
                    <h3 class="text-lg font-semibold text-white mb-6">Statistik</h3>
                    
                    <div class="grid md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Jumlah Kompetensi</label>
                            <input type="number" name="stat_competencies" value="{{ old('stat_competencies', $program_keahlian->stat_competencies) }}"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Persentase Kerja/Kuliah</label>
                            <input type="number" name="stat_employment" value="{{ old('stat_employment', $program_keahlian->stat_employment) }}" min="0" max="100"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Jumlah Mitra</label>
                            <input type="number" name="stat_partners" value="{{ old('stat_partners', $program_keahlian->stat_partners) }}"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Range Gaji</label>
                            <input type="text" name="salary_range" value="{{ old('salary_range', $program_keahlian->salary_range) }}"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white" placeholder="Rp 5-15 Jt">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-300 mb-2">Label Gaji</label>
                            <input type="text" name="salary_label" value="{{ old('salary_label', $program_keahlian->salary_label) }}"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white">
                        </div>
                    </div>
                </div>

                <!-- Overview Content -->
                <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl border border-slate-700/50 p-6">
                    <h3 class="text-lg font-semibold text-white mb-6">Konten Overview</h3>
                    <textarea name="overview_content" rows="4"
                              class="w-full px-4 py-3 rounded-xl bg-slate-700/50 border border-slate-600 text-white">{{ old('overview_content', $program_keahlian->overview_content) }}</textarea>
                </div>

                <!-- Status & Submit -->
                <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl border border-slate-700/50 p-6">
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ $program_keahlian->is_active ? 'checked' : '' }}
                                   class="w-5 h-5 rounded border-slate-600 bg-slate-700 text-blue-600">
                            <span class="text-white font-medium">Aktifkan Program</span>
                        </label>

                        <button type="submit" class="px-6 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Sidebar: Skills & Careers -->
        <div class="space-y-6">
            <!-- Skills -->
            <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl border border-slate-700/50 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-white">Materi Pembelajaran</h3>
                    <span class="text-sm text-slate-400">{{ $program_keahlian->skills->count() }} items</span>
                </div>

                <!-- Skills List -->
                <div class="space-y-3 mb-4 max-h-64 overflow-y-auto">
                    @forelse($program_keahlian->skills as $skill)
                    <div class="bg-slate-700/50 rounded-xl p-3">
                        <div class="flex items-start justify-between gap-2">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="text-lg">{{ $skill->icon ?? '📚' }}</span>
                                    <span class="text-white font-medium truncate">{{ $skill->name }}</span>
                                </div>
                                <p class="text-slate-400 text-sm mt-1 line-clamp-2">{{ $skill->description }}</p>
                            </div>
                            <form action="{{ route('admin.program-keahlian.skills.destroy', $skill) }}" method="POST" class="shrink-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 rounded bg-red-500/20 text-red-400 hover:bg-red-500/30"
                                        onclick="return confirm('Hapus skill ini?')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <p class="text-slate-500 text-sm text-center py-4">Belum ada skill</p>
                    @endforelse
                </div>

                <!-- Add Skill Form -->
                <form action="{{ route('admin.program-keahlian.skills.store', $program_keahlian) }}" method="POST" class="border-t border-slate-600 pt-4">
                    @csrf
                    <div class="space-y-3">
                        <input type="text" name="name" placeholder="Nama Skill" required
                               class="w-full px-3 py-2 rounded-lg bg-slate-700 border border-slate-600 text-white text-sm">
                        <textarea name="description" placeholder="Deskripsi" rows="2" required
                                  class="w-full px-3 py-2 rounded-lg bg-slate-700 border border-slate-600 text-white text-sm"></textarea>
                        <div class="grid grid-cols-3 gap-2">
                            <input type="text" name="icon" placeholder="Icon" value="📚"
                                   class="px-3 py-2 rounded-lg bg-slate-700 border border-slate-600 text-white text-sm">
                            <select name="gradient_from" class="px-2 py-2 rounded-lg bg-slate-700 border border-slate-600 text-white text-sm">
                                @foreach($gradientColors as $color)
                                    <option value="{{ $color }}">{{ $color }}</option>
                                @endforeach
                            </select>
                            <select name="gradient_to" class="px-2 py-2 rounded-lg bg-slate-700 border border-slate-600 text-white text-sm">
                                @foreach($gradientColors as $color)
                                    <option value="{{ $color }}" {{ $color == 'indigo-600' ? 'selected' : '' }}>{{ $color }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="w-full py-2 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700">
                            + Tambah Skill
                        </button>
                    </div>
                </form>
            </div>

            <!-- Careers -->
            <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl border border-slate-700/50 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-white">Peluang Karir</h3>
                    <span class="text-sm text-slate-400">{{ $program_keahlian->careers->count() }} items</span>
                </div>

                <!-- Careers List -->
                <div class="space-y-3 mb-4 max-h-64 overflow-y-auto">
                    @forelse($program_keahlian->careers as $career)
                    <div class="bg-slate-700/50 rounded-xl p-3">
                        <div class="flex items-start justify-between gap-2">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="text-lg">{{ $career->icon ?? '💼' }}</span>
                                    <span class="text-white font-medium truncate">{{ $career->name }}</span>
                                </div>
                                <p class="text-slate-400 text-sm mt-1 line-clamp-2">{{ $career->description }}</p>
                            </div>
                            <form action="{{ route('admin.program-keahlian.careers.destroy', $career) }}" method="POST" class="shrink-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 rounded bg-red-500/20 text-red-400 hover:bg-red-500/30"
                                        onclick="return confirm('Hapus karir ini?')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <p class="text-slate-500 text-sm text-center py-4">Belum ada karir</p>
                    @endforelse
                </div>

                <!-- Add Career Form -->
                <form action="{{ route('admin.program-keahlian.careers.store', $program_keahlian) }}" method="POST" class="border-t border-slate-600 pt-4">
                    @csrf
                    <div class="space-y-3">
                        <input type="text" name="name" placeholder="Nama Karir" required
                               class="w-full px-3 py-2 rounded-lg bg-slate-700 border border-slate-600 text-white text-sm">
                        <textarea name="description" placeholder="Deskripsi" rows="2" required
                                  class="w-full px-3 py-2 rounded-lg bg-slate-700 border border-slate-600 text-white text-sm"></textarea>
                        <div class="grid grid-cols-3 gap-2">
                            <input type="text" name="icon" placeholder="Icon" value="💼"
                                   class="px-3 py-2 rounded-lg bg-slate-700 border border-slate-600 text-white text-sm">
                            <select name="gradient_from" class="px-2 py-2 rounded-lg bg-slate-700 border border-slate-600 text-white text-sm">
                                @foreach($gradientColors as $color)
                                    <option value="{{ $color }}">{{ $color }}</option>
                                @endforeach
                            </select>
                            <select name="gradient_to" class="px-2 py-2 rounded-lg bg-slate-700 border border-slate-600 text-white text-sm">
                                @foreach($gradientColors as $color)
                                    <option value="{{ $color }}" {{ $color == 'purple-600' ? 'selected' : '' }}>{{ $color }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="w-full py-2 rounded-lg bg-purple-600 text-white text-sm font-medium hover:bg-purple-700">
                            + Tambah Karir
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@php
use Illuminate\Support\Facades\Storage;
@endphp
@endsection
