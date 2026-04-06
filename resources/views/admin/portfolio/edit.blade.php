@extends('admin.layouts.app')

@section('title', 'Edit Portfolio Item')
@section('page-title', 'Edit Portfolio Item')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $portfolio->title) }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $portfolio->slug) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Leave blank to auto-generate">
                </div>
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <input type="text" name="category" id="category" value="{{ old('category', $portfolio->category) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="client_name" class="block text-sm font-medium text-gray-700">Client Name</label>
                    <input type="text" name="client_name" id="client_name" value="{{ old('client_name', $portfolio->client_name) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="project_date" class="block text-sm font-medium text-gray-700">Project Date</label>
                    <input type="date" name="project_date" id="project_date" value="{{ old('project_date', optional($portfolio->project_date)->format('Y-m-d')) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location', $portfolio->location) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                    @if($portfolio->image)
                        <div class="mb-2">
                            <img src="{{ asset($portfolio->image) }}" alt="Portfolio Image" class="h-16 w-16 object-cover rounded">
                        </div>
                    @endif
                    <input type="file" name="image" id="image"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="md:col-span-2">
                    <label for="short_description" class="block text-sm font-medium text-gray-700">Short Description</label>
                    <textarea name="short_description" id="short_description" rows="3"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('short_description', $portfolio->short_description) }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="5"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $portfolio->description) }}</textarea>
                </div>
                <div>
                    <label for="meta_title" class="block text-sm font-medium text-gray-700">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $portfolio->meta_title) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" rows="2"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('meta_description', $portfolio->meta_description) }}</textarea>
                </div>
                <div>
                    <label for="meta_keywords" class="block text-sm font-medium text-gray-700">Meta Keywords</label>
                    <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $portfolio->meta_keywords) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="comma,separated,keywords">
                </div>
                <div class="flex items-center mt-4">
                    <input type="checkbox" name="status" id="status" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded" {{ old('status', $portfolio->status) ? 'checked' : '' }}>
                    <label for="status" class="ml-2 block text-sm text-gray-900">Active</label>
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Portfolio Item</button>
                <a href="{{ route('admin.portfolio.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
@endsection