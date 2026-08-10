@extends('layouts.app')

@section('title', 'JASAIBNU — IT Solutions, Software Development, SaaS & AI')
@section('meta_description', 'PT JASA IBNU DEVELOPMENT membantu perusahaan membangun website, aplikasi, software, SaaS, integrasi AI, dan solusi IT yang dirancang sesuai kebutuhan bisnis.')

@section('content')
    <section class="hero">
        <div class="container hero-grid">
            <div class="hero-copy">
                <p class="eyebrow">IT SOLUTIONS • SOFTWARE DEVELOPMENT • SAAS • AI INTEGRATION</p>
                <h1>Solusi Digital untuk Bisnis yang Siap Bertumbuh</h1>
                <p class="hero-lead">PT JASA IBNU DEVELOPMENT membantu perusahaan membangun website, aplikasi, SaaS, integrasi AI, dan sistem digital yang scalable, aman, dan siap dikembangkan jangka panjang.</p>

                <div class="button-row">
                    <a class="button button-primary" href="{{ route('contact') }}">Konsultasi Gratis</a>
                    <a class="button button-ghost" href="{{ route('services.index') }}">Lihat Layanan</a>
                </div>

                <p class="trust-line">Custom Development • SEO Ready • Secure Architecture • Scalable System</p>
            </div>

            <div class="delivery-interface" role="img" aria-label="Corporate delivery interface showing software project flow, secure architecture, and scalable deployment">
                <div class="interface-shell">
                    <div class="interface-header">
                        <span>Digital Delivery System</span>
                        <strong>JASAIBNU</strong>
                    </div>

                    <div class="pipeline">
                        @foreach ([
                            ['step' => '01', 'label' => 'Discovery'],
                            ['step' => '02', 'label' => 'UI/UX'],
                            ['step' => '03', 'label' => 'Development'],
                            ['step' => '04', 'label' => 'SaaS Platform'],
                            ['step' => '05', 'label' => 'AI Integration'],
                            ['step' => '06', 'label' => 'Deployment'],
                            ['step' => '07', 'label' => 'Support'],
                        ] as $item)
                            <div class="pipeline-row">
                                <span>{{ $item['step'] }}</span>
                                <p>{{ $item['label'] }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="system-layer">
                        <div>
                            <span>Architecture</span>
                            <strong>Modular</strong>
                        </div>
                        <div>
                            <span>Status</span>
                            <strong>Production Ready</strong>
                        </div>
                    </div>

                    <div class="code-line" aria-hidden="true">
                        <span>deploy</span><span>:</span><strong> secure scalable system</strong>
                    </div>
                </div>

                <div class="interface-badge badge-secure">
                    <span></span>
                    <p>Secure</p>
                </div>
                <div class="interface-badge badge-scale">
                    <span></span>
                    <p>Scalable</p>
                </div>
            </div>
        </div>
    </section>

    <section class="company-strip" aria-label="JASAIBNU service focus">
        <div class="container company-strip-inner">
            @foreach (['Building Digital Solutions for Better Business', 'Website Development', 'Web Application', 'SaaS Development', 'SEO Services', 'AI Integration'] as $focus)
                <span>{{ $focus }}</span>
            @endforeach
        </div>
    </section>

    <section class="section-pad services-preview" aria-labelledby="services-heading">
        <div class="container">
            <div class="section-heading">
                <p class="section-kicker">Services</p>
                <h2 id="services-heading">Solusi Teknologi untuk Setiap Kebutuhan Bisnis</h2>
                <a class="text-link" href="{{ route('services.index') }}">Lihat Semua Layanan</a>
            </div>

            <div class="services-layout">
                @foreach ([
                    ['title' => 'Website Development', 'body' => 'Website perusahaan yang cepat, responsive, SEO-ready, dan mudah dikembangkan.', 'featured' => true],
                    ['title' => 'SEO Services', 'body' => 'Optimasi teknis, struktur konten, dan fondasi search visibility yang rapi.'],
                    ['title' => 'Web Application', 'body' => 'Aplikasi web custom untuk workflow, data, dan proses operasional bisnis.'],
                    ['title' => 'Mobile Application', 'body' => 'Aplikasi mobile untuk kebutuhan internal, layanan pelanggan, atau operasional lapangan.'],
                    ['title' => 'SaaS Development', 'body' => 'Platform SaaS dengan struktur modular, akun pengguna, billing flow, dan roadmap produk.'],
                    ['title' => 'AI Integration', 'body' => 'Integrasi AI dan automation yang relevan untuk mempercepat pekerjaan tim.'],
                ] as $service)
                    <article class="service-card @if (! empty($service['featured'])) service-featured @endif">
                        <span class="service-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3>{{ $service['title'] }}</h3>
                        <p>{{ $service['body'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-pad why-section" aria-labelledby="why-heading">
        <div class="container why-grid">
            <div>
                <p class="section-kicker">Why JASAIBNU</p>
                <h2 id="why-heading">Technology Partner yang Berpikir tentang Bisnis Anda</h2>
                <p class="section-lead">Kami menempatkan kebutuhan bisnis sebagai titik awal, lalu memilih teknologi yang paling relevan untuk membangun solusi digital yang tahan berkembang.</p>
            </div>

            <div class="value-stack">
                @foreach ([
                    ['title' => 'Arsitektur Scalable', 'body' => 'Fondasi teknis disiapkan agar sistem tetap mudah dirawat saat kebutuhan berkembang.'],
                    ['title' => 'SEO Ready', 'body' => 'Struktur halaman, performa, dan metadata dipikirkan sejak awal pengembangan.'],
                    ['title' => 'Integrasi Sistem', 'body' => 'Website, aplikasi, API, email bisnis, cloud, dan tools operasional dapat dirancang saling terhubung.'],
                    ['title' => 'Maintenance & Support', 'body' => 'Setelah rilis, sistem dapat dipantau, diperbaiki, dan dikembangkan bertahap.'],
                ] as $value)
                    <article class="value-item">
                        <h3>{{ $value['title'] }}</h3>
                        <p>{{ $value['body'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-pad" aria-labelledby="solutions-heading">
        <div class="container">
            <div class="section-heading">
                <p class="section-kicker">Solutions</p>
                <h2 id="solutions-heading">Solusi untuk Transformasi Bisnis</h2>
                <a class="text-link" href="{{ route('solutions.index') }}">Jelajahi Solutions</a>
            </div>

            <div class="solution-grid">
                @foreach ([
                    ['title' => 'Digital Transformation', 'body' => 'Merapikan proses manual menjadi alur digital yang lebih mudah dipantau.'],
                    ['title' => 'Business Process Automation', 'body' => 'Automation untuk pekerjaan berulang agar tim dapat fokus pada pekerjaan bernilai tinggi.'],
                    ['title' => 'CRM Solutions', 'body' => 'Fondasi pengelolaan prospek, pelanggan, follow-up, dan aktivitas sales.'],
                    ['title' => 'Enterprise Applications', 'body' => 'Aplikasi internal untuk data, approval, laporan, dan kontrol operasional.'],
                    ['title' => 'AI for Business', 'body' => 'Pemanfaatan AI untuk bantuan kerja, pencarian informasi, dan workflow internal.'],
                    ['title' => 'Cloud Solutions', 'body' => 'Setup server, deployment, domain, email, dan environment yang siap bertumbuh.'],
                ] as $solution)
                    <article class="solution-item">
                        <h3>{{ $solution['title'] }}</h3>
                        <p>{{ $solution['body'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-pad process-section" aria-labelledby="process-heading">
        <div class="container">
            <div class="section-heading">
                <p class="section-kicker">Process</p>
                <h2 id="process-heading">Metodologi Kerja yang Terstruktur</h2>
            </div>

            <div class="timeline">
                @foreach ([
                    ['step' => '01', 'title' => 'Discovery & Strategi', 'body' => 'Memahami kebutuhan bisnis, pengguna, dan prioritas pengembangan.'],
                    ['step' => '02', 'title' => 'Perencanaan', 'body' => 'Menyusun scope, struktur fitur, timeline, dan pendekatan teknis.'],
                    ['step' => '03', 'title' => 'UI/UX & Development', 'body' => 'Membangun interface dan sistem dengan fondasi yang rapi.'],
                    ['step' => '04', 'title' => 'Testing', 'body' => 'Menguji alur penting, responsive layout, performa, dan stabilitas dasar.'],
                    ['step' => '05', 'title' => 'Deployment', 'body' => 'Menyiapkan rilis, environment, domain, dan konfigurasi produksi.'],
                    ['step' => '06', 'title' => 'Maintenance', 'body' => 'Mendukung perbaikan, peningkatan fitur, dan pengembangan lanjutan.'],
                ] as $process)
                    <article class="timeline-item">
                        <span>{{ $process['step'] }}</span>
                        <h3>{{ $process['title'] }}</h3>
                        <p>{{ $process['body'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-pad stack-section" aria-labelledby="technology-heading">
        <div class="container">
            <div class="section-heading">
                <p class="section-kicker">Technology</p>
                <h2 id="technology-heading">Technology Stack yang Siap Dikembangkan</h2>
            </div>

            <div class="chip-row chip-row-subtle">
                @foreach (['Laravel', 'PHP', 'Blade', 'Vite', 'JavaScript', 'MySQL', 'PostgreSQL', 'REST API', 'Cloud Server', 'AI Integration'] as $tech)
                    <span class="chip">{{ $tech }}</span>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-pad portfolio-insights" aria-label="Portfolio and insights preview">
        <div class="container preview-grid">
            <article class="preview-panel">
                <p class="section-kicker">Portfolio</p>
                <h2>Selected Work</h2>
                <p>Halaman portfolio disiapkan untuk menampilkan studi kasus dan proyek terpilih yang sudah siap dipublikasikan.</p>
                <a class="button button-secondary" href="{{ route('portfolio.index') }}">Lihat Portfolio</a>
            </article>

            <article class="preview-panel preview-panel-muted">
                <p class="section-kicker">Insights</p>
                <h2>Insights & Technology</h2>
                <p>Topik seputar web development, software, SaaS, SEO, automation, cloud, dan AI untuk bisnis akan disiapkan bertahap.</p>
                <a class="button button-secondary" href="{{ route('insights.index') }}">Lihat Insights</a>
            </article>
        </div>
    </section>

    <section class="final-cta" aria-labelledby="contact-heading">
        <div class="container cta-panel">
            <p class="section-kicker">Start a Project</p>
            <h2 id="contact-heading">Mari Bangun Solusi Digital untuk Bisnis Anda</h2>
            <p>Diskusikan kebutuhan website, aplikasi, software, SaaS, AI, atau infrastruktur IT bersama tim JASAIBNU.</p>
            <a class="button button-light" href="{{ route('contact') }}">Diskusikan Project Anda</a>
        </div>
    </section>
@endsection
