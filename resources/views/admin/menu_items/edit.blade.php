@extends('admin.layouts.app')

@section('title', 'Edit Menu Item')
@section('page-title', 'Edit Menu Item')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.menu-items.update', $menuItem->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="menu_id" class="block text-sm font-medium text-gray-700">Menu</label>
                    <select name="menu_id" id="menu_id" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            onchange="location.href = '{{ route('admin.menu-items.edit', $menuItem->id) }}?menu_id=' + this.value">
                        <option value="">-- Select Menu --</option>
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}" {{ old('menu_id', $selectedMenu->id) == $menu->id ? 'selected' : '' }}>{{ $menu->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $menuItem->title) }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                    <input type="text" name="url" id="url" value="{{ old('url', $menuItem->url) }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="/about-us">
                </div>
                <div>
                    <label for="parent_id" class="block text-sm font-medium text-gray-700">Parent Item</label>
                    <select name="parent_id" id="parent_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- None --</option>
                        @foreach($parentItems as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id', $menuItem->parent_id) == $parent->id ? 'selected' : '' }}>{{ $parent->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700">Order</label>
                    <input type="number" name="order" id="order" value="{{ old('order', $menuItem->order) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Leave blank for auto">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Menu Item</button>
                <a href="{{ route('admin.menus.edit', $menuItem->menu_id) }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
@endsection