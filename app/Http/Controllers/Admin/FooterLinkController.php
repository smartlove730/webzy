<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\FooterLink;
use App\Models\FooterSection;

/**
 * Manages links inside footer sections. Links can point to internal
 * pages, external URLs or files and can be ordered within their section.
 */
class FooterLinkController extends Controller
    /**
     * Display a listing of all footer links.
     */
    public function index(): View
    {
        $links = FooterLink::with('section')->orderBy('footer_section_id')->orderBy('order')->paginate(30);
        return view('admin.footer_links.index', compact('links'));
    }
{
    public function create(): View
    {
        // Create a new footer link; pass available sections for dropdown
        $footerLink = new FooterLink();
        $sections = FooterSection::orderBy('order')->get();
        // Preselect section if provided via query parameter
        $selectedSectionId = request()->query('footer_section_id');
        return view('admin.footer_links.create', compact('footerLink', 'sections', 'selectedSectionId'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate and create footer link
        $data = $request->validate([
            'footer_section_id' => 'required|exists:footer_sections,id',
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);
        // Determine order if not provided
        if (empty($data['order'])) {
            $max = FooterLink::where('footer_section_id', $data['footer_section_id'])->max('order');
            $data['order'] = $max ? $max + 1 : 1;
        }
        FooterLink::create($data);
        return redirect()->route('admin.footer-sections.edit', $data['footer_section_id'])->with('success', 'Footer link created successfully.');
    }

    public function edit(int $id): View
    {
        $footerLink = FooterLink::findOrFail($id);
        $sections = FooterSection::orderBy('order')->get();
        return view('admin.footer_links.edit', compact('footerLink', 'sections'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $footerLink = FooterLink::findOrFail($id);
        $data = $request->validate([
            'footer_section_id' => 'required|exists:footer_sections,id',
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);
        if (empty($data['order'])) {
            $max = FooterLink::where('footer_section_id', $data['footer_section_id'])->max('order');
            $data['order'] = $max ? $max + 1 : 1;
        }
        $footerLink->update($data);
        return redirect()->route('admin.footer-sections.edit', $data['footer_section_id'])->with('success', 'Footer link updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $footerLink = FooterLink::findOrFail($id);
        $sectionId = $footerLink->footer_section_id;
        $footerLink->delete();
        return redirect()->route('admin.footer-sections.edit', $sectionId)->with('success', 'Footer link deleted successfully.');
    }
}