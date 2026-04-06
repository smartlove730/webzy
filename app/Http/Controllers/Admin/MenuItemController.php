<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Menu;
use App\Models\MenuItem;

/**
 * Manage individual menu items including nested items. Menu items define
 * the label, URL and ordering of entries in a menu. Each item belongs
 * to a menu and may have a parent item to create dropdowns.
 */
class MenuItemController extends Controller
{
    public function create(): View
    {
        $menus = Menu::orderBy('name')->get();
        $menuId = request('menu_id');
        $selectedMenu = $menuId ? Menu::find($menuId) : null;
        $parentItems = $selectedMenu ? $selectedMenu->items()->orderBy('title')->get() : collect();
        $menuItem = new MenuItem();
        return view('admin.menu_items.create', compact('menus', 'selectedMenu', 'parentItems', 'menuItem'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:menu_items,id',
            'order' => 'nullable|integer',
        ]);
        // Determine order; if not provided, set to next highest order
        if (empty($data['order'])) {
            $max = MenuItem::where('menu_id', $data['menu_id'])->max('order');
            $data['order'] = $max ? $max + 1 : 1;
        }
        MenuItem::create($data);
        return redirect()->route('admin.menus.edit', $data['menu_id'])->with('success', 'Menu item added successfully.');
    }

    public function edit(int $id): View
    {
        $menuItem = MenuItem::findOrFail($id);
        $menus = Menu::orderBy('name')->get();
        $selectedMenu = $menuItem->menu;
        $parentItems = $selectedMenu->items()->where('id', '!=', $menuItem->id)->orderBy('title')->get();
        return view('admin.menu_items.edit', compact('menuItem', 'menus', 'selectedMenu', 'parentItems'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $menuItem = MenuItem::findOrFail($id);
        $data = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:menu_items,id',
            'order' => 'nullable|integer',
        ]);
        if (empty($data['order'])) {
            $max = MenuItem::where('menu_id', $data['menu_id'])->max('order');
            $data['order'] = $max ? $max + 1 : 1;
        }
        $menuItem->update($data);
        return redirect()->route('admin.menus.edit', $menuItem->menu_id)->with('success', 'Menu item updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $menuItem = MenuItem::findOrFail($id);
        $menuId = $menuItem->menu_id;
        // Delete item and its children
        $this->deleteItemRecursive($menuItem);
        return redirect()->route('admin.menus.edit', $menuId)->with('success', 'Menu item deleted successfully.');
    }

    /**
     * Recursively delete a menu item and its children.
     */
    protected function deleteItemRecursive(MenuItem $item)
    {
        foreach ($item->children as $child) {
            $this->deleteItemRecursive($child);
        }
        $item->delete();
    }
}