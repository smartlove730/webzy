@extends('admin.layouts.app')

@section('title', 'SEO Settings')
@section('page-title', 'SEO Settings')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.settings.seo.update') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="default_meta_title" class="block text-sm font-medium text-gray-700">Default Meta Title</label>
                    <input type="text" name="default_meta_title" id="default_meta_title" value="{{ old('default_meta_title', $settings['default_meta_title'] ?? '') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="default_meta_description" class="block text-sm font-medium text-gray-700">Default Meta Description</label>
                    <textarea name="default_meta_description" id="default_meta_description" rows="3"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('default_meta_description', $settings['default_meta_description'] ?? '') }}</textarea>
                </div>
                <div>
                    <label for="default_meta_keywords" class="block text-sm font-medium text-gray-700">Default Meta Keywords</label>
                    <input type="text" name="default_meta_keywords" id="default_meta_keywords" value="{{ old('default_meta_keywords', $settings['default_meta_keywords'] ?? '') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="comma,separated,keywords">
                </div>
                <div>
                    <label for="default_canonical_url" class="block text-sm font-medium text-gray-700">Default Canonical URL</label>
                    <input type="url" name="default_canonical_url" id="default_canonical_url" value="{{ old('default_canonical_url', $settings['default_canonical_url'] ?? '') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="https://webzy.co.in">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save SEO Settings</button>
            </div>
        </form>
    </div>
@endsection