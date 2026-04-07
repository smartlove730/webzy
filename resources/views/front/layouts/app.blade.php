<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('meta_title', $settings['default_meta_title'] ?? config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', $settings['default_meta_description'] ?? config('app.name').' – Premium Web Development Services')">
    <meta name="keywords" content="@yield('meta_keywords', $settings['default_meta_keywords'] ?? 'web development, digital agency, web design')">
    {{-- Open Graph / Social Meta Tags --}}
    <meta property="og:title" content="@yield('meta_title', $settings['default_meta_title'] ?? config('app.name'))">
    <meta property="og:description" content="@yield('meta_description', $settings['default_meta_description'] ?? config('app.name').' – Premium Web Development Services')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('meta_image', isset($theme) && $theme->logo_path ? asset('storage/'.$theme->logo_path) : '')">
    <meta property="og:type" content="@yield('meta_type', 'website')">
    {{-- Canonical URL for SEO --}}
    <link rel="canonical" href="@yield('canonical', url()->current())" />
    <link rel="icon" type="image/png" href="@php $theme = \App\Models\ThemeSetting::first(); echo $theme && $theme->favicon_path ? asset('storage/'.$theme->favicon_path) : asset('favicon.ico'); @endphp">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Theme colours -->
    @php
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        $theme = $theme ?? \App\Models\ThemeSetting::first();
        $primary = $theme->primary_color ?? '#0A65CC';
        $secondary = $theme->secondary_color ?? '#00A8E8';
    @endphp
    <style>
        :root {
            --primary-color: {{ $primary }};
            --secondary-color: {{ $secondary }};
        }
        .btn-primary { background-color: var(--primary-color); color: #fff; }
        .btn-primary:hover { background-color: var(--secondary-color); }
        .text-primary { color: var(--primary-color); }
    </style>
    @if(!empty($settings['custom_css']))
        <style>
            {!! $settings['custom_css'] !!}
        </style>
    @endif
    @stack('styles')
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-800">
    @include('front.partials.header')
    <main class="flex-1">
        @yield('content')
    </main>
    @include('front.partials.footer')
    <!-- Alpine.js for mobile menu toggle -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.3/cdn.min.js" defer></script>
    {{-- Firebase configuration (optional) --}}
    @php
        $firebase = \App\Models\FirebaseSetting::first();
    @endphp
    @if($firebase && $firebase->server_key && $firebase->sender_id && $firebase->project_id)
        <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging.js"></script>
        <script>
            // Initialize Firebase using dynamically configured keys from the database.
            const firebaseConfig = {
                apiKey: "{{ $firebase->server_key }}",
                projectId: "{{ $firebase->project_id }}",
                messagingSenderId: "{{ $firebase->sender_id }}",
                appId: "{{ $firebase->sender_id }}", // using sender ID as fallback for appId
            };
            firebase.initializeApp(firebaseConfig);
            const messaging = firebase.messaging();
            // Example: request permission and log token. Developers can customize this to
            // send notifications or save the token via AJAX.
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