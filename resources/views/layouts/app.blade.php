<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php
        $siteName = $siteSettings->company_legal_name ?? config('app.name', 'PT JASA IBNU DEVELOPMENT');
        $title = html_entity_decode(trim($__env->yieldContent('title', $siteName)), ENT_QUOTES, 'UTF-8');
        $description = html_entity_decode(trim($__env->yieldContent('meta_description', 'IT Solutions, Software Development, SaaS, and AI Integration for better business.')), ENT_QUOTES, 'UTF-8');
        $canonical = trim($__env->yieldContent('canonical', url()->current()));
        $robots = trim($__env->yieldContent('robots', 'index,follow'));
        $ogType = trim($__env->yieldContent('og_type', 'website'));
        $twitterCard = trim($__env->yieldContent('twitter_card', 'summary'));
        $homeUrl = rtrim(route('home'), '/');
    @endphp

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $description }}">
    <meta name="robots" content="{{ $robots }}">
    <link rel="canonical" href="{{ $canonical }}">

    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:site_name" content="{{ $siteName }}">

    <meta name="twitter:card" content="{{ $twitterCard }}">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">

    <title>{{ $title }}</title>

    @if($siteSettings && !empty($siteSettings->favicon_path))
        <link rel="icon" href="{{ asset('storage/' . $siteSettings->favicon_path) }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')

    <script type="application/ld+json">
    @json($siteSettings->organizationSchema($homeUrl), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
    </script>
    <script type="application/ld+json">
    @json($siteSettings->websiteSchema($homeUrl), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
    </script>
</head>
<body class="@yield('body_class')">
    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    @stack('scripts')
</body>
</html>
