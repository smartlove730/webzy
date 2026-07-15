<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $settings = $settings ?? \App\Models\Setting::pluck('value', 'key')->toArray();
        $theme = $theme ?? \App\Models\ThemeSetting::first();
        $primary = $theme->primary_color ?? '#4F46E5';
        $secondary = $theme->secondary_color ?? '#06B6D4';
    @endphp
    <title>@yield('meta_title', $settings['default_meta_title'] ?? config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', $settings['default_meta_description'] ?? '')">
    <meta name="keywords" content="@yield('meta_keywords', $settings['default_meta_keywords'] ?? '')">
    <meta name="theme-color" content="#050505">

    <meta property="og:title" content="@yield('meta_title', $settings['default_meta_title'] ?? config('app.name'))">
    <meta property="og:description" content="@yield('meta_description', '')">
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="canonical" href="@yield('canonical', url()->current())" />
    <link rel="icon" type="image/png" href="{{ $theme && $theme->favicon_path ? asset('storage/'.$theme->favicon_path) : asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/css/cinematic.css', 'resources/js/cinematic-pages.js'])

    <style>
        :root { --primary: {{ $primary }}; --secondary: {{ $secondary }}; }
    </style>
    @stack('styles')
</head>
<body>
    {{-- Ambient background --}}
    <div class="ambient-bg" aria-hidden="true">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>
    <div class="noise-overlay" aria-hidden="true"></div>
    <div class="cin-vignette" aria-hidden="true"></div>
    <div id="cursor-glow"></div>

    <div class="cinematic-overlay">
        @include('front.partials.header')

        <main>
            @yield('content')
        </main>

        @include('front.partials.footer')
    </div>

    @stack('scripts')
</body>
</html>
