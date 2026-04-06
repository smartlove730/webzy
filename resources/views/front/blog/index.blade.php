@extends('front.layouts.app')

@section('meta_title', $page->meta_title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)

@section('content')
<section class="bg-gray-100 py-16">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-6 text-center">{{ $page->title }}</h1>
        <div class="max-w-3xl mx-auto text-lg text-gray-700 mb-10 leading-relaxed space-y-4 text-center">
            {!! $page->content !!}
        </div>
        <div class="flex flex-col md:flex-row md:space-x-8">
            <!-- Posts list -->
            <div class="flex-1 space-y-8">
                @foreach($posts as $post)
                    <div class="bg-white shadow rounded overflow-hidden">
                        @if($post->featured_image)
                            <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->title }}" class="h-56 w-full object-cover">
                        @endif
                        <div class="p-6">
                            <span class="text-sm text-primary mb-2 block">{{ optional($post->category)->title }}</span>
                            <h3 class="text-2xl font-bold mb-2">{{ $post->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ $post->short_description }}</p>
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <span>{{ $post->published_at->format('F d, Y') }}</span>
                                <a href="{{ route('blog.show', $post->slug) }}" class="text-primary hover:text-secondary font-medium">Read More &rarr;</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="mt-8">
                    @include('front.partials.pagination', ['paginator' => $posts])
                </div>
            </div>
            <!-- Sidebar -->
            <aside class="mt-12 md:mt-0 w-full md:w-1/3">
                <div class="bg-white shadow rounded p-6 mb-8">
                    <h4 class="text-lg font-bold mb-4">Categories</h4>
                    <ul class="space-y-2">
                        @foreach($categories as $cat)
                            <li><a href="{{ url('/blog?category='.$cat->slug) }}" class="text-gray-700 hover:text-primary">{{ $cat->title }} ({{ $cat->blogPosts->where('is_published', true)->count() }})</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="bg-white shadow rounded p-6">
                    <h4 class="text-lg font-bold mb-4">Tags</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <a href="{{ url('/blog?tag='.$tag->slug) }}" class="text-sm text-gray-600 hover:text-primary border border-gray-300 rounded px-2 py-1">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection