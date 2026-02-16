@extends('admin.layouts.app')

@section('title', 'Programs Management')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Programs Management</h1>
        <a href="{{ route('admin.programs.create') }}" 
           class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors shadow-lg shadow-blue-600/20">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add New Program
        </a>
    </div>

    <!-- Programs Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($programs as $program)
            <div class="bg-white dark:bg-slate-800/50 overflow-hidden rounded-2xl border border-gray-200 dark:border-slate-700 hover:shadow-lg dark:hover:bg-slate-800 transition-all duration-200">
                @if($program->image)
                    <div class="h-48 bg-gray-200 dark:bg-slate-900">
                        <img src="{{ img_url($program->image, 'programs', $program->id, 'image') }}" alt="{{ $program->name }}" 
                             class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-teal-500 flex items-center justify-center">
                        <div class="text-center text-white">
                            <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <p class="text-2xl font-bold">{{ $program->code }}</p>
                        </div>
                    </div>
                @endif
                
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $program->name }}</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $program->is_active ? 'bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-400' }}">
                            {{ $program->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    
                    <p class="text-sm text-gray-500 dark:text-slate-400 mb-3">{{ $program->code }}</p>
                    
                    <p class="text-sm text-gray-600 dark:text-slate-300 mb-4 line-clamp-3">{{ Str::limit($program->description, 100) }}</p>
                    
                    <!-- Capacity Info -->
                    <div class="mb-4">
                        <div class="flex justify-between text-sm text-gray-600 dark:text-slate-400 mb-1">
                            <span>Students</span>
                            <span>{{ $program->students_count }}/{{ $program->capacity }}</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-slate-900 rounded-full h-2.5">
                            <div class="bg-gradient-to-r from-blue-500 to-teal-400 h-2.5 rounded-full" style="width: {{ $program->occupancy_percentage }}%"></div>
                        </div>
                        <p class="text-xs text-gray-400 dark:text-slate-500 mt-1">{{ $program->occupancy_percentage }}% filled</p>
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.programs.show', $program) }}" 
                           class="flex-1 text-center px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-lg text-sm font-medium text-gray-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                            View
                        </a>
                        <a href="{{ route('admin.programs.edit', $program) }}" 
                           class="flex-1 text-center px-3 py-2 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('admin.programs.destroy', $program) }}" 
                              class="inline" onsubmit="return confirm('Are you sure? This will delete the program and all related data.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-3 py-2 rounded-lg text-sm font-medium text-white bg-red-600 hover:bg-red-700 transition-colors">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white dark:bg-slate-800/50 rounded-2xl border border-gray-200 dark:border-slate-700 text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No programs</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">Get started by creating a new program.</p>
                <div class="mt-6">
                    <a href="{{ route('admin.programs.create') }}" 
                       class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Program
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($programs->hasPages())
        <div class="mt-6">
            {{ $programs->links() }}
        </div>
    @endif
</div>
@endsection