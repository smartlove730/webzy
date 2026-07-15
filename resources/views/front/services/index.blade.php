@extends('front.layouts.cinematic')

@section('meta_title', optional($page)->meta_title ?? 'Our Services')
@section('meta_description', optional($page)->meta_description ?? '')
@section('meta_keywords', optional($page)->meta_keywords ?? '')

@section('content')

    {{-- ══ PAGE HERO ══ --}}
    <section class="cin-page-hero">
        <div class="container" style="display:flex;flex-direction:column;align-items:center;">
            <span class="cin-section-label">What We Offer</span>
            <h1 class="cin-page-hero__title text-gradient">{{ optional($page)->title ?? 'Our Services' }}</h1>
            <p class="cin-page-hero__desc">
                @if(optional($page)->content)
                    {!! strip_tags($page->content) !!}
                @else
                    Full-spectrum digital solutions engineered for scale,
                    optimized for performance, and designed to impress.
                @endif
            </p>
            <div class="cin-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>Services</span>
            </div>
        </div>
    </section>

    {{-- ══ SERVICES GRID ══ --}}
    <section class="cin-page-section">
        <div class="container">
            <div class="cin-services-grid cin-stagger-grid">
                @foreach($services as $service)
                    <div class="cin-service-card cin-stagger-item">
                        <div class="cin-glass-panel cin-tilt-card">
                            <div class="cin-feature-icon">
                                <i class="fa {{ $service->icon ?? 'fa-cube' }}"></i>
                            </div>
                            <h3 class="cin-feature-title">{{ $service->title }}</h3>
                            <p class="cin-feature-text">{{ $service->short_description }}</p>
                            <a href="{{ route('services.show', $service->slug) }}" class="cin-service-link">
                                Learn More <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($services->lastPage() > 1)
                <nav class="cin-pagination" aria-label="Pagination">
                    @if ($services->currentPage() > 1)
                        <a href="{{ $services->url($services->currentPage() - 1) }}" rel="prev">&laquo;</a>
                    @endif
                    @for ($i = 1; $i <= $services->lastPage(); $i++)
                        @if($services->currentPage() == $i)
                            <span class="active">{{ $i }}</span>
                        @else
                            <a href="{{ $services->url($i) }}">{{ $i }}</a>
                        @endif
                    @endfor
                    @if ($services->currentPage() < $services->lastPage())
                        <a href="{{ $services->url($services->currentPage() + 1) }}" rel="next">&raquo;</a>
                    @endif
                </nav>
            @endif
        </div>
    </section>

    {{-- ══ CTA ══ --}}
    <section class="cin-page-section">
        <div class="cin-glass-panel cin-cta cin-reveal-scale" style="max-width:900px;margin:0 auto;">
            <span class="cin-section-label">Need Something Custom?</span>
            <h2 class="cin-cta__title text-gradient">Let's Discuss Your Project</h2>
            <p class="cin-cta__text">
                Don't see exactly what you need? We specialize in custom solutions
                tailored to your unique requirements.
            </p>
            <div class="cin-hero__actions">
                <a href="{{ route('contact') }}" class="btn btn-primary">Start a Conversation →</a>
            </div>
        </div>
    </section>

@endsection