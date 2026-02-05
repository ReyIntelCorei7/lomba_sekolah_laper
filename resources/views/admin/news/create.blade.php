@extends('admin.layouts.app')

@section('title', 'Create News')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create News Article</h1>
        <a href="{{ route('admin.news.index') }}" 
           class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg text-sm font-medium text-gray-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to News
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700">
        <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data" class="space-y-6 p-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Title *</label>
                    <input type="text" name="title" id="title" required 
                           value="{{ old('title') }}"
                           class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Category *</label>
                    <select name="category" id="category" required 
                            class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('category') border-red-500 @enderror">
                        <option value="">Select Category</option>
                        <option value="academic" {{ old('category') == 'academic' ? 'selected' : '' }}>Academic</option>
                        <option value="activity" {{ old('category') == 'activity' ? 'selected' : '' }}>Activity</option>
                        <option value="extracurricular" {{ old('category') == 'extracurricular' ? 'selected' : '' }}>Extracurricular</option>
                        <option value="arts" {{ old('category') == 'arts' ? 'selected' : '' }}>Arts & Culture</option>
                        <option value="alumni" {{ old('category') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                        <option value="workshop" {{ old('category') == 'workshop' ? 'selected' : '' }}>Workshop</option>
                        <option value="achievement" {{ old('category') == 'achievement' ? 'selected' : '' }}>Achievement</option>
                        <option value="scout" {{ old('category') == 'scout' ? 'selected' : '' }}>Scout</option>
                    </select>
                    @error('category')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Author -->
                <div>
                    <label for="author" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Author</label>
                    <input type="text" name="author" id="author" 
                           value="{{ old('author', auth('admin')->user()->name) }}"
                           class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('author') border-red-500 @enderror">
                    @error('author')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Excerpt -->
            <div>
                <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Excerpt</label>
                <textarea name="excerpt" id="excerpt" rows="3" 
                          placeholder="Brief summary of the article..."
                          class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-slate-500 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('excerpt') border-red-500 @enderror">{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Content -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Content *</label>
                <textarea name="content" id="content" rows="12" required 
                          placeholder="Write your article content here..."
                          class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-slate-500 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Featured Image</label>
                <input type="file" name="image" id="image" accept="image/*"
                       class="w-full text-sm text-gray-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 dark:file:bg-blue-900/30 dark:file:text-blue-400 hover:file:bg-blue-100 dark:hover:file:bg-blue-900/50 transition-colors">
                <p class="mt-1 text-sm text-gray-500 dark:text-slate-500">Upload a featured image for this article (JPG, PNG, max 2MB)</p>
                @error('image')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Options -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="published_at" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Publish Date</label>
                    <input type="datetime-local" name="published_at" id="published_at" 
                           value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}"
                           class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div class="space-y-4 pt-2">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_published" id="is_published" value="1" 
                               {{ old('is_published', 1) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-slate-600 dark:bg-slate-900 rounded">
                        <label for="is_published" class="ml-2 block text-sm text-gray-900 dark:text-slate-300">
                            Publish immediately
                        </label>
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" 
                               {{ old('is_featured') ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-slate-600 dark:bg-slate-900 rounded">
                        <label for="is_featured" class="ml-2 block text-sm text-gray-900 dark:text-slate-300">
                            Mark as featured
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-slate-700">
                <a href="{{ route('admin.news.index') }}" 
                   class="px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg text-sm font-medium text-gray-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                    Cancel
                </a>
                <button type="submit" name="action" value="draft"
                        class="px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg text-sm font-medium text-gray-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                    Save as Draft
                </button>
                <button type="submit" name="action" value="publish"
                        class="px-4 py-2 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors shadow-lg shadow-blue-600/20">
                    Publish Article
                </button>
            </div>
        </form>
    </div>
</div>
@endsection