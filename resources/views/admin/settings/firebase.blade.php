@extends('admin.layouts.app')

@section('title', 'Firebase Settings')
@section('page-title', 'Firebase Settings')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.settings.firebase.update') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label for="server_key" class="block text-sm font-medium text-gray-700">Server Key</label>
                    <input type="text" name="server_key" id="server_key" value="{{ old('server_key', $firebase->server_key ?? '') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="md:col-span-2">
                    <label for="sender_id" class="block text-sm font-medium text-gray-700">Sender ID</label>
                    <input type="text" name="sender_id" id="sender_id" value="{{ old('sender_id', $firebase->sender_id ?? '') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="md:col-span-2">
                    <label for="project_id" class="block text-sm font-medium text-gray-700">Project ID</label>
                    <input type="text" name="project_id" id="project_id" value="{{ old('project_id', $firebase->project_id ?? '') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Firebase Settings</button>
            </div>
        </form>
    </div>
@endsection