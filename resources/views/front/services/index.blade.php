@extends('front.layouts.app')

@section('meta_title', $page->meta_title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>{{ $page->title }}</h1>
            @if($page->content)
                <div class="page-desc">
                    {!! $page->content !!}
                </div>
            @endif
        </div>
    </section>

    <!-- Services Grid -->
    <section class="section" style="padding-top: 2rem;">
        <div class="container">
            <div class="grid-cards">
                @foreach($services as $service)
                    <div class="service-card">
                        <div class="service-card-header">
                            <div class="service-card-icon">
                                <i class="fa {{ $service->icon }}"></i>
                            </div>
                            <h3 class="service-card-title">{{ $service->title }}</h3>
                        </div>
                        <p class="service-card-text">{{ $service->short_description }}</p>
                        <a href="{{ route('services.show', $service->slug) }}" class="service-card-link">
                            Learn More <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($services->lastPage() > 1)
                <nav class="pagination" aria-label="Pagination">
                    @if ($services->currentPage() > 1)
                        <a href="{{ $services->url($services->currentPage() - 1) }}" rel="prev">&laquo; Prev</a>
                    @endif
                    @for ($i = 1; $i <= $services->lastPage(); $i++)
                        @if($services->currentPage() == $i)
                            <span class="active">{{ $i }}</span>
                        @else
                            <a href="{{ $services->url($i) }}">{{ $i }}</a>
                        @endif
                    @endfor
                    @if ($services->currentPage() < $services->lastPage())
                        <a href="{{ $services->url($services->currentPage() + 1) }}" rel="next">Next &raquo;</a>
                    @endif
                </nav>
            @endif
        </div>
    </section>
@endsection