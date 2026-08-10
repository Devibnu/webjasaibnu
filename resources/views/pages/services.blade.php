@extends('layouts.app')

@section('title', 'Layanan Digital JASAIBNU — Website, SEO, Software, SaaS & AI')
@section('meta_description', 'Layanan PT JASA IBNU DEVELOPMENT untuk website development, SEO services, web application, mobile application, SaaS development, dan AI integration yang scalable, aman, dan siap dikembangkan.')

@section('content')
    <section class="page-hero page-hero-dark services-hero">
        <div class="container page-hero-grid">
            <div>
                <p class="eyebrow">LAYANAN JASAIBNU</p>
                <h1>Layanan Digital untuk Membangun dan Mengembangkan Bisnis Anda</h1>
                <p>JASAIBNU membantu bisnis membangun website, aplikasi, SaaS, SEO, dan integrasi AI dengan fondasi teknis yang scalable, aman, dan siap dikembangkan jangka panjang.</p>

                <div class="button-row">
                    <a class="button button-primary" href="{{ route('contact') }}">Konsultasi Gratis</a>
                    <a class="button button-ghost" href="{{ route('solutions.index') }}">Lihat Solusi</a>
                </div>
            </div>

            <div class="services-hero-panel" aria-label="JASAIBNU service focus">
                <span>IT Solutions</span>
                <span>Software Development</span>
                <span>SaaS</span>
                <span>AI Integration</span>
            </div>
        </div>
    </section>

    <section class="section-pad services-parent-section" aria-labelledby="services-overview-heading">
        <div class="container">
            <div class="section-heading">
                <p class="section-kicker">Services Overview</p>
                <h2 id="services-overview-heading">Layanan Utama untuk Fondasi Digital Perusahaan</h2>
                <p>Setiap layanan dapat dimulai sebagai project terpisah atau digabungkan menjadi sistem digital yang saling terhubung.</p>
            </div>

            <div class="services-parent-grid">
                @foreach ([
                    [
                        'title' => 'Website Development',
                        'body' => 'Website perusahaan yang cepat, responsive, SEO-ready, dan dibangun dengan struktur yang mudah dikembangkan.',
                        'benefits' => ['Corporate profile rapi', 'Struktur SEO lebih siap', 'Performa dan responsive layout'],
                        'featured' => true,
                    ],
                    [
                        'title' => 'SEO Services',
                        'body' => 'Optimasi teknis dan struktur konten untuk membantu website lebih mudah dipahami mesin pencari.',
                        'benefits' => ['Technical SEO foundation', 'On-page structure', 'Content architecture'],
                    ],
                    [
                        'title' => 'Web Application',
                        'body' => 'Aplikasi web custom untuk merapikan workflow, data, approval, panel operasional, dan proses internal.',
                        'benefits' => ['Workflow bisnis custom', 'Role dan akses pengguna', 'Data operasional terstruktur'],
                    ],
                    [
                        'title' => 'Mobile Application',
                        'body' => 'Aplikasi mobile untuk kebutuhan internal, layanan pelanggan, atau operasional lapangan yang membutuhkan akses cepat.',
                        'benefits' => ['Customer-facing app', 'Internal mobile workflow', 'Integrasi API backend'],
                    ],
                    [
                        'title' => 'SaaS Development',
                        'body' => 'Pengembangan platform SaaS dengan fondasi produk, akun pengguna, subscription flow, dan roadmap fitur.',
                        'benefits' => ['Multi-user platform', 'Subscription-ready flow', 'Modular product roadmap'],
                    ],
                    [
                        'title' => 'AI Integration',
                        'body' => 'Integrasi AI dan automation yang relevan untuk mempercepat pekerjaan, pencarian informasi, dan proses tim.',
                        'benefits' => ['Automation workflow', 'AI assistant internal', 'Integrasi data dan API'],
                    ],
                ] as $service)
                    <article class="services-parent-card @if (! empty($service['featured'])) services-parent-card-featured @endif">
                        <div>
                            <span class="service-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <h2>{{ $service['title'] }}</h2>
                            <p>{{ $service['body'] }}</p>
                        </div>

                        <ul>
                            @foreach ($service['benefits'] as $benefit)
                                <li>{{ $benefit }}</li>
                            @endforeach
                        </ul>

                        <a class="text-link" href="{{ route('contact') }}">Diskusikan Layanan Ini</a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-pad services-method-section" aria-labelledby="how-we-help-heading">
        <div class="container">
            <div class="section-heading">
                <p class="section-kicker">How We Help</p>
                <h2 id="how-we-help-heading">Pendekatan Kerja yang Rapi dari Awal sampai Maintenance</h2>
                <p>JASAIBNU memulai dari kebutuhan bisnis, lalu menerjemahkannya menjadi solusi digital yang realistis, terukur, dan siap dirawat.</p>
            </div>

            <div class="services-method-grid">
                @foreach ([
                    ['step' => '01', 'title' => 'Discovery kebutuhan bisnis'],
                    ['step' => '02', 'title' => 'Desain solusi'],
                    ['step' => '03', 'title' => 'Development'],
                    ['step' => '04', 'title' => 'Testing'],
                    ['step' => '05', 'title' => 'Deployment'],
                    ['step' => '06', 'title' => 'Maintenance'],
                ] as $item)
                    <article class="services-method-item">
                        <span>{{ $item['step'] }}</span>
                        <h3>{{ $item['title'] }}</h3>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="final-cta services-cta" aria-labelledby="services-contact-heading">
        <div class="container cta-panel">
            <p class="section-kicker">Consultation</p>
            <h2 id="services-contact-heading">Butuh Layanan Digital yang Sesuai dengan Kebutuhan Bisnis?</h2>
            <p>Ceritakan kebutuhan website, aplikasi, SaaS, SEO, integrasi AI, atau sistem internal yang ingin Anda bangun.</p>
            <a class="button button-light" href="{{ route('contact') }}">Konsultasi Gratis</a>
        </div>
    </section>
@endsection
