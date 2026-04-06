<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\BlogTag;
use Illuminate\Support\Str;

/**
 * CRUD controller for blog tags. Tags allow posts to be cross‑referenced
 * across categories and improve discoverability.
 */
class BlogTagController extends Controller
{
    public function index(): View
    {
        $tags = BlogTag::orderBy('name')->paginate(15);
        return view('admin.blog_tags.index', compact('tags'));
    }

    public function create(): View
    {
        $tag = new BlogTag();
        return view('admin.blog_tags.create', compact('tag'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_tags,slug',
        ]);
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        BlogTag::create($data);
        return redirect()->route('admin.blog-tags.index')->with('success', 'Tag created successfully.');
    }

    public function edit(int $id): View
    {
        $tag = BlogTag::findOrFail($id);
        return view('admin.blog_tags.edit', compact('tag'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $tag = BlogTag::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_tags,slug,' . $tag->id,
        ]);
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        $tag->update($data);
        return redirect()->route('admin.blog-tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $tag = BlogTag::findOrFail($id);
        // detach relation from pivot table
        $tag->blogPosts()->detach();
        $tag->delete();
        return redirect()->route('admin.blog-tags.index')->with('success', 'Tag deleted successfully.');
    }
}