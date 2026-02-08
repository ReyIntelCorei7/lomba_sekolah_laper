@extends('admin.layouts.app')

@section('title', 'Edit Alumni')

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
            <h1 class="text-2xl font-bold text-white">Edit Alumni</h1>
            <p class="text-slate-400 mt-1">{{ $alumni->name }}</p>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.alumni.update', $alumni) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-slate-800/50 rounded-xl p-6 border border-slate-700 space-y-6">
            <!-- Current Photo -->
            @if($alumni->photo)
            <div class="flex items-center gap-4">
                <img src="{{ $alumni->photo_url }}" alt="{{ $alumni->name }}" class="w-24 h-24 rounded-xl object-cover">
                <div>
                    <p class="text-slate-300 font-medium">Foto saat ini</p>
                    <p class="text-slate-400 text-sm">Upload foto baru untuk mengganti</p>
                </div>
            </div>
            @endif

            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Nama Lengkap *</label>
                <input type="text" name="name" value="{{ old('name', $alumni->name) }}" required
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
                        <option value="{{ $year }}" {{ old('graduation_year', $alumni->graduation_year) == $year ? 'selected' : '' }}>{{ $year }}</option>
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
                        <option value="perhotelan" {{ old('program', $alumni->program) === 'perhotelan' ? 'selected' : '' }}>Perhotelan</option>
                        <option value="dkv" {{ old('program', $alumni->program) === 'dkv' ? 'selected' : '' }}>Desain Komunikasi Visual</option>
                        <option value="pplg" {{ old('program', $alumni->program) === 'pplg' ? 'selected' : '' }}>PPLG</option>
                        <option value="kuliner" {{ old('program', $alumni->program) === 'kuliner' ? 'selected' : '' }}>Tata Boga</option>
                        <option value="akuntansi" {{ old('program', $alumni->program) === 'akuntansi' ? 'selected' : '' }}>Akuntansi</option>
                    </select>
                    @error('program')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Photo -->
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Foto Baru</label>
                <input type="file" name="photo" accept="image/*"
                    class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:bg-blue-600 file:text-white hover:file:bg-blue-700">
                <p class="text-slate-400 text-sm mt-1">Format: JPEG, PNG, JPG, WebP. Maksimal 2MB.</p>
                @error('photo')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Current Position -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Posisi Sekarang</label>
                    <input type="text" name="current_position" value="{{ old('current_position', $alumni->current_position) }}"
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: Front Desk Officer">
                    @error('current_position')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Company/University -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Perusahaan / Universitas</label>
                    <input type="text" name="company_or_university" value="{{ old('company_or_university', $alumni->company_or_university) }}"
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
                    placeholder="Ceritakan pengalaman selama di SMK Metland...">{{ old('testimonial', $alumni->testimonial) }}</textarea>
                @error('testimonial')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <!-- Order -->
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Urutan</label>
                    <input type="number" name="order" value="{{ old('order', $alumni->order) }}"
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Featured -->
                <div class="flex items-center gap-3 pt-8">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $alumni->is_featured) ? 'checked' : '' }}
                        class="w-5 h-5 bg-slate-700 border-slate-600 rounded text-blue-600 focus:ring-blue-500">
                    <label class="text-slate-300">Featured Alumni</label>
                </div>

                <!-- Active -->
                <div class="flex items-center gap-3 pt-8">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $alumni->is_active) ? 'checked' : '' }}
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
                Update Alumni
            </button>
        </div>
    </form>
</div>
@endsection
