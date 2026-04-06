<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Manage social media links displayed in the header or footer. Each link
 * includes a title, URL and icon class. Social links are dynamically
 * rendered on the frontend.
 */
class SocialLinkController extends Controller
{
    public function index(): View
    {
        // List social links ordered by platform name
        $links = SocialLink::orderBy('platform')->paginate(20);
        return view('admin.social_links.index', compact('links'));
    }

    public function create(): View
    {
        // Show form to create a new social link
        $socialLink = new SocialLink();
        return view('admin.social_links.create', compact('socialLink'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate input
        $data = $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url',
            'icon' => 'required|string|max:255',
        ]);
        SocialLink::create($data);
        return redirect()->route('admin.social-links.index')->with('success', 'Social link created successfully.');
    }

    public function edit(int $id): View
    {
        // Find the social link to edit
        $socialLink = SocialLink::findOrFail($id);
        return view('admin.social_links.edit', compact('socialLink'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        // Update social link
        $socialLink = SocialLink::findOrFail($id);
        $data = $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url',
            'icon' => 'required|string|max:255',
        ]);
        $socialLink->update($data);
        return redirect()->route('admin.social-links.index')->with('success', 'Social link updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $socialLink = SocialLink::findOrFail($id);
        $socialLink->delete();
        return redirect()->route('admin.social-links.index')->with('success', 'Social link deleted successfully.');
    }
}