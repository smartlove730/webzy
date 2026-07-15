<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        $theme = \App\Models\ThemeSetting::first();
        $primary = $theme->primary_color ?? '#4F46E5';
        $secondary = $theme->secondary_color ?? '#06B6D4';
    @endphp
    <title>@yield('meta_title', $settings['default_meta_title'] ?? config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', $settings['default_meta_description'] ?? config('app.name').' – Premium Web Development Services')">
    <meta name="keywords" content="@yield('meta_keywords', $settings['default_meta_keywords'] ?? 'web development, digital agency, web design')">

    {{-- Open Graph / Social Meta Tags --}}
    <meta property="og:title" content="@yield('meta_title', $settings['default_meta_title'] ?? config('app.name'))">
    <meta property="og:description" content="@yield('meta_description', $settings['default_meta_description'] ?? config('app.name').' – Premium Web Development Services')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('meta_image', isset($theme) && $theme->logo_path ? asset('storage/'.$theme->logo_path) : '')">
    <meta property="og:type" content="@yield('meta_type', 'website')">

    {{-- Canonical --}}
    <link rel="canonical" href="@yield('canonical', url()->current())" />
    <link rel="icon" type="image/png" href="{{ $theme && $theme->favicon_path ? asset('storage/'.$theme->favicon_path) : asset('favicon.ico') }}">

    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <!-- GSAP Animation Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" defer></script>

    <!-- CSS & JS via Vite -->
    @vite(['resources/css/app.css', 'resources/css/cinematic.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: {{ $primary }};
            --secondary: {{ $secondary }};
        }
    </style>
    @if(!empty($settings['custom_css']))
        <style>
            {!! $settings['custom_css'] !!}
        </style>
    @endif
    @stack('styles')
</head>
<body>
    <!-- Cinematic Ambient Effects -->
    <canvas id="starfield"></canvas>
    <div class="holo-grid"></div>
    <div class="scanlines"></div>
    <div id="cursor-glow"></div>
    <div class="ambient-bg">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>
    <div class="noise-overlay"></div>

    <!-- Floating Particles -->
    <div class="particle" style="left:10%;width:3px;height:3px;animation-delay:0s;animation-duration:12s"></div>
    <div class="particle" style="left:25%;width:2px;height:2px;animation-delay:2s;animation-duration:18s"></div>
    <div class="particle" style="left:45%;width:4px;height:4px;animation-delay:5s;animation-duration:14s"></div>
    <div class="particle" style="left:65%;width:2px;height:2px;animation-delay:8s;animation-duration:16s"></div>
    <div class="particle" style="left:80%;width:3px;height:3px;animation-delay:3s;animation-duration:20s"></div>
    <div class="particle" style="left:92%;width:2px;height:2px;animation-delay:7s;animation-duration:13s"></div>

    <div class="app-wrapper">
        @include('front.partials.header')

        <main class="main-content" >
            @yield('content')
        </main>

        @include('front.partials.footer')
    </div>

    <!-- Firebase configuration (optional) -->
    @php
        try {
            $firebase = \App\Models\FirebaseSetting::first();
        } catch (\Exception $e) {
            $firebase = null;
        }
    @endphp
    @if($firebase && $firebase->server_key && $firebase->sender_id && $firebase->project_id)
        <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging.js"></script>
        <script>
            const firebaseConfig = {
                apiKey: "{{ $firebase->server_key }}",
                projectId: "{{ $firebase->project_id }}",
                messagingSenderId: "{{ $firebase->sender_id }}",
                appId: "{{ $firebase->sender_id }}",
            };
            firebase.initializeApp(firebaseConfig);
            const messaging = firebase.messaging();
            messaging.getToken({ vapidKey: '{{ $firebase->server_key }}' }).then((currentToken) => {
                console.log('Firebase token:', currentToken);
            }).catch((err) => {
                console.error('Error retrieving Firebase token', err);
            });
        </script>
    @endif

    @stack('scripts')
</body>
</html>