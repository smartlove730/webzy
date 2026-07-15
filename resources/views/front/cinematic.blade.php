<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Cinematic Experience — ' . config('app.name'))</title>
    <meta name="description" content="Experience the future of web design with an interactive 3D cinematic landing page.">
    <meta name="theme-color" content="#050505">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite(['resources/css/app.css', 'resources/css/cinematic.css', 'resources/js/cinematic-canvas.js'])
</head>

<body>
    {{-- Ambient CSS blobs --}}
    <div class="ambient-bg" aria-hidden="true">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>
    <div class="noise-overlay" aria-hidden="true"></div>

    {{-- THREE.JS WEBGL CANVAS --}}
    <canvas id="cinematic-canvas" aria-hidden="true"></canvas>

    {{-- Cinematic overlays --}}
    <div class="cin-vignette" aria-hidden="true"></div>
    <div class="cin-scanlines" aria-hidden="true"></div>

    {{-- SCROLLABLE UI --}}
    <div class="cinematic-overlay">

        {{-- HEADER --}}
        <header class="header" id="main-header">
            <nav class="container navbar">
                <a href="{{ route('home') }}" class="brand">Web<span>zy</span></a>
                <ul class="nav-links">
                    <li><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                    <li><a href="{{ route('about') }}" class="nav-link">About</a></li>
                    <li><a href="{{ route('services') }}" class="nav-link">Services</a></li>
                    <li><a href="{{ route('portfolio') }}" class="nav-link">Portfolio</a></li>
                    <li><a href="{{ route('blog') }}" class="nav-link">Blog</a></li>
                    <li><a href="{{ route('contact') }}" class="btn btn-primary" style="padding:.65rem 1.5rem;font-size:.9rem;">Contact</a></li>
                </ul>
                <button class="mobile-toggle" id="mobile-toggle" aria-label="Toggle navigation">☰</button>
            </nav>
            <div class="mobile-nav" id="mobile-nav">
                <div class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></div>
                <div class="nav-item"><a href="{{ route('about') }}" class="nav-link">About</a></div>
                <div class="nav-item"><a href="{{ route('services') }}" class="nav-link">Services</a></div>
                <div class="nav-item"><a href="{{ route('portfolio') }}" class="nav-link">Portfolio</a></div>
                <div class="nav-item"><a href="{{ route('blog') }}" class="nav-link">Blog</a></div>
                <div class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></div>
            </div>
        </header>

        {{-- ══ HERO ══ --}}
        <section class="cin-section cin-section--hero" id="section-hero">
            <div class="container" style="display:flex;flex-direction:column;align-items:center;">

                <div class="cin-hero__badge">
                    <span>Next-Gen Digital Experiences</span>
                </div>

                <h1 class="cin-hero__title">
                    <span class="cin-line">We Build</span>
                    <span class="cin-line"><span class="cin-highlight">Extraordinary</span></span>
                    <span class="cin-line">Digital Products</span>
                </h1>

                <p class="cin-hero__subtitle">
                    Crafting immersive web experiences that merge cutting-edge 3D technology
                    with pixel-perfect design. Welcome to the future of the web.
                </p>

                <div class="cin-hero__actions">
                    <a href="{{ route('portfolio') }}" class="btn btn-primary">View Our Work →</a>
                    <a href="{{ route('contact') }}" class="btn">Start a Project</a>
                </div>

                <div class="cin-scroll-indicator">
                    <div class="cin-scroll-indicator__line"></div>
                    <span>Scroll to Explore</span>
                </div>
            </div>
        </section>

        {{-- ══ FEATURES ══ --}}
        <section class="cin-section" id="section-features">
            <div class="container">
                <div class="cin-section-header reveal-on-scroll">
                    <span class="cin-section-label">What We Do</span>
                    <h2 class="cin-section-title text-gradient">Capabilities & Services</h2>
                    <div class="cin-divider"></div>
                    <p class="cin-section-desc">
                        From concept to deployment, we deliver full-spectrum digital solutions
                        that push the boundaries of what's possible on the web.
                    </p>
                </div>

                <div class="cin-feature-grid">
                    <div class="cin-glass-panel">
                        <div class="cin-feature-icon">🎨</div>
                        <h3 class="cin-feature-title">UI/UX Design</h3>
                        <p class="cin-feature-text">
                            Research-driven interfaces with glassmorphism, micro-animations,
                            and fluid typography that delight users.
                        </p>
                    </div>
                    <div class="cin-glass-panel">
                        <div class="cin-feature-icon">⚡</div>
                        <h3 class="cin-feature-title">Performance Engineering</h3>
                        <p class="cin-feature-text">
                            Sub-second load times, optimised asset pipelines, and
                            hardware-accelerated rendering for silky-smooth UX.
                        </p>
                    </div>
                    <div class="cin-glass-panel">
                        <div class="cin-feature-icon">🌐</div>
                        <h3 class="cin-feature-title">3D & WebGL</h3>
                        <p class="cin-feature-text">
                            Interactive Three.js scenes, scroll-driven animations,
                            and real-time 3D product configurators.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ══ SHOWCASE ══ --}}
        <section class="cin-section" id="section-showcase">
            <div class="container">
                <div class="cin-showcase-grid">
                    <div class="cin-showcase-content reveal-on-scroll">
                        <span class="cin-section-label">Why Choose Us</span>
                        <h3 class="text-gradient">Built for Scale.<br>Designed to Impress.</h3>
                        <p>
                            Every pixel is intentional. Every animation is buttery smooth.
                            We blend art-direction with engineering to deliver digital
                            experiences that convert visitors into loyal customers.
                        </p>
                        <div class="cin-stat-row">
                            <div class="cin-stat">
                                <span class="cin-stat__value">98%</span>
                                <span class="cin-stat__label">Satisfaction</span>
                            </div>
                            <div class="cin-stat">
                                <span class="cin-stat__value">150+</span>
                                <span class="cin-stat__label">Projects</span>
                            </div>
                            <div class="cin-stat">
                                <span class="cin-stat__value">4.9★</span>
                                <span class="cin-stat__label">Rating</span>
                            </div>
                        </div>
                    </div>
                    <div class="cin-glass-panel reveal-on-scroll" style="min-height:380px;display:flex;align-items:center;justify-content:center;">
                        <p style="color:rgba(255,255,255,0.2);font-size:0.9rem;text-align:center;">
                            <span style="font-size:2.5rem;display:block;margin-bottom:1rem;">✦</span>
                            3D Object Viewport<br>
                            <small>Scroll-driven mesh appears here</small>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ══ CTA ══ --}}
        <section class="cin-section" id="section-cta">
            <div class="cin-glass-panel cin-cta reveal-on-scroll" style="max-width:900px;margin:0 auto;">
                <span class="cin-section-label">Ready to Launch?</span>
                <h2 class="cin-cta__title text-gradient">Let's Create Something<br>Unforgettable</h2>
                <p class="cin-cta__text">
                    Whether you're building a product, rebranding, or pushing into 3D web —
                    we're the team to make it happen.
                </p>
                <div class="cin-hero__actions">
                    <a href="{{ route('contact') }}" class="btn btn-primary">Get in Touch →</a>
                    <a href="{{ route('portfolio') }}" class="btn">See Case Studies</a>
                </div>
            </div>
        </section>

        {{-- FOOTER --}}
        <footer class="footer">
            <div class="container footer-grid">
                <div class="footer-col">
                    <h4>Web<span style="color:var(--secondary)">zy</span></h4>
                    <p>Crafting next-generation digital experiences with cutting-edge technology and stunning design.</p>
                </div>
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <div class="footer-links">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('about') }}">About Us</a>
                        <a href="{{ route('services') }}">Services</a>
                        <a href="{{ route('portfolio') }}">Portfolio</a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Resources</h4>
                    <div class="footer-links">
                        <a href="{{ route('blog') }}">Blog</a>
                        <a href="{{ route('contact') }}">Contact</a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Newsletter</h4>
                    <p>Stay updated with our latest work and insights.</p>
                    <form class="footer-newsletter" action="{{ route('newsletter.subscribe') }}" method="POST">
                        @csrf
                        <input type="email" name="email" placeholder="you@example.com" required>
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container footer-bottom-inner">
                    <span class="footer-copyright">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</span>
                    <div class="social-icons">
                        <a href="#" aria-label="Twitter">𝕏</a>
                        <a href="#" aria-label="GitHub">⌨</a>
                        <a href="#" aria-label="LinkedIn">in</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        window.addEventListener('scroll', () => {
            document.getElementById('main-header')?.classList.toggle('scrolled', window.scrollY > 60);
        }, { passive: true });
        document.getElementById('mobile-toggle')?.addEventListener('click', () => {
            document.getElementById('mobile-nav')?.classList.toggle('open');
        });
    </script>
</body>
</html>
