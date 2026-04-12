@extends('front.layouts.app')

@section('meta_title', $service->meta_title)
@section('meta_description', $service->meta_description)
@section('meta_keywords', $service->meta_keywords)
@section('meta_type', 'article')
@section('meta_image', asset('storage/'.$service->image))
@section('canonical', url('/services/'.$service->slug))

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>{{ $service->title }}</h1>
            <div class="page-desc">{{ $service->short_description }}</div>
        </div>
    </section>

    <!-- Service Detail -->
    <section class="section" style="padding-top: 2rem;">
        <div class="container" style="max-width: 900px;">
            <div class="form-glass" style="border-radius: 24px;">
                @if($service->image)
                    <div style="margin-bottom: 2rem; border-radius: 16px; overflow: hidden;">
                        <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->title }}" style="width: 100%; height: 320px; object-fit: cover; display: block;">
                    </div>
                @endif
                <div style="color: var(--text-muted); font-size: 1.05rem; line-height: 1.9;">
                    {!! $service->description !!}
                </div>
                <div style="margin-top: 3rem; text-align: center;">
                    <a href="{{ url('/contact-us') }}" class="btn btn-primary">
                        Start Your Project <i class="fa fa-arrow-right" style="margin-left: 0.5rem;"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection