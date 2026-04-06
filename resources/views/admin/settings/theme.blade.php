@extends('admin.layouts.app')

@section('title', 'Theme Settings')
@section('page-title', 'Theme Settings')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.settings.theme.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="primary_color" class="block text-sm font-medium text-gray-700">Primary Color</label>
                    <input type="color" name="primary_color" id="primary_color" value="{{ old('primary_color', $theme->primary_color ?? '#0A65CC') }}"
                           class="mt-1 block w-32 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="secondary_color" class="block text-sm font-medium text-gray-700">Secondary Color</label>
                    <input type="color" name="secondary_color" id="secondary_color" value="{{ old('secondary_color', $theme->secondary_color ?? '#00A8E8') }}"
                           class="mt-1 block w-32 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
                    @if(!empty($theme->logo_path))
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$theme->logo_path) }}" alt="Logo" class="h-12">
                        </div>
                    @endif
                    <input type="file" name="logo" id="logo"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="favicon" class="block text-sm font-medium text-gray-700">Favicon</label>
                    @if(!empty($theme->favicon_path))
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$theme->favicon_path) }}" alt="Favicon" class="h-8">
                        </div>
                    @endif
                    <input type="file" name="favicon" id="favicon"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Theme</button>
            </div>
        </form>
    </div>
@endsection