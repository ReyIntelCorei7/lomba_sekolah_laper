@extends('admin.layouts.app')

@section('title', 'View News')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">News Article</h1>
        <div class="flex space-x-3">
            <a href="{{ route('admin.news.edit', $news) }}" 
               class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors shadow-lg shadow-blue-600/20">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Article
            </a>
            <a href="{{ route('admin.news.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg text-sm font-medium text-gray-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to News
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Article Content -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 overflow-hidden">
                @if($news->image)
                    <div class="h-64 bg-gray-200 dark:bg-slate-900">
                        <img src="{{ img_url($news->image, 'news', $news->id, 'image') }}" alt="{{ $news->title }}" 
                             class="w-full h-full object-cover">
                    </div>
                @endif
                
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $news->is_published ? 'bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-400' : 'bg-gray-100 text-gray-800 dark:bg-slate-500/20 dark:text-slate-400' }}">
                                {{ $news->is_published ? 'Published' : 'Draft' }}
                            </span>
                            @if($news->is_featured)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-500/20 dark:text-yellow-400">
                                    Featured
                                </span>
                            @endif
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-500/20 dark:text-blue-400">
                                {{ ucfirst($news->category) }}
                            </span>
                        </div>
                    </div>
                    
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ $news->title }}</h1>
                    
                    <div class="flex items-center text-sm text-gray-500 dark:text-slate-400 mb-6">
                        <span>By {{ $news->author }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $news->formatted_date }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $news->views }} views</span>
                        <span class="mx-2">•</span>
                        <span>{{ $news->reading_time }}</span>
                    </div>
                    
                    @if($news->excerpt)
                        <div class="bg-gray-50 dark:bg-slate-900/50 border-l-4 border-blue-500 p-4 mb-6 rounded-r-lg">
                            <p class="text-gray-700 dark:text-slate-300 italic">{{ $news->excerpt }}</p>
                        </div>
                    @endif
                    
                    <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-slate-300">
                        {!! nl2br(e($news->content)) !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Article Stats -->
            <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Article Statistics</h3>
                
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-slate-400">Views</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ number_format($news->views) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-slate-400">Reading Time</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $news->reading_time }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-slate-400">Word Count</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ str_word_count(strip_tags($news->content)) }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.news.edit', $news) }}" 
                       class="w-full inline-flex justify-center items-center px-4 py-2 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                        Edit Article
                    </a>
                    
                    <form method="POST" action="{{ route('admin.news.toggle-publish', $news) }}" class="w-full">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg text-sm font-medium text-gray-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                            {{ $news->is_published ? 'Unpublish' : 'Publish' }}
                        </button>
                    </form>
                    
                    <form method="POST" action="{{ route('admin.news.destroy', $news) }}" 
                          class="w-full" onsubmit="return confirm('Are you sure you want to delete this article?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full inline-flex justify-center items-center px-4 py-2 rounded-lg text-sm font-medium text-white bg-red-600 hover:bg-red-700 transition-colors">
                            Delete Article
                        </button>
                    </form>
                </div>
            </div>

            <!-- Article Info -->
            <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Article Information</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Created</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">{{ $news->created_at->format('M d, Y H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Last Updated</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">{{ $news->updated_at->format('M d, Y H:i') }}</dd>
                    </div>
                    @if($news->published_at)
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Published</dt>
                            <dd class="text-sm text-gray-900 dark:text-white">{{ $news->published_at->format('M d, Y H:i') }}</dd>
                        </div>
                    @endif
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Slug</dt>
                        <dd class="text-sm text-gray-900 dark:text-white break-all">{{ $news->slug }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection