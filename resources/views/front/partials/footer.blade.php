@php
    use App\Models\FooterSection;
    use App\Models\SocialLink;
    use App\Models\Setting;
    $footerSections = FooterSection::with('links')->orderBy('order')->get();
    $socialLinks = SocialLink::orderBy('platform')->get();
    $settings = $settings ?? Setting::pluck('value', 'key')->toArray();
@endphp

<footer class="bg-gray-800 text-gray-200 mt-12">
    <div class="container mx-auto py-12 px-6 grid grid-cols-1 md:grid-cols-{{ $footerSections->count() + 1 }} gap-8">
        @foreach($footerSections as $section)
            <div>
                <h4 class="text-lg font-semibold mb-4 text-white">{{ $section->title }}</h4>
                @if($section->content)
                    <div class="text-sm text-gray-300 mb-4">
                        {!! $section->content !!}
                    </div>
                @endif
                @if($section->links->count())
                    <ul class="space-y-2">
                        @foreach($section->links as $link)
                            <li><a href="{{ url($link->url) }}" class="text-gray-300 hover:text-white">{{ $link->title }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
        <!-- Newsletter column -->
        <div>
            <h4 class="text-lg font-semibold mb-4 text-white">Newsletter</h4>
            <p class="text-sm text-gray-300 mb-4">Subscribe to receive news and updates.</p>
            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col sm:flex-row items-start sm:items-stretch">
                @csrf
                <input type="email" name="email" placeholder="Your email" required
                       class="w-full px-3 py-2 rounded-l sm:rounded-none sm:rounded-l-md border-gray-300 focus:ring-primary focus:border-primary mb-2 sm:mb-0">
                <button type="submit" class="sm:rounded-r-md px-4 py-2 bg-primary text-white hover:bg-secondary">Subscribe</button>
            </form>
        </div>
    </div>
    <div class="bg-gray-900 py-4">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
            <p class="text-sm text-gray-400">&copy; {{ date('Y') }} {{ $settings['site_title'] ?? config('app.name') }}. All rights reserved.</p>
            <div class="flex space-x-4 mt-2 md:mt-0">
                @foreach($socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank" class="text-gray-400 hover:text-white">
                        <i class="fa {{ $link->icon }} fa-lg"></i>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</footer>