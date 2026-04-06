<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Page;
use Illuminate\Support\Str;

/**
 * Manages static pages such as About, Home sections and any custom pages. Allows
 * administrators to create, edit and delete pages as well as control the
 * ordering of sections within a page.
 */
class PageController extends Controller
{
    public function index(): View
    {
        $pages = Page::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.pages.index', compact('pages'));
    }

    public function create(): View
    {
        $page = new Page();
        return view('admin.pages.create', compact('page'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug',
            'content' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'status' => 'nullable|boolean',
        ]);
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        Page::create($data);
        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function edit(int $id): View
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $page = Page::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug,' . $page->id,
            'content' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'status' => 'nullable|boolean',
        ]);
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        $page->update($data);
        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $page = Page::findOrFail($id);
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}