@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Pages Card -->
        <div class="bg-white p-5 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fa fa-file-lines text-3xl text-blue-500"></i>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold">Pages</h3>
                        <p class="text-2xl font-bold">{{ $metrics['pages'] }}</p>
                    </div>
                </div>
                <a href="{{ route('admin.pages.index') }}" class="text-blue-600 hover:underline">View</a>
            </div>
        </div>
        <!-- Services Card -->
        <div class="bg-white p-5 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fa fa-briefcase text-3xl text-green-500"></i>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold">Services</h3>
                        <p class="text-2xl font-bold">{{ $metrics['services'] }}</p>
                    </div>
                </div>
                <a href="{{ route('admin.services.index') }}" class="text-blue-600 hover:underline">View</a>
            </div>
        </div>
        <!-- Portfolio Card -->
        <div class="bg-white p-5 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fa fa-folder-open text-3xl text-purple-500"></i>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold">Portfolio</h3>
                        <p class="text-2xl font-bold">{{ $metrics['portfolio'] }}</p>
                    </div>
                </div>
                <a href="{{ route('admin.portfolio.index') }}" class="text-blue-600 hover:underline">View</a>
            </div>
        </div>
        <!-- Blog Posts Card -->
        <div class="bg-white p-5 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fa fa-blog text-3xl text-yellow-500"></i>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold">Blog Posts</h3>
                        <p class="text-2xl font-bold">{{ $metrics['blogPosts'] }}</p>
                    </div>
                </div>
                <a href="{{ route('admin.blogs.index') }}" class="text-blue-600 hover:underline">View</a>
            </div>
        </div>
        <!-- Subscribers Card -->
        <div class="bg-white p-5 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fa fa-envelope-open-text text-3xl text-orange-500"></i>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold">Subscribers</h3>
                        <p class="text-2xl font-bold">{{ $metrics['subscribers'] }}</p>
                    </div>
                </div>
                <a href="{{ route('admin.subscribers.index') }}" class="text-blue-600 hover:underline">View</a>
            </div>
        </div>
        <!-- Contacts Card -->
        <div class="bg-white p-5 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fa fa-message text-3xl text-red-500"></i>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold">Contacts</h3>
                        <p class="text-2xl font-bold">{{ $metrics['contacts'] }}</p>
                    </div>
                </div>
                <a href="{{ route('admin.contact-messages.index') }}" class="text-blue-600 hover:underline">View</a>
            </div>
        </div>
    </div>
@endsection