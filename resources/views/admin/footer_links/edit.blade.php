@extends('admin.layouts.app')

@section('title', 'Edit Footer Link')
@section('page-title', 'Edit Footer Link')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.footer-links.update', $footerLink->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label for="footer_section_id" class="block text-sm font-medium text-gray-700">Section</label>
                    <select name="footer_section_id" id="footer_section_id" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}" {{ (old('footer_section_id', $footerLink->footer_section_id) == $section->id) ? 'selected' : '' }}>
                                {{ $section->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $footerLink->title) }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="url" class="block text-sm font-medium text-gray-700">URL</label>
                    <input type="text" name="url" id="url" value="{{ old('url', $footerLink->url) }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700">Order</label>
                    <input type="number" name="order" id="order" value="{{ old('order', $footerLink->order) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Auto">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Link</button>
                <a href="{{ route('admin.footer-sections.edit', $footerLink->footer_section_id) }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
@endsection