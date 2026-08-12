@extends('layouts.app')

@section('body_class', 'startup2-home')
@section('title', 'JASAIBNU — IT Solutions, Software Development, SaaS & AI')
@section('meta_description', 'PT JASA IBNU DEVELOPMENT membantu bisnis membangun website, aplikasi, SaaS, SEO, dan integrasi AI dengan fondasi teknis yang scalable, aman, dan siap dikembangkan.')

@push('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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

        .startup2-home .carousel-caption h1 {
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
            .startup2-home .navbar-dark .navbar-brand h1 {
                font-size: 1.65rem;
            }
        }

        @media (max-width: 576px) {
            .startup2-home .carousel-item img {
                min-height: 520px;
                object-fit: cover;
            }

            .startup2-home .carousel-caption {
                left: 0;
                right: 0;
                padding-inline: 16px;
            }

            .startup2-home .carousel-caption .p-3 {
                width: min(100%, 318px);
                max-width: 100% !important;
                margin-inline: auto;
            }

            .startup2-home .startup2-hero-copy {
                width: min(100%, 280px);
                max-width: 280px;
                margin-inline: auto;
                font-size: .88rem;
                line-height: 1.55;
                overflow-wrap: anywhere;
            }

            .startup2-home .carousel-caption h1 {
                max-width: 300px;
                font-size: 30px;
                line-height: 1.12;
                overflow-wrap: anywhere;
            }

            .startup2-home .carousel-caption h5 {
                max-width: 280px;
                margin-right: auto;
                margin-left: auto;
                font-size: .72rem;
                line-height: 1.35;
                overflow-wrap: anywhere;
            }

            .startup2-home .carousel-caption .btn {
                width: min(100%, 248px);
                margin: 6px 0 !important;
                padding: .72rem 1.1rem !important;
                font-size: .9rem;
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
        <div id="header-carousel" class="carousel slide carousel-fade">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('assets/startup2/img/carousel-1.jpg') }}" alt="Diskusi strategi digital untuk bisnis">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">IT Solutions • Software Development • SaaS • AI Integration</h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Solusi Digital untuk Bisnis yang Siap Bertumbuh</h1>
                            <p class="text-white mb-4 startup2-hero-copy animated zoomIn">PT JASA IBNU DEVELOPMENT membantu bisnis membangun website, aplikasi, SaaS, SEO, dan integrasi AI dengan fondasi teknis yang scalable, aman, dan siap dikembangkan jangka panjang.</p>
                            <a href="{{ route('contact') }}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Konsultasi Gratis</a>
                            <a href="{{ route('services.index') }}" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Lihat Layanan</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('assets/startup2/img/carousel-2.jpg') }}" alt="Kolaborasi pengembangan sistem digital">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">PT JASA IBNU DEVELOPMENT</h5>
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn">Website, Aplikasi, SaaS, SEO, dan AI Integration</h1>
                            <p class="text-white mb-4 startup2-hero-copy animated zoomIn">Bangun fondasi teknis yang rapi untuk produk digital, workflow bisnis, automation, dan pertumbuhan jangka panjang.</p>
                            <a href="{{ route('contact') }}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Konsultasi Gratis</a>
                            <a href="{{ route('services.index') }}" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Lihat Layanan</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-startup-carousel="prev" aria-label="Previous hero slide">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-startup-carousel="next" aria-label="Next hero slide">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
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
                        <h5 class="fw-bold text-primary text-uppercase">About JASAIBNU</h5>
                        <h1 class="mb-0">Partner Teknologi untuk Website, Aplikasi, SaaS, dan AI</h1>
                    </div>
                    <p class="mb-4">JASAIBNU membantu bisnis merancang dan membangun solusi digital yang tidak hanya terlihat rapi, tetapi juga memiliki struktur teknis yang siap dirawat dan dikembangkan.</p>
                    <div class="row g-0 mb-3">
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                            <h5 class="mb-3"><span class="text-primary me-3">✓</span>Business-first planning</h5>
                            <h5 class="mb-3"><span class="text-primary me-3">✓</span>Scalable architecture</h5>
                        </div>
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                            <h5 class="mb-3"><span class="text-primary me-3">✓</span>SEO-ready foundation</h5>
                            <h5 class="mb-3"><span class="text-primary me-3">✓</span>Maintenance support</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.6s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <span class="text-white">☎</span>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Diskusikan kebutuhan digital Anda</h5>
                            <h4 class="text-primary mb-0">Konsultasi via WhatsApp</h4>
                        </div>
                    </div>
                    <a href="{{ route('about') }}" class="btn btn-primary py-3 px-5 mt-3 wow zoomIn" data-wow-delay="0.9s">Tentang JASAIBNU</a>
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="{{ asset('assets/startup2/img/about.jpg') }}" alt="Konsultasi pengembangan solusi digital" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Why Choose Us</h5>
                <h1 class="mb-0">Pendekatan Rapi untuk Solusi Digital Jangka Panjang</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="row g-5">
                        <div class="col-12 wow zoomIn" data-wow-delay="0.2s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <span class="text-white startup2-feature-icon">01</span>
                            </div>
                            <h4>Discovery Kebutuhan</h4>
                            <p class="mb-0">Memahami tujuan bisnis, pengguna, dan prioritas fitur sebelum mulai membangun.</p>
                        </div>
                        <div class="col-12 wow zoomIn" data-wow-delay="0.6s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <span class="text-white startup2-feature-icon">02</span>
                            </div>
                            <h4>SEO & Performance</h4>
                            <p class="mb-0">Struktur halaman, kecepatan, dan technical SEO disiapkan sejak awal.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.9s" style="min-height: 350px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.1s" src="{{ asset('assets/startup2/img/feature.jpg') }}" alt="Perencanaan solusi software untuk bisnis" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row g-5">
                        <div class="col-12 wow zoomIn" data-wow-delay="0.4s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <span class="text-white startup2-feature-icon">03</span>
                            </div>
                            <h4>Development Terstruktur</h4>
                            <p class="mb-0">Sistem dibuat modular agar lebih mudah diuji, dirawat, dan ditingkatkan.</p>
                        </div>
                        <div class="col-12 wow zoomIn" data-wow-delay="0.8s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <span class="text-white startup2-feature-icon">04</span>
                            </div>
                            <h4>Support Bertahap</h4>
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
                <h1 class="mb-0">Custom IT Solutions untuk Kebutuhan Bisnis Anda</h1>
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
                            <h4 class="mb-3">{{ $service['title'] }}</h4>
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
                        <h1 class="mb-0">Butuh Solusi Digital yang Sesuai dengan Proses Bisnis Anda?</h1>
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
