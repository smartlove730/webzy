@extends('admin.layouts.app')

@section('title', 'Edit Blog Category')
@section('page-title', 'Edit Blog Category')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.blog-categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $category->title) }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Leave blank to auto-generate">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $category->description) }}</textarea>
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Category</button>
                <a href="{{ route('admin.blog-categories.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
@endsection