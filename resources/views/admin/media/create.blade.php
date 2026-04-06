@extends('admin.layouts.app')

@section('title', 'Upload Media')
@section('page-title', 'Upload Media')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="file" class="block text-sm font-medium text-gray-700">Choose File</label>
                    <input type="file" name="file" id="file" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Upload</button>
                <a href="{{ route('admin.media.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
@endsection