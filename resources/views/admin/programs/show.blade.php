@extends('admin.layouts.app')

@section('title', 'Program Details')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Program Details</h1>
        <div class="flex space-x-3">
            <a href="{{ route('admin.programs.edit', $program) }}" 
               class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors shadow-lg shadow-blue-600/20">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Program
            </a>
            <a href="{{ route('admin.programs.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg text-sm font-medium text-gray-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Programs
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Program Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Info Card -->
            <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 overflow-hidden">
                @if($program->image)
                    <div class="h-64 bg-gray-200 dark:bg-slate-900">
                        <img src="{{ asset('storage/' . $program->image) }}" alt="{{ $program->name }}" 
                             class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="h-64 bg-gradient-to-br from-blue-500 to-teal-500 flex items-center justify-center">
                        <div class="text-center text-white">
                            <svg class="w-24 h-24 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <p class="text-4xl font-bold">{{ $program->code }}</p>
                        </div>
                    </div>
                @endif
                
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $program->name }}</h2>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $program->is_active ? 'bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-400' }}">
                            {{ $program->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-slate-400">Program Code</p>
                            <p class="text-lg text-gray-900 dark:text-white">{{ $program->code }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-slate-400">Capacity</p>
                            <p class="text-lg text-gray-900 dark:text-white">{{ $program->capacity }} students</p>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-slate-400 mb-2">Description</p>
                        <p class="text-gray-700 dark:text-slate-300">{{ $program->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Students List -->
            <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Registered Students</h3>
                </div>
                <div class="overflow-x-auto">
                    @if($program->students->count() > 0)
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-700">
                            <thead class="bg-gray-50 dark:bg-slate-900">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-slate-400 uppercase tracking-wider">Student</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-slate-400 uppercase tracking-wider">Registered</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-transparent divide-y divide-gray-200 dark:divide-slate-700">
                                @foreach($program->students->take(10) as $student)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-800/50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $student->full_name }}</div>
                                                <div class="text-sm text-gray-500 dark:text-slate-400">{{ $student->email }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $statusClasses = [
                                                    'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-500/20 dark:text-yellow-400',
                                                    'accepted' => 'bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-400',
                                                    'rejected' => 'bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-400',
                                                ];
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClasses[$student->status] ?? 'bg-gray-100 text-gray-800 dark:bg-slate-500/20 dark:text-slate-400' }}">
                                                {{ ucfirst($student->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-slate-400">
                                            {{ $student->registered_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.students.show', $student) }}" 
                                               class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 transition-colors">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        @if($program->students->count() > 10)
                            <div class="px-6 py-3 bg-gray-50 dark:bg-slate-900 text-center border-t border-gray-200 dark:border-slate-700">
                                <a href="{{ route('admin.students.index', ['program_id' => $program->id]) }}" 
                                   class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 text-sm font-medium transition-colors">
                                    View all {{ $program->students->count() }} students →
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="px-6 py-8 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No students registered</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">Students will appear here when they register for this program.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Statistics -->
            <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Statistics</h3>
                
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-sm font-medium text-gray-900 dark:text-white mb-1">
                            <span>Capacity</span>
                            <span>{{ $program->current_students }}/{{ $program->capacity }}</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-slate-900 rounded-full h-2.5">
                            <div class="bg-gradient-to-r from-blue-500 to-teal-400 h-2.5 rounded-full" style="width: {{ $program->occupancy_percentage }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-slate-500 mt-1">{{ $program->occupancy_percentage }}% filled</p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-200 dark:border-slate-700">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $program->students->where('status', 'accepted')->count() }}</p>
                            <p class="text-xs text-gray-500 dark:text-slate-500">Accepted</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $program->students->where('status', 'pending')->count() }}</p>
                            <p class="text-xs text-gray-500 dark:text-slate-500">Pending</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.students.index', ['program_id' => $program->id]) }}" 
                       class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-lg text-sm font-medium text-gray-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                        View All Students
                    </a>
                    <a href="{{ route('admin.students.index', ['program_id' => $program->id, 'status' => 'pending']) }}" 
                       class="w-full inline-flex justify-center items-center px-4 py-2 rounded-lg text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 transition-colors">
                        Review Applications
                    </a>
                    <a href="{{ route('admin.programs.edit', $program) }}" 
                       class="w-full inline-flex justify-center items-center px-4 py-2 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                        Edit Program
                    </a>
                </div>
            </div>

            <!-- Program Info -->
            <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Program Information</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Created</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">{{ $program->created_at->format('M d, Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Last Updated</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">{{ $program->updated_at->format('M d, Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-slate-400">Available Slots</dt>
                        <dd class="text-sm text-gray-900 dark:text-white">{{ $program->available_slots }} remaining</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection