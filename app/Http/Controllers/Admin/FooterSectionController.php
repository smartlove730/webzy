<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\FooterSection;

/**
 * Handles the management of footer sections. Each section may include
 * content or a set of links and can be ordered in the footer area.
 */
class FooterSectionController extends Controller
{
    public function index(): View
    {
        $sections = FooterSection::with('links')->orderBy('order')->paginate(20);
        return view('admin.footer_sections.index', compact('sections'));
    }

    public function create(): View
    {
        $footerSection = new FooterSection();
        return view('admin.footer_sections.create', compact('footerSection'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);
        if (empty($data['order'])) {
            $max = FooterSection::max('order');
            $data['order'] = $max ? $max + 1 : 1;
        }
        FooterSection::create($data);
        return redirect()->route('admin.footer-sections.index')->with('success', 'Footer section created successfully.');
    }

    public function edit(int $id): View
    {
        $footerSection = FooterSection::with('links')->findOrFail($id);
        return view('admin.footer_sections.edit', compact('footerSection'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $section = FooterSection::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);
        if (empty($data['order'])) {
            $max = FooterSection::max('order');
            $data['order'] = $max ? $max + 1 : 1;
        }
        $section->update($data);
        return redirect()->route('admin.footer-sections.index')->with('success', 'Footer section updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $section = FooterSection::findOrFail($id);
        $section->links()->delete();
        $section->delete();
        return redirect()->route('admin.footer-sections.index')->with('success', 'Footer section deleted successfully.');
    }
}