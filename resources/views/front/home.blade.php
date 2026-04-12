@extends('front.layouts.app')

@section('meta_title', $page->meta_title ?? 'Home')
@section('meta_description', $page->meta_description ?? '')
@section('meta_keywords', $page->meta_keywords ?? '')

@section('content')
    {{-- Ultra Modern Hero Section --}}
    @php $hero = $sections['hero'] ?? null; @endphp
    @if($hero)
        <section class="hero reveal-scale">
            <div class="container relative z-10">
                <span class="hero-pill reveal-up" style="transition-delay: 0.1s;">Next-Gen Design Agency</span>
                <h1 class="hero-title text-gradient reveal-up" style="transition-delay: 0.2s;">
                    {{ $hero->title }}
                </h1>
                <div class="hero-text reveal-up" style="transition-delay: 0.3s;">
                    {!! $hero->content !!}
                </div>
                <div class="reveal-up" style="display:flex; gap:1.5rem; justify-content:center; transition-delay: 0.4s;">
                    <a href="{{ url('/portfolio') }}" class="btn btn-primary">Start a Project</a>
                    <a href="{{ url('/contact-us') }}" class="btn" style="border-color: rgba(255,255,255,0.2);">Learn More</a>
                </div>
            </div>
            
            <div class="marquee-container reveal">
                <div class="marquee">
                    <h2>Creative Design <span>•</span> Web Development <span>•</span> Digital Marketing <span>•</span> UI/UX <span>•</span> Branding <span>•</span></h2>
                    <h2>Creative Design <span>•</span> Web Development <span>•</span> Digital Marketing <span>•</span> UI/UX <span>•</span> Branding <span>•</span></h2>
                </div>
            </div>
        </section>
    @endif

    {{-- Advanced Bento Grid About Section --}}
    @php $about = $sections['about'] ?? null; @endphp
    @if($about)
        <section class="section container">
            <div class="bento-grid">
                <div class="bento-item large reveal-left">
                    <h2 class="section-title text-gradient-primary" style="text-align:left; font-size:2.8rem;">{{ $about->title }}</h2>
                    <div style="font-size:1.1rem; color:var(--text-muted); line-height:1.8; margin-top:2rem;">
                        {!! $about->content !!}
                    </div>
                </div>
                <div class="bento-item reveal-right" style="display:flex; flex-direction:column; justify-content:center; align-items:center; text-align:center;">
                    <i class="fa fa-rocket" style="font-size:3rem; color:var(--primary); margin-bottom:1rem;"></i>
                    <h3 style="font-size:1.25rem;">Ship Faster</h3>
                    <p style="color:var(--text-muted); margin-top:0.5rem;">Cutting-edge dev stacks</p>
                </div>
                <div class="bento-item reveal-up" style="background: linear-gradient(135deg, rgba(236, 72, 153, 0.1), rgba(79, 70, 229, 0.1)); border-color: rgba(236,72,153,0.3);">
                    <i class="fa fa-gem" style="font-size:3rem; color:var(--accent); margin-bottom:1rem;"></i>
                    <h3 style="font-size:1.25rem;">Premium Quality</h3>
                    <p style="color:var(--text-muted); margin-top:0.5rem;">Pixel-perfect attention to detail in every project.</p>
                </div>
            </div>
        </section>
    @endif

    {{-- Services Section with Glass Cards --}}
    @php $servicesSection = $sections['services'] ?? null; @endphp
    @if($servicesSection)
        <section class="section">
            <div class="container reveal-up">
                <h2 class="section-title text-gradient">{{ $servicesSection->title }}</h2>
                <div class="section-subtitle">{!! $servicesSection->content !!}</div>
                
                <div class="grid-cards">
                    @foreach($services as $index => $service)
                        <div class="glass-card reveal-up" style="transition-delay: {{ $index * 0.1 }}s;">
                            <div class="card-icon-wrap">
                                <i class="fa {{ $service->icon }}"></i>
                            </div>
                            <h3>{{ $service->title }}</h3>
                            <p>{{ $service->short_description }}</p>
                            <a href="{{ route('services.show', $service->slug) }}" class="nav-link" style="color:var(--secondary); padding:0; display:inline-flex;">
                                Discover <i class="fa fa-arrow-right" style="margin-left:8px; font-size:0.85rem;"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Portfolio Section --}}
    @php $portfolioSection = $sections['portfolio'] ?? null; @endphp
    @if($portfolioSection)
        <section class="section">
            <div class="container reveal-up">
                <h2 class="section-title text-gradient">{{ $portfolioSection->title }}</h2>
                <div class="section-subtitle">{!! $portfolioSection->content !!}</div>
                
                <div class="grid-cards">
                    @foreach($projects as $index => $project)
                        <div class="glass-card media-card reveal-up" style="transition-delay: {{ $index * 0.1 }}s; padding:1rem;">
                            <div class="img-container">
                                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=600&q=80" alt="{{ $project->title }}">
                                <div style="position:absolute; top:15px; right:15px; background:rgba(0,0,0,0.6); backdrop-filter:blur(10px); padding:4px 12px; border-radius:100px; font-size:0.8rem; font-weight:600; border:1px solid rgba(255,255,255,0.1);">
                                    {{ $project->client_name }}
                                </div>
                            </div>
                            <div style="padding:1rem;">
                                <h3>{{ $project->title }}</h3>
                                <p style="margin-bottom:0;">{{ $project->short_description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div style="text-align: center; margin-top: 4rem;" class="reveal-up">
                    <a href="{{ url('/portfolio') }}" class="btn">Explore All Work</a>
                </div>
            </div>
        </section>
    @endif

    {{-- Call to Action Section --}}
    @php $cta = $sections['cta'] ?? null; @endphp
    @if($cta)
        <div class="container reveal-scale" style="margin-bottom: 5rem;">
            <section class="cta-box">
                <h2 style="font-size:3rem; margin-bottom:1rem; letter-spacing:-1px;">{{ $cta->title }}</h2>
                <div style="font-size: 1.2rem; color:var(--text-muted); max-width:600px; margin:0 auto 3rem auto;">
                    {!! $cta->content !!}
                </div>
                <a href="{{ url('/contact-us') }}" class="btn btn-primary" style="font-size:1.1rem; padding:1.2rem 3rem;">Start Your Journey</a>
            </section>
        </div>
    @endif
@endsection