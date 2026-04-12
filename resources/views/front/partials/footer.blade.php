@php
    use App\Models\FooterSection;
    use App\Models\SocialLink;
    use App\Models\Setting;
    $footerSections = FooterSection::with('links')->orderBy('order')->get();
    $socialLinks = SocialLink::orderBy('platform')->get();
    $settings = $settings ?? Setting::pluck('value', 'key')->toArray();
@endphp

<footer class="footer">
    <div class="container footer-grid">
        @foreach($footerSections as $section)
            <div class="footer-col">
                <h4>{{ $section->title }}</h4>
                @if($section->content)
                    <div>
                        {!! $section->content !!}
                    </div>
                @endif
                @if($section->links->count())
                    <div class="footer-links">
                        @foreach($section->links as $link)
                            <a href="{{ url($link->url) }}">{{ $link->title }}</a>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
        
        <!-- Newsletter column -->
        <div class="footer-col">
            <h4>Newsletter</h4>
            <p>Subscribe to receive news and updates.</p>
            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="footer-newsletter">
                @csrf
                <input type="email" name="email" placeholder="Your email" required>
                <button type="submit">Subscribe</button>
            </form>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="container footer-bottom-inner">
            <div class="footer-copyright">
                &copy; {{ date('Y') }} {{ $settings['site_title'] ?? config('app.name') }}. All rights reserved.
            </div>
            <div class="social-icons">
                @foreach($socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank" title="{{ $link->platform }}">
                        <i class="fa-brands {{ $link->icon }}"></i>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</footer>