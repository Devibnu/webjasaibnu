@extends('layouts.app')

@section('title', 'Contact JASAIBNU | PT JASA IBNU DEVELOPMENT')
@section('meta_description', 'Hubungi JASAIBNU untuk konsultasi website, aplikasi, SaaS, SEO, integrasi sistem, dan penerapan AI untuk kebutuhan bisnis.')
@section('body_class', 'contact-page startup2-home')

@push('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
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
        .startup2-home .ji-topbar-icon {
            font-weight: 800;
            line-height: 1;
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
    <section class="contact-content" aria-labelledby="contact-main-heading">
        <div class="contact-shell">
            <div class="contact-section-title">
                <p>HUBUNGI KAMI</p>
                <h2 id="contact-main-heading">Mari Diskusikan Kebutuhan Digital Anda</h2>
                <span>Ceritakan kebutuhan website, aplikasi, SaaS, SEO, integrasi sistem, atau penerapan AI untuk bisnis Anda. Kami akan membantu memahami kebutuhan dan pendekatan teknologi yang sesuai.</span>
            </div>

            <div class="contact-info-grid" aria-label="Informasi kontak JASAIBNU">
                @foreach ([
                    ['icon' => '⌖', 'label' => 'LOCATION', 'value' => $siteSettings->contactAddress()],
                    ['icon' => '✉', 'label' => 'EMAIL', 'value' => $siteSettings->email],
                    ['icon' => '☎', 'label' => 'CONSULTATION', 'value' => $siteSettings->phone],
                ] as $item)
                    <article class="contact-info-item">
                        <span aria-hidden="true">{{ $item['icon'] }}</span>
                        <div>
                            <h3>{{ $item['label'] }}</h3>
                            <p>{{ $item['value'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="contact-main-grid">
                <form class="contact-form" action="{{ route('contact.store') }}" method="POST" novalidate>
                    @csrf

                    @if (session('contact_status'))
                        <div class="contact-alert contact-alert-success" role="status">
                            {{ session('contact_status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="contact-alert contact-alert-error" role="alert">
                            Mohon lengkapi data yang wajib diisi dengan benar.
                        </div>
                    @endif

                    <div class="contact-form-row">
                        <label>
                            <span>Nama</span>
                            <input type="text" name="name" value="{{ old('name') }}" required>
                            @error('name') <small>{{ $message }}</small> @enderror
                        </label>

                        <label>
                            <span>Email</span>
                            <input type="email" name="email" value="{{ old('email') }}" required>
                            @error('email') <small>{{ $message }}</small> @enderror
                        </label>
                    </div>

                    <div class="contact-form-row">
                        <label>
                            <span>Nomor WhatsApp</span>
                            <input type="text" name="phone" value="{{ old('phone') }}">
                            @error('phone') <small>{{ $message }}</small> @enderror
                        </label>

                        <label>
                            <span>Perusahaan / Bisnis</span>
                            <input type="text" name="company" value="{{ old('company') }}">
                            @error('company') <small>{{ $message }}</small> @enderror
                        </label>
                    </div>

                    <label>
                        <span>Layanan yang Dibutuhkan</span>
                        <select name="service" required>
                            <option value="">Pilih layanan</option>
                            @foreach ([
                                'Website Development',
                                'SEO Services',
                                'Web Application',
                                'Mobile Application',
                                'SaaS Development',
                                'System Integration',
                                'AI Integration',
                                'Lainnya',
                            ] as $service)
                                <option value="{{ $service }}" @selected(old('service') === $service)>{{ $service }}</option>
                            @endforeach
                        </select>
                        @error('service') <small>{{ $message }}</small> @enderror
                    </label>

                    <label>
                        <span>Pesan</span>
                        <textarea name="message" rows="5" required>{{ old('message') }}</textarea>
                        @error('message') <small>{{ $message }}</small> @enderror
                    </label>

                    <button type="submit">Kirim Pesan</button>
                </form>

                <div class="contact-map-panel" aria-label="Peta area {{ $siteSettings->contactAddress() }}">
                    {{-- Replace general Jakarta map with verified office location when available --}}
                    <iframe
                        src="{{ $siteSettings->google_maps_embed_url }}"
                        title="Lokasi {{ $siteSettings->company_name }} - {{ $siteSettings->contactAddress() }}"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection
