@extends('admin.layouts.app')

@section('title', 'Kelola Alumni')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white">Alumni</h1>
            <p class="text-slate-400 mt-1">Kelola data alumni SMK Metland</p>
        </div>
        <a href="{{ route('admin.alumni.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Alumni
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-slate-800/50 rounded-xl p-4 border border-slate-700">
        <form method="GET" class="flex flex-wrap gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari alumni..."
                class="flex-1 min-w-[200px] px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500">
            
            <select name="year"
                class="px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Tahun</option>
                @foreach($years as $year)
                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>

            <select name="program"
                class="px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Jurusan</option>
                <option value="perhotelan" {{ request('program') === 'perhotelan' ? 'selected' : '' }}>Perhotelan</option>
                <option value="dkv" {{ request('program') === 'dkv' ? 'selected' : '' }}>DKV</option>
                <option value="pplg" {{ request('program') === 'pplg' ? 'selected' : '' }}>PPLG</option>
                <option value="kuliner" {{ request('program') === 'kuliner' ? 'selected' : '' }}>Tata Boga</option>
                <option value="akuntansi" {{ request('program') === 'akuntansi' ? 'selected' : '' }}>Akuntansi</option>
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
    @if($alumni->count() > 0)
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($alumni as $person)
        <div class="bg-slate-800/50 rounded-xl border border-slate-700 overflow-hidden hover:border-blue-500/50 transition-all group">
            <!-- Photo -->
            <div class="h-48 relative overflow-hidden">
                <img src="{{ $person->photo_url }}" alt="{{ $person->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                
                <!-- Status Badge -->
                <div class="absolute top-3 right-3">
                    <span class="inline-block px-2 py-1 rounded-full text-xs font-bold {{ $person->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                        {{ $person->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>

                <!-- Featured Badge -->
                @if($person->is_featured)
                <div class="absolute top-3 left-3">
                    <span class="inline-block px-2 py-1 rounded-full text-xs font-bold bg-yellow-500/20 text-yellow-400">
                        ⭐ Featured
                    </span>
                </div>
                @endif

                <!-- Year Badge -->
                <div class="absolute bottom-3 right-3">
                    <span class="inline-block px-2 py-1 rounded-lg text-xs font-bold bg-black/50 text-white backdrop-blur-sm">
                        {{ $person->graduation_year }}
                    </span>
                </div>
            </div>

            <!-- Content -->
            <div class="p-4">
                <span class="inline-block px-2 py-0.5 {{ $person->program_color }} text-white text-xs font-medium rounded-full mb-2">
                    {{ $person->program_label }}
                </span>
                <h3 class="text-lg font-bold text-white mb-1">{{ $person->name }}</h3>
                @if($person->current_position)
                <p class="text-sm text-blue-400 font-medium mb-1">{{ $person->current_position }}</p>
                @endif
                @if($person->company_or_university)
                <p class="text-sm text-slate-400">{{ $person->company_or_university }}</p>
                @endif
            </div>

            <!-- Actions -->
            <div class="px-4 pb-4 flex gap-2">
                <a href="{{ route('admin.alumni.edit', $person) }}"
                    class="flex-1 text-center px-3 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg text-sm font-medium transition-colors">
                    Edit
                </a>
                <form action="{{ route('admin.alumni.toggle-active', $person) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="px-3 py-2 {{ $person->is_active ? 'bg-amber-600 hover:bg-amber-700' : 'bg-green-600 hover:bg-green-700' }} text-white rounded-lg text-sm font-medium transition-colors">
                        {{ $person->is_active ? 'Off' : 'On' }}
                    </button>
                </form>
                <form action="{{ route('admin.alumni.destroy', $person) }}" method="POST" onsubmit="return confirm('Hapus alumni ini?')">
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
        {{ $alumni->links() }}
    </div>
    @else
    <div class="bg-slate-800/50 rounded-xl border border-slate-700 p-12 text-center">
        <svg class="w-16 h-16 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13-5.803a4 4 0 11-8 0 4 4 0 018 0z"></path>
        </svg>
        <h3 class="text-lg font-bold text-white mb-2">Belum Ada Alumni</h3>
        <p class="text-slate-400 mb-6">Tambahkan data alumni pertama</p>
        <a href="{{ route('admin.alumni.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Alumni
        </a>
    </div>
    @endif
</div>
@endsection
