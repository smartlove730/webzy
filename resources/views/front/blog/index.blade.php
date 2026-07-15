@extends('front.layouts.cinematic')

@section('meta_title', optional($page)->meta_title ?? 'Blog')
@section('meta_description', optional($page)->meta_description ?? '')
@section('meta_keywords', optional($page)->meta_keywords ?? '')

@section('content')

    {{-- ══ PAGE HERO ══ --}}
    <section class="cin-page-hero">
        <div class="container" style="display:flex;flex-direction:column;align-items:center;">
            <span class="cin-section-label">Insights & Stories</span>
            <h1 class="cin-page-hero__title text-gradient">{{ optional($page)->title ?? 'Our Blog' }}</h1>
            <p class="cin-page-hero__desc">
                @if(optional($page)->content)
                    {!! strip_tags($page->content) !!}
                @else
                    Thoughts, tutorials, and insights from our team on design,
                    development, and the future of the web.
                @endif
            </p>
            <div class="cin-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>Blog</span>
            </div>
        </div>
    </section>

    {{-- ══ BLOG LAYOUT ══ --}}
    <section class="cin-page-section">
        <div class="container">
            <div class="cin-blog-layout">

                {{-- Posts --}}
                <div>
                    @foreach($posts as $post)
                        <article class="cin-blog-card cin-reveal">
                            @if($post->featured_image)
                                <img src="{{ asset('storage/'.$post->featured_image) }}"
                                    alt="{{ $post->title }}"
                                    class="cin-blog-card__img">
                            @else
                                <div style="height:240px;background:linear-gradient(135deg,rgba(79,70,229,0.12),rgba(6,182,212,0.08));display:flex;align-items:center;justify-content:center;">
                                    <span style="font-size:3rem;opacity:0.2;">✎</span>
                                </div>
                            @endif
                            <div class="cin-blog-card__body">
                                <span class="cin-blog-card__category">{{ optional($post->category)->title ?? 'Uncategorized' }}</span>
                                <h2 class="cin-blog-card__title">{{ $post->title }}</h2>
                                <p class="cin-blog-card__text">{{ $post->short_description }}</p>
                                <div class="cin-blog-card__meta">
                                    <span>{{ $post->published_at->format('M d, Y') }}</span>
                                    <a href="{{ route('blog.show', $post->slug) }}">Read More →</a>
                                </div>
                            </div>
                        </article>
                    @endforeach

                    @if($posts->lastPage() > 1)
                        <nav class="cin-pagination" aria-label="Pagination">
                            @if ($posts->currentPage() > 1)
                                <a href="{{ $posts->url($posts->currentPage() - 1) }}" rel="prev">&laquo;</a>
                            @endif
                            @for ($i = 1; $i <= $posts->lastPage(); $i++)
                                @if($posts->currentPage() == $i)
                                    <span class="active">{{ $i }}</span>
                                @else
                                    <a href="{{ $posts->url($i) }}">{{ $i }}</a>
                                @endif
                            @endfor
                            @if ($posts->currentPage() < $posts->lastPage())
                                <a href="{{ $posts->url($posts->currentPage() + 1) }}" rel="next">&raquo;</a>
                            @endif
                        </nav>
                    @endif
                </div>

                {{-- Sidebar --}}
                <aside class="cin-sidebar">
                    {{-- Categories --}}
                    <div class="cin-glass-panel cin-reveal">
                        <h4>Categories</h4>
                        <ul class="cin-sidebar-list">
                            @foreach($categories as $cat)
                                <li>
                                    <a href="{{ url('/blog?category='.$cat->slug) }}">
                                        {{ $cat->title }}
                                        <span style="opacity:0.4;">({{ $cat->blogPosts->where('is_published', true)->count() }})</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Tags --}}
                    <div class="cin-glass-panel cin-reveal">
                        <h4>Tags</h4>
                        <div class="cin-tag-cloud">
                            @foreach($tags as $tag)
                                <a href="{{ url('/blog?tag='.$tag->slug) }}" class="cin-tag">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Newsletter CTA --}}
                    <div class="cin-glass-panel cin-reveal" style="text-align:center;">
                        <div style="font-size:2rem;margin-bottom:1rem;">📮</div>
                        <h4>Stay Updated</h4>
                        <p style="color:var(--text-muted);font-size:0.9rem;margin-bottom:1.5rem;">
                            Get the latest insights delivered to your inbox.
                        </p>
                        <form action="{{ route('newsletter.subscribe') }}" method="POST">
                            @csrf
                            <input type="email" name="email" placeholder="your@email.com"
                                class="cin-form-input" style="margin-bottom:0.75rem;" required>
                            <button type="submit" class="cin-form-btn" style="width:100%;justify-content:center;padding:0.8rem;">
                                Subscribe
                            </button>
                        </form>
                    </div>
                </aside>

            </div>
        </div>
    </section>

@endsection