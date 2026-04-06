<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Portfolio;
use Illuminate\Support\Str;

/**
 * Handles CRUD operations for portfolio items. Each portfolio item may
 * include images, descriptions, categories and external links.
 */
class PortfolioController extends Controller
{
    public function index(): View
    {
        $portfolioItems = Portfolio::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.portfolio.index', compact('portfolioItems'));
    }

    public function create(): View
    {
        $portfolio = new Portfolio();
        return view('admin.portfolio.create', compact('portfolio'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:portfolio,slug',
            'client_name' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'project_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'status' => 'nullable|boolean',
        ]);
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/portfolio');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $fileName);
            $data['image'] = 'storage/portfolio/' . $fileName;
        }
        Portfolio::create($data);
        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio item created successfully.');
    }

    public function edit(int $id): View
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('admin.portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $portfolio = Portfolio::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:portfolio,slug,' . $portfolio->id,
            'client_name' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'project_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'status' => 'nullable|boolean',
        ]);
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('storage/portfolio');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $fileName);
            $data['image'] = 'storage/portfolio/' . $fileName;
        }
        $portfolio->update($data);
        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio item updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $portfolio = Portfolio::findOrFail($id);
        $portfolio->delete();
        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio item deleted successfully.');
    }
}