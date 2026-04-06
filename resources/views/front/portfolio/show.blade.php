@extends('front.layouts.app')

@section('meta_title', $project->meta_title)
@section('meta_description', $project->meta_description)
@section('meta_keywords', $project->meta_keywords)
@section('meta_type', 'article')
@section('meta_image', asset('storage/'.$project->image))
@section('canonical', url('/portfolio/'.$project->slug))

@section('content')
<section class="bg-gray-100 py-16">
    <div class="container mx-auto px-6 max-w-4xl">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-4">{{ $project->title }}</h1>
        <div class="text-sm text-gray-500 mb-6 flex flex-wrap space-y-2 md:space-y-0 md:space-x-4">
            <span><strong>Client:</strong> {{ $project->client_name }}</span>
            <span><strong>Category:</strong> {{ $project->category }}</span>
            <span><strong>Date:</strong> {{ \Carbon\Carbon::parse($project->project_date)->format('F d, Y') }}</span>
            <span><strong>Location:</strong> {{ $project->location }}</span>
        </div>
        @if($project->image)
            <img src="{{ asset('storage/'.$project->image) }}" alt="{{ $project->title }}" class="w-full h-64 object-cover rounded mb-6">
        @endif
        <div class="text-gray-700 leading-relaxed space-y-4">
            {!! $project->description !!}
        </div>
        <div class="mt-10">
            <a href="{{ url('/contact-us') }}" class="btn-primary px-5 py-3 rounded">Start a Similar Project</a>
        </div>
    </div>
</section>
@endsection