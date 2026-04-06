@extends('front.layouts.app')

@section('meta_title', $service->meta_title)
@section('meta_description', $service->meta_description)
@section('meta_keywords', $service->meta_keywords)
@section('meta_type', 'article')
@section('meta_image', asset('storage/'.$service->image))
@section('canonical', url('/services/'.$service->slug))

@section('content')
<section class="bg-gray-100 py-16">
    <div class="container mx-auto px-6 max-w-4xl">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-4">{{ $service->title }}</h1>
        <p class="text-gray-600 text-lg mb-8">{{ $service->short_description }}</p>
        @if($service->image)
            <div class="mb-6">
                <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->title }}" class="w-full h-64 object-cover rounded">
            </div>
        @endif
        <div class="text-gray-700 leading-relaxed space-y-4">
            {!! $service->description !!}
        </div>
        <div class="mt-10">
            <a href="{{ url('/contact-us') }}" class="btn-primary px-5 py-3 rounded">Start Your Project</a>
        </div>
    </div>
</section>
@endsection