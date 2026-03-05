@extends('admin.layouts.app')

@section('title', 'Audit Logs')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-white">Audit Logs</h2>
            <p class="text-slate-400 mt-1">Riwayat semua perubahan data di sistem</p>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-slate-800/50 border border-slate-700 rounded-2xl p-6">
        <form method="GET" action="{{ route('admin.audit-logs.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">Cari</label>
                <input type="text" name="search" value="{{ request('search') }}"
                       class="w-full bg-slate-900 border border-slate-600 rounded-lg px-3 py-2 text-white text-sm focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Cari deskripsi...">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">Aksi</label>
                <select name="action" class="w-full bg-slate-900 border border-slate-600 rounded-lg px-3 py-2 text-white text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Aksi</option>
                    @foreach($actions as $action)
                        <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>{{ ucfirst($action) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-400 mb-1">Admin</label>
                <select name="admin_id" class="w-full bg-slate-900 border border-slate-600 rounded-lg px-3 py-2 text-white text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Admin</option>
                    @foreach($admins as $admin)
                        <option value="{{ $admin->id }}" {{ request('admin_id') == $admin->id ? 'selected' : '' }}>{{ $admin->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                    Filter
                </button>
            </div>
        </form>
    </div>

    {{-- Logs Table --}}
    <div class="bg-slate-800/50 border border-slate-700 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-700">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Waktu</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Admin</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Aksi</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">IP</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Perubahan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50">
                    @forelse($logs as $log)
                        <tr class="hover:bg-slate-700/20 transition-colors">
                            <td class="px-6 py-4 text-sm text-slate-300 whitespace-nowrap">
                                {{ $log->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-white whitespace-nowrap">
                                {{ $log->admin?->name ?? 'System' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $actionColors = [
                                        'created' => 'bg-green-500/10 text-green-400 border-green-500/20',
                                        'updated' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                        'deleted' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                        'login' => 'bg-purple-500/10 text-purple-400 border-purple-500/20',
                                        'logout' => 'bg-slate-500/10 text-slate-400 border-slate-500/20',
                                        '2fa_enabled' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                        '2fa_disabled' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                        '2fa_verified' => 'bg-green-500/10 text-green-400 border-green-500/20',
                                    ];
                                    $colorClass = $actionColors[$log->action] ?? 'bg-slate-500/10 text-slate-400 border-slate-500/20';
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $colorClass }}">
                                    {{ ucfirst($log->action) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-300 max-w-xs truncate">
                                {{ $log->description ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-400 whitespace-nowrap font-mono">
                                {{ $log->ip_address ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm" x-data="{ open: false }">
                                @if($log->old_values || $log->new_values)
                                    <button @click="open = !open" class="text-blue-400 hover:text-blue-300 text-xs font-medium">
                                        <span x-show="!open">Lihat Detail</span>
                                        <span x-show="open">Tutup</span>
                                    </button>
                                    <div x-show="open" x-cloak class="mt-2 space-y-2">
                                        @if($log->old_values)
                                            <div>
                                                <span class="text-xs text-red-400 font-medium">Sebelum:</span>
                                                <pre class="text-xs text-slate-400 bg-slate-900 rounded p-2 mt-1 overflow-x-auto">{{ json_encode($log->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                            </div>
                                        @endif
                                        @if($log->new_values)
                                            <div>
                                                <span class="text-xs text-green-400 font-medium">Sesudah:</span>
                                                <pre class="text-xs text-slate-400 bg-slate-900 rounded p-2 mt-1 overflow-x-auto">{{ json_encode($log->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-slate-500 text-xs">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                <svg class="w-12 h-12 mx-auto mb-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-lg font-medium">Belum ada log</p>
                                <p class="text-sm">Log aktivitas akan muncul di sini</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($logs->hasPages())
            <div class="px-6 py-4 border-t border-slate-700">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
