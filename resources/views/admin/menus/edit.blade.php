@extends('admin.layouts.app')

@section('title', 'Edit Menu')
@section('page-title', 'Edit Menu')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Menu Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $menu->name) }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location', $menu->location) }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Menu</button>
                <a href="{{ route('admin.menus.index') }}" class="ml-2 text-gray-600 hover:underline">Back</a>
            </div>
        </form>
    </div>

    <!-- Menu Items -->
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Menu Items</h3>
        <a href="{{ route('admin.menu-items.create', ['menu_id' => $menu->id]) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Add Item</a>
    </div>
    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parent</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($menu->items->sortBy('order') as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->url }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ optional($item->parent)->title ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->order }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <a href="{{ route('admin.menu-items.edit', $item->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                            <form action="{{ route('admin.menu-items.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No items found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection