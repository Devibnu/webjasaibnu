@php
    $quickLinks = [
        ['label' => 'Home', 'route' => 'home'],
        ['label' => 'Services', 'route' => 'services.index'],
        ['label' => 'Solutions', 'route' => 'solutions.index'],
        ['label' => 'Portfolio', 'route' => 'portfolio.index'],
        ['label' => 'Insights', 'route' => 'insights.index'],
        ['label' => 'Contact', 'route' => 'contact'],
    ];

    $popularLinks = [
        'Website Development',
        'SEO Services',
        'Web Application',
        'SaaS Development',
        'AI Integration',
    ];
@endphp

<div class="container-fluid bg-dark text-light mt-5 wow fadeInUp jasaibnu-startup-footer" data-wow-delay="0.1s">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-4 col-md-6 footer-about">
                <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-primary p-4">
                    <a href="{{ route('home') }}" class="navbar-brand">
                        @if ($siteSettings->logo_dark_path)
                            <img src="{{ asset('storage/' . $siteSettings->logo_dark_path) }}" alt="{{ $siteSettings->company_name }}" style="max-height: 45px;" class="mb-2">
                        @elseif ($siteSettings->logo_path)
                            <img src="{{ asset('storage/' . $siteSettings->logo_path) }}" alt="{{ $siteSettings->company_name }}" style="max-height: 45px;" class="mb-2">
                        @else
                            <div class="m-0 h1 text-white"><span class="ji-footer-brand-icon me-2">JI</span>{{ $siteSettings->company_name }}</div>
                        @endif
                    </a>
                    <small class="text-white-50 fw-bold">{{ $siteSettings->company_legal_name }}</small>
                    <p class="mt-3 mb-4">{{ $siteSettings->footer_description }}</p>
                    <a class="btn btn-dark py-3 px-5" href="{{ route('contact') }}">Konsultasi Gratis</a>
                </div>
            </div>

            <div class="col-lg-8 col-md-6">
                <div class="row gx-5">
                    <div class="col-lg-4 col-md-12 pt-5 mb-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="text-light mb-0">Get In Touch</h3>
                        </div>
                        <div class="d-flex mb-2">
                            <span class="text-primary me-2">⌖</span>
                            <p class="mb-0">{{ $siteSettings->contactAddress() }}</p>
                        </div>
                        <div class="d-flex mb-2">
                            <span class="text-primary me-2">✉</span>
                            <p class="mb-0">{{ $siteSettings->email }}</p>
                        </div>
                        <div class="d-flex mb-2">
                            <span class="text-primary me-2">☎</span>
                            <p class="mb-0">{{ $siteSettings->phone }}</p>
                        </div>
                        <div class="d-flex mt-4">
                            @foreach ($siteSettings->socialLinks() as $social)
                                @if ($social['value'])
                                    <a class="btn btn-primary btn-square{{ $loop->last ? '' : ' me-2' }}" href="{{ $social['value'] }}" aria-label="{{ $social['label'] }}"><span aria-hidden="true">{{ $social['text'] }}</span></a>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="text-light mb-0">Quick Links</h3>
                        </div>
                        <div class="link-animated d-flex flex-column justify-content-start">
                            @foreach ($quickLinks as $link)
                                <a class="text-light mb-2" href="{{ route($link['route']) }}"><span class="text-primary me-2">›</span>{{ $link['label'] }}</a>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                        <div class="section-title section-title-sm position-relative pb-3 mb-4">
                            <h3 class="text-light mb-0">Popular Links</h3>
                        </div>
                        <div class="link-animated d-flex flex-column justify-content-start">
                            @foreach ($popularLinks as $link)
                                <a class="text-light mb-2" href="{{ route('services.index') }}"><span class="text-primary me-2">›</span>{{ $link }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid text-white jasaibnu-startup-copyright" style="background: #061429;">
    <div class="container text-center">
        <div class="row justify-content-end">
            <div class="col-lg-8 col-md-6">
                <div class="d-flex align-items-center justify-content-center" style="height: 75px;">
                    <p class="mb-0">&copy; {{ now()->year }} <a class="text-white border-bottom" href="{{ route('home') }}">{{ $siteSettings->company_legal_name }}</a>. {{ $siteSettings->copyright_text }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@php
    $whatsappUrl = $siteSettings->whatsappContactUrl('Halo JASAIBNU, saya ingin konsultasi mengenai kebutuhan digital bisnis saya.');
    $homepageWhatsappUrl = \App\Models\AboutPage::query()->value('homepage_cta_url');

    if (! $whatsappUrl && $homepageWhatsappUrl && $homepageWhatsappUrl !== '#') {
        $whatsappUrl = str_starts_with($homepageWhatsappUrl, 'http://') || str_starts_with($homepageWhatsappUrl, 'https://')
            ? $homepageWhatsappUrl
            : url($homepageWhatsappUrl);
    }
@endphp

@if ($whatsappUrl)
    <a class="floating-whatsapp" href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Konsultasi via WhatsApp">
        <svg viewBox="0 0 32 32" aria-hidden="true" focusable="false">
            <path fill="currentColor" d="M16.02 3.2c-7.02 0-12.73 5.67-12.73 12.64 0 2.22.59 4.39 1.72 6.3L3.2 28.8l6.83-1.79a12.86 12.86 0 0 0 5.99 1.51c7.02 0 12.73-5.67 12.73-12.64S23.04 3.2 16.02 3.2Zm0 22.98c-1.9 0-3.76-.51-5.39-1.48l-.39-.23-4.05 1.06 1.08-3.93-.25-.4a10.22 10.22 0 0 1-1.57-5.36c0-5.68 4.74-10.3 10.57-10.3s10.57 4.62 10.57 10.3-4.74 10.34-10.57 10.34Zm5.8-7.74c-.32-.16-1.89-.93-2.18-1.04-.29-.11-.5-.16-.71.16-.21.31-.81 1.04-.99 1.25-.18.21-.37.24-.68.08-.32-.16-1.34-.49-2.55-1.57-.94-.84-1.58-1.88-1.76-2.19-.18-.32-.02-.49.14-.65.14-.14.32-.37.48-.55.16-.18.21-.32.32-.53.11-.21.05-.4-.03-.56-.08-.16-.71-1.7-.97-2.33-.25-.61-.51-.53-.71-.54h-.61c-.21 0-.55.08-.84.4-.29.32-1.1 1.07-1.1 2.61s1.13 3.03 1.29 3.24c.16.21 2.22 3.36 5.38 4.71.75.32 1.34.51 1.8.65.76.24 1.45.21 1.99.13.61-.09 1.89-.77 2.16-1.51.26-.74.26-1.38.18-1.51-.08-.13-.29-.21-.61-.37Z"/>
        </svg>
        <span>Konsultasi via WhatsApp</span>
    </a>
@endif

<button type="button" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top" aria-label="Back to top" data-back-to-top>↑</button>
