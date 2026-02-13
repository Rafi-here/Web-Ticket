<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'logo_type' => 'required|in:text,image',
            'logo_text' => 'required_if:logo_type,text|string|nullable',
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'theme_color' => 'nullable|string',
            'default_theme' => 'required|in:light,dark',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
            'address' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'maintenance_mode' => 'boolean',
            'ticket_expiry_hours' => 'required|integer|min:1|max:72',
        ]);

        // Handle file uploads
        if ($request->hasFile('logo_image')) {
            $path = $request->file('logo_image')->store('settings', 'public');
            Setting::set('logo_image', $path, 'image');
        }

        if ($request->hasFile('favicon')) {
            $path = $request->file('favicon')->store('settings', 'public');
            Setting::set('favicon', $path, 'image');
        }

        // Update other settings
        $settings = [
            'site_name' => 'text',
            'site_description' => 'text',
            'logo_type' => 'text',
            'logo_text' => 'text',
            'theme_color' => 'text',
            'default_theme' => 'text',
            'contact_email' => 'text',
            'contact_phone' => 'text',
            'address' => 'text',
            'facebook_url' => 'text',
            'instagram_url' => 'text',
            'twitter_url' => 'text',
            'youtube_url' => 'text',
            'maintenance_mode' => 'boolean',
            'ticket_expiry_hours' => 'integer',
        ];

        foreach ($settings as $key => $type) {
            if ($request->has($key)) {
                Setting::set($key, $request->$key, $type);
            }
        }

        return redirect()->route('admin.settings')
            ->with('success', 'Settings updated successfully');
    }

    public function clearCache()
    {
        Setting::clearCache();
        return back()->with('success', 'Settings cache cleared');
    }

    public function export()
    {
        $settings = Setting::all();
        return response()->json($settings);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:json'
        ]);

        $json = json_decode(file_get_contents($request->file('file')), true);

        foreach ($json as $item) {
            Setting::updateOrCreate(
                ['key' => $item['key']],
                ['value' => $item['value'], 'type' => $item['type']]
            );
        }

        return back()->with('success', 'Settings imported successfully');
    }
}
