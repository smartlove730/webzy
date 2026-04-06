<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\BlogCategory;
use Illuminate\Support\Str;

/**
 * Manages blog categories used to organize blog posts. Categories support
 * hierarchical organization and can be created, edited and deleted.
 */
class BlogCategoryController extends Controller
{
    public function index(): View
    {
        $categories = BlogCategory::orderBy('title')->paginate(15);
        return view('admin.blog_categories.index', compact('categories'));
    }

    public function create(): View
    {
        $category = new BlogCategory();
        return view('admin.blog_categories.create', compact('category'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_categories,slug',
            'description' => 'nullable|string',
        ]);
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        BlogCategory::create($data);
        return redirect()->route('admin.blog-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(int $id): View
    {
        $category = BlogCategory::findOrFail($id);
        return view('admin.blog_categories.edit', compact('category'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $category = BlogCategory::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_categories,slug,' . $category->id,
            'description' => 'nullable|string',
        ]);
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        $category->update($data);
        return redirect()->route('admin.blog-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $category = BlogCategory::findOrFail($id);
        // Optionally detach category from posts or set to null; here we simply delete
        $category->delete();
        return redirect()->route('admin.blog-categories.index')->with('success', 'Category deleted successfully.');
    }
}