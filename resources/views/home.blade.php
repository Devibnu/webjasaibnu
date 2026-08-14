@extends('layouts.app')

@section('body_class', 'startup2-home')
@section('title', 'JASAIBNU — IT Solutions, Software Development, SaaS & AI')
@section('meta_description', 'PT JASA IBNU DEVELOPMENT membantu bisnis membangun website, aplikasi, SaaS, SEO, dan integrasi AI dengan fondasi teknis yang scalable, aman, dan siap dikembangkan.')

@push('head')
    @php
        $firstHeroImage = ($heroSlides ?? collect())->first()?->imageUrl() ?: asset('assets/startup2/img/carousel-1.jpg');
    @endphp
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="image" href="{{ $firstHeroImage }}" fetchpriority="high">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/startup2/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/startup2/css/style.css') }}" rel="stylesheet">
    <style>
        .startup2-home {
            font-family: "Rubik", sans-serif;
            overflow-x: hidden;
        }

        .startup2-home .navbar-dark .navbar-brand h1 {
            font-size: 1.9rem;
            line-height: 1.02;
            letter-spacing: 0;
        }

        .startup2-home .navbar-brand small {
            display: block;
            margin-top: 2px;
            color: rgba(255, 255, 255, .72);
            font-family: "Nunito", sans-serif;
            font-size: .7rem;
            font-weight: 600;
            letter-spacing: 0;
        }

        .startup2-home .navbar-dark .navbar-nav .nav-link {
            margin-left: 18px;
            font-size: 14px;
            font-weight: 500;
        }

        .startup2-home .navbar .btn {
            font-size: .9rem;
            padding: .48rem 1.05rem !important;
        }

        .startup2-home .sticky-top.navbar-dark .navbar-brand small {
            color: var(--dark);
        }

        @media (max-width: 991.98px) {
            .startup2-home .navbar-dark .navbar-brand small {
                color: var(--dark);
            }
        }

        .startup2-home .ji-brand-icon {
            display: inline-grid;
            width: 38px;
            height: 38px;
            place-items: center;
            border-radius: 2px;
            background: var(--primary);
            color: #fff;
            font-size: .92rem;
            vertical-align: middle;
        }

        .startup2-home .ji-bars,
        .startup2-home .ji-topbar-icon,
        .startup2-home .startup2-fact-icon,
        .startup2-home .startup2-feature-icon,
        .startup2-home .startup2-service-number {
            font-weight: 800;
            line-height: 1;
        }

        .startup2-home .startup2-hero-copy {
            max-width: 720px;
            margin-inline: auto;
            font-size: .98rem;
            font-weight: 400;
            line-height: 1.62;
        }

        .startup2-home .facts p {
            font-size: .92rem;
        }

        .startup2-home .carousel-caption h5 {
            font-size: .875rem;
            font-weight: 600 !important;
            line-height: 1.35;
        }

        .startup2-home .carousel-caption .startup2-hero-title {
            max-width: 720px;
            margin-right: auto;
            margin-left: auto;
            font-size: clamp(3rem, 4vw, 3.5rem);
            line-height: 1.14;
        }

        .startup2-home .carousel-caption .btn {
            font-size: .9rem;
            padding: .7rem 1.75rem !important;
        }

        .startup2-home .carousel-control-prev,
        .startup2-home .carousel-control-next {
            width: 8%;
            opacity: .72;
        }

        .startup2-home .carousel-control-prev-icon,
        .startup2-home .carousel-control-next-icon {
            width: 2.25rem;
            height: 2.25rem;
        }

        @media (max-width: 1199.98px) {
            .startup2-home .navbar-dark .navbar-brand h1 {
                font-size: 1.72rem;
            }

            .startup2-home .navbar-dark .navbar-nav .nav-link {
                margin-left: 12px;
                font-size: 13.5px;
            }
        }

        @media (max-width: 991.98px) {
            .startup2-home .navbar {
                min-height: clamp(96px, 13svh, 105px);
                align-items: center;
            }

            .startup2-home .ji-header-logo-stack {
                max-width: min(230px, 62vw);
            }

            .startup2-home .ji-header-logo {
                max-height: 46px;
            }

            .startup2-home .navbar-dark .navbar-brand h1 {
                font-size: 1.65rem;
            }

            .startup2-home #header-carousel,
            .startup2-home #header-carousel .carousel-inner,
            .startup2-home #header-carousel .carousel-item {
                height: calc(100svh - clamp(96px, 13svh, 105px));
                min-height: 560px;
                max-height: 760px;
            }

            .startup2-home #header-carousel .carousel-item img {
                height: 100%;
                min-height: 0;
                object-fit: cover;
                object-position: center 42%;
            }

            .startup2-home .carousel-caption {
                left: 0;
                right: 0;
                padding: clamp(34px, 6svh, 54px) 24px 86px;
            }

            .startup2-home .carousel-caption .p-3 {
                width: min(100%, 720px);
                max-width: 100% !important;
                padding: 0 !important;
            }

            .startup2-home .carousel-caption h5 {
                max-width: 680px;
                margin-right: auto;
                margin-bottom: 12px !important;
                margin-left: auto;
                font-size: clamp(15px, 2.25vw, 17px);
                line-height: 1.4;
                overflow-wrap: anywhere;
            }

            .startup2-home .carousel-caption .startup2-hero-title {
                max-width: 760px;
                font-size: clamp(38px, 6.4vw, 46px);
                line-height: 1.1;
                overflow-wrap: normal;
            }

            .startup2-home .startup2-hero-copy {
                width: min(100%, 620px);
                max-width: 620px;
                margin: 14px auto 20px !important;
                font-size: clamp(18px, 2.8vw, 20px);
                line-height: 1.5;
                overflow-wrap: anywhere;
            }

            .startup2-home .carousel-caption .btn {
                min-height: 44px;
                padding: .58rem 1.28rem !important;
                font-size: .92rem;
                line-height: 1.2;
            }

            .startup2-home .carousel-control-prev,
            .startup2-home .carousel-control-next {
                top: auto;
                bottom: clamp(18px, 3.8svh, 30px);
                width: 44px;
                height: 44px;
                border-radius: 999px;
                background: rgba(9, 30, 62, .32);
                opacity: .64;
            }

            .startup2-home .carousel-control-prev {
                left: 18px;
            }

            .startup2-home .carousel-control-next {
                right: 18px;
            }

            .startup2-home .carousel-control-prev-icon,
            .startup2-home .carousel-control-next-icon {
                width: 1.24rem;
                height: 1.24rem;
            }
        }

        @media (max-width: 575.98px) {
            .startup2-home .navbar {
                min-height: clamp(96px, 12svh, 102px);
                padding-right: 16px !important;
                padding-left: 16px !important;
            }

            .startup2-home .ji-header-logo-stack {
                max-width: min(218px, 61vw);
            }

            .startup2-home #header-carousel,
            .startup2-home #header-carousel .carousel-inner,
            .startup2-home #header-carousel .carousel-item {
                height: calc(100svh - clamp(96px, 12svh, 102px));
                min-height: 540px;
                max-height: 700px;
            }

            .startup2-home .carousel-item img {
                height: 100%;
                min-height: 0;
                object-fit: cover;
                object-position: 52% 40%;
            }

            .startup2-home .carousel-caption {
                left: 0;
                right: 0;
                padding: 28px 18px 76px;
            }

            .startup2-home .carousel-caption .p-3 {
                width: min(100%, 354px);
                max-width: 100% !important;
                margin-inline: auto;
                padding: 0 !important;
            }

            .startup2-home .startup2-hero-copy {
                width: min(100%, 336px);
                max-width: 336px;
                margin-inline: auto;
                font-size: clamp(17px, 4.6vw, 19px);
                line-height: 1.48;
                overflow-wrap: anywhere;
            }

            .startup2-home .carousel-caption .startup2-hero-title {
                max-width: 354px;
                font-size: clamp(36px, 10.8vw, 44px);
                line-height: 1.09;
                overflow-wrap: normal;
            }

            .startup2-home .carousel-caption h5 {
                max-width: 338px;
                margin-right: auto;
                margin-bottom: 10px !important;
                margin-left: auto;
                font-size: clamp(15px, 4vw, 16px);
                line-height: 1.38;
                overflow-wrap: anywhere;
            }

            .startup2-home .carousel-caption .btn {
                width: min(100%, 258px);
                min-height: 44px;
                margin: 4px 0 !important;
                padding: .54rem 1rem !important;
                font-size: .9rem;
            }

            .startup2-home .carousel-control-prev,
            .startup2-home .carousel-control-next {
                bottom: 16px;
                width: 40px;
                height: 40px;
            }

            .startup2-home .carousel-control-prev {
                left: 14px;
            }

            .startup2-home .carousel-control-next {
                right: 14px;
            }

            .startup2-home .facts .d-flex {
                justify-content: flex-start !important;
            }

            .startup2-home .facts .ps-4 {
                min-width: 0;
            }

            .startup2-home .facts p {
                max-width: 210px;
                overflow-wrap: anywhere;
            }

            .startup2-home .jasaibnu-startup-footer .container,
            .startup2-home .jasaibnu-startup-copyright .container {
                width: min(100% - 28px, 362px);
                padding-right: 0;
                padding-left: 0;
            }

            .startup2-home .jasaibnu-startup-footer .row,
            .startup2-home .jasaibnu-startup-copyright .row {
                --bs-gutter-x: 0;
                margin-right: 0;
                margin-left: 0;
            }

            .startup2-home .jasaibnu-startup-footer [class*="col-"],
            .startup2-home .jasaibnu-startup-copyright [class*="col-"] {
                min-width: 0;
                padding-right: 0;
                padding-left: 0;
            }

            .startup2-home .jasaibnu-startup-footer .footer-about > div {
                padding-right: 20px !important;
                padding-left: 20px !important;
            }

            .startup2-home .jasaibnu-startup-footer .footer-about p {
                max-width: 280px;
                margin-right: auto;
                margin-left: auto;
                overflow-wrap: anywhere;
            }

            .startup2-home .jasaibnu-startup-copyright p {
                max-width: 260px;
                margin-right: auto;
                margin-left: auto;
                font-size: .92rem;
                overflow-wrap: anywhere;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid position-relative p-0">
        @include('partials.hero-slider')
    </div>

    <div class="container-fluid facts py-5 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="row gx-0">
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.1s">
                    <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <span class="text-primary startup2-fact-icon">01</span>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white mb-0">Website & SEO</h5>
                            <p class="text-white mb-0">Website perusahaan dan fondasi search visibility.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.3s">
                    <div class="bg-light shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <span class="text-white startup2-fact-icon">02</span>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-primary mb-0">Software Development</h5>
                            <p class="mb-0">Aplikasi web dan mobile untuk proses bisnis.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
                    <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                        <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                            <span class="text-primary startup2-fact-icon">03</span>
                        </div>
                        <div class="ps-4">
                            <h5 class="text-white mb-0">SaaS & AI Integration</h5>
                            <p class="text-white mb-0">Produk digital dan automation yang scalable.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <h5 class="fw-bold text-primary text-uppercase">{{ $homepageAbout->homepageAboutValue('homepage_about_label') }}</h5>
                        <h2 class="h1 mb-0">{{ $homepageAbout->homepageAboutValue('homepage_about_title') }}</h2>
                    </div>
                    <p class="mb-4">{{ $homepageAbout->homepageAboutValue('homepage_about_description') }}</p>
                    <div class="row g-0 mb-3">
                        @foreach (array_chunk($homepageAbout->homepageChecklist(), 2) as $index => $checklistGroup)
                            <div class="col-sm-6 wow zoomIn" data-wow-delay="{{ $index === 0 ? '0.2s' : '0.4s' }}">
                                @foreach ($checklistGroup as $checklistItem)
                                    <h5 class="mb-3"><span class="text-primary me-3">✓</span>{{ $checklistItem }}</h5>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <a class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.6s" href="{{ $homepageAbout->homepageCtaUrl() }}">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <span class="text-white">☎</span>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">{{ $homepageAbout->homepageAboutValue('homepage_cta_small_text') }}</h5>
                            <h4 class="text-primary mb-0">{{ $homepageAbout->homepageAboutValue('homepage_cta_main_text') }}</h4>
                        </div>
                    </a>
                    <a href="{{ $homepageAbout->homepageButtonUrl() }}" class="btn btn-primary py-3 px-5 mt-3 wow zoomIn" data-wow-delay="0.9s">{{ $homepageAbout->homepageAboutValue('homepage_button_label') }}</a>
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="{{ $homepageAbout->homepageAboutImageUrl() }}" alt="Konsultasi pengembangan solusi digital" width="800" height="800" loading="lazy" decoding="async" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Why Choose Us</h5>
                <h2 class="h1 mb-0">Pendekatan Rapi untuk Solusi Digital Jangka Panjang</h2>
            </div>
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="row g-5">
                        <div class="col-12 wow zoomIn" data-wow-delay="0.2s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <span class="text-white startup2-feature-icon">01</span>
                            </div>
                            <h3 class="h4">Discovery Kebutuhan</h3>
                            <p class="mb-0">Memahami tujuan bisnis, pengguna, dan prioritas fitur sebelum mulai membangun.</p>
                        </div>
                        <div class="col-12 wow zoomIn" data-wow-delay="0.6s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <span class="text-white startup2-feature-icon">02</span>
                            </div>
                            <h3 class="h4">SEO & Performance</h3>
                            <p class="mb-0">Struktur halaman, kecepatan, dan technical SEO disiapkan sejak awal.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.9s" style="min-height: 350px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.1s" src="{{ asset('assets/startup2/img/feature.jpg') }}" alt="Perencanaan solusi software untuk bisnis" width="800" height="800" loading="lazy" decoding="async" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row g-5">
                        <div class="col-12 wow zoomIn" data-wow-delay="0.4s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <span class="text-white startup2-feature-icon">03</span>
                            </div>
                            <h3 class="h4">Development Terstruktur</h3>
                            <p class="mb-0">Sistem dibuat modular agar lebih mudah diuji, dirawat, dan ditingkatkan.</p>
                        </div>
                        <div class="col-12 wow zoomIn" data-wow-delay="0.8s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <span class="text-white startup2-feature-icon">04</span>
                            </div>
                            <h3 class="h4">Support Bertahap</h3>
                            <p class="mb-0">Setelah rilis, solusi dapat dikembangkan sesuai kebutuhan bisnis berikutnya.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Our Services</h5>
                <h2 class="h1 mb-0">Custom IT Solutions untuk Kebutuhan Bisnis Anda</h2>
            </div>
            <div class="row g-5">
                @foreach ([
                    ['title' => 'Website Development', 'body' => 'Website perusahaan yang cepat, responsive, SEO-ready, dan mudah dikembangkan.', 'icon' => '01'],
                    ['title' => 'SEO Services', 'body' => 'Optimasi teknis, struktur konten, dan fondasi search visibility yang rapi.', 'icon' => '02'],
                    ['title' => 'Web Application', 'body' => 'Aplikasi web custom untuk workflow, data, dan proses operasional bisnis.', 'icon' => '03'],
                    ['title' => 'Mobile Application', 'body' => 'Aplikasi mobile untuk kebutuhan internal, pelanggan, atau operasional lapangan.', 'icon' => '04'],
                    ['title' => 'SaaS Development', 'body' => 'Platform SaaS dengan fondasi produk, akun pengguna, dan roadmap fitur.', 'icon' => '05'],
                ] as $service)
                    <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="{{ 0.3 + (($loop->iteration - 1) % 3) * 0.3 }}s">
                        <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                            <div class="service-icon">
                                <span class="text-white startup2-service-number">{{ $service['icon'] }}</span>
                            </div>
                            <h3 class="h4 mb-3">{{ $service['title'] }}</h3>
                            <p class="m-0">{{ $service['body'] }}</p>
                            <a class="btn btn-lg btn-primary rounded" href="{{ route('services.index') }}" aria-label="Lihat layanan {{ $service['title'] }}">→</a>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.9s">
                    <div class="position-relative bg-primary rounded h-100 d-flex flex-column align-items-center justify-content-center text-center p-5">
                        <h3 class="text-white mb-3">AI Integration</h3>
                        <p class="text-white mb-3">Integrasi AI dan automation yang relevan untuk mempercepat pekerjaan tim.</p>
                        <a href="{{ route('contact') }}" class="btn btn-dark py-2 px-4">Diskusikan Layanan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <h5 class="fw-bold text-primary text-uppercase">Consultation</h5>
                        <h2 class="h1 mb-0">Butuh Solusi Digital yang Sesuai dengan Proses Bisnis Anda?</h2>
                    </div>
                    <div class="row gx-3">
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                            <h5 class="mb-4"><span class="text-primary me-3">↩</span>Analisis kebutuhan awal</h5>
                        </div>
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                            <h5 class="mb-4"><span class="text-primary me-3">☎</span>Diskusi scope teknis</h5>
                        </div>
                    </div>
                    <p class="mb-4">Diskusikan kebutuhan website, aplikasi, SaaS, SEO, integrasi AI, atau sistem internal yang ingin Anda bangun bersama JASAIBNU. Kami membantu memetakan pendekatan yang realistis sebelum masuk ke tahap produksi.</p>
                    <div class="d-flex align-items-center mt-2 wow zoomIn" data-wow-delay="0.6s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <span class="text-white">✉</span>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Mulai dengan konsultasi</h5>
                            <h4 class="text-primary mb-0">hello@jasaibnu.com</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="bg-primary rounded h-100 d-flex align-items-center p-5 wow zoomIn" data-wow-delay="0.9s">
                        <div>
                            <h3 class="text-white mb-3">Konsultasi Gratis</h3>
                            <p class="text-white mb-4">Ceritakan target bisnis dan kebutuhan sistem Anda. Kami akan membantu memetakan solusi digital yang sesuai.</p>
                            <a class="btn btn-dark w-100 py-3" href="{{ route('contact') }}">Hubungi JASAIBNU</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
