<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Pages --}}
    @foreach($pages as $page)
        @php
            $loc = $page->slug === 'home' ? url('/') : url($page->slug);
        @endphp
        <url>
            <loc>{{ $loc }}</loc>
            <lastmod>{{ $page->updated_at->toAtomString() }}</lastmod>
            <priority>0.8</priority>
        </url>
    @endforeach
    {{-- Services --}}
    @foreach($services as $service)
        <url>
            <loc>{{ url('/services/'.$service->slug) }}</loc>
            <lastmod>{{ $service->updated_at->toAtomString() }}</lastmod>
            <priority>0.7</priority>
        </url>
    @endforeach
    {{-- Portfolio projects --}}
    @foreach($projects as $project)
        <url>
            <loc>{{ url('/portfolio/'.$project->slug) }}</loc>
            <lastmod>{{ $project->updated_at->toAtomString() }}</lastmod>
            <priority>0.7</priority>
        </url>
    @endforeach
    {{-- Blog posts --}}
    @foreach($posts as $post)
        <url>
            <loc>{{ url('/blog/'.$post->slug) }}</loc>
            <lastmod>{{ $post->updated_at->toAtomString() }}</lastmod>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>