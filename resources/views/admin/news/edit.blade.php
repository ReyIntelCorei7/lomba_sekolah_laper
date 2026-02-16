@extends('admin.layouts.app')

@section('title', 'Edit News')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit News Article</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">Update article content and settings</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.news.show', $news) }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                View Article
            </a>
            <a href="{{ route('admin.news.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to News
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-slate-800/50 shadow-lg rounded-xl border border-gray-200 dark:border-slate-700">
        <form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data" class="space-y-6 p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Title *</label>
                    <input type="text" name="title" id="title" required 
                           value="{{ old('title', $news->title) }}"
                           class="block w-full px-4 py-3 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-slate-500 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('title') border-red-500 dark:border-red-500 @enderror">
                    @error('title')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Category *</label>
                    <select name="category" id="category" required 
                            class="block w-full px-4 py-3 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('category') border-red-500 dark:border-red-500 @enderror">
                        <option value="">Select Category</option>
                        <option value="academic" {{ old('category', $news->category) == 'academic' ? 'selected' : '' }}>Academic</option>
                        <option value="activity" {{ old('category', $news->category) == 'activity' ? 'selected' : '' }}>Activity</option>
                        <option value="extracurricular" {{ old('category', $news->category) == 'extracurricular' ? 'selected' : '' }}>Extracurricular</option>
                        <option value="arts" {{ old('category', $news->category) == 'arts' ? 'selected' : '' }}>Arts & Culture</option>
                        <option value="alumni" {{ old('category', $news->category) == 'alumni' ? 'selected' : '' }}>Alumni</option>
                        <option value="workshop" {{ old('category', $news->category) == 'workshop' ? 'selected' : '' }}>Workshop</option>
                        <option value="achievement" {{ old('category', $news->category) == 'achievement' ? 'selected' : '' }}>Achievement</option>
                        <option value="scout" {{ old('category', $news->category) == 'scout' ? 'selected' : '' }}>Scout</option>
                    </select>
                    @error('category')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Author -->
                <div>
                    <label for="author" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Author</label>
                    <input type="text" name="author" id="author" 
                           value="{{ old('author', $news->author) }}"
                           class="block w-full px-4 py-3 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-slate-500 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('author') border-red-500 dark:border-red-500 @enderror">
                    @error('author')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Excerpt -->
            <div>
                <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Excerpt</label>
                <textarea name="excerpt" id="excerpt" rows="3" 
                          placeholder="Brief summary of the article..."
                          class="block w-full px-4 py-3 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-slate-500 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('excerpt') border-red-500 dark:border-red-500 @enderror">{{ old('excerpt', $news->excerpt) }}</textarea>
                @error('excerpt')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Content -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Content *</label>
                <textarea name="content" id="content" rows="12" required 
                          placeholder="Write your article content here..."
                          class="block w-full px-4 py-3 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-slate-500 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('content') border-red-500 dark:border-red-500 @enderror">{{ old('content', $news->content) }}</textarea>
                @error('content')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Current Image -->
            @if($news->image)
                <div class="p-4 bg-gray-50 dark:bg-slate-900/50 rounded-lg border border-gray-200 dark:border-slate-700">
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-3">Current Image</label>
                    <div class="flex items-center gap-4">
                        <img src="{{ img_url($news->image, 'news', $news->id, 'image') }}" alt="{{ $news->title }}" 
                             class="h-24 w-36 object-cover rounded-lg border border-gray-200 dark:border-slate-600 shadow-sm">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-slate-400">Upload a new image below to replace this one</p>
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">
                    {{ $news->image ? 'Replace Image' : 'Featured Image' }}
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-slate-600 border-dashed rounded-lg hover:border-blue-400 dark:hover:border-blue-500 transition-colors bg-gray-50 dark:bg-slate-900/50">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-slate-500" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600 dark:text-slate-400">
                            <label for="image" class="relative cursor-pointer rounded-md font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 focus-within:outline-none">
                                <span>Upload a file</span>
                                <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-slate-500">PNG, JPG, GIF up to 2MB</p>
                    </div>
                </div>
                @error('image')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Options -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 bg-gray-50 dark:bg-slate-900/50 rounded-lg border border-gray-200 dark:border-slate-700">
                <div>
                    <label for="published_at" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Publish Date</label>
                    <input type="datetime-local" name="published_at" id="published_at" 
                           value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                           class="block w-full px-4 py-3 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                </div>
                
                <div class="space-y-4 flex flex-col justify-center">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_published" id="is_published" value="1" 
                               {{ old('is_published', $news->is_published) ? 'checked' : '' }}
                               class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-slate-600 rounded dark:bg-slate-900">
                        <label for="is_published" class="ml-3 block text-sm font-medium text-gray-900 dark:text-white">
                            Published
                        </label>
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" 
                               {{ old('is_featured', $news->is_featured) ? 'checked' : '' }}
                               class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-slate-600 rounded dark:bg-slate-900">
                        <label for="is_featured" class="ml-3 block text-sm font-medium text-gray-900 dark:text-white">
                            Mark as featured
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-slate-700">
                <a href="{{ route('admin.news.show', $news) }}" 
                   class="px-6 py-3 border border-gray-300 dark:border-slate-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 border border-transparent rounded-lg shadow-lg shadow-blue-600/20 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Article
                </button>
            </div>
        </form>
    </div>
</div>
@endsection