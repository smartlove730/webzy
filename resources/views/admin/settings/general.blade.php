@extends('admin.layouts.app')

@section('title', 'General Settings')
@section('page-title', 'General Settings')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.settings.general.update') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="site_title" class="block text-sm font-medium text-gray-700">Site Title</label>
                    <input type="text" name="site_title" id="site_title" value="{{ old('site_title', $settings['site_title'] ?? '') }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="site_tagline" class="block text-sm font-medium text-gray-700">Tagline</label>
                    <input type="text" name="site_tagline" id="site_tagline" value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="contact_email" class="block text-sm font-medium text-gray-700">Contact Email</label>
                    <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="contact_phone" class="block text-sm font-medium text-gray-700">Contact Phone</label>
                    <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" name="address" id="address" value="{{ old('address', $settings['address'] ?? '') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="md:col-span-2">
                    <label for="default_meta_title" class="block text-sm font-medium text-gray-700">Default Meta Title</label>
                    <input type="text" name="default_meta_title" id="default_meta_title" value="{{ old('default_meta_title', $settings['default_meta_title'] ?? '') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="md:col-span-2">
                    <label for="default_meta_description" class="block text-sm font-medium text-gray-700">Default Meta Description</label>
                    <textarea name="default_meta_description" id="default_meta_description" rows="3"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('default_meta_description', $settings['default_meta_description'] ?? '') }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label for="default_meta_keywords" class="block text-sm font-medium text-gray-700">Default Meta Keywords</label>
                    <input type="text" name="default_meta_keywords" id="default_meta_keywords" value="{{ old('default_meta_keywords', $settings['default_meta_keywords'] ?? '') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="comma,separated,keywords">
                </div>
                <div class="md:col-span-2">
                    <label for="default_canonical_url" class="block text-sm font-medium text-gray-700">Default Canonical URL</label>
                    <input type="url" name="default_canonical_url" id="default_canonical_url" value="{{ old('default_canonical_url', $settings['default_canonical_url'] ?? '') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="https://webzy.co.in">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Settings</button>
            </div>
        </form>
    </div>
@endsection