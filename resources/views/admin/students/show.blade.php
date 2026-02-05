@extends('admin.layouts.app')

@section('title', 'Student Details')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.students.index') }}" class="text-gray-400 dark:text-slate-400 hover:text-gray-600 dark:hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $student->full_name }}</h1>
                <p class="text-sm text-gray-500 dark:text-slate-400">{{ $student->registration_number }}</p>
            </div>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.students.edit', $student) }}" 
               class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors shadow-lg shadow-blue-600/20">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Registration Info -->
            <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Registration Information</h3>
                </div>
                <div class="divide-y divide-gray-200 dark:divide-slate-700">
                    <div class="px-6 py-4 flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-slate-400">Registration Number</span>
                        <span class="text-sm text-gray-900 dark:text-white font-medium">{{ $student->registration_number }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-slate-400">Registration Type</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $student->registration_type == 'online' ? 'bg-blue-100 text-blue-800 dark:bg-blue-500/20 dark:text-blue-400' : 'bg-gray-100 text-gray-800 dark:bg-slate-500/20 dark:text-slate-400' }}">
                            {{ ucfirst($student->registration_type) }}
                        </span>
                    </div>
                    <div class="px-6 py-4 flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-slate-400">Status</span>
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
                    </div>
                    <div class="px-6 py-4 flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-slate-400">Program</span>
                        <span class="text-sm text-gray-900 dark:text-white font-medium">{{ $student->program->name ?? 'No Program' }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-slate-400">Registered At</span>
                        <span class="text-sm text-gray-900 dark:text-white">{{ $student->registered_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Personal Info -->
            <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Personal Information</h3>
                </div>
                <div class="divide-y divide-gray-200 dark:divide-slate-700">
                    <div class="px-6 py-4 flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-slate-400">Full Name</span>
                        <span class="text-sm text-gray-900 dark:text-white font-medium">{{ $student->full_name }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-slate-400">Email</span>
                        <span class="text-sm text-blue-600 dark:text-blue-400">{{ $student->email }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-slate-400">Phone</span>
                        <span class="text-sm text-gray-900 dark:text-white">{{ $student->phone ?? '-' }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-slate-400">Gender</span>
                        <span class="text-sm text-gray-900 dark:text-white">{{ ucfirst($student->gender ?? '-') }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-slate-400">Birth Date</span>
                        <span class="text-sm text-gray-900 dark:text-white">{{ $student->birth_date ? $student->birth_date->format('d M Y') : '-' }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-slate-400">Address</span>
                        <span class="text-sm text-gray-900 dark:text-white text-right max-w-xs">{{ $student->address ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Parent Info -->
            <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Parent Information</h3>
                </div>
                <div class="divide-y divide-gray-200 dark:divide-slate-700">
                    <div class="px-6 py-4 flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-slate-400">Parent Name</span>
                        <span class="text-sm text-gray-900 dark:text-white font-medium">{{ $student->parent_name ?? '-' }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-slate-400">Parent Phone</span>
                        <span class="text-sm text-gray-900 dark:text-white">{{ $student->parent_phone ?? '-' }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-slate-400">Parent Job</span>
                        <span class="text-sm text-gray-900 dark:text-white">{{ $student->parent_job ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Academic Info -->
            <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Academic Information</h3>
                </div>
                <div class="divide-y divide-gray-200 dark:divide-slate-700">
                    <div class="px-6 py-4 flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-slate-400">School Origin</span>
                        <span class="text-sm text-gray-900 dark:text-white font-medium">{{ $student->school_origin ?? '-' }}</span>
                    </div>
                    <div class="px-6 py-4 flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-slate-400">Average Grade</span>
                        <span class="text-sm text-gray-900 dark:text-white">{{ $student->average_grade ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Student Photo -->
            <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Photo</h3>
                @if($student->photo)
                    <img src="{{ Storage::url($student->photo) }}" alt="{{ $student->full_name }}" class="w-full rounded-lg">
                @else
                    <div class="w-full aspect-square bg-gray-100 dark:bg-slate-900 rounded-lg flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <p class="text-sm text-gray-400 dark:text-slate-500 mt-2">No Photo</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Admin Notes -->
            <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Admin Notes</h3>
                <p class="text-sm text-gray-600 dark:text-slate-300">{{ $student->notes ?? 'No notes added.' }}</p>
            </div>

            <!-- Actions -->
            <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Actions</h3>
                <div class="space-y-3">
                    @if($student->status === 'pending')
                        <form method="POST" action="{{ route('admin.students.updateStatus', $student) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="accepted">
                            <button type="submit" class="w-full px-4 py-2 rounded-lg text-sm font-medium text-white bg-green-600 hover:bg-green-700 transition-colors">
                                Accept Student
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.students.updateStatus', $student) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="w-full px-4 py-2 rounded-lg text-sm font-medium text-white bg-red-600 hover:bg-red-700 transition-colors">
                                Reject Student
                            </button>
                        </form>
                    @endif
                    <form method="POST" action="{{ route('admin.students.destroy', $student) }}" onsubmit="return confirm('Are you sure you want to delete this student?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 border border-red-500 dark:border-red-500/50 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10 text-sm font-medium rounded-lg transition-colors">
                            Delete Student
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
