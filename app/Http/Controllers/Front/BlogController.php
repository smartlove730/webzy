<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Page;
use Illuminate\Http\Request;

/**
 * Handles blog listing and single blog post display. Posts and their
 * associated meta data are stored in the `blog_posts` table with many‑to‑many
 * relationships to categories and tags.
 */
class BlogController extends Controller
{
    /**
     * Show a list of published blog posts.
     */
    public function index(Request $request): View
    {
        // Build query for published posts
        $query = BlogPost::where('is_published', true);
        // Filter by category if provided
        $categorySlug = $request->query('category');
        if ($categorySlug) {
            $category = BlogCategory::where('slug', $categorySlug)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }
        // Filter by tag if provided
        $tagSlug = $request->query('tag');
        if ($tagSlug) {
            $query->whereHas('tags', function ($q) use ($tagSlug) {
                $q->where('slug', $tagSlug);
            });
        }
        // Fetch posts with pagination and preserve query parameters
        $posts = $query->orderBy('published_at', 'desc')
            ->paginate(6)
            ->withQueryString();
        // All categories and tags for sidebar/filter
        $categories = BlogCategory::all();
        $tags = BlogTag::all();
        // Blog page meta
        $page = Page::where('slug', 'blog')->first();
        return view('front.blog.index', compact('posts', 'categories', 'tags', 'page'));
    }

    /**
     * Show a single blog post by slug.
     */
    public function show(string $slug): View
    {
        $post = BlogPost::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
        // Fetch related posts from same category
        $related = BlogPost::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->where('is_published', true)
            ->latest('published_at')
            ->limit(3)
            ->get();
        return view('front.blog.show', compact('post', 'related'));
    }
}