<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Menu;

/**
 * Controller to manage menus such as the primary navigation. Menus are
 * collections of menu items that can be ordered and nested.
 */
class MenuController extends Controller
{
    public function index(): View
    {
        $menus = Menu::orderBy('name')->paginate(20);
        return view('admin.menus.index', compact('menus'));
    }

    public function create(): View
    {
        $menu = new Menu();
        return view('admin.menus.create', compact('menu'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);
        Menu::create($data);
        return redirect()->route('admin.menus.index')->with('success', 'Menu created successfully.');
    }

    public function edit(int $id): View
    {
        $menu = Menu::with('items')->findOrFail($id);
        // Load all menus for potential parent selection of items. We'll pass to view
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $menu = Menu::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);
        $menu->update($data);
        return redirect()->route('admin.menus.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $menu = Menu::findOrFail($id);
        // delete associated items
        $menu->items()->delete();
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu deleted successfully.');
    }
}