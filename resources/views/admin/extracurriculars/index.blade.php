@extends('admin.layouts.app')

@section('title', 'Ekstrakurikuler')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white">Ekstrakurikuler</h1>
            <p class="mt-1 text-sm text-slate-400">Kelola semua kegiatan ekstrakurikuler sekolah</p>
        </div>
        <a href="{{ route('admin.extracurriculars.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-lg shadow-blue-600/20 transition-all">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Eskul
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-slate-800/50 rounded-xl border border-slate-700 p-4">
        <form method="GET" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Cari eskul..."
                    class="w-full px-4 py-2 bg-slate-900 border border-slate-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <select name="category" class="px-4 py-2 bg-slate-900 border border-slate-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Kategori</option>
                <option value="olahraga" {{ request('category') === 'olahraga' ? 'selected' : '' }}>⚽ Olahraga</option>
                <option value="seni" {{ request('category') === 'seni' ? 'selected' : '' }}>🎨 Seni & Budaya</option>
                <option value="akademik" {{ request('category') === 'akademik' ? 'selected' : '' }}>📚 Akademik</option>
                <option value="teknologi" {{ request('category') === 'teknologi' ? 'selected' : '' }}>💻 Teknologi</option>
                <option value="keagamaan" {{ request('category') === 'keagamaan' ? 'selected' : '' }}>🕌 Keagamaan</option>
                <option value="other" {{ request('category') === 'other' ? 'selected' : '' }}>🎯 Lainnya</option>
            </select>
            <select name="status" class="px-4 py-2 bg-slate-900 border border-slate-600 text-white rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg transition-colors">
                Filter
            </button>
            @if(request()->hasAny(['search', 'category', 'status']))
            <a href="{{ route('admin.extracurriculars.index') }}" class="px-4 py-2 text-slate-400 hover:text-white transition-colors">
                Reset
            </a>
            @endif
        </form>
    </div>

    <!-- Grid -->
    @if($extracurriculars->count() > 0)
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($extracurriculars as $eskul)
        <div class="bg-slate-800/50 rounded-xl border border-slate-700 overflow-hidden hover:border-blue-500/50 transition-all group">
            <!-- Image -->
            <div class="relative h-40 overflow-hidden">
                @if($eskul->image)
                <img src="{{ display_image($eskul->image) }}" alt="{{ $eskul->name }}" 
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                @else
                <div class="w-full h-full bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center">
                    <svg class="w-16 h-16 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                @endif
                
                <!-- Status Badge -->
                <div class="absolute top-3 left-3">
                    <span class="px-2 py-1 text-xs font-bold rounded-full {{ $eskul->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                        {{ $eskul->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
                
                <!-- Category Badge -->
                <div class="absolute top-3 right-3">
                    <span class="px-2 py-1 text-xs font-bold rounded-full {{ $eskul->category_color }} text-white">
                        {{ ucfirst($eskul->category) }}
                    </span>
                </div>
            </div>

            <!-- Content -->
            <div class="p-4">
                <h3 class="text-lg font-bold text-white mb-2 line-clamp-1">{{ $eskul->name }}</h3>
                
                @if($eskul->coach)
                <p class="text-sm text-slate-400 mb-2 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    {{ $eskul->coach }}
                </p>
                @endif

                @if($eskul->schedule)
                <p class="text-sm text-slate-400 mb-3 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $eskul->schedule }}
                </p>
                @endif

                <!-- Actions -->
                <div class="flex items-center gap-2 pt-3 border-t border-slate-700">
                    <a href="{{ route('admin.extracurriculars.edit', $eskul) }}" 
                        class="flex-1 px-3 py-2 text-center text-sm bg-slate-700 hover:bg-slate-600 text-white rounded-lg transition-colors">
                        Edit
                    </a>
                    <form action="{{ route('admin.extracurriculars.toggle-active', $eskul) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="px-3 py-2 text-sm {{ $eskul->is_active ? 'bg-amber-600 hover:bg-amber-700' : 'bg-green-600 hover:bg-green-700' }} text-white rounded-lg transition-colors" title="{{ $eskul->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                            @if($eskul->is_active)
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                            </svg>
                            @else
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            @endif
                        </button>
                    </form>
                    <form action="{{ route('admin.extracurriculars.destroy', $eskul) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus eskul ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-2 text-sm bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors" title="Hapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $extracurriculars->withQueryString()->links() }}
    </div>
    @else
    <div class="bg-slate-800/50 rounded-xl border border-slate-700 p-12 text-center">
        <svg class="w-16 h-16 mx-auto text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
        </svg>
        <h3 class="text-lg font-bold text-white mb-2">Belum Ada Ekstrakurikuler</h3>
        <p class="text-slate-400 mb-6">Mulai tambahkan kegiatan ekstrakurikuler pertama</p>
        <a href="{{ route('admin.extracurriculars.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Eskul
        </a>
    </div>
    @endif
</div>
@endsection
