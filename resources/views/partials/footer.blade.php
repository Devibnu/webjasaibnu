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
                        <h1 class="m-0 text-white"><span class="ji-footer-brand-icon me-2">JI</span>{{ $siteSettings->company_name }}</h1>
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

<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top" aria-label="Back to top" data-back-to-top>↑</a>
