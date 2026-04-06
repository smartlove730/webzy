@extends('front.layouts.app')

@section('meta_title', $page->meta_title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)

@section('content')
<section class="bg-gray-100 py-16">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-6">{{ $page->title }}</h1>
        <div class="max-w-3xl mx-auto text-lg leading-relaxed text-gray-700 space-y-5">
            {!! $page->content !!}
        </div>
        <div class="mt-10 text-center">
            <a href="{{ url('/services') }}" class="btn-primary px-5 py-3 rounded text-white font-medium">Explore Our Services</a>
        </div>
    </div>
</section>
@endsection