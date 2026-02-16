<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use App\Traits\HandlesBase64Images;
use Illuminate\Http\Request;

class WebsiteSettingController extends Controller
{
    use HandlesBase64Images;

    public function index()
    {
        // Get distinct groups
        $groups = WebsiteSetting::distinct()->pluck('group')->toArray();

        // Build settings array grouped by group name
        $settings = [];
        foreach ($groups as $group) {
            $settings[$group] = WebsiteSetting::where('group', $group)
                ->orderBy('key')
                ->get();
        }

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

        // Handle image uploads - convert to base64 
        if ($request->hasFile('settings')) {
            $files = $request->file('settings');

            foreach ($files as $key => $file) {
                if ($file && $file->isValid()) {
                    $setting = WebsiteSetting::where('key', $key)->where('type', 'image')->first();

                    if ($setting) {
                        // Convert to base64 and store in DB
                        $base64 = $this->convertToBase64($file);
                        $setting->update(['value' => $base64]);
                    }
                }
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
