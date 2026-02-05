@extends('admin.layouts.app')

@section('title', 'Create Program')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create New Program</h1>
        <a href="{{ route('admin.programs.index') }}" 
           class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg text-sm font-medium text-gray-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Programs
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700">
        <form method="POST" action="{{ route('admin.programs.store') }}" enctype="multipart/form-data" class="space-y-6 p-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Program Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Program Name *</label>
                    <input type="text" name="name" id="name" required 
                           value="{{ old('name') }}"
                           class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Program Code -->
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Program Code *</label>
                    <input type="text" name="code" id="code" required 
                           value="{{ old('code') }}"
                           placeholder="e.g., AKL, DKV, PPLG"
                           class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-slate-500 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('code') border-red-500 @enderror">
                    @error('code')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Capacity -->
                <div>
                    <label for="capacity" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Capacity *</label>
                    <input type="number" name="capacity" id="capacity" required min="1"
                           value="{{ old('capacity', 36) }}"
                           class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('capacity') border-red-500 @enderror">
                    @error('capacity')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Status -->
                <div>
                    <label for="is_active" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Status</label>
                    <select name="is_active" id="is_active" 
                            class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('is_active')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Description *</label>
                <textarea name="description" id="description" rows="4" required 
                          class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Program Image</label>
                <input type="file" name="image" id="image" accept="image/*"
                       class="w-full text-sm text-gray-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 dark:file:bg-blue-900/30 dark:file:text-blue-400 hover:file:bg-blue-100 dark:hover:file:bg-blue-900/50 transition-colors">
                <p class="mt-1 text-sm text-gray-500 dark:text-slate-500">Upload an image for this program (JPG, PNG, max 2MB)</p>
                @error('image')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-slate-700">
                <a href="{{ route('admin.programs.index') }}" 
                   class="px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg text-sm font-medium text-gray-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-4 py-2 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors shadow-lg shadow-blue-600/20">
                    Create Program
                </button>
            </div>
        </form>
    </div>
</div>
@endsection