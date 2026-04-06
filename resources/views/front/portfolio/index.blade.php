@extends('front.layouts.app')

@section('meta_title', $page->meta_title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)

@section('content')
<section class="bg-gray-100 py-16">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-6 text-center">{{ $page->title }}</h1>
        <div class="max-w-3xl mx-auto text-lg text-gray-700 mb-10 leading-relaxed space-y-4">
            {!! $page->content !!}
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($projects as $project)
                <div class="bg-white shadow rounded overflow-hidden flex flex-col">
                    @if($project->image)
                        <img src="{{ asset('storage/'.$project->image) }}" alt="{{ $project->title }}" class="h-48 w-full object-cover">
                    @endif
                    <div class="p-6 flex-1 flex flex-col">
                        <span class="text-sm text-primary mb-2">{{ $project->category }}</span>
                        <h3 class="text-xl font-bold mb-2">{{ $project->title }}</h3>
                        <p class="text-gray-600 flex-1">{{ $project->short_description }}</p>
                        <div class="mt-4">
                            <a href="{{ route('portfolio.show', $project->slug) }}" class="text-primary hover:text-secondary font-medium">View Project &rarr;</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            @include('front.partials.pagination', ['paginator' => $projects])
        </div>
    </div>
</section>
@endsection