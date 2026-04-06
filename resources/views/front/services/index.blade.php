@extends('front.layouts.app')

@section('meta_title', $page->meta_title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)

@section('content')
<section class="bg-gray-100 py-16">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-6 text-center">{{ $page->title }}</h1>
        @if($page->content)
            <div class="max-w-3xl mx-auto text-lg text-gray-700 mb-10 leading-relaxed space-y-4">
                {!! $page->content !!}
            </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
                <div class="bg-white shadow rounded p-6 flex flex-col">
                    <div class="flex items-center mb-4">
                        <span class="text-primary text-3xl mr-3"><i class="fa {{ $service->icon }}"></i></span>
                        <h3 class="text-xl font-bold">{{ $service->title }}</h3>
                    </div>
                    <p class="text-gray-600 flex-1">{{ $service->short_description }}</p>
                    <div class="mt-6">
                        <a href="{{ route('services.show', $service->slug) }}" class="text-primary hover:text-secondary font-medium">Learn More &rarr;</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{-- Pagination --}}
            @include('front.partials.pagination', ['paginator' => $services])
        </div>
    </div>
</section>
@endsection