@extends('admin.layouts.app')

@section('title', 'Program Keahlian')
@section('page-title', 'Kelola Program Keahlian')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-white">Daftar Program Keahlian</h2>
            <p class="text-slate-400 mt-1">Kelola jurusan dan program keahlian sekolah</p>
        </div>
        <a href="{{ route('admin.program-keahlian.create') }}" 
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Program
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-500/20 border border-green-500/50 rounded-xl p-4 text-green-300">
        {{ session('success') }}
    </div>
    @endif

    <!-- Programs Table -->
    <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl border border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-700/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Program</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-slate-300 uppercase tracking-wider">Skills</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-slate-300 uppercase tracking-wider">Careers</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-slate-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-slate-300 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50">
                    @forelse($programs as $program)
                    <tr class="hover:bg-slate-700/30 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl
                                    @switch($program->color_theme)
                                        @case('indigo') bg-indigo-500/20 @break
                                        @case('purple') bg-purple-500/20 @break
                                        @case('emerald') bg-emerald-500/20 @break
                                        @case('orange') bg-orange-500/20 @break
                                        @case('cyan') bg-cyan-500/20 @break
                                        @default bg-blue-500/20
                                    @endswitch">
                                    {{ $program->icon ?? '📚' }}
                                </div>
                                <div>
                                    <div class="font-semibold text-white">{{ $program->name }}</div>
                                    <div class="text-sm text-slate-400">{{ $program->short_name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <code class="text-sm bg-slate-700 px-2 py-1 rounded text-blue-400">/prokeh/{{ $program->slug }}</code>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-500/20 text-blue-400 font-semibold">
                                {{ $program->skills_count }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-purple-500/20 text-purple-400 font-semibold">
                                {{ $program->careers_count }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($program->is_active)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-500/20 text-green-400 text-xs font-medium">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-500/20 text-slate-400 text-xs font-medium">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.program-keahlian.edit', $program) }}" 
                                   class="p-2 rounded-lg bg-blue-500/20 text-blue-400 hover:bg-blue-500/30 transition-colors"
                                   title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('prokeh.show', $program->slug) }}" target="_blank"
                                   class="p-2 rounded-lg bg-green-500/20 text-green-400 hover:bg-green-500/30 transition-colors"
                                   title="Lihat">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.program-keahlian.destroy', $program) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Hapus program {{ $program->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="p-2 rounded-lg bg-red-500/20 text-red-400 hover:bg-red-500/30 transition-colors"
                                            title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 rounded-2xl bg-slate-700/50 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <p class="text-slate-400">Belum ada program keahlian</p>
                                <a href="{{ route('admin.program-keahlian.create') }}" class="text-blue-400 hover:text-blue-300">
                                    Tambah program pertama →
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($programs->hasPages())
        <div class="px-6 py-4 border-t border-slate-700/50">
            {{ $programs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
