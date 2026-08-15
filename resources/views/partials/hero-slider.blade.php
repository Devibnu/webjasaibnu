@php
    /** @var \Illuminate\Support\Collection $heroSlides */
    $heroSlides = $heroSlides ?? collect();
    $hasManagedSlides = $heroSlides->isNotEmpty();
@endphp

<div id="header-carousel" class="carousel slide carousel-fade">
    <div class="carousel-inner">
        @forelse ($heroSlides as $slide)
            <div class="carousel-item @if ($loop->first) active @endif">
                @if ($slide->optimizedMobileImageUrl())
                    <picture>
                        <source type="image/webp" media="(max-width: 767px)" srcset="{{ $slide->optimizedMobileImageUrl() }}">
                        <source type="image/webp" srcset="{{ $slide->optimizedDesktopImageUrl() }}">
                        <img class="w-100" src="{{ $slide->imageUrl() }}" alt="{{ $slide->image_alt ?: $slide->title }}" width="1280" height="720" @if ($loop->first) fetchpriority="high" decoding="sync" @else loading="lazy" decoding="async" @endif>
                    </picture>
                @else
                    <img class="w-100" src="{{ $slide->imageUrl() }}" alt="{{ $slide->image_alt ?: $slide->title }}" width="1920" height="1080" @if ($loop->first) fetchpriority="high" decoding="sync" @else loading="lazy" decoding="async" @endif>
                @endif
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center" style="background: {{ $slide->overlayRgba() }};">
                    <div class="p-3" style="max-width: 900px;">
                        @if ($slide->eyebrow)
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown">{{ $slide->eyebrow }}</h5>
                        @endif
                        @if ($loop->first)
                            <h1 class="display-1 text-white mb-md-4 animated zoomIn startup2-hero-title">{{ $slide->title }}</h1>
                        @else
                            <h2 class="display-1 text-white mb-md-4 animated zoomIn startup2-hero-title">{{ $slide->title }}</h2>
                        @endif
                        @if ($slide->description)
                            <p class="text-white mb-4 startup2-hero-copy animated zoomIn">{{ $slide->description }}</p>
                        @endif
                        @if ($slide->primary_button_text && $slide->primary_button_url)
                            <a href="{{ $slide->primary_button_url }}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">{{ $slide->primary_button_text }}</a>
                        @endif
                        @if ($slide->secondary_button_text && $slide->secondary_button_url)
                            <a href="{{ $slide->secondary_button_url }}" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">{{ $slide->secondary_button_text }}</a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="carousel-item active">
                <picture>
                    <source type="image/webp" media="(max-width: 767px)" srcset="{{ asset('assets/startup2/img/optimized/carousel-1-mobile.webp') }}">
                    <source type="image/webp" srcset="{{ asset('assets/startup2/img/optimized/carousel-1-desktop.webp') }}">
                    <img class="w-100" src="{{ asset('assets/startup2/img/carousel-1.jpg') }}" alt="Diskusi strategi digital untuk bisnis" width="1280" height="720" fetchpriority="high" decoding="sync">
                </picture>
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h5 class="text-white text-uppercase mb-3 animated slideInDown">IT Solutions • Software Development • SaaS • AI Integration</h5>
                        <h1 class="display-1 text-white mb-md-4 animated zoomIn startup2-hero-title">Solusi Digital untuk Bisnis yang Siap Bertumbuh</h1>
                        <p class="text-white mb-4 startup2-hero-copy animated zoomIn">PT JASA IBNU DEVELOPMENT membantu bisnis membangun website, aplikasi, SaaS, SEO, dan integrasi AI dengan fondasi teknis yang scalable, aman, dan siap dikembangkan jangka panjang.</p>
                        <a href="{{ route('contact') }}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Konsultasi Gratis</a>
                        <a href="{{ route('services.index') }}" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Lihat Layanan</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <picture>
                    <source type="image/webp" media="(max-width: 767px)" srcset="{{ asset('assets/startup2/img/optimized/carousel-2-mobile.webp') }}">
                    <source type="image/webp" srcset="{{ asset('assets/startup2/img/optimized/carousel-2-desktop.webp') }}">
                    <img class="w-100" src="{{ asset('assets/startup2/img/carousel-2.jpg') }}" alt="Kolaborasi pengembangan sistem digital" width="1280" height="720" loading="lazy" decoding="async">
                </picture>
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h5 class="text-white text-uppercase mb-3 animated slideInDown">PT JASA IBNU DEVELOPMENT</h5>
                        <h2 class="display-1 text-white mb-md-4 animated zoomIn startup2-hero-title">Website, Aplikasi, SaaS, SEO, dan AI Integration</h2>
                        <p class="text-white mb-4 startup2-hero-copy animated zoomIn">Bangun fondasi teknis yang rapi untuk produk digital, workflow bisnis, automation, dan pertumbuhan jangka panjang.</p>
                        <a href="{{ route('contact') }}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Konsultasi Gratis</a>
                        <a href="{{ route('services.index') }}" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Lihat Layanan</a>
                    </div>
                </div>
            </div>
        @endforelse
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
