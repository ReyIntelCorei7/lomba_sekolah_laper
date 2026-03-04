@extends('admin.layouts.app')

@section('title', 'Homepage')

@section('content')
<div class="space-y-6">
    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-50 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400 dark:text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800 dark:text-green-400">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Homepage</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">
                Kelola gambar-gambar yang tampil di halaman utama website
            </p>
        </div>
    </div>

    @if(count($settings) > 0)
    <!-- Settings Form -->
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf
        
        @foreach($settings as $group => $groupSettings)
            <div class="bg-white dark:bg-slate-800/50 shadow rounded-xl border border-gray-200 dark:border-slate-700 mb-6 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/80">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white capitalize">{{ str_replace('_', ' ', $group) }}</h3>
                </div>
                
                <div class="px-6 py-6 space-y-6">
                    @foreach($groupSettings as $setting)
                        <div>
                            <label for="settings_{{ $setting->key }}" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">
                                {{ $setting->label }}
                                @if($setting->description)
                                    <span class="text-gray-500 dark:text-slate-500 font-normal text-xs">- {{ $setting->description }}</span>
                                @endif
                            </label>
                            
                            @if($setting->type === 'text')
                                <input type="text" 
                                       name="settings[{{ $setting->key }}]" 
                                       id="settings_{{ $setting->key }}"
                                       value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                       class="block w-full px-4 py-3 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-slate-500 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            
                            @elseif($setting->type === 'textarea')
                                <textarea name="settings[{{ $setting->key }}]" 
                                          id="settings_{{ $setting->key }}"
                                          rows="4"
                                          class="block w-full px-4 py-3 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-slate-500 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">{{ old('settings.' . $setting->key, $setting->value) }}</textarea>
                            
                            @elseif($setting->type === 'boolean')
                                <div class="mt-1">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" 
                                               name="settings[{{ $setting->key }}]" 
                                               id="settings_{{ $setting->key }}"
                                               value="true"
                                               {{ old('settings.' . $setting->key, $setting->value) === 'true' ? 'checked' : '' }}
                                               class="h-5 w-5 rounded border-gray-300 dark:border-slate-600 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-slate-900">
                                        <span class="ml-3 text-sm text-gray-700 dark:text-slate-300">Enable</span>
                                    </label>
                                </div>
                            
                            @elseif($setting->type === 'date')
                                <input type="date" 
                                       name="settings[{{ $setting->key }}]" 
                                       id="settings_{{ $setting->key }}"
                                       value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                       class="block w-full px-4 py-3 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            
                            @elseif($setting->type === 'image')
                                <div class="mt-1">
                                    @if($setting->value)
                                        <div class="mb-3">
                                            @php
                                                $imageUrl = img_url($setting->value, 'website_settings', $setting->id, 'value');
                                            @endphp
                                            <div class="relative inline-block group">
                                                <img src="{{ $imageUrl }}" 
                                                     alt="{{ $setting->label }}" 
                                                     class="h-24 w-24 object-cover rounded-lg border border-gray-200 dark:border-slate-700 shadow-sm">
                                            </div>
                                        </div>
                                    @endif
                                    <input type="file" 
                                           name="settings[{{ $setting->key }}]" 
                                           id="settings_{{ $setting->key }}"
                                           accept="image/*"
                                           class="block w-full text-sm text-gray-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 dark:file:bg-blue-900/30 dark:file:text-blue-400 hover:file:bg-blue-100 dark:hover:file:bg-blue-900/50 transition-colors">
                                </div>
                            
                            @elseif($setting->type === 'color')
                                <div class="flex items-center gap-4">
                                    <input type="color" 
                                           name="settings[{{ $setting->key }}]" 
                                           id="settings_{{ $setting->key }}"
                                           value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                           class="h-12 w-20 p-1 block bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-600 rounded-lg cursor-pointer">
                                    <span class="text-sm font-mono text-gray-600 dark:text-slate-400 bg-gray-100 dark:bg-slate-800 px-3 py-2 rounded-lg border border-gray-200 dark:border-slate-600">
                                        {{ old('settings.' . $setting->key, $setting->value) }}
                                    </span>
                                </div>
                            
                            @else
                                <input type="text" 
                                       name="settings[{{ $setting->key }}]" 
                                       id="settings_{{ $setting->key }}"
                                       value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                       class="block w-full px-4 py-3 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-600 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-slate-500 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        
        <!-- Submit Button -->
        <div class="bg-white dark:bg-slate-800/50 shadow rounded-xl border border-gray-200 dark:border-slate-700 px-6 py-4">
            <div class="flex justify-end">
                <button type="submit" 
                        class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-lg shadow-blue-600/20 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Save Settings
                </button>
            </div>
        </div>
    </form>
    @else
    <div class="bg-white dark:bg-slate-800/50 shadow rounded-xl border border-gray-200 dark:border-slate-700 p-8 text-center">
        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
        </svg>
        <h3 class="mt-2 text-sm font-bold text-gray-900 dark:text-white">No settings configured</h3>
        <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">Website settings will appear here once they are configured.</p>
    </div>
    @endif
</div>
@endsection