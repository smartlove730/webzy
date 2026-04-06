@extends('admin.layouts.app')

@section('title', 'Social Links')
@section('page-title', 'Social Links')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Social Links</h2>
        <a href="{{ route('admin.social-links.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Add Social Link</a>
    </div>
    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Platform</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icon</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($links as $link)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $link->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $link->platform }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600">
                            <a href="{{ $link->url }}" target="_blank" class="hover:underline">{{ $link->url }}</a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><i class="fa {{ $link->icon }}"></i> {{ $link->icon }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <a href="{{ route('admin.social-links.edit', $link->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                            <form action="{{ route('admin.social-links.destroy', $link->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No social links found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $links->links() }}
    </div>
@endsection