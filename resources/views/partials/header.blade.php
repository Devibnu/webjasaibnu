@php
    $navigation = [
        ['label' => 'Home', 'route' => 'home'],
        ['label' => 'Services', 'route' => 'services.index'],
        ['label' => 'Solutions', 'route' => 'solutions.index'],
        ['label' => 'Portfolio', 'route' => 'portfolio.index'],
        ['label' => 'Insights', 'route' => 'insights.index'],
        ['label' => 'About', 'route' => 'about'],
        ['label' => 'Contact', 'route' => 'contact'],
    ];
    $publicLogoPath = $siteSettings->logo_path;
    $darkLogoPath = $siteSettings->logo_dark_path ?: $siteSettings->logo_path;
@endphp

@if (request()->routeIs('home') || request()->routeIs('services.index') || request()->routeIs('solutions.index') || request()->routeIs('portfolio.index') || request()->routeIs('insights.*') || request()->routeIs('about') || request()->routeIs('contact'))
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner"></div>
    </div>

    <div class="container-fluid bg-dark px-5 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <small class="me-3 text-light"><span class="ji-topbar-icon me-2">⌖</span>{{ $siteSettings->contactAddress() }}</small>
                    <small class="me-3 text-light"><span class="ji-topbar-icon me-2">☎</span>{{ $siteSettings->phone }}</small>
                    <small class="text-light"><span class="ji-topbar-icon me-2">✉</span>{{ $siteSettings->email }}</small>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    @foreach ($siteSettings->socialLinks() as $social)
                        @if ($social['value'])
                            <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="{{ $social['value'] }}" aria-label="{{ $social['label'] }}"><span aria-hidden="true">{{ $social['text'] }}</span></a>
                        @endif
                    @endforeach
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle" href="{{ route('contact') }}" aria-label="Contact"><span aria-hidden="true">↗</span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid position-relative p-0 startup-inner-shell">
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <a href="{{ route('home') }}" class="navbar-brand p-0">
                @if ($siteSettings->logo_path)
                    <span class="ji-header-logo-stack">
                        <img class="ji-header-logo ji-header-logo-public" src="{{ asset('storage/' . $publicLogoPath) }}" alt="{{ $siteSettings->company_name }}" width="214" height="77" decoding="async">
                        <img class="ji-header-logo ji-header-logo-dark" src="{{ asset('storage/' . $darkLogoPath) }}" alt="{{ $siteSettings->company_name }}" width="214" height="77" decoding="async">
                    </span>
                @else
                    <div class="m-0 h1 ji-brand-heading"><span class="ji-brand-icon me-2">JI</span>{{ $siteSettings->company_name }}</div>
                    <small>{{ $siteSettings->company_legal_name }}</small>
                @endif
            </a>
            <button class="navbar-toggler" type="button" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Open navigation" data-startup-nav-toggle>
                <span class="ji-bars">☰</span>
            </button>
            <div class="startup-mobile-backdrop" data-startup-nav-backdrop hidden></div>
            <div class="collapse navbar-collapse" id="navbarCollapse" data-startup-nav>
                <div class="startup-mobile-nav-head">
                    <a href="{{ route('home') }}" class="startup-mobile-brand" aria-label="{{ $siteSettings->company_legal_name }} home">
                        @if ($siteSettings->logo_path)
                            <img src="{{ asset('storage/' . $darkLogoPath) }}" alt="{{ $siteSettings->company_name }}" width="214" height="77" decoding="async">
                        @else
                            <span class="ji-brand-icon me-2">JI</span>
                            <span>{{ $siteSettings->company_name }}</span>
                        @endif
                    </a>
                    <button class="startup-mobile-close" type="button" aria-label="Close navigation" data-startup-nav-close>
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="navbar-nav ms-auto py-0">
                    @foreach ($navigation as $item)
                        <a href="{{ route($item['route']) }}" class="nav-item nav-link @if (request()->routeIs($item['route']) || ($item['route'] === 'services.index' && request()->routeIs('services.*')) || ($item['route'] === 'solutions.index' && request()->routeIs('solutions.*')) || ($item['route'] === 'portfolio.index' && request()->routeIs('portfolio.*')) || ($item['route'] === 'insights.index' && request()->routeIs('insights.*'))) active @endif">{{ $item['label'] }}</a>
                    @endforeach
                </div>
                <a href="{{ route('contact') }}" class="btn btn-primary py-2 px-4 ms-3 nav-contact">Konsultasi Gratis</a>
                <div class="startup-mobile-nav-footer">
                    <strong>{{ $siteSettings->company_legal_name }}</strong>
                    @if ($siteSettings->email)
                        <span>{{ $siteSettings->email }}</span>
                    @endif
                </div>
            </div>
        </nav>

        @if (request()->routeIs('services.index'))
            <section class="services-page-hero" aria-labelledby="services-page-title">
                <div class="services-page-hero-content">
                    <h1 id="services-page-title">Services</h1>
                    <nav aria-label="Breadcrumb">
                        <ol class="services-breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li aria-hidden="true"><span>○</span></li>
                            <li><a href="{{ route('services.index') }}" aria-current="page">Services</a></li>
                        </ol>
                    </nav>
                </div>
            </section>
        @elseif (request()->routeIs('solutions.index'))
            <section class="solutions-page-hero" aria-labelledby="solutions-page-title">
                <div class="solutions-page-hero-content">
                    <h1 id="solutions-page-title">Solutions</h1>
                    <nav aria-label="Breadcrumb">
                        <ol class="solutions-breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li aria-hidden="true"><span>○</span></li>
                            <li><a href="{{ route('solutions.index') }}" aria-current="page">Solutions</a></li>
                        </ol>
                    </nav>
                </div>
            </section>
        @elseif (request()->routeIs('portfolio.index'))
            <section class="portfolio-page-hero" aria-labelledby="portfolio-page-title">
                <div class="portfolio-page-hero-content">
                    <h1 id="portfolio-page-title">Portfolio</h1>
                    <nav aria-label="Breadcrumb">
                        <ol class="portfolio-breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li aria-hidden="true"><span>○</span></li>
                            <li><a href="{{ route('portfolio.index') }}" aria-current="page">Portfolio</a></li>
                        </ol>
                    </nav>
                </div>
            </section>
        @elseif (request()->routeIs('insights.index'))
            <section class="insights-page-hero" aria-labelledby="insights-page-title">
                <div class="insights-page-hero-content">
                    <h1 id="insights-page-title">Insights</h1>
                    <nav aria-label="Breadcrumb">
                        <ol class="insights-breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li aria-hidden="true"><span>○</span></li>
                            <li><a href="{{ route('insights.index') }}" aria-current="page">Insights</a></li>
                        </ol>
                    </nav>
                </div>
            </section>
        @elseif (request()->routeIs('insights.show'))
            <section class="insights-page-hero insights-detail-hero" aria-labelledby="insights-page-title">
                <div class="insights-page-hero-content">
                    <p class="insights-page-label">INSIGHT</p>
                    <h1 id="insights-page-title">{{ $article->title ?? 'Insight' }}</h1>
                    <nav aria-label="Breadcrumb">
                        <ol class="insights-breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li aria-hidden="true"><span>○</span></li>
                            <li><a href="{{ route('insights.index') }}">Insights</a></li>
                            <li aria-hidden="true"><span>○</span></li>
                            <li><span aria-current="page">{{ $article->title ?? 'Detail' }}</span></li>
                        </ol>
                    </nav>
                </div>
            </section>
        @elseif (request()->routeIs('about'))
            <section class="about-page-hero" aria-labelledby="about-page-title">
                <div class="about-page-hero-content">
                    <h1 id="about-page-title">About Us</h1>
                    <nav aria-label="Breadcrumb">
                        <ol class="about-breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li aria-hidden="true"><span>○</span></li>
                            <li><a href="{{ route('about') }}" aria-current="page">About Us</a></li>
                        </ol>
                    </nav>
                </div>
            </section>
        @elseif (request()->routeIs('contact'))
            <section class="contact-page-hero" aria-labelledby="contact-page-title">
                <div class="contact-page-hero-content">
                    <h1 id="contact-page-title">Contact Us</h1>
                    <nav aria-label="Breadcrumb">
                        <ol class="contact-breadcrumb">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li aria-hidden="true"><span>○</span></li>
                            <li><a href="{{ route('contact') }}" aria-current="page">Contact Us</a></li>
                        </ol>
                    </nav>
                </div>
            </section>
        @endif
    </div>
@else
<header class="site-header" data-site-header>
    <div class="container header-inner">
        <a class="brand" href="{{ route('home') }}" aria-label="{{ $siteSettings->company_legal_name }} home">
            @if ($siteSettings->logo_path)
                <img src="{{ asset('storage/' . $siteSettings->logo_path) }}" alt="{{ $siteSettings->company_name }}" width="214" height="77" decoding="async" style="max-height: 45px;">
            @else
                <span class="brand-mark" aria-hidden="true">JI</span>
                <span class="brand-text">
                    <strong>{{ $siteSettings->company_name }}</strong>
                    <span>{{ $siteSettings->company_legal_name }}</span>
                </span>
            @endif
        </a>

        <button class="menu-toggle" type="button" aria-label="Open navigation" aria-controls="primary-navigation" aria-expanded="false" data-menu-toggle>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </button>

        <nav class="primary-nav" id="primary-navigation" aria-label="Primary navigation" data-primary-nav>
            @foreach ($navigation as $item)
                <a href="{{ route($item['route']) }}" @if (request()->routeIs($item['route'])) aria-current="page" @endif>{{ $item['label'] }}</a>
            @endforeach
            <a class="button button-small button-primary nav-cta" href="{{ route('contact') }}">Konsultasi Gratis</a>
        </nav>
    </div>
</header>
@endif
