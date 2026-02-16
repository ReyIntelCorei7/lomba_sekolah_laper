@extends('admin.layouts.app')

@section('title', 'Kelola Organisasi')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white">Organisasi</h1>
            <p class="text-slate-400 mt-1">Kelola organisasi siswa</p>
        </div>
        <a href="{{ route('admin.organizations.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Organisasi
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-slate-800/50 rounded-xl p-4 border border-slate-700">
        <form method="GET" class="flex flex-wrap gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari organisasi..."
                class="flex-1 min-w-[200px] px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500">
            
            <select name="category"
                class="px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Kategori</option>
                <option value="osis" {{ request('category') === 'osis' ? 'selected' : '' }}>OSIS</option>
                <option value="mpk" {{ request('category') === 'mpk' ? 'selected' : '' }}>MPK</option>
                <option value="pramuka" {{ request('category') === 'pramuka' ? 'selected' : '' }}>Pramuka</option>
                <option value="pmr" {{ request('category') === 'pmr' ? 'selected' : '' }}>PMR</option>
                <option value="paskibra" {{ request('category') === 'paskibra' ? 'selected' : '' }}>Paskibra</option>
                <option value="rohis" {{ request('category') === 'rohis' ? 'selected' : '' }}>Rohis</option>
                <option value="other" {{ request('category') === 'other' ? 'selected' : '' }}>Lainnya</option>
            </select>

            <select name="status"
                class="px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
            </select>

            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                Filter
            </button>
        </form>
    </div>

    <!-- Grid -->
    @if($organizations->count() > 0)
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($organizations as $org)
        <div class="bg-slate-800/50 rounded-xl border border-slate-700 overflow-hidden hover:border-blue-500/50 transition-all group">
            <!-- Image -->
            <div class="h-40 relative overflow-hidden">
                @if($org->image)
                <img src="{{ img_url($org->image, 'organizations', $org->id, 'image') }}" alt="{{ $org->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                @else
                <div class="w-full h-full bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center">
                    <span class="text-4xl">{{ substr($org->category_label, 0, 2) }}</span>
                </div>
                @endif
                
                <!-- Logo Badge (Top Left) -->
                @if($org->logo)
                <div class="absolute top-3 left-3 w-12 h-12 bg-white rounded-xl shadow-lg p-1.5">
                    <img src="{{ img_url($org->logo, 'organizations', $org->id, 'logo') }}" alt="{{ $org->abbreviation ?? $org->name }}" class="w-full h-full object-contain">
                </div>
                @endif

                <!-- Status Badge -->
                <div class="absolute top-3 right-3">
                    <span class="inline-block px-2 py-1 rounded-full text-xs font-bold {{ $org->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                        {{ $org->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
            </div>

            <!-- Content -->
            <div class="p-4">
                <span class="inline-block px-2 py-0.5 {{ $org->category_color }} text-white text-xs font-medium rounded-full mb-2">
                    {{ $org->category_label }}
                </span>
                <h3 class="text-lg font-bold text-white mb-1">{{ $org->name }}</h3>
                @if($org->abbreviation)
                <p class="text-sm text-blue-400 font-medium mb-2">{{ $org->abbreviation }}</p>
                @endif
                @if($org->advisor)
                <p class="text-sm text-slate-400">Pembina: {{ $org->advisor }}</p>
                @endif
            </div>

            <!-- Actions -->
            <div class="px-4 pb-4 flex gap-2">
                <a href="{{ route('admin.organizations.edit', $org) }}"
                    class="flex-1 text-center px-3 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg text-sm font-medium transition-colors">
                    Edit
                </a>
                <form action="{{ route('admin.organizations.toggle-active', $org) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="px-3 py-2 {{ $org->is_active ? 'bg-amber-600 hover:bg-amber-700' : 'bg-green-600 hover:bg-green-700' }} text-white rounded-lg text-sm font-medium transition-colors">
                        {{ $org->is_active ? 'Off' : 'On' }}
                    </button>
                </form>
                <form action="{{ route('admin.organizations.destroy', $org) }}" method="POST" onsubmit="return confirm('Hapus organisasi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $organizations->links() }}
    </div>
    @else
    <div class="bg-slate-800/50 rounded-xl border border-slate-700 p-12 text-center">
        <svg class="w-16 h-16 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
        <h3 class="text-lg font-bold text-white mb-2">Belum Ada Organisasi</h3>
        <p class="text-slate-400 mb-6">Tambahkan organisasi siswa pertama</p>
        <a href="{{ route('admin.organizations.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Organisasi
        </a>
    </div>
    @endif
</div>
@endsection
