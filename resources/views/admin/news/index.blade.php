@extends('admin.layouts.app')

@section('title', 'News Management')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">News Management</h1>
        <a href="{{ route('admin.news.create') }}"
            class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors shadow-lg shadow-blue-600/20">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add News
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-slate-800/50 p-6 rounded-xl border border-gray-200 dark:border-slate-700">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Search</label>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search news..."
                    class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-slate-400 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Category</label>
                <select name="category" onchange="this.form.submit()" class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Categories</option>
                    <option value="academic" {{ request('category') == 'academic' ? 'selected' : '' }}>Academic</option>
                    <option value="activity" {{ request('category') == 'activity' ? 'selected' : '' }}>Activity</option>
                    <option value="extracurricular" {{ request('category') == 'extracurricular' ? 'selected' : '' }}>Extracurricular</option>
                    <option value="arts" {{ request('category') == 'arts' ? 'selected' : '' }}>Arts & Culture</option>
                    <option value="alumni" {{ request('category') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                    <option value="workshop" {{ request('category') == 'workshop' ? 'selected' : '' }}>Workshop</option>
                    <option value="achievement" {{ request('category') == 'achievement' ? 'selected' : '' }}>Achievement</option>
                    <option value="scout" {{ request('category') == 'scout' ? 'selected' : '' }}>Scout</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Status</label>
                <select name="status" onchange="this.form.submit()" class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Status</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>

            <div class="md:col-span-3 flex space-x-3">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Filter
                </button>
                <a href="{{ route('admin.news.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg text-sm font-medium text-gray-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                    Clear
                </a>
            </div>
        </form>
    </div>

    <!-- News List -->
    <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 overflow-hidden">
        <ul class="divide-y divide-gray-200 dark:divide-slate-700">
            @forelse($news ?? [] as $article)
            <li class="hover:bg-gray-50 dark:hover:bg-slate-800/50 transition-colors">
                <div class="px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center min-w-0 flex-1">
                        @if($article->image)
                        <img class="h-16 w-16 rounded-xl object-cover mr-4 border border-gray-200 dark:border-slate-600"
                            src="{{ asset('storage/' . $article->image) }}"
                            alt="{{ $article->title }}">
                        @else
                        <div class="h-16 w-16 rounded-xl bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center mr-4">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"></path>
                            </svg>
                        </div>
                        @endif

                        <div class="min-w-0 flex-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-bold text-gray-900 dark:text-white truncate">
                                    {{ $article->title }}
                                </p>
                                <div class="flex items-center space-x-2 ml-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $article->is_published ? 'bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-400' : 'bg-gray-100 text-gray-800 dark:bg-slate-500/20 dark:text-slate-400' }}">
                                        {{ $article->is_published ? 'Published' : 'Draft' }}
                                    </span>
                                    @if($article->is_featured)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-500/20 dark:text-yellow-400">
                                        Featured
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-1">
                                <p class="text-sm text-gray-600 dark:text-slate-300 truncate">{{ Str::limit($article->excerpt ?? strip_tags($article->content), 100) }}</p>
                            </div>
                            <div class="mt-2 flex items-center text-xs text-gray-400 dark:text-slate-500">
                                <span class="px-2 py-0.5 rounded bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-400 font-medium">{{ ucfirst($article->category) }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $article->author }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $article->created_at->format('M d, Y') }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $article->views }} views</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3 ml-6">
                        <a href="{{ route('admin.news.show', $article) }}"
                            class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium transition-colors">View</a>
                        <a href="{{ route('admin.news.edit', $article) }}"
                            class="text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-300 text-sm font-medium transition-colors">Edit</a>
                        <form method="POST" action="{{ route('admin.news.destroy', $article) }}"
                            class="inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 text-sm font-medium transition-colors">Delete</button>
                        </form>
                    </div>
                </div>
            </li>
            @empty
            <li class="px-6 py-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No news articles</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">Get started by creating your first news article.</p>
                <div class="mt-6">
                    <a href="{{ route('admin.news.create') }}"
                        class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add News
                    </a>
                </div>
            </li>
            @endforelse
        </ul>
    </div>
</div>
@endsection