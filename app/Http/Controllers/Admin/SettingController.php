<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Setting;
use App\Models\ThemeSetting;
use App\Models\FirebaseSetting;

/**
 * Central controller for managing various application settings including
 * general website information, theme customization, SEO defaults and
 * Firebase configuration. Each settings page uses its own view.
 */
class SettingController extends Controller
{
    // General settings
    public function general(): View
    {
        // Fetch existing general settings into an associative array keyed by "key"
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.general', compact('settings'));
    }

    public function updateGeneral(Request $request): RedirectResponse
    {
        // Validate incoming fields
        $data = $request->validate([
            'site_title' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'default_meta_title' => 'nullable|string|max:255',
            'default_meta_description' => 'nullable|string|max:500',
            'default_meta_keywords' => 'nullable|string|max:500',
            'default_canonical_url' => 'nullable|url',
        ]);

        // Persist each setting
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        return redirect()->route('admin.settings.general')->with('success', 'General settings updated successfully.');
    }

    // Theme settings
    public function theme(): View
    {
        // Fetch the first theme settings record
        $theme = ThemeSetting::first();
        return view('admin.settings.theme', compact('theme'));
    }

    public function updateTheme(Request $request): RedirectResponse
    {
        // Validate theme settings
        $data = $request->validate([
            'primary_color' => 'required|string|max:7',
            'secondary_color' => 'required|string|max:7',
            'logo' => 'nullable|image',
            'favicon' => 'nullable|image',
        ]);
        $theme = ThemeSetting::first() ?: new ThemeSetting();
        // Handle logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = $file->store('theme', 'public');
            $data['logo_path'] = $path;
        }
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $path = $file->store('theme', 'public');
            $data['favicon_path'] = $path;
        }
        // Remove file inputs to avoid mass assignment
        unset($data['logo'], $data['favicon']);
        $theme->fill($data);
        $theme->save();
        return redirect()->route('admin.settings.theme')->with('success', 'Theme settings updated successfully.');
    }

    // SEO settings
    public function seo(): View
    {
        // For SEO defaults we also store them in the settings table
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.seo', compact('settings'));
    }

    public function updateSeo(Request $request): RedirectResponse
    {
        // Validate SEO settings
        $data = $request->validate([
            'default_meta_title' => 'nullable|string|max:255',
            'default_meta_description' => 'nullable|string|max:500',
            'default_meta_keywords' => 'nullable|string|max:500',
            'default_canonical_url' => 'nullable|url',
        ]);
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        return redirect()->route('admin.settings.seo')->with('success', 'SEO settings updated successfully.');
    }

    // Firebase settings
    public function firebase(): View
    {
        // Fetch Firebase settings
        $firebase = FirebaseSetting::first();
        return view('admin.settings.firebase', compact('firebase'));
    }

    public function updateFirebase(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'server_key' => 'nullable|string',
            'sender_id' => 'nullable|string',
            'project_id' => 'nullable|string',
        ]);
        $firebase = FirebaseSetting::first() ?: new FirebaseSetting();
        $firebase->fill($data);
        $firebase->save();
        return redirect()->route('admin.settings.firebase')->with('success', 'Firebase settings updated successfully.');
    }
}