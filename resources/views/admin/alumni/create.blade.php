@extends('admin.layouts.app')

@section('title', 'Tambah Alumni')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.alumni.index') }}" class="p-2 hover:bg-slate-700 rounded-lg transition-colors">
            <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white">Tambah Alumni</h1>
            <p class="text-slate-400 mt-1">Tambahkan data alumni baru</p>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.alumni.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-slate-800/50 rounded-xl p-6 border border-slate-700 space-y-6">
            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Nama Lengkap *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500"
                    placeholder="Contoh: Ahmad Rizki">
                @error('name')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Graduation Year -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Tahun Kelulusan *</label>
                    <select name="graduation_year" required
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Tahun</option>
                        @for($year = date('Y'); $year >= 2014; $year--)
                        <option value="{{ $year }}" {{ old('graduation_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endfor
                    </select>
                    @error('graduation_year')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Program -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Jurusan *</label>
                    <select name="program" required
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Jurusan</option>
                        <option value="perhotelan" {{ old('program') === 'perhotelan' ? 'selected' : '' }}>Perhotelan</option>
                        <option value="dkv" {{ old('program') === 'dkv' ? 'selected' : '' }}>Desain Komunikasi Visual</option>
                        <option value="pplg" {{ old('program') === 'pplg' ? 'selected' : '' }}>PPLG</option>
                        <option value="kuliner" {{ old('program') === 'kuliner' ? 'selected' : '' }}>Tata Boga</option>
                        <option value="akuntansi" {{ old('program') === 'akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                    </select>
                    @error('program')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Photo -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Foto</label>
                <input type="file" name="photo" accept="image/*"
                    class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:bg-blue-600 file:text-white hover:file:bg-blue-700">
                <p class="text-slate-400 text-sm mt-1">Format: JPEG, PNG, JPG, WebP. Maksimal 2MB.</p>
                @error('photo')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Current Position -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Posisi Sekarang</label>
                    <input type="text" name="current_position" value="{{ old('current_position') }}"
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: Front Desk Officer">
                    @error('current_position')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Company/University -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Perusahaan / Universitas</label>
                    <input type="text" name="company_or_university" value="{{ old('company_or_university') }}"
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: Hotel Indonesia Kempinski">
                    @error('company_or_university')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Testimonial -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Testimonial</label>
                <textarea name="testimonial" rows="4"
                    class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500"
                    placeholder="Ceritakan pengalaman selama di SMK Metland...">{{ old('testimonial') }}</textarea>
                @error('testimonial')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <!-- Order -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Urutan</label>
                    <input type="number" name="order" value="{{ old('order', 0) }}"
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Featured -->
                <div class="flex items-center gap-3 pt-8">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                        class="w-5 h-5 bg-slate-700 border-slate-600 rounded text-blue-600 focus:ring-blue-500">
                    <label class="text-slate-300">Featured Alumni</label>
                </div>

                <!-- Active -->
                <div class="flex items-center gap-3 pt-8">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                        class="w-5 h-5 bg-slate-700 border-slate-600 rounded text-blue-600 focus:ring-blue-500">
                    <label class="text-slate-300">Aktif</label>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.alumni.index') }}" class="px-6 py-3 bg-slate-700 hover:bg-slate-600 text-white rounded-lg font-medium transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                Simpan Alumni
            </button>
        </div>
    </form>
</div>
@endsection
