@extends('admin.layouts.app')

@section('title', 'Website Settings')

@section('content')
<div class="space-y-6">
    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-gray-900">Website Settings</h1>
        <div class="text-sm text-gray-500">
            Configure your website content and appearance
        </div>
    </div>

    <!-- Settings Form -->
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf
        
        @foreach($settings as $group => $groupSettings)
            <div class="bg-white shadow rounded-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 capitalize">{{ str_replace('_', ' ', $group) }} Settings</h3>
                </div>
                
                <div class="px-6 py-6 space-y-6">
                    @foreach($groupSettings as $setting)
                        <div>
                            <label for="settings_{{ $setting->key }}" class="block text-sm font-medium text-gray-700">
                                {{ $setting->label }}
                                @if($setting->description)
                                    <span class="text-gray-500 font-normal">- {{ $setting->description }}</span>
                                @endif
                            </label>
                            
                            @if($setting->type === 'text')
                                <input type="text" 
                                       name="settings[{{ $setting->key }}]" 
                                       id="settings_{{ $setting->key }}"
                                       value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            
                            @elseif($setting->type === 'textarea')
                                <textarea name="settings[{{ $setting->key }}]" 
                                          id="settings_{{ $setting->key }}"
                                          rows="4"
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('settings.' . $setting->key, $setting->value) }}</textarea>
                            
                            @elseif($setting->type === 'boolean')
                                <div class="mt-1">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" 
                                               name="settings[{{ $setting->key }}]" 
                                               id="settings_{{ $setting->key }}"
                                               value="true"
                                               {{ old('settings.' . $setting->key, $setting->value) === 'true' ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-600">Enable</span>
                                    </label>
                                </div>
                            
                            @elseif($setting->type === 'date')
                                <input type="date" 
                                       name="settings[{{ $setting->key }}]" 
                                       id="settings_{{ $setting->key }}"
                                       value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            
                            @elseif($setting->type === 'image')
                                <div class="mt-1">
                                    @if($setting->value)
                                        <div class="mb-3">
                                            @php
                                                // Handle both storage and public paths
                                                $imagePath = $setting->value;
                                                if (str_starts_with($imagePath, 'settings/')) {
                                                    $imageUrl = asset('storage/' . $imagePath);
                                                } else {
                                                    $imageUrl = asset($imagePath);
                                                }
                                            @endphp
                                            <img src="{{ $imageUrl }}" 
                                                 alt="{{ $setting->label }}" 
                                                 class="h-32 w-32 object-cover rounded-lg">
                                        </div>
                                    @endif
                                    <input type="file" 
                                           name="settings[{{ $setting->key }}]" 
                                           id="settings_{{ $setting->key }}"
                                           accept="image/*"
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                </div>
                            
                            @else
                                <input type="text" 
                                       name="settings[{{ $setting->key }}]" 
                                       id="settings_{{ $setting->key }}"
                                       value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        
        <!-- Submit Button -->
        <div class="bg-white shadow rounded-lg px-6 py-4">
            <div class="flex justify-end">
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Save Settings
                </button>
            </div>
        </div>
    </form>
</div>

@if($settings->isEmpty())
    <div class="bg-white shadow rounded-lg p-8 text-center">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900">No settings configured</h3>
        <p class="mt-1 text-sm text-gray-500">Website settings will appear here once they are configured.</p>
    </div>
@endif
@endsection