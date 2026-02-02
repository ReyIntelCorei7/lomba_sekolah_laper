@extends('admin.layouts.app')

@section('title', 'Kelola Berita')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Kelola Berita</h1>
        <a href="{{ route('admin.news.create') }}"
           class="px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark transition">
            <i class="fas fa-plus mr-2"></i>Tambah Berita
        </a>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($news as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($item->image)
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full object-cover" 
                                         src="{{ asset('storage/' . $item->image) }}" 
                                         alt="{{ $item->title }}">
                                </div>
                                @endif
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ Str::limit($item->title, 50) }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $item->author }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $categoryLabels = [
                                    'academic' => 'Akademik',
                                    'activity' => 'Kegiatan',
                                    'extracurricular' => 'Ekstrakurikuler',
                                    'arts' => 'Seni & Budaya',
                                    'alumni' => 'Alumni',
                                    'workshop' => 'Workshop',
                                    'achievement' => 'Prestasi',
                                    'scout' => 'Kepramukaan'
                                ];
                            @endphp
                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                {{ $item->category == 'academic' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $item->category == 'activity' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $item->category == 'extracurricular' ? 'bg-purple-100 text-purple-800' : '' }}
                                {{ $item->category == 'arts' ? 'bg-pink-100 text-pink-800' : '' }}">
                                {{ $categoryLabels[$item->category] ?? $item->category }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                {{ $item->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $item->is_published ? 'Published' : 'Draft' }}
                            </span>
                            @if($item->is_featured)
                            <span class="ml-2 px-3 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded-full">
                                Featured
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->published_at?->format('d/m/Y') ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-3">
                                <a href="{{ route('news.show', $item->slug) }}" target="_blank"
                                   class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.news.edit', $item) }}"
                                   class="text-primary hover:text-primary-dark">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.news.destroy', $item) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.news.toggle-publish', $item) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-gray-600 hover:text-gray-900">
                                        <i class="fas {{ $item->is_published ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t">
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection