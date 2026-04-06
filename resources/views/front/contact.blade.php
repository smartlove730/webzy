@extends('front.layouts.app')

@section('meta_title', $page->meta_title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)

@section('content')
<section class="bg-gray-100 py-16">
    <div class="container mx-auto px-6 max-w-3xl">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-6 text-center">{{ $page->title }}</h1>
        <div class="text-gray-700 mb-8 leading-relaxed space-y-4">
            {!! $page->content !!}
        </div>
        @if(!empty($status))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
                {{ $status }}
            </div>
        @endif
        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4 bg-white shadow rounded p-6">
            @csrf
            <div>
                <label for="name" class="block text-gray-700 font-medium">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 mt-1 @error('name') border-red-500 @enderror"
                       required>
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 mt-1 @error('email') border-red-500 @enderror"
                       required>
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="subject" class="block text-gray-700 font-medium">Subject</label>
                <input type="text" name="subject" id="subject" value="{{ old('subject') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 mt-1 @error('subject') border-red-500 @enderror"
                       required>
                @error('subject')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="message" class="block text-gray-700 font-medium">Message</label>
                <textarea name="message" id="message" rows="5"
                          class="w-full border border-gray-300 rounded px-3 py-2 mt-1 @error('message') border-red-500 @enderror"
                          required>{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn-primary px-5 py-3 rounded">Send Message</button>
            </div>
        </form>
        <div class="mt-8 text-gray-700">
            <h3 class="text-2xl font-bold mb-4">Contact Details</h3>
            <p class="mb-2"><strong>Address:</strong> {{ $settings['address'] ?? '' }}</p>
            <p class="mb-2"><strong>Email:</strong> <a href="mailto:{{ $settings['contact_email'] ?? '' }}" class="text-primary hover:underline">{{ $settings['contact_email'] ?? '' }}</a></p>
            <p><strong>Phone:</strong> <a href="tel:{{ $settings['contact_phone'] ?? '' }}" class="text-primary hover:underline">{{ $settings['contact_phone'] ?? '' }}</a></p>
        </div>
    </div>
</section>
@endsection