@extends('front.layouts.cinematic')

@section('meta_title', optional($page)->meta_title ?? 'Portfolio')
@section('meta_description', optional($page)->meta_description ?? '')
@section('meta_keywords', optional($page)->meta_keywords ?? '')

@section('content')

    {{-- ══ PAGE HERO ══ --}}
    <section class="cin-page-hero">
        <div class="container" style="display:flex;flex-direction:column;align-items:center;">
            <span class="cin-section-label">Our Work</span>
            <h1 class="cin-page-hero__title text-gradient">{{ optional($page)->title ?? 'Portfolio' }}</h1>
            <p class="cin-page-hero__desc">
                @if(optional($page)->content)
                    {!! strip_tags($page->content) !!}
                @else
                    Explore our latest projects — each one a testament to our commitment
                    to exceptional design and engineering.
                @endif
            </p>
            <div class="cin-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>Portfolio</span>
            </div>
        </div>
    </section>

    {{-- ══ PORTFOLIO GRID ══ --}}
    <section class="cin-page-section">
        <div class="container">
            <div class="cin-portfolio-grid cin-stagger-grid">
                @foreach($projects as $project)
                    <div class="cin-portfolio-card cin-stagger-item">
                        @if($project->image)
                            <div style="overflow:hidden;">
                                <img src="{{ asset('storage/'.$project->image) }}"
                                    alt="{{ $project->title }}"
                                    class="cin-portfolio-card__img">
                            </div>
                        @else
                            <div style="height:220px;background:linear-gradient(135deg,rgba(79,70,229,0.15),rgba(6,182,212,0.1));display:flex;align-items:center;justify-content:center;">
                                <span style="font-size:3rem;opacity:0.3;">✦</span>
                            </div>
                        @endif
                        <div class="cin-portfolio-card__body">
                            <span class="cin-portfolio-card__category">{{ $project->category ?? 'Project' }}</span>
                            <h3 class="cin-portfolio-card__title">{{ $project->title }}</h3>
                            <p class="cin-portfolio-card__text">{{ $project->short_description }}</p>
                            <a href="{{ route('portfolio.show', $project->slug) }}" class="cin-service-link">
                                View Project <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($projects->lastPage() > 1)
                <nav class="cin-pagination" aria-label="Pagination">
                    @if ($projects->currentPage() > 1)
                        <a href="{{ $projects->url($projects->currentPage() - 1) }}" rel="prev">&laquo;</a>
                    @endif
                    @for ($i = 1; $i <= $projects->lastPage(); $i++)
                        @if($projects->currentPage() == $i)
                            <span class="active">{{ $i }}</span>
                        @else
                            <a href="{{ $projects->url($i) }}">{{ $i }}</a>
                        @endif
                    @endfor
                    @if ($projects->currentPage() < $projects->lastPage())
                        <a href="{{ $projects->url($projects->currentPage() + 1) }}" rel="next">&raquo;</a>
                    @endif
                </nav>
            @endif
        </div>
    </section>

@endsection