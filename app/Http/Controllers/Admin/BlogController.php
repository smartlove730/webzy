<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Support\Str;

/**
 * Administration of blog posts. Supports AI assisted generation of content
 * (implemented in later phases) along with standard CRUD operations.
 */
use App\Services\BlogGeneratorService;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    /**
     * The blog generator service instance.
     *
     * @var \App\Services\BlogGeneratorService
     */
    protected BlogGeneratorService $generator;

    /**
     * Inject dependencies.
     */
    public function __construct(BlogGeneratorService $generator)
    {
        $this->generator = $generator;
    }
    public function index(): View
    {
        $posts = BlogPost::with(['category', 'author'])->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.blogs.index', compact('posts'));
    }

    public function create(): View
    {
        $post = new BlogPost();
        $categories = BlogCategory::orderBy('name')->get();
        $tags = BlogTag::orderBy('name')->get();
        return view('admin.blogs.create', compact('post', 'categories', 'tags'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_posts,slug',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'short_description' => 'nullable|string',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:blog_categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        // Handle featured image
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/blogs');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $fileName);
            $data['featured_image'] = 'storage/blogs/' . $fileName;
        }
        $data['author_id'] = auth()->id();
        // Determine publication date/time
        if (!isset($data['is_published']) || !$data['is_published']) {
            $data['is_published'] = false;
            $data['published_at'] = null;
        } else {
            if (empty($data['published_at'])) {
                $data['published_at'] = now();
            }
        }

        $post = BlogPost::create($data);
        // Sync tags
        if (!empty($data['tags'])) {
            $post->tags()->sync($data['tags']);
        }
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully.');
    }

    public function edit(int $id): View
    {
        $post = BlogPost::with('tags')->findOrFail($id);
        $categories = BlogCategory::orderBy('name')->get();
        $tags = BlogTag::orderBy('name')->get();
        return view('admin.blogs.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $post = BlogPost::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_posts,slug,' . $post->id,
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'short_description' => 'nullable|string',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:blog_categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/blogs');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $fileName);
            $data['featured_image'] = 'storage/blogs/' . $fileName;
        }
        // Publication toggle
        if (!isset($data['is_published']) || !$data['is_published']) {
            $data['is_published'] = false;
            $data['published_at'] = null;
        } else {
            if (empty($data['published_at'])) {
                $data['published_at'] = now();
            }
        }

        $post->update($data);
        if (!empty($data['tags'])) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $post = BlogPost::findOrFail($id);
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully.');
    }

    /**
     * Generate blog content via AI service.
     *
     * Accepts a topic from the request and returns a JSON response containing
     * generated fields. This endpoint is accessed via AJAX from the blog
     * create/edit pages.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function generate(Request $request): JsonResponse
    {
        $data = $request->validate([
            'topic' => 'required|string|max:255',
        ]);
        try {
            $result = $this->generator->generateBlog($data['topic']);
            return response()->json($result);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}