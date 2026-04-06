@extends('front.layouts.app')

@section('meta_title', $post->meta_title)
@section('meta_description', $post->meta_description)
@section('meta_keywords', $post->meta_keywords)
@section('meta_type', 'article')
@section('meta_image', asset('storage/'.$post->featured_image))
@section('canonical', url('/blog/'.$post->slug))

@section('content')
<section class="bg-gray-100 py-16">
    <div class="container mx-auto px-6 max-w-3xl">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-4">{{ $post->title }}</h1>
        <div class="flex items-center text-sm text-gray-500 mb-4 space-x-2">
            <span>{{ optional($post->category)->title }}</span>
            <span>&bull;</span>
            <span>{{ $post->published_at->format('F d, Y') }}</span>
        </div>
        @if($post->featured_image)
            <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover rounded mb-6">
        @endif
        <div class="text-gray-700 leading-relaxed space-y-4">
            {!! $post->content !!}
        </div>
        <div class="mt-8">
            @foreach($post->tags as $tag)
                <a href="{{ url('/blog?tag='.$tag->slug) }}" class="inline-block text-sm text-primary border border-primary rounded px-2 py-1 mr-2 mb-2 hover:bg-primary hover:text-white">{{ $tag->name }}</a>
            @endforeach
        </div>

        {{-- Social sharing links --}}
        <div class="mt-8">
            <h4 class="font-bold mb-2">Share this article:</h4>
            <div class="flex space-x-4">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="text-primary hover:text-secondary"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&amp;text={{ urlencode($post->title) }}" target="_blank" class="text-primary hover:text-secondary"><i class="fab fa-twitter fa-lg"></i></a>
                <a href="https://www.linkedin.com/shareArticle?url={{ urlencode(request()->fullUrl()) }}&amp;title={{ urlencode($post->title) }}" target="_blank" class="text-primary hover:text-secondary"><i class="fab fa-linkedin-in fa-lg"></i></a>
            </div>
        </div>
        @if($related->count())
            <h3 class="mt-12 text-2xl font-bold text-gray-800">Related Posts</h3>
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($related as $r)
                    <div class="bg-white shadow rounded overflow-hidden">
                        @if($r->featured_image)
                            <img src="{{ asset('storage/'.$r->featured_image) }}" alt="{{ $r->title }}" class="h-40 w-full object-cover">
                        @endif
                        <div class="p-4">
                            <span class="text-sm text-primary mb-1 block">{{ optional($r->category)->title }}</span>
                            <h4 class="text-lg font-bold mb-1">{{ $r->title }}</h4>
                            <a href="{{ route('blog.show', $r->slug) }}" class="text-sm text-primary hover:text-secondary">Read More &rarr;</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="mt-10 text-center">
            <a href="{{ url('/blog') }}" class="btn-primary px-4 py-2 rounded">Back to Blog</a>
        </div>
    </div>
</section>
@endsection