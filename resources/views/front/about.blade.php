@extends('front.layouts.cinematic')

@section('meta_title', $page->meta_title ?? 'About Us')
@section('meta_description', $page->meta_description ?? '')
@section('meta_keywords', $page->meta_keywords ?? '')

@section('content')

    {{-- ══ PAGE HERO ══ --}}
    <section class="cin-page-hero">
        <div class="container" style="display:flex;flex-direction:column;align-items:center;">
            <span class="cin-section-label">Who We Are</span>
            <h1 class="cin-page-hero__title text-gradient">{{ $page->title ?? 'About Us' }}</h1>
            <p class="cin-page-hero__desc">
                We're a team of passionate technologists, designers, and strategists
                building the future of digital experiences.
            </p>
            <div class="cin-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>About Us</span>
            </div>
        </div>
    </section>

    {{-- ══ STORY SECTION ══ --}}
    <section class="cin-page-section">
        <div class="container">
            <div class="cin-two-col">
                <div class="cin-reveal-left">
                    <span class="cin-section-label">Our Story</span>
                    <h2 class="cin-section-title text-gradient" style="text-align:left;">
                        Born from a Vision.<br>Driven by Innovation.
                    </h2>
                    <div style="color:var(--text-muted);line-height:1.9;margin-top:1.5rem;">
                        @if($page->content)
                            {!! $page->content !!}
                        @else
                            <p>We started with a simple belief: technology should inspire.
                            Every project we undertake is a chance to push boundaries,
                            challenge conventions, and create something truly extraordinary.</p>
                        @endif
                    </div>
                </div>
                <div class="cin-reveal-right">
                    <div class="cin-glass-panel" style="padding:3rem;text-align:center;">
                        <div class="cin-stat-row" style="flex-direction:column;gap:2.5rem;">
                            <div class="cin-stat" style="align-items:center;">
                                <span class="cin-stat__value cin-counter" data-target="150" data-suffix="+">0</span>
                                <span class="cin-stat__label">Projects Delivered</span>
                            </div>
                            <div class="cin-stat" style="align-items:center;">
                                <span class="cin-stat__value cin-counter" data-target="98" data-suffix="%">0</span>
                                <span class="cin-stat__label">Client Satisfaction</span>
                            </div>
                            <div class="cin-stat" style="align-items:center;">
                                <span class="cin-stat__value cin-counter" data-target="12" data-suffix="+">0</span>
                                <span class="cin-stat__label">Years of Experience</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══ VALUES ══ --}}
    <section class="cin-page-section cin-page-section--alt">
        <div class="container">
            <div class="cin-section-header cin-reveal">
                <span class="cin-section-label">What We Stand For</span>
                <h2 class="cin-section-title text-gradient">Our Core Values</h2>
                <div class="cin-divider"></div>
            </div>

            <div class="cin-values-grid cin-stagger-grid">
                <div class="cin-glass-panel cin-tilt-card cin-stagger-item">
                    <div class="cin-feature-icon">🎯</div>
                    <h3 class="cin-feature-title">Precision</h3>
                    <p class="cin-feature-text">
                        Every pixel matters. We obsess over the details that make
                        the difference between good and extraordinary.
                    </p>
                </div>
                <div class="cin-glass-panel cin-tilt-card cin-stagger-item">
                    <div class="cin-feature-icon">🚀</div>
                    <h3 class="cin-feature-title">Innovation</h3>
                    <p class="cin-feature-text">
                        We embrace emerging technologies and push boundaries
                        to create solutions that don't exist yet.
                    </p>
                </div>
                <div class="cin-glass-panel cin-tilt-card cin-stagger-item">
                    <div class="cin-feature-icon">🤝</div>
                    <h3 class="cin-feature-title">Partnership</h3>
                    <p class="cin-feature-text">
                        Your success is our success. We work as an extension
                        of your team, not just a vendor.
                    </p>
                </div>
                <div class="cin-glass-panel cin-tilt-card cin-stagger-item">
                    <div class="cin-feature-icon">⚡</div>
                    <h3 class="cin-feature-title">Performance</h3>
                    <p class="cin-feature-text">
                        Fast, accessible, and optimized. We engineer experiences
                        that perform flawlessly at scale.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ══ JOURNEY TIMELINE ══ --}}
    <section class="cin-page-section">
        <div class="container">
            <div class="cin-section-header cin-reveal">
                <span class="cin-section-label">Our Journey</span>
                <h2 class="cin-section-title text-gradient">Milestones</h2>
                <div class="cin-divider"></div>
            </div>

            <div class="cin-timeline">
                <div class="cin-timeline-item cin-reveal">
                    <div class="cin-timeline-dot"></div>
                    <div class="cin-timeline-content cin-glass-panel">
                        <span class="cin-timeline-year">2014</span>
                        <h3 class="cin-feature-title">Founded</h3>
                        <p class="cin-feature-text">Started as a two-person studio with a dream to redefine web experiences.</p>
                    </div>
                </div>
                <div class="cin-timeline-item cin-reveal">
                    <div class="cin-timeline-dot"></div>
                    <div class="cin-timeline-content cin-glass-panel">
                        <span class="cin-timeline-year">2017</span>
                        <h3 class="cin-feature-title">50 Projects Milestone</h3>
                        <p class="cin-feature-text">Crossed our first major milestone and expanded the team to 10 specialists.</p>
                    </div>
                </div>
                <div class="cin-timeline-item cin-reveal">
                    <div class="cin-timeline-dot"></div>
                    <div class="cin-timeline-content cin-glass-panel">
                        <span class="cin-timeline-year">2020</span>
                        <h3 class="cin-feature-title">3D & WebGL Division</h3>
                        <p class="cin-feature-text">Launched our interactive 3D division, pioneering immersive web experiences.</p>
                    </div>
                </div>
                <div class="cin-timeline-item cin-reveal">
                    <div class="cin-timeline-dot"></div>
                    <div class="cin-timeline-content cin-glass-panel">
                        <span class="cin-timeline-year">2024</span>
                        <h3 class="cin-feature-title">Global Reach</h3>
                        <p class="cin-feature-text">Serving clients across 15+ countries with a fully remote-first culture.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══ CTA ══ --}}
    <section class="cin-page-section">
        <div class="cin-glass-panel cin-cta cin-reveal-scale" style="max-width:900px;margin:0 auto;">
            <span class="cin-section-label">Join Forces</span>
            <h2 class="cin-cta__title text-gradient">Let's Build the Future Together</h2>
            <p class="cin-cta__text">
                Ready to transform your digital presence? Let's talk about
                what extraordinary looks like for your brand.
            </p>
            <div class="cin-hero__actions">
                <a href="{{ route('contact') }}" class="btn btn-primary">Get in Touch →</a>
                <a href="{{ route('services') }}" class="btn">Explore Services</a>
            </div>
        </div>
    </section>

@endsection