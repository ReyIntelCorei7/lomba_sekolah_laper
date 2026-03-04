@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Students -->
        <div class="bg-white dark:bg-slate-800/50 rounded-2xl border border-gray-200 dark:border-slate-700 p-6 hover:shadow-lg dark:hover:bg-slate-800 transition-all duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-slate-400 truncate">Total Students</dt>
                    <dd class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total_students'] }}</dd>
                </div>
            </div>
        </div>

        <!-- Pending Applications -->
        <div class="bg-white dark:bg-slate-800/50 rounded-2xl border border-gray-200 dark:border-slate-700 p-6 hover:shadow-lg dark:hover:bg-slate-800 transition-all duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-yellow-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-slate-400 truncate">Pending Review</dt>
                    <dd class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['pending_applications'] }}</dd>
                </div>
            </div>
        </div>

        <!-- Accepted Students -->
        <div class="bg-white dark:bg-slate-800/50 rounded-2xl border border-gray-200 dark:border-slate-700 p-6 hover:shadow-lg dark:hover:bg-slate-800 transition-all duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-slate-400 truncate">Accepted</dt>
                    <dd class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['accepted_students'] }}</dd>
                </div>
            </div>
        </div>

        <!-- Online Registrations -->
        <div class="bg-white dark:bg-slate-800/50 rounded-2xl border border-gray-200 dark:border-slate-700 p-6 hover:shadow-lg dark:hover:bg-slate-800 transition-all duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dt class="text-sm font-medium text-gray-500 dark:text-slate-400 truncate">Online Reg</dt>
                    <dd class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['online_registrations'] }}</dd>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts & Tables Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Students -->
        <div class="bg-white dark:bg-slate-800/50 rounded-2xl border border-gray-200 dark:border-slate-700">
            <div class="px-6 py-5 border-b border-gray-200 dark:border-slate-700 flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Recent Applications</h3>
                <a href="{{ route('admin.students.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium">View All →</a>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($recent_students as $student)
                        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-slate-900/50 rounded-xl hover:bg-gray-100 dark:hover:bg-slate-900 transition-colors">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold">
                                    {{ substr($student->full_name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $student->full_name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-slate-400">{{ $student->program->name ?? 'No Program' }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-500/20 dark:text-yellow-400',
                                        'accepted' => 'bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-400',
                                        'rejected' => 'bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-400',
                                        'waiting' => 'bg-blue-100 text-blue-800 dark:bg-blue-500/20 dark:text-blue-400',
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClasses[$student->status] ?? 'bg-gray-100 text-gray-800 dark:bg-slate-500/20 dark:text-slate-400' }}">
                                    {{ ucfirst($student->status) }}
                                </span>
                                <p class="text-xs text-gray-400 dark:text-slate-500 mt-1">{{ $student->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <p class="text-gray-500 dark:text-slate-400">No recent applications found</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Program Statistics -->
        <div class="bg-white dark:bg-slate-800/50 rounded-2xl border border-gray-200 dark:border-slate-700">
            <div class="px-6 py-5 border-b border-gray-200 dark:border-slate-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Program Capacity</h3>
            </div>
            <div class="p-6">
                <div class="space-y-6">
                    @foreach($program_stats as $program)
                        <div>
                            <div class="flex justify-between text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">
                                <span>{{ $program['name'] }}</span>
                                <span class="text-gray-500 dark:text-slate-400">{{ $program['students_count'] }} / {{ $program['capacity'] }}</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-slate-900 rounded-full h-2.5 overflow-hidden">
                                <div class="bg-gradient-to-r from-blue-500 to-teal-400 h-2.5 rounded-full transition-all duration-500" 
                                     style="width: {{ $program['occupancy_percentage'] }}%"></div>
                            </div>
                            <div class="flex justify-between mt-1">
                                <p class="text-xs text-gray-400 dark:text-slate-500">{{ $program['occupancy_percentage'] }}% Filled</p>
                                @if($program['occupancy_percentage'] >= 90)
                                    <p class="text-xs text-red-500 dark:text-red-400 font-medium">Almost Full</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white dark:bg-slate-800/50 rounded-2xl border border-gray-200 dark:border-slate-700 p-6">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Quick Actions</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.students.index', ['status' => 'pending']) }}" 
               class="flex flex-col items-center justify-center p-6 bg-yellow-50 dark:bg-yellow-500/10 rounded-xl border border-yellow-200 dark:border-yellow-500/20 hover:bg-yellow-100 dark:hover:bg-yellow-500/20 transition-colors group">
                <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-500/20 text-yellow-600 dark:text-yellow-400 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <span class="text-sm font-semibold text-yellow-700 dark:text-yellow-400">Review Applications</span>
            </a>
            

            
            <a href="{{ route('admin.news.create') }}" 
               class="flex flex-col items-center justify-center p-6 bg-green-50 dark:bg-green-500/10 rounded-xl border border-green-200 dark:border-green-500/20 hover:bg-green-100 dark:hover:bg-green-500/20 transition-colors group">
                <div class="w-12 h-12 bg-green-100 dark:bg-green-500/20 text-green-600 dark:text-green-400 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
                <span class="text-sm font-semibold text-green-700 dark:text-green-400">Post News</span>
            </a>
            
            <a href="{{ route('admin.settings.index') }}" 
               class="flex flex-col items-center justify-center p-6 bg-gray-50 dark:bg-slate-700/30 rounded-xl border border-gray-200 dark:border-slate-600 hover:bg-gray-100 dark:hover:bg-slate-700/50 transition-colors group">
                <div class="w-12 h-12 bg-gray-200 dark:bg-slate-600 text-gray-600 dark:text-slate-300 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <span class="text-sm font-semibold text-gray-700 dark:text-slate-300">Settings</span>
            </a>
        </div>
    </div>
</div>
@endsection