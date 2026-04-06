@extends('admin.layouts.app')

@section('title', 'Edit Social Link')
@section('page-title', 'Edit Social Link')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.social-links.update', $socialLink->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="platform" class="block text-sm font-medium text-gray-700">Platform</label>
                    <input type="text" name="platform" id="platform" value="{{ old('platform', $socialLink->platform) }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                    <input type="url" name="url" id="url" value="{{ old('url', $socialLink->url) }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="md:col-span-2">
                    <label for="icon" class="block text-sm font-medium text-gray-700">Icon Class (FontAwesome)</label>
                    <input type="text" name="icon" id="icon" value="{{ old('icon', $socialLink->icon) }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="fa-brands fa-linkedin">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Link</button>
                <a href="{{ route('admin.social-links.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
@endsection