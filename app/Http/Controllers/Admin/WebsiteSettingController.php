<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsiteSettingController extends Controller
{
    public function index()
    {
        $settings = WebsiteSetting::orderBy('group')->orderBy('key')->get()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = $request->input('settings', []);

        // Handle regular settings first
        foreach ($settings as $key => $value) {
            $setting = WebsiteSetting::where('key', $key)->first();
            
            if ($setting && $setting->type !== 'image') {
                $setting->update(['value' => $value]);
            }
        }

        // Handle image uploads separately - check if settings array has files
        if ($request->hasFile('settings')) {
            $files = $request->file('settings');
            
            foreach ($files as $key => $file) {
                if ($file && $file->isValid()) {
                    $setting = WebsiteSetting::where('key', $key)->where('type', 'image')->first();
                    
                    if ($setting) {
                        // Delete old image if it exists and is in storage
                        if ($setting->value && str_starts_with($setting->value, 'settings/') && Storage::disk('public')->exists($setting->value)) {
                            Storage::disk('public')->delete($setting->value);
                        }
                        
                        // Store new image
                        $newImagePath = $file->store('settings', 'public');
                        $setting->update(['value' => $newImagePath]);
                    }
                }
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}