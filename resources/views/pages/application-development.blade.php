@extends('layouts.app')

@php
    $canonical = route('application-development');
    $applicationSettings = \App\Models\SiteSetting::current();
    $whatsappMessage = "Halo JASAIBNU, saya ingin berkonsultasi mengenai aplikasi bisnis.\n\nProses bisnis yang ingin didukung:\nPengguna aplikasi:\nFitur atau integrasi yang dibutuhkan:\nCatatan:";
    $consultationUrl = $applicationSettings->whatsappContactUrl($whatsappMessage) ?: route('contact');
    $consultationExternal = str_starts_with($consultationUrl, 'http');
    $faqs = [
        ['Apa itu aplikasi bisnis custom?', 'Aplikasi bisnis custom adalah sistem yang dirancang mengikuti proses, pengguna, data, dan kebutuhan operasional tertentu. Struktur fitur dan implementasinya ditentukan melalui analisis kebutuhan serta ruang lingkup project.'],
        ['Apa perbedaan website dan aplikasi web?', 'Website umumnya berfokus pada penyajian informasi dan komunikasi kepada pengunjung. Aplikasi web mendukung aktivitas seperti login, pengelolaan data, workflow, approval, dashboard, reporting, atau proses operasional lainnya.'],
        ['Apa perbedaan aplikasi custom dan software siap pakai?', 'Software siap pakai menawarkan alur dan fitur yang telah ditentukan penyedia. Aplikasi custom dirancang agar lebih dekat dengan proses bisnis aktual, tetapi kebutuhan, biaya, pengembangan, dan perawatannya perlu dipetakan secara khusus.'],
        ['Apakah aplikasi yang dibuat berbasis web?', 'Fokus layanan ini adalah aplikasi bisnis berbasis web yang dapat diakses melalui browser. Dukungan perangkat, pola akses, dan kebutuhan responsive ditentukan berdasarkan pengguna serta ruang lingkup project.'],
        ['Proses bisnis apa yang dapat didukung?', 'Contohnya meliputi pengelolaan customer dan sales pipeline, ticketing, approval, workflow operasional, dashboard, reporting, monitoring, serta portal internal atau pelanggan. Contoh tersebut adalah kemungkinan use case, bukan fitur wajib setiap project.'],
        ['Apakah aplikasi dapat memiliki role dan permission?', 'Bisa. Role, permission, batas akses data, serta tindakan yang tersedia bagi setiap jenis pengguna dapat dirancang sesuai kebutuhan dan hasil analisis proses bisnis.'],
        ['Apakah dashboard dan reporting dapat disesuaikan?', 'Dashboard dan reporting dapat dirancang berdasarkan data, indikator, filter, serta kebutuhan pengguna yang disepakati. Ketersediaan dan kualitas sumber data akan memengaruhi ruang lingkup implementasi.'],
        ['Apakah aplikasi dapat terhubung ke API atau sistem lain?', 'Integrasi dapat dievaluasi berdasarkan ketersediaan API, dokumentasi, akses, batas penyedia, struktur data, serta kebutuhan sinkronisasi. Kelayakannya perlu diperiksa sebelum menjadi komitmen project.'],
        ['Apakah data dari sistem lama dapat dimigrasikan?', 'Migrasi dapat menjadi bagian dari ruang lingkup setelah format, volume, kualitas, relasi, dan akses data lama diperiksa. Proses pembersihan atau transformasi data mungkin dibutuhkan sesuai kondisi sumber.'],
        ['Bagaimana pendekatan keamanan aplikasinya?', 'Pendekatan dapat mencakup role-based access, permission boundaries, validasi, data-access controls, konfigurasi yang sesuai, dan testing berdasarkan ruang lingkup. Arsitektur keamanan disesuaikan dengan kebutuhan dan risiko project, bukan dijanjikan secara absolut.'],
        ['Bagaimana source code dan proses handover?', 'Kepemilikan, akses, source code, deployment credentials, dokumentasi, data, dan bentuk handover ditetapkan dalam ruang lingkup serta perjanjian project.'],
        ['Apakah tersedia maintenance setelah go-live?', 'Maintenance dan support dapat dibahas sesuai kebutuhan, tanggung jawab operasional, infrastruktur, serta kesepakatan setelah aplikasi digunakan.'],
        ['Berapa lama proses development?', 'Durasi bergantung pada kompleksitas workflow, jumlah pengguna dan role, modul, integrasi, kesiapan data, proses review, testing, dan deployment. Timeline disusun setelah kebutuhan utama dipetakan.'],
        ['Berapa biaya pembuatan aplikasi?', 'Biaya ditentukan oleh ruang lingkup, kompleksitas fitur, kebutuhan UI, integrasi, data, infrastruktur, testing, deployment, dan support. Penawaran disusun setelah proses bisnis serta prioritas project dipahami.'],
    ];
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        '@id' => $canonical . '#service',
        'url' => $canonical,
        'name' => 'Jasa Pembuatan Aplikasi untuk Kebutuhan Bisnis',
        'description' => 'JASAIBNU menyediakan jasa pembuatan aplikasi bisnis berbasis web sesuai kebutuhan untuk workflow, dashboard, reporting, integrasi, dan operasional perusahaan.',
        'serviceType' => 'Jasa pembuatan aplikasi',
        'areaServed' => ['@type' => 'Country', 'name' => 'Indonesia'],
        'provider' => ['@id' => rtrim(route('home'), '/') . '#professional-service'],
    ];
    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        '@id' => $canonical . '#faq',
        'mainEntity' => collect($faqs)->map(fn ($faq) => [
            '@type' => 'Question',
            'name' => $faq[0],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq[1]],
        ])->values()->all(),
    ];
@endphp

@section('title', 'Jasa Pembuatan Aplikasi Custom untuk Bisnis | JASAIBNU')
@section('meta_description', 'JASAIBNU menyediakan jasa pembuatan aplikasi bisnis berbasis web sesuai kebutuhan untuk workflow, dashboard, reporting, integrasi, dan operasional perusahaan.')
@section('canonical', $canonical)
@section('robots', 'index,follow')
@section('body_class', 'startup2-home application-development-page')

@push('head')
    <style>
        .application-development-page { --app-navy: #061429; --app-blue: #06a3da; --app-ink: #243247; --app-muted: #627084; --app-soft: #f2f6f9; color: var(--app-ink); overflow-x: hidden; }
        .application-development-page > .container-fluid.bg-dark,
        .application-development-page > .startup-inner-shell { font-family: "Rubik", Arial, sans-serif; }
        .application-development-page .navbar-dark .navbar-nav .nav-link { margin-left: 18px; font-size: 14px; font-weight: 500; }
        .application-development-page .navbar .btn { padding: .48rem 1.05rem !important; font-size: .9rem; }
        .app-shell { width: min(100% - 48px, 1180px); margin-inline: auto; }
        .app-hero { padding: 86px 0 74px; background: var(--app-navy); color: #fff; }
        .app-hero-grid { display: grid; grid-template-columns: minmax(0, 1.12fr) minmax(330px, .88fr); gap: 58px; align-items: center; }
        .app-eyebrow { margin: 0 0 14px; color: var(--app-blue); font-size: .82rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0; }
        .app-hero h1 { max-width: 760px; margin: 0; color: #fff; font-size: clamp(2.35rem, 4vw, 4.15rem); line-height: 1.08; letter-spacing: 0; }
        .app-hero-copy { max-width: 760px; margin: 24px 0 0; color: #d4deea; font-size: 1.08rem; line-height: 1.75; }
        .app-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 30px; }
        .app-button { display: inline-flex; min-height: 48px; align-items: center; justify-content: center; padding: 12px 20px; border: 1px solid var(--app-blue); border-radius: 4px; background: var(--app-blue); color: #fff; font-weight: 700; text-decoration: none; }
        .app-button:hover { background: #078bb9; color: #fff; }
        .app-button.secondary { border-color: rgba(255,255,255,.55); background: transparent; }
        .app-system-map { padding: 28px; border: 1px solid rgba(255,255,255,.2); background: #0c213c; }
        .app-system-map strong { display: block; margin-bottom: 18px; color: #fff; font-size: 1.05rem; }
        .app-flow { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
        .app-flow span { min-width: 0; padding: 13px; border-left: 3px solid var(--app-blue); background: rgba(255,255,255,.07); color: #dce5ef; font-size: .92rem; }
        .app-flow span:last-child { grid-column: 1 / -1; text-align: center; }
        .app-section { padding: 76px 0; }
        .app-section.alt { background: var(--app-soft); }
        .app-heading { max-width: 790px; margin-bottom: 34px; }
        .app-heading h2 { margin: 0 0 14px; color: var(--app-navy); font-size: clamp(1.75rem, 2.5vw, 2.55rem); line-height: 1.2; letter-spacing: 0; }
        .app-heading p:last-child { margin-bottom: 0; color: var(--app-muted); line-height: 1.75; }
        .app-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
        .app-card { min-width: 0; padding: 24px; border: 1px solid #d8e2e9; border-radius: 6px; background: #fff; }
        .app-card h3 { margin: 0 0 9px; color: var(--app-navy); font-size: 1.06rem; letter-spacing: 0; }
        .app-card p { margin: 0; color: var(--app-muted); line-height: 1.68; }
        .app-problem-layout { display: grid; grid-template-columns: minmax(0, .82fr) minmax(0, 1.18fr); gap: 48px; align-items: start; }
        .app-list { display: grid; gap: 12px; }
        .app-list article { padding: 18px 20px; border-left: 3px solid var(--app-blue); background: #fff; }
        .app-list h3, .app-list p { margin: 0; }
        .app-list h3 { margin-bottom: 5px; color: var(--app-navy); font-size: 1rem; }
        .app-list p { color: var(--app-muted); line-height: 1.6; }
        .app-signals { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); border: 1px solid #d8e2e9; background: #fff; }
        .app-signals article { min-width: 0; padding: 24px; border-bottom: 1px solid #d8e2e9; }
        .app-signals article:nth-child(odd) { border-right: 1px solid #d8e2e9; }
        .app-signals article:nth-last-child(-n+2) { border-bottom: 0; }
        .app-signals h3 { margin: 0 0 8px; color: var(--app-navy); font-size: 1.02rem; }
        .app-signals p { margin: 0; color: var(--app-muted); line-height: 1.65; }
        .app-matrix { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); border: 1px solid #d5e0e7; background: #fff; }
        .app-matrix-column { min-width: 0; padding: 28px; }
        .app-matrix-column + .app-matrix-column { border-left: 1px solid #d5e0e7; }
        .app-matrix h3 { margin: 0 0 17px; color: var(--app-navy); font-size: 1.14rem; }
        .app-checklist { display: grid; gap: 10px; margin: 0; padding: 0; list-style: none; }
        .app-checklist li { position: relative; padding-left: 22px; color: var(--app-muted); line-height: 1.55; }
        .app-checklist li::before { position: absolute; left: 0; color: var(--app-blue); content: "✓"; font-weight: 800; }
        .app-note { margin: 22px 0 0; padding: 17px 19px; border-left: 3px solid var(--app-blue); background: #e7f5fb; line-height: 1.65; }
        .app-process { display: grid; grid-template-columns: repeat(7, minmax(0, 1fr)); gap: 10px; counter-reset: app-step; }
        .app-process article { min-width: 0; padding: 20px 16px; border-top: 3px solid var(--app-blue); background: #fff; counter-increment: app-step; }
        .app-process article::before { display: block; margin-bottom: 13px; color: var(--app-blue); content: "0" counter(app-step); font-weight: 800; }
        .app-process h3 { margin: 0 0 7px; color: var(--app-navy); font-size: .95rem; }
        .app-process p { margin: 0; color: var(--app-muted); font-size: .88rem; line-height: 1.55; }
        .app-technical { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
        .app-technical article { min-width: 0; padding: 27px; border-top: 4px solid var(--app-blue); background: var(--app-navy); color: #d5dfeb; }
        .app-technical h2 { margin: 0 0 12px; color: #fff; font-size: 1.35rem; letter-spacing: 0; }
        .app-technical p { margin: 0; line-height: 1.7; }
        .app-proof { display: grid; grid-template-columns: minmax(280px, .8fr) minmax(0, 1.2fr); border: 1px solid #d8e2e9; background: #fff; }
        .app-proof img { width: 100%; height: 100%; min-height: 330px; object-fit: cover; }
        .app-proof-content { padding: 38px; }
        .app-proof-content h2 { margin: 0 0 13px; color: var(--app-navy); font-size: clamp(1.65rem, 2.3vw, 2.25rem); letter-spacing: 0; }
        .app-proof-content p { color: var(--app-muted); line-height: 1.7; }
        .app-proof-content .app-button { margin-top: 8px; }
        .app-faq-list { display: grid; gap: 11px; }
        .app-faq { border: 1px solid #d5e0e7; border-radius: 6px; background: #fff; }
        .app-faq summary { padding: 19px 21px; color: var(--app-navy); cursor: pointer; }
        .app-faq summary h3 { display: inline; margin: 0; font-size: 1.01rem; letter-spacing: 0; }
        .app-faq p { margin: 0; padding: 0 21px 21px; color: var(--app-muted); line-height: 1.7; }
        .app-final { padding: 62px 0; background: var(--app-blue); color: #fff; }
        .app-final-row { display: grid; grid-template-columns: minmax(0, 1fr) auto; gap: 30px; align-items: center; }
        .app-final h2 { margin: 0 0 10px; color: #fff; font-size: clamp(1.7rem, 2.5vw, 2.45rem); letter-spacing: 0; }
        .app-final p { max-width: 780px; margin: 0; line-height: 1.7; }
        .app-final .app-button { border-color: #fff; background: #fff; color: var(--app-navy); }
        .app-inline-link { color: inherit; font-weight: 700; text-decoration: underline; }
        @media (max-width: 1199.98px) { .application-development-page .navbar-dark .navbar-nav .nav-link { margin-left: 12px; font-size: 13.5px; } }
        @media (max-width: 1024px) { .app-hero-grid { gap: 34px; } .app-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } .app-process { grid-template-columns: repeat(4, minmax(0, 1fr)); } }
        @media (max-width: 991.98px) {
            .application-development-page .navbar { min-height: 74px; padding-top: .75rem !important; padding-bottom: .75rem !important; background: #fff; }
            .application-development-page .ji-header-logo-stack { display: inline-block; max-width: min(230px, 62vw); }
            .application-development-page .ji-header-logo { width: auto; max-height: 42px; }
            .application-development-page .ji-header-logo-public { display: none; }
            .application-development-page .ji-header-logo-dark { display: inline-block; }
            .application-development-page .navbar-toggler { width: 42px; height: 42px; border: 1px solid #06a3da; border-radius: 2px; background: #fff; color: #06a3da; }
        }
        @media (max-width: 767.98px) { .app-shell { width: min(100% - 32px, 680px); } .app-hero { padding: 62px 0 54px; } .app-hero-grid, .app-problem-layout, .app-proof, .app-final-row { grid-template-columns: 1fr; } .app-section { padding: 56px 0; } .app-grid, .app-technical { grid-template-columns: 1fr; } .app-matrix { grid-template-columns: 1fr; } .app-matrix-column + .app-matrix-column { border-top: 1px solid #d5e0e7; border-left: 0; } .app-process { grid-template-columns: repeat(2, minmax(0, 1fr)); } .app-proof img { min-height: 260px; } }
        @media (max-width: 575.98px) { .application-development-page .navbar { min-height: 68px; padding-right: 16px !important; padding-left: 16px !important; } .application-development-page .ji-header-logo-stack { max-width: min(190px, 58vw); } }
        @media (max-width: 430px) { .app-shell { width: min(100% - 24px, 406px); } .app-hero { padding: 48px 0 42px; } .app-hero h1 { font-size: 2.18rem; } .app-actions { display: grid; } .app-button { width: 100%; text-align: center; } .app-system-map { display: none; } .app-card, .app-matrix-column, .app-proof-content { padding: 21px; } .app-flow, .app-signals, .app-process { grid-template-columns: 1fr; } .app-flow span:last-child { grid-column: auto; } .app-signals article, .app-signals article:nth-child(odd), .app-signals article:nth-last-child(-n+2) { border-right: 0; border-bottom: 1px solid #d8e2e9; } .app-signals article:last-child { border-bottom: 0; } }
    </style>
    <script type="application/ld+json">@json($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
    <script type="application/ld+json">@json($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
@endpush

@section('content')
    <section class="app-hero" aria-labelledby="application-development-title">
        <div class="app-shell app-hero-grid">
            <div>
                <p class="app-eyebrow">CUSTOM BUSINESS APPLICATION</p>
                <h1 id="application-development-title">Jasa Pembuatan Aplikasi untuk Kebutuhan Bisnis</h1>
                <p class="app-hero-copy">JASAIBNU membantu merancang aplikasi bisnis berbasis web yang mengikuti workflow, kebutuhan pengguna, pengelolaan data, dashboard, reporting, dan integrasi sistem sesuai ruang lingkup project.</p>
                <div class="app-actions">
                    <a class="app-button" href="{{ $consultationUrl }}" @if($consultationExternal) target="_blank" rel="noopener noreferrer" @endif>Konsultasikan Kebutuhan Aplikasi</a>
                    <a class="app-button secondary" href="{{ route('portfolio.index') }}">Lihat Portfolio JASAIBNU</a>
                </div>
            </div>
            <aside class="app-system-map" aria-label="Contoh alur aplikasi bisnis">
                <strong>Alur sistem yang mengikuti proses kerja</strong>
                <div class="app-flow"><span>Pengguna &amp; akses</span><span>Data bisnis</span><span>Workflow &amp; approval</span><span>Integrasi sistem</span><span>Dashboard &amp; reporting</span></div>
            </aside>
        </div>
    </section>

    <section class="app-section alt" aria-labelledby="business-problems-title"><div class="app-shell app-problem-layout">
        <div class="app-heading"><p class="app-eyebrow">BUSINESS PROBLEMS</p><h2 id="business-problems-title">Proses yang berkembang membutuhkan kontrol dan alur yang lebih jelas.</h2><p>Aplikasi custom mulai relevan ketika alat kerja yang ada menyulitkan tim melihat data dan menjalankan proses secara konsisten.</p></div>
        <div class="app-list">@foreach ([['Spreadsheet sulit dikendalikan','File tersebar, versi data berbeda, atau akses mulai sulit dikelola.'],['Input data berulang','Informasi yang sama perlu dicatat kembali pada beberapa tempat.'],['Approval belum terstruktur','Permintaan, penanggung jawab, status, dan riwayat keputusan tidak berada dalam satu alur.'],['Sistem tidak terhubung','Data dari beberapa alat perlu dipindahkan atau dicocokkan secara manual.'],['Reporting masih manual','Tim memerlukan waktu untuk menggabungkan data sebelum laporan dapat digunakan.'],['Akses pengguna berbeda','Setiap role memerlukan batas data dan tindakan yang tidak sama.']] as [$title, $copy])<article><h3>{{ $title }}</h3><p>{{ $copy }}</p></article>@endforeach</div>
    </div></section>

    <section class="app-section" aria-labelledby="custom-signals-title"><div class="app-shell"><div class="app-heading"><p class="app-eyebrow">KAPAN APLIKASI CUSTOM DIBUTUHKAN</p><h2 id="custom-signals-title">Pertimbangkan sistem khusus ketika proses bisnis tidak lagi cocok dengan alur software siap pakai.</h2><p>Keputusan tetap perlu dimulai dari analisis kebutuhan, pengguna, data, risiko, dan prioritas implementasi.</p></div><div class="app-signals">
        @foreach ([['Workflow memiliki aturan khusus','Tahap, status, validasi, atau approval mengikuti kebijakan internal.'],['Data perlu dipantau bersama','Tim membutuhkan sumber data dan konteks status yang lebih konsisten.'],['Tools yang ada membatasi proses','Fitur generik memaksa tim mengubah cara kerja yang sebenarnya penting.'],['Sistem perlu dikembangkan bertahap','Kebutuhan awal dan roadmap berikutnya perlu disusun dalam arsitektur modular.']] as [$title, $copy])<article><h3>{{ $title }}</h3><p>{{ $copy }}</p></article>@endforeach
    </div><p class="app-note">Pelajari juga pembahasan informasional tentang <a href="{{ route('insights.show', 'kapan-bisnis-membutuhkan-aplikasi-web-custom') }}">kapan bisnis membutuhkan aplikasi web custom</a>.</p></div></section>

    <section class="app-section alt" aria-labelledby="use-cases-title"><div class="app-shell"><div class="app-heading"><p class="app-eyebrow">USE CASES</p><h2 id="use-cases-title">Contoh sistem yang dapat dipetakan dari kebutuhan operasional.</h2><p>Daftar ini menggambarkan kategori capability dan kemungkinan penggunaan, bukan klaim project klien atau fitur yang otomatis tersedia.</p></div><div class="app-grid">
        @foreach ([['CRM & Sales Pipeline','Customer, lead, opportunity, aktivitas, dan tindak lanjut penjualan.'],['Service Management','Ticketing, assignment, status layanan, dan riwayat penanganan.'],['Operational Workflow','Task, status, approval, dan koordinasi proses internal.'],['Dashboard & Reporting','Ringkasan, filter, indikator, serta laporan berdasarkan data yang tersedia.'],['Portal & Multi-user','Portal pelanggan atau internal dengan role dan permission yang sesuai.'],['API & System Integration','Pertukaran data dengan sistem lain setelah kelayakan integrasi diperiksa.'],['Monitoring','Pemantauan aktivitas, status, atau data operasional sesuai kebutuhan.'],['SaaS-style Application','Struktur akun dan roadmap produk modular sebagai scope-dependent.']] as [$title, $copy])<article class="app-card"><h3>{{ $title }}</h3><p>{{ $copy }}</p></article>@endforeach
    </div></div></section>

    <section class="app-section" aria-labelledby="capability-title"><div class="app-shell"><div class="app-heading"><p class="app-eyebrow">CAPABILITY MATRIX</p><h2 id="capability-title">Bedakan fondasi layanan, kemampuan umum, dan kebutuhan yang harus dievaluasi.</h2><p>Ruang lingkup final ditentukan melalui discovery dan perjanjian project.</p></div><div class="app-matrix">
        <div class="app-matrix-column"><h3>Core</h3><ul class="app-checklist">@foreach (['Custom workflow','Web application','Multi-user','Role & permission','Dashboard & reporting','Data management','Status/lifecycle','Responsive interface','API integration'] as $item)<li>{{ $item }}</li>@endforeach</ul></div>
        <div class="app-matrix-column"><h3>Generic Capability</h3><ul class="app-checklist">@foreach (['Approval flow','Customer/internal portal','Notifications','Data export','Operational monitoring','System documentation'] as $item)<li>{{ $item }}</li>@endforeach</ul></div>
        <div class="app-matrix-column"><h3>Scope-dependent</h3><ul class="app-checklist">@foreach (['Automation & external API','AI integration','SaaS/multi-tenant','Subscription flow','Advanced audit trail','Data migration','Cloud architecture','Advanced security controls','Maintenance & scalability work'] as $item)<li>{{ $item }}</li>@endforeach</ul></div>
    </div></div></section>

    <section class="app-section alt" aria-labelledby="modules-title"><div class="app-shell"><div class="app-heading"><p class="app-eyebrow">POSSIBLE MODULES</p><h2 id="modules-title">Modul dipilih berdasarkan proses, pengguna, dan prioritas project.</h2><p>Tidak setiap aplikasi membutuhkan seluruh fitur berikut. Hubungan antar modul, data, akses, dan integrasi harus ditentukan dalam scope.</p></div><div class="app-grid">
        @foreach ([['Users & Access','User management, roles, permissions, dan batas akses data.'],['Workflow & Approval','Tahap proses, assignment, approval, task, dan status.'],['Dashboard & Reporting','Ringkasan data, filter, laporan, serta export.'],['Notifications','Pemberitahuan berdasarkan event dan channel yang disepakati.'],['Integration','API, sinkronisasi, dan pertukaran data sesuai kelayakan.'],['History & Audit','Riwayat aktivitas atau audit trail sesuai tingkat kebutuhan.'],['Customer Portal','Akses layanan dan informasi bagi pengguna eksternal.'],['Internal Portal','Ruang kerja bagi tim dengan konteks role masing-masing.']] as [$title, $copy])<article class="app-card"><h3>{{ $title }}</h3><p>{{ $copy }}</p></article>@endforeach
    </div></div></section>

    <section class="app-section" aria-labelledby="process-title"><div class="app-shell"><div class="app-heading"><p class="app-eyebrow">DEVELOPMENT PROCESS</p><h2 id="process-title">Tahapan kerja dari konteks bisnis sampai sistem siap digunakan.</h2><p>Durasi setiap tahap mengikuti kompleksitas, kesiapan data, integrasi, review, dan ruang lingkup project.</p></div><div class="app-process">
        @foreach ([['Konsultasi / Discovery','Memahami tujuan, pengguna, masalah, dan batas awal.'],['Analisis Proses Bisnis','Memetakan workflow, data, role, dan prioritas.'],['Perancangan Sistem & UI','Menyusun struktur, interface, dan acceptance criteria.'],['Development','Membangun fungsi secara bertahap sesuai scope.'],['Testing','Memvalidasi fungsi dan menindaklanjuti hasil pengujian.'],['Deployment / Go Live','Menyiapkan environment dan mekanisme rilis.'],['Handover / Support','Menetapkan akses, dokumentasi, dan dukungan sesuai agreement.']] as [$title, $copy])<article><h3>{{ $title }}</h3><p>{{ $copy }}</p></article>@endforeach
    </div></div></section>

    <section class="app-section alt" aria-label="Pendekatan teknis"><div class="app-shell"><div class="app-technical">
        <article><h2>Integrasi &amp; Data Flow</h2><p>Integrasi dievaluasi berdasarkan ketersediaan API, dokumentasi, akses, batas provider, struktur data, dan kebutuhan sinkronisasi. Kelayakan pihak ketiga diperiksa sebelum menjadi komitmen project.</p></article>
        <article><h2>Security &amp; Access</h2><p>Pendekatan dapat mencakup role-based access, permission boundaries, validasi, data-access controls, secure configuration, dan testing sesuai ruang lingkup serta kebutuhan sistem.</p></article>
        <article><h2>Scalability &amp; Future Development</h2><p>Arsitektur dapat direncanakan untuk expected growth. Pengembangan modular dapat mendukung fase berikutnya, sementara infrastruktur dan optimasi mengikuti kebutuhan aktual.</p></article>
    </div></div></section>

    <section class="app-section" aria-labelledby="handover-title"><div class="app-shell"><div class="app-heading"><p class="app-eyebrow">OWNERSHIP &amp; HANDOVER</p><h2 id="handover-title">Tanggung jawab dan akses perlu jelas sebelum aplikasi diserahkan.</h2><p>Kepemilikan, akses, source code, deployment credentials, dokumentasi, data, dan bentuk handover ditetapkan dalam ruang lingkup serta perjanjian project. Maintenance dan support dibahas sesuai kebutuhan dan kesepakatan.</p></div></div></section>

    <section class="app-section alt" aria-labelledby="proof-title"><div class="app-shell"><div class="app-proof">
        <picture><source media="(max-width: 767px)" srcset="{{ asset('assets/startup2/img/optimized/feature-mobile.webp') }}"><source srcset="{{ asset('assets/startup2/img/optimized/feature-desktop.webp') }}"><img src="{{ asset('assets/startup2/img/feature.jpg') }}" alt="Perencanaan dan pengembangan sistem aplikasi bisnis" width="800" height="800" loading="lazy" decoding="async"></picture>
        <div class="app-proof-content"><p class="app-eyebrow">CAPABILITY PROOF</p><h2 id="proof-title">Tinjau jenis solusi dan capability yang telah dipublikasikan.</h2><p>Portfolio JASAIBNU mencakup kategori CRM, sales platform, service management, workflow, dashboard, SaaS, serta API dan system integration. Isinya digunakan sebagai konteks capability; kesesuaian dengan kebutuhan Anda tetap dibahas saat konsultasi.</p><p>Untuk memahami pendekatan solusi lintas kebutuhan, kunjungi juga <a href="{{ route('solutions.index') }}">halaman solusi JASAIBNU</a>.</p><a class="app-button" href="{{ route('portfolio.index') }}">Lihat Portfolio JASAIBNU</a></div>
    </div></div></section>

    <section class="app-section" aria-labelledby="faq-title"><div class="app-shell"><div class="app-heading"><p class="app-eyebrow">FAQ</p><h2 id="faq-title">Pertanyaan tentang pembuatan aplikasi bisnis custom.</h2></div><div class="app-faq-list">
        @foreach ($faqs as $index => [$question, $answer])<details class="app-faq" @if($index === 0) open @endif><summary><h3>{{ $question }}</h3></summary><p>{{ $answer }}</p></details>@endforeach
    </div></div></section>

    <section class="app-final" aria-labelledby="final-cta-title"><div class="app-shell app-final-row"><div><h2 id="final-cta-title">Mulai dari pemetaan proses dan kebutuhan aplikasi Anda.</h2><p>Ceritakan workflow, pengguna, data, fitur, serta integrasi yang perlu didukung agar ruang lingkup awal dapat dibahas dengan lebih jelas. Anda juga dapat menggunakan <a class="app-inline-link" href="{{ route('contact') }}">form kontak JASAIBNU</a>.</p></div><a class="app-button" href="{{ $consultationUrl }}" @if($consultationExternal) target="_blank" rel="noopener noreferrer" @endif>Konsultasikan Kebutuhan Aplikasi</a></div></section>
@endsection
