@extends('admin.layouts.app')

@section('title', 'Edit Ekstrakurikuler')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.extracurriculars.index') }}" class="p-2 bg-slate-800 hover:bg-slate-700 rounded-lg transition-colors">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white">Edit Ekstrakurikuler</h1>
            <p class="text-sm text-slate-400">{{ $extracurricular->name }}</p>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.extracurriculars.update', $extracurricular) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-slate-800/50 rounded-xl border border-slate-700 p-6 space-y-6">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-slate-300 mb-2">Nama Ekstrakurikuler <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $extracurricular->name) }}" required
                    class="w-full px-4 py-3 bg-slate-900 border border-slate-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('name')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category & Schedule -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="category" class="block text-sm font-medium text-slate-300 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select name="category" id="category" required
                        class="w-full px-4 py-3 bg-slate-900 border border-slate-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="olahraga" {{ old('category', $extracurricular->category) === 'olahraga' ? 'selected' : '' }}>⚽ Olahraga</option>
                        <option value="seni" {{ old('category', $extracurricular->category) === 'seni' ? 'selected' : '' }}>🎨 Seni & Budaya</option>
                        <option value="akademik" {{ old('category', $extracurricular->category) === 'akademik' ? 'selected' : '' }}>📚 Akademik</option>
                        <option value="teknologi" {{ old('category', $extracurricular->category) === 'teknologi' ? 'selected' : '' }}>💻 Teknologi</option>
                        <option value="keagamaan" {{ old('category', $extracurricular->category) === 'keagamaan' ? 'selected' : '' }}>🕌 Keagamaan</option>
                        <option value="other" {{ old('category', $extracurricular->category) === 'other' ? 'selected' : '' }}>🎯 Lainnya</option>
                    </select>
                </div>
                <div>
                    <label for="schedule" class="block text-sm font-medium text-slate-300 mb-2">Jadwal Latihan</label>
                    <input type="text" name="schedule" id="schedule" value="{{ old('schedule', $extracurricular->schedule) }}"
                        class="w-full px-4 py-3 bg-slate-900 border border-slate-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            <!-- Coach & Order -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="coach" class="block text-sm font-medium text-slate-300 mb-2">Pembina</label>
                    <input type="text" name="coach" id="coach" value="{{ old('coach', $extracurricular->coach) }}"
                        class="w-full px-4 py-3 bg-slate-900 border border-slate-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label for="order" class="block text-sm font-medium text-slate-300 mb-2">Urutan Tampil</label>
                    <input type="number" name="order" id="order" value="{{ old('order', $extracurricular->order) }}" min="0"
                        class="w-full px-4 py-3 bg-slate-900 border border-slate-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-slate-300 mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-4 py-3 bg-slate-900 border border-slate-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('description', $extracurricular->description) }}</textarea>
            </div>

            <!-- Achievements -->
            <div>
                <label for="achievements" class="block text-sm font-medium text-slate-300 mb-2">Prestasi</label>
                <textarea name="achievements" id="achievements" rows="3"
                    class="w-full px-4 py-3 bg-slate-900 border border-slate-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('achievements', $extracurricular->achievements) }}</textarea>
            </div>

            <!-- Current & New Image -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Gambar</label>
                <div x-data="{ preview: null }" class="space-y-3">
                    @if($extracurricular->image)
                    <div class="flex items-center gap-4 p-4 bg-slate-900 rounded-lg">
                        <img src="{{ img_url($extracurricular->image, 'extracurriculars', $extracurricular->id, 'image') }}" alt="{{ $extracurricular->name }}" class="w-20 h-20 object-cover rounded-lg">
                        <div>
                            <p class="text-sm text-slate-300">Gambar saat ini</p>
                            <p class="text-xs text-slate-500">Upload gambar baru untuk mengganti</p>
                        </div>
                    </div>
                    @endif
                    <div class="relative border-2 border-dashed border-slate-600 rounded-xl p-8 text-center hover:border-blue-500 transition-colors">
                        <input type="file" name="image" id="image" accept="image/*"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                            @change="preview = URL.createObjectURL($event.target.files[0])">
                        <div x-show="!preview" class="space-y-2">
                            <svg class="w-12 h-12 mx-auto text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-slate-400">Klik atau drag gambar baru</p>
                        </div>
                        <img x-show="preview" :src="preview" class="max-h-48 mx-auto rounded-lg">
                    </div>
                </div>
            </div>

            <!-- Active Status -->
            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $extracurricular->is_active) ? 'checked' : '' }}
                    class="w-5 h-5 rounded border-slate-600 bg-slate-900 text-blue-600 focus:ring-blue-500">
                <label for="is_active" class="text-sm text-slate-300">Aktifkan ekstrakurikuler ini</label>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center gap-4">
            <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-lg shadow-blue-600/20 transition-all">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.extracurriculars.index') }}" class="px-6 py-3 bg-slate-700 hover:bg-slate-600 text-white font-medium rounded-lg transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
