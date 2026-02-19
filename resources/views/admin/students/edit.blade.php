@extends('admin.layouts.app')

@section('title', 'Edit Student')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.students.show', $student) }}" class="text-gray-400 dark:text-slate-400 hover:text-gray-600 dark:hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Student</h1>
            <p class="text-sm text-gray-500 dark:text-slate-400">{{ $student->full_name }} - {{ $student->registration_number }}</p>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.students.update', $student) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Form -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Status & Program -->
                <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Status & Program</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Status</label>
                            <select id="status" name="status" class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <option value="pending" {{ old('status', $student->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="accepted" {{ old('status', $student->status) == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="rejected" {{ old('status', $student->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="waiting" {{ old('status', $student->status) == 'waiting' ? 'selected' : '' }}>Waiting</option>
                            </select>
                        </div>
                        <div>
                            <label for="program_id" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Program</label>
                            <select id="program_id" name="program_id" class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}" {{ old('program_id', $student->program_id) == $program->id ? 'selected' : '' }}>
                                        {{ $program->name }} ({{ $program->code }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Personal Information -->
                <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Personal Information</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label for="full_name" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Full Name</label>
                            <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $student->full_name) }}" 
                                   class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $student->email) }}" 
                                   class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Phone</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone', $student->phone) }}" 
                                   class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Gender</label>
                            <select id="gender" name="gender" class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Gender</option>
                                <option value="L" {{ old('gender', $student->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('gender', $student->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label for="birth_date" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Birth Date</label>
                            <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $student->birth_date?->format('Y-m-d')) }}" 
                                   class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Address</label>
                            <textarea id="address" name="address" rows="3" 
                                      class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('address', $student->address) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Family Information -->
                <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Family Information</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="parent_name" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Parent Name</label>
                            <input type="text" id="parent_name" name="parent_name" value="{{ old('parent_name', $student->parent_name) }}" 
                                   class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="parent_phone" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Parent Phone</label>
                            <input type="text" id="parent_phone" name="parent_phone" value="{{ old('parent_phone', $student->parent_phone) }}" 
                                   class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="parent_job" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Parent Job</label>
                            <input type="text" id="parent_job" name="parent_job" value="{{ old('parent_job', $student->parent_job) }}" 
                                   class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Academic Info -->
                <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Academic Information</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="school_origin" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">School Origin</label>
                            <input type="text" id="school_origin" name="school_origin" value="{{ old('school_origin', $student->school_origin) }}" 
                                   class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="average_grade" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Average Grade</label>
                            <input type="text" id="average_grade" name="average_grade" value="{{ old('average_grade', $student->average_grade) }}" 
                                   class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Upload Dokumen -->
                <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Upload Dokumen</h3>
                    <div class="space-y-4">
                        <!-- Pas Foto -->
                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Pas Foto</label>
                            @if($student->photo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $student->photo) }}" alt="Pas Foto" class="w-full rounded-lg object-cover border border-gray-200 dark:border-slate-600">
                                </div>
                            @endif
                            <input type="file" id="photo" name="photo" accept="image/jpeg,image/png"
                                   class="w-full text-sm text-gray-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 dark:file:bg-blue-500/10 dark:file:text-blue-400 hover:file:bg-blue-100">
                            <p class="mt-1 text-xs text-gray-500 dark:text-slate-500">Format: JPG, PNG (Max: 2MB)</p>
                            @error('photo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Ijazah/SKHUN -->
                        <div>
                            <label for="certificate" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Ijazah / SKHUN</label>
                            @if($student->certificate)
                                <div class="mb-2">
                                    @if(Str::endsWith(strtolower($student->certificate), ['.jpg', '.jpeg', '.png']))
                                        <img src="{{ asset('storage/' . $student->certificate) }}" alt="Ijazah/SKHUN" class="w-full rounded-lg object-cover border border-gray-200 dark:border-slate-600">
                                    @else
                                        <a href="{{ asset('storage/' . $student->certificate) }}" target="_blank" class="inline-flex items-center text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                            📄 Lihat Dokumen (PDF)
                                        </a>
                                    @endif
                                </div>
                            @endif
                            <input type="file" id="certificate" name="certificate" accept=".pdf,image/jpeg,image/png"
                                   class="w-full text-sm text-gray-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 dark:file:bg-blue-500/10 dark:file:text-blue-400 hover:file:bg-blue-100">
                            <p class="mt-1 text-xs text-gray-500 dark:text-slate-500">Format: PDF, JPG, PNG (Max: 5MB)</p>
                            @error('certificate')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Transkrip Nilai -->
                        <div>
                            <label for="transcript" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Transkrip Nilai</label>
                            @if($student->transcript)
                                <div class="mb-2">
                                    @if(Str::endsWith(strtolower($student->transcript), ['.jpg', '.jpeg', '.png']))
                                        <img src="{{ asset('storage/' . $student->transcript) }}" alt="Transkrip Nilai" class="w-full rounded-lg object-cover border border-gray-200 dark:border-slate-600">
                                    @else
                                        <a href="{{ asset('storage/' . $student->transcript) }}" target="_blank" class="inline-flex items-center text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                            📄 Lihat Dokumen (PDF)
                                        </a>
                                    @endif
                                </div>
                            @endif
                            <input type="file" id="transcript" name="transcript" accept=".pdf,image/jpeg,image/png"
                                   class="w-full text-sm text-gray-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 dark:file:bg-blue-500/10 dark:file:text-blue-400 hover:file:bg-blue-100">
                            <p class="mt-1 text-xs text-gray-500 dark:text-slate-500">Format: PDF, JPG, PNG (Max: 5MB)</p>
                            @error('transcript')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Admin Notes -->
                <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Admin Notes</h3>
                    <textarea id="notes" name="notes" rows="5" 
                              class="w-full bg-white dark:bg-slate-900 border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 dark:placeholder-slate-500"
                              placeholder="Add internal notes...">{{ old('notes', $student->notes) }}</textarea>
                </div>

                <!-- Actions -->
                <div class="bg-white dark:bg-slate-800/50 rounded-xl border border-gray-200 dark:border-slate-700 p-6">
                    <div class="space-y-3">
                        <button type="submit" class="w-full px-4 py-3 rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors shadow-lg shadow-blue-600/20">
                            Save Changes
                        </button>
                        <a href="{{ route('admin.students.show', $student) }}" class="block w-full px-4 py-3 border border-gray-300 dark:border-slate-600 text-gray-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-700 text-sm font-medium rounded-lg text-center transition-colors">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
