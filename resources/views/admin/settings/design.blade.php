@extends('admin.layouts.app')

@section('title', 'Design Settings')
@section('page-title', 'Design Settings')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.settings.design.update') }}" method="POST">
            @csrf
            <div>
                <label for="custom_css" class="block text-sm font-medium text-gray-700">Custom CSS</label>
                <p class="mt-1 text-sm text-gray-500">Add CSS rules that will be injected site-wide. Save with valid CSS only.</p>
                <textarea name="custom_css" id="custom_css" rows="16"
                          class="mt-2 block w-full border-gray-300 rounded-md shadow-sm font-mono text-sm focus:ring-blue-500 focus:border-blue-500"
                          placeholder="/* Example: */&#10;.hero-title {&#10;  letter-spacing: 0.04em;&#10;}">{{ old('custom_css', $settings['custom_css'] ?? '') }}</textarea>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Design Settings</button>
            </div>
        </form>
    </div>
@endsection
