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
        $inputSettings = $request->input('settings', []);

        // Handle regular (non-image) settings
        foreach ($inputSettings as $key => $value) {
            $setting = WebsiteSetting::where('key', $key)->first();

            if ($setting && $setting->type !== 'image') {
                $setting->update(['value' => $value]);
            }
        }

        // Handle image uploads - check each image setting individually
        $imageSettings = WebsiteSetting::where('type', 'image')->get();

        foreach ($imageSettings as $setting) {
            $fileKey = 'settings.' . $setting->key;

            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);

                if ($file && $file->isValid()) {
                    // Convert to base64 and store in DB
                    $base64 = $this->convertToBase64($file);
                    $setting->update(['value' => $base64]);
                }
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
