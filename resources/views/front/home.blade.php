@extends('front.layouts.app')

@section('meta_title', $page->meta_title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)

@section('content')
    {{-- Hero Section --}}
    @php $hero = $sections['hero'] ?? null; @endphp
    @if($hero)
        <section class="bg-primary text-white py-24">
            <div class="container mx-auto px-6 text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">{{ $hero->title }}</h1>
                <div class="max-w-3xl mx-auto text-lg leading-relaxed">
                    {!! $hero->content !!}
                </div>
            </div>
        </section>
    @endif

    {{-- About Section --}}
    @php $about = $sections['about'] ?? null; @endphp
    @if($about)
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-6 md:px-12 lg:px-16">
                <h2 class="text-3xl font-bold mb-4 text-gray-800 text-center md:text-left">{{ $about->title }}</h2>
                <div class="text-gray-600 leading-relaxed max-w-3xl mx-auto md:mx-0">
                    {!! $about->content !!}
                </div>
            </div>
        </section>
    @endif

    {{-- Services Section --}}
    @php $servicesSection = $sections['services'] ?? null; @endphp
    @if($servicesSection)
        <section class="py-16 bg-white">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold mb-4 text-gray-800">{{ $servicesSection->title }}</h2>
                <p class="text-gray-600 max-w-2xl mx-auto mb-10">{!! $servicesSection->content !!}</p>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($services as $service)
                        <div class="bg-gray-100 p-6 rounded-lg shadow-md hover:shadow-lg transition">
                            <div class="flex items-center justify-center h-12 w-12 mx-auto mb-4 text-primary">
                                <i class="fa {{ $service->icon }} fa-2x"></i>
                            </div>
                            <h3 class="text-xl font-semibold mb-2 text-gray-800">{{ $service->title }}</h3>
                            <p class="text-gray-600 text-sm">{{ $service->short_description }}</p>
                            <a href="{{ route('services.show', $service->slug) }}" class="text-primary hover:underline mt-3 inline-block">Learn more</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Portfolio Section --}}
    @php $portfolioSection = $sections['portfolio'] ?? null; @endphp
    @if($portfolioSection)
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold mb-4 text-gray-800">{{ $portfolioSection->title }}</h2>
                <p class="text-gray-600 max-w-2xl mx-auto mb-10">{!! $portfolioSection->content !!}</p>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($projects as $project)
                        <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition">
                            <div class="h-48 bg-gray-200 flex items-center justify-center">
                                <!-- Placeholder for project image -->
                                <span class="text-gray-400">{{ $project->client_name }}</span>
                            </div>
                            <div class="p-4 text-left">
                                <h3 class="text-xl font-semibold mb-2 text-gray-800">{{ $project->title }}</h3>
                                <p class="text-gray-600 text-sm">{{ $project->short_description }}</p>
                                <a href="{{ route('portfolio.show', $project->slug) }}" class="text-primary hover:underline mt-3 inline-block">View case study</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Testimonials Section --}}
    @php $testimonials = $sections['testimonials'] ?? null; @endphp
    @if($testimonials)
        <section class="py-16 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">{{ $testimonials->title }}</h2>
                <div class="max-w-3xl mx-auto">
                    {!! $testimonials->content !!}
                </div>
            </div>
        </section>
    @endif

    {{-- Blog Section --}}
    @php $blogSection = $sections['blog'] ?? null; @endphp
    @if($blogSection)
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold mb-4 text-gray-800">{{ $blogSection->title }}</h2>
                <p class="text-gray-600 max-w-2xl mx-auto mb-10">{!! $blogSection->content !!}</p>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                        <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition text-left">
                            <div class="h-48 bg-gray-200 flex items-center justify-center">
                                <!-- Placeholder for blog image -->
                                <span class="text-gray-400">{{ $post->category->name ?? '' }}</span>
                            </div>
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-2 text-gray-800">{{ $post->title }}</h3>
                                <p class="text-gray-600 text-sm">{{ $post->short_description }}</p>
                                <a href="{{ route('blog.show', $post->slug) }}" class="text-primary hover:underline mt-3 inline-block">Read more</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Call to Action Section --}}
    @php $cta = $sections['cta'] ?? null; @endphp
    @if($cta)
        <section class="py-16 bg-primary text-white">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold mb-4">{{ $cta->title }}</h2>
                <div class="max-w-3xl mx-auto mb-6">{!! $cta->content !!}</div>
            </div>
        </section>
    @endif
@endsection