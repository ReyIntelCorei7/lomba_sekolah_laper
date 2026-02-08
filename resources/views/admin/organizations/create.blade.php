@extends('admin.layouts.app')

@section('title', 'Tambah Organisasi')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.organizations.index') }}" class="p-2 bg-slate-700 hover:bg-slate-600 rounded-lg text-white transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white">Tambah Organisasi</h1>
            <p class="text-slate-400 mt-1">Tambah organisasi baru</p>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.organizations.store') }}" method="POST" enctype="multipart/form-data" class="bg-slate-800/50 rounded-xl border border-slate-700 p-6 space-y-6">
        @csrf

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Nama Organisasi *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-2.5 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="OSIS SMK Metland">
                @error('name')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Abbreviation -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Singkatan</label>
                <input type="text" name="abbreviation" value="{{ old('abbreviation') }}"
                    class="w-full px-4 py-2.5 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="OSIS">
                @error('abbreviation')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Kategori *</label>
                <select name="category" required
                    class="w-full px-4 py-2.5 bg-slate-700 border border-slate-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Pilih Kategori</option>
                    <option value="osis" {{ old('category') === 'osis' ? 'selected' : '' }}>🏛️ OSIS</option>
                    <option value="mpk" {{ old('category') === 'mpk' ? 'selected' : '' }}>⚖️ MPK</option>
                    <option value="pramuka" {{ old('category') === 'pramuka' ? 'selected' : '' }}>⚜️ Pramuka</option>
                    <option value="pmr" {{ old('category') === 'pmr' ? 'selected' : '' }}>🏥 PMR</option>
                    <option value="paskibra" {{ old('category') === 'paskibra' ? 'selected' : '' }}>🎖️ Paskibra</option>
                    <option value="rohis" {{ old('category') === 'rohis' ? 'selected' : '' }}>🕌 Rohis</option>
                    <option value="other" {{ old('category') === 'other' ? 'selected' : '' }}>🎯 Lainnya</option>
                </select>
                @error('category')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Advisor -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Pembina</label>
                <input type="text" name="advisor" value="{{ old('advisor') }}"
                    class="w-full px-4 py-2.5 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Nama pembina organisasi">
                @error('advisor')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Logo Upload -->
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">Logo Organisasi</label>
            <div x-data="{ logoPreview: null }" class="flex items-center gap-4">
                <div class="w-20 h-20 bg-slate-700 border-2 border-dashed border-slate-600 rounded-xl flex items-center justify-center overflow-hidden">
                    <template x-if="logoPreview">
                        <img :src="logoPreview" class="w-full h-full object-contain p-2">
                    </template>
                    <template x-if="!logoPreview">
                        <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </template>
                </div>
                <div class="flex-1">
                    <input type="file" name="logo" accept="image/*" @change="logoPreview = URL.createObjectURL($event.target.files[0])"
                        class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                    <p class="text-slate-500 text-xs mt-1">Logo akan muncul di pojok kiri card. Max 1MB. Format: PNG, JPG, SVG</p>
                </div>
            </div>
            @error('logo')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Cover Image Upload -->
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">Gambar Cover</label>
            <div x-data="{ imagePreview: null }" class="border-2 border-dashed border-slate-600 rounded-xl p-6 text-center hover:border-blue-500 transition-colors">
                <template x-if="imagePreview">
                    <img :src="imagePreview" class="w-full h-48 object-cover rounded-lg mb-4">
                </template>
                <template x-if="!imagePreview">
                    <div class="h-48 flex items-center justify-center">
                        <svg class="w-16 h-16 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </template>
                <input type="file" name="image" accept="image/*" @change="imagePreview = URL.createObjectURL($event.target.files[0])"
                    class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                <p class="text-slate-500 text-xs mt-2">Gambar kegiatan organisasi. Max 2MB</p>
            </div>
            @error('image')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">Deskripsi</label>
            <textarea name="description" rows="4"
                class="w-full px-4 py-2.5 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                placeholder="Deskripsi tentang organisasi...">{{ old('description') }}</textarea>
            @error('description')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Vision -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Visi</label>
                <textarea name="vision" rows="3"
                    class="w-full px-4 py-2.5 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                    placeholder="Visi organisasi...">{{ old('vision') }}</textarea>
                @error('vision')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mission -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Misi</label>
                <textarea name="mission" rows="3"
                    class="w-full px-4 py-2.5 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                    placeholder="Misi organisasi (pisahkan dengan enter)...">{{ old('mission') }}</textarea>
                @error('mission')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Achievements -->
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">Prestasi</label>
            <textarea name="achievements" rows="3"
                class="w-full px-4 py-2.5 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                placeholder="Prestasi organisasi (pisahkan dengan enter)...">{{ old('achievements') }}</textarea>
            @error('achievements')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Order -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Urutan</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" min="0"
                    class="w-full px-4 py-2.5 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('order')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Status</label>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        class="w-5 h-5 rounded bg-slate-700 border-slate-600 text-blue-600 focus:ring-blue-500">
                    <span class="text-white">Aktif</span>
                </label>
            </div>
        </div>

        <!-- Submit -->
        <div class="flex gap-4 pt-4 border-t border-slate-700">
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                Simpan Organisasi
            </button>
            <a href="{{ route('admin.organizations.index') }}"
                class="px-6 py-2.5 bg-slate-700 hover:bg-slate-600 text-white rounded-lg font-medium transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
