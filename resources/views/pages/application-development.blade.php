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
        @media (min-width: 992px) {
            .application-development-page > .startup-inner-shell .navbar:not(.sticky-top) { background: #091e3e; }
        }
        .application-development-page .app-shell { width: min(100% - 48px, 1180px); margin-inline: auto; }
        .application-development-page .app-hero { padding: 76px 0 68px; background: linear-gradient(120deg, #fff 0%, #fff 58%, #edf8fc 100%); }
        .application-development-page .app-hero-grid { display: grid; grid-template-columns: minmax(0, 1.02fr) minmax(400px, .98fr); gap: 64px; align-items: center; }
        .application-development-page .app-hero-content { min-width: 0; }
        .application-development-page .app-eyebrow { margin: 0 0 13px; color: var(--app-blue); font-size: .78rem; font-weight: 800; text-transform: uppercase; letter-spacing: .08em; }
        .application-development-page .app-hero h1 { max-width: 650px; margin: 0; color: var(--app-navy); font-size: clamp(2.45rem, 4vw, 4rem); line-height: 1.08; letter-spacing: 0; }
        .application-development-page .app-hero-copy { max-width: 650px; margin: 22px 0 0; color: var(--app-muted); font-size: 1.07rem; line-height: 1.75; }
        .application-development-page .app-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 28px; }
        .application-development-page .app-button { display: inline-flex; min-height: 48px; align-items: center; justify-content: center; padding: 12px 20px; border: 1px solid var(--app-blue); border-radius: 4px; background: var(--app-blue); color: #fff; font-weight: 700; text-decoration: none; transition: background .2s ease, border-color .2s ease, color .2s ease; }
        .application-development-page .app-button:hover { border-color: #078bb9; background: #078bb9; color: #fff; }
        .application-development-page .app-button.secondary { border-color: #b8cad6; background: #fff; color: var(--app-navy); }
        .application-development-page .app-benefits { display: flex; flex-wrap: wrap; gap: 10px 22px; margin: 25px 0 0; padding: 0; list-style: none; }
        .application-development-page .app-benefits li { position: relative; padding-left: 20px; color: #425269; font-size: .9rem; }
        .application-development-page .app-benefits li::before { position: absolute; left: 0; color: var(--app-blue); content: "\2713"; font-weight: 800; }
        .application-development-page .app-dashboard { min-width: 0; overflow: hidden; border: 1px solid #cadce7; border-radius: 7px; background: #fff; box-shadow: 0 22px 50px rgba(6,20,41,.12); }
        .application-development-page .app-dashboard-bar { display: flex; align-items: center; gap: 7px; height: 31px; padding: 0 12px; border-bottom: 1px solid #dce7ed; background: #f5f8fa; }
        .application-development-page .app-dashboard-bar span { width: 7px; height: 7px; border-radius: 50%; background: #b9c7cf; }
        .application-development-page .app-dashboard-layout { display: grid; grid-template-columns: 105px minmax(0, 1fr); min-height: 340px; }
        .application-development-page .app-dashboard-side { padding: 19px 13px; background: var(--app-navy); color: #aab8ca; }
        .application-development-page .app-dashboard-brand { display: flex; align-items: center; gap: 7px; margin-bottom: 27px; color: #fff; font-size: .76rem; font-weight: 800; }
        .application-development-page .app-dashboard-brand i { color: var(--app-blue); }
        .application-development-page .app-dashboard-nav { display: grid; gap: 10px; }
        .application-development-page .app-dashboard-nav span { padding: 7px 8px; border-radius: 3px; font-size: .65rem; }
        .application-development-page .app-dashboard-nav span:first-child { background: rgba(6,163,218,.22); color: #fff; }
        .application-development-page .app-dashboard-main { min-width: 0; padding: 20px; }
        .application-development-page .app-dashboard-head { display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 16px; }
        .application-development-page .app-dashboard-head strong { color: var(--app-navy); font-size: .95rem; }
        .application-development-page .app-dashboard-head span { color: var(--app-muted); font-size: .65rem; }
        .application-development-page .app-summary-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 9px; }
        .application-development-page .app-summary { min-width: 0; padding: 11px; border: 1px solid #e1e9ee; border-radius: 4px; }
        .application-development-page .app-summary small { display: block; color: var(--app-muted); font-size: .58rem; }
        .application-development-page .app-summary strong { color: var(--app-navy); font-size: .86rem; }
        .application-development-page .app-dashboard-panels { display: grid; grid-template-columns: 1.25fr .75fr; gap: 10px; margin-top: 10px; }
        .application-development-page .app-dashboard-panel { min-width: 0; padding: 12px; border: 1px solid #e1e9ee; border-radius: 4px; }
        .application-development-page .app-dashboard-panel h3 { margin: 0 0 12px; color: var(--app-navy); font-size: .69rem; }
        .application-development-page .app-chart { display: flex; height: 82px; align-items: end; gap: 7px; padding-top: 10px; border-bottom: 1px solid #dfe8ed; }
        .application-development-page .app-chart span { flex: 1; min-height: 12px; background: #80d4ee; }
        .application-development-page .app-chart span:nth-child(2n) { background: var(--app-blue); }
        .application-development-page .app-activity { display: grid; gap: 9px; }
        .application-development-page .app-activity span { display: flex; align-items: center; gap: 7px; color: var(--app-muted); font-size: .58rem; }
        .application-development-page .app-activity i { width: 7px; height: 7px; flex: 0 0 7px; border-radius: 50%; background: var(--app-blue); }
        .application-development-page .app-workflow { display: grid; grid-column: 1 / -1; gap: 7px; margin-top: 10px; }
        .application-development-page .app-workflow-row { display: grid; grid-template-columns: 1fr auto; gap: 10px; align-items: center; padding: 7px 9px; background: #f5f8fa; color: #4c5c70; font-size: .59rem; }
        .application-development-page .app-workflow-row em { padding: 3px 6px; border-radius: 3px; background: #daf3fb; color: #087da7; font-style: normal; }
        .application-development-page .app-section { padding: 78px 0; }
        .application-development-page .app-section.alt { background: var(--app-soft); }
        .application-development-page .app-heading { max-width: 790px; margin-bottom: 36px; }
        .application-development-page .app-heading.center { margin-inline: auto; text-align: center; }
        .application-development-page .app-heading h2 { margin: 0 0 14px; color: var(--app-navy); font-size: clamp(1.75rem, 2.5vw, 2.55rem); line-height: 1.2; letter-spacing: 0; }
        .application-development-page .app-heading p:last-child { margin-bottom: 0; color: var(--app-muted); line-height: 1.75; }
        .application-development-page .app-problem-layout { display: grid; grid-template-columns: minmax(0, .76fr) minmax(0, 1.24fr); gap: 62px; align-items: start; }
        .application-development-page .app-problem-layout .app-heading { position: sticky; top: 110px; margin-bottom: 0; }
        .application-development-page .app-problem-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); column-gap: 30px; }
        .application-development-page .app-problem { display: grid; grid-template-columns: 34px minmax(0, 1fr); gap: 12px; padding: 17px 0; border-bottom: 1px solid #dce6ec; }
        .application-development-page .app-problem-icon, .application-development-page .app-solution-icon { display: inline-flex; width: 34px; height: 34px; align-items: center; justify-content: center; border-radius: 4px; background: #def4fb; color: #078ebd; }
        .application-development-page .app-problem h3, .application-development-page .app-problem p { margin: 0; }
        .application-development-page .app-problem h3 { margin-bottom: 4px; color: var(--app-navy); font-size: .98rem; }
        .application-development-page .app-problem p { color: var(--app-muted); font-size: .91rem; line-height: 1.55; }
        .application-development-page .app-note { margin: 25px 0 0; padding: 17px 19px; border-left: 3px solid var(--app-blue); background: #e7f5fb; color: #415167; line-height: 1.65; }
        .application-development-page .app-solutions { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 0 34px; }
        .application-development-page .app-solution { min-width: 0; padding: 24px 0; border-bottom: 1px solid #dce6ec; }
        .application-development-page .app-solution-icon { margin-bottom: 15px; }
        .application-development-page .app-solution h3 { margin: 0 0 8px; color: var(--app-navy); font-size: 1.08rem; }
        .application-development-page .app-solution p { margin: 0; color: var(--app-muted); line-height: 1.65; }
        .application-development-page .app-process { position: relative; display: grid; grid-template-columns: repeat(7, minmax(0, 1fr)); gap: 0; counter-reset: app-step; }
        .application-development-page .app-process::before { position: absolute; top: 20px; right: 7%; left: 7%; height: 1px; background: #bdd7e3; content: ""; }
        .application-development-page .app-process article { position: relative; min-width: 0; padding: 0 12px; text-align: center; counter-increment: app-step; }
        .application-development-page .app-process article::before { position: relative; z-index: 1; display: inline-flex; width: 40px; height: 40px; align-items: center; justify-content: center; margin-bottom: 17px; border: 1px solid #8ccce2; border-radius: 50%; background: #fff; color: var(--app-blue); content: counter(app-step); font-weight: 800; }
        .application-development-page .app-process h3 { margin: 0 0 7px; color: var(--app-navy); font-size: .9rem; line-height: 1.4; }
        .application-development-page .app-process p { margin: 0; color: var(--app-muted); font-size: .82rem; line-height: 1.55; }
        .application-development-page .app-overview { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); border: 1px solid #d5e0e7; background: #fff; }
        .application-development-page .app-overview-column { min-width: 0; padding: 29px; }
        .application-development-page .app-overview-column + .app-overview-column { border-left: 1px solid #d5e0e7; }
        .application-development-page .app-overview h3 { margin: 0 0 17px; color: var(--app-navy); font-size: 1.12rem; }
        .application-development-page .app-checklist { display: grid; gap: 10px; margin: 0; padding: 0; list-style: none; }
        .application-development-page .app-checklist li { position: relative; padding-left: 20px; color: var(--app-muted); line-height: 1.55; }
        .application-development-page .app-checklist li::before { position: absolute; left: 0; color: var(--app-blue); content: "\2713"; font-weight: 800; }
        .application-development-page .app-modules { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 0 24px; margin-top: 36px; }
        .application-development-page .app-module { padding: 18px 0; border-bottom: 1px solid #dce6ec; }
        .application-development-page .app-module h3 { margin: 0 0 6px; color: var(--app-navy); font-size: .98rem; }
        .application-development-page .app-module p { margin: 0; color: var(--app-muted); font-size: .9rem; line-height: 1.58; }
        .application-development-page .app-technical { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); border-top: 1px solid #d5e0e7; border-bottom: 1px solid #d5e0e7; }
        .application-development-page .app-technical article { min-width: 0; padding: 30px; }
        .application-development-page .app-technical article + article { border-left: 1px solid #d5e0e7; }
        .application-development-page .app-technical h2 { margin: 0 0 12px; color: var(--app-navy); font-size: 1.28rem; letter-spacing: 0; }
        .application-development-page .app-technical p { margin: 0; color: var(--app-muted); line-height: 1.7; }
        .application-development-page .app-handover { display: grid; grid-template-columns: minmax(0, .8fr) minmax(0, 1.2fr); gap: 56px; align-items: center; }
        .application-development-page .app-handover .app-heading { margin-bottom: 0; }
        .application-development-page .app-handover-points { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 13px; }
        .application-development-page .app-handover-points span { padding: 14px 16px; border-left: 2px solid var(--app-blue); background: #fff; color: #43536a; }
        .application-development-page .app-proof { display: grid; grid-template-columns: minmax(250px, .72fr) minmax(0, 1.28fr); align-items: center; border: 1px solid #d8e2e9; background: #fff; }
        .application-development-page .app-proof img { width: 100%; height: 100%; min-height: 300px; object-fit: cover; }
        .application-development-page .app-proof-content { padding: 40px; }
        .application-development-page .app-proof-content h2 { margin: 0 0 13px; color: var(--app-navy); font-size: clamp(1.65rem, 2.3vw, 2.25rem); letter-spacing: 0; }
        .application-development-page .app-proof-content p { color: var(--app-muted); line-height: 1.7; }
        .application-development-page .app-proof-content .app-button { margin-top: 8px; }
        .application-development-page .app-faq-list { border-top: 1px solid #d5e0e7; }
        .application-development-page .app-faq { border-bottom: 1px solid #d5e0e7; background: #fff; }
        .application-development-page .app-faq summary { position: relative; padding: 19px 48px 19px 4px; color: var(--app-navy); cursor: pointer; list-style: none; }
        .application-development-page .app-faq summary::-webkit-details-marker { display: none; }
        .application-development-page .app-faq summary::after { position: absolute; top: 50%; right: 8px; color: var(--app-blue); content: "+"; font-size: 1.4rem; transform: translateY(-50%); }
        .application-development-page .app-faq[open] summary::after { content: "\2212"; }
        .application-development-page .app-faq summary:focus-visible { outline: 2px solid var(--app-blue); outline-offset: 2px; }
        .application-development-page .app-faq summary h3 { display: inline; margin: 0; font-size: 1.01rem; letter-spacing: 0; }
        .application-development-page .app-faq p { margin: 0; padding: 0 48px 20px 4px; color: var(--app-muted); line-height: 1.7; }
        .application-development-page .app-final { padding: 64px 0; background: var(--app-navy); color: #fff; }
        .application-development-page .app-final-row { display: grid; grid-template-columns: minmax(0, 1fr) auto; gap: 40px; align-items: center; }
        .application-development-page .app-final h2 { margin: 0 0 10px; color: #fff; font-size: clamp(1.7rem, 2.5vw, 2.45rem); letter-spacing: 0; }
        .application-development-page .app-final p { max-width: 720px; margin: 0; color: #cbd7e5; line-height: 1.7; }
        .application-development-page .app-final .app-actions { margin-top: 0; }
        .application-development-page .app-final .app-button.secondary { border-color: #668098; background: transparent; color: #fff; }
        .application-development-page .app-inline-link { color: inherit; font-weight: 700; text-decoration: underline; }
        @media (max-width: 1199.98px) { .application-development-page .navbar-dark .navbar-nav .nav-link { margin-left: 12px; font-size: 13.5px; } }
        @media (max-width: 1024px) { .application-development-page .app-hero-grid { grid-template-columns: minmax(0, 1fr) minmax(360px, .9fr); gap: 34px; } .application-development-page .app-solutions { grid-template-columns: repeat(2, minmax(0, 1fr)); } .application-development-page .app-process { grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 28px 0; } .application-development-page .app-process::before { display: none; } .application-development-page .app-modules { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 991.98px) {
            .application-development-page .navbar { min-height: 74px; padding-top: .75rem !important; padding-bottom: .75rem !important; background: #fff; }
            .application-development-page .ji-header-logo-stack { display: inline-block; max-width: min(230px, 62vw); }
            .application-development-page .ji-header-logo { width: auto; max-height: 42px; }
            .application-development-page .ji-header-logo-public { display: none; }
            .application-development-page .ji-header-logo-dark { display: inline-block; }
            .application-development-page .navbar-toggler { width: 42px; height: 42px; border: 1px solid #06a3da; border-radius: 2px; background: #fff; color: #06a3da; }
        }
        @media (max-width: 768px) { .application-development-page .app-shell { width: min(100% - 32px, 680px); } .application-development-page .app-hero { padding: 58px 0 54px; } .application-development-page .app-hero-grid, .application-development-page .app-problem-layout, .application-development-page .app-handover, .application-development-page .app-proof, .application-development-page .app-final-row { grid-template-columns: 1fr; } .application-development-page .app-dashboard { margin-top: 8px; } .application-development-page .app-section { padding: 58px 0; } .application-development-page .app-problem-layout .app-heading { position: static; margin-bottom: 8px; } .application-development-page .app-overview, .application-development-page .app-technical { grid-template-columns: 1fr; } .application-development-page .app-overview-column + .application-development-page .app-overview-column, .application-development-page .app-technical article + .application-development-page .app-technical article { border-top: 1px solid #d5e0e7; border-left: 0; } .application-development-page .app-process { grid-template-columns: 1fr; gap: 0; } .application-development-page .app-process article { display: grid; grid-template-columns: 40px minmax(0, 1fr); column-gap: 16px; padding: 0 0 22px; text-align: left; } .application-development-page .app-process article::before { grid-row: 1 / 3; margin: 0; } .application-development-page .app-process h3 { margin-top: 1px; } .application-development-page .app-proof img { min-height: 250px; } .application-development-page .app-final .app-actions { margin-top: 4px; } }
        @media (max-width: 575.98px) { .application-development-page .navbar { min-height: 68px; padding-right: 16px !important; padding-left: 16px !important; } .application-development-page .ji-header-logo-stack { max-width: min(190px, 58vw); } }
        @media (max-width: 575.98px) { .application-development-page .app-problem-grid, .application-development-page .app-solutions, .application-development-page .app-modules, .application-development-page .app-handover-points { grid-template-columns: 1fr; } .application-development-page .app-dashboard-layout { grid-template-columns: 78px minmax(0, 1fr); } .application-development-page .app-dashboard-side { padding-inline: 8px; } .application-development-page .app-dashboard-nav span { padding-inline: 5px; } .application-development-page .app-dashboard-main { padding: 13px; } }
        @media (max-width: 430px) { .application-development-page .app-shell { width: min(100% - 24px, 406px); } .application-development-page .app-hero { padding: 46px 0 44px; } .application-development-page .app-hero h1 { font-size: 2.12rem; } .application-development-page .app-actions { display: grid; } .application-development-page .app-button { width: 100%; text-align: center; } .application-development-page .app-benefits { display: grid; } .application-development-page .app-dashboard-layout { grid-template-columns: 1fr; } .application-development-page .app-dashboard-side { display: none; } .application-development-page .app-dashboard-panels { grid-template-columns: 1fr; } .application-development-page .app-proof-content, .application-development-page .app-overview-column { padding: 22px; } }
    </style>
    <script type="application/ld+json">@json($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
    <script type="application/ld+json">@json($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
@endpush

@section('content')
    <section class="app-hero" aria-labelledby="application-development-title">
        <div class="app-shell app-hero-grid">
            <div class="app-hero-content">
                <p class="app-eyebrow">CUSTOM BUSINESS APPLICATION</p>
                <h1 id="application-development-title">Jasa Pembuatan Aplikasi untuk Kebutuhan Bisnis</h1>
                <p class="app-hero-copy">JASAIBNU membantu merancang aplikasi bisnis berbasis web yang mengikuti workflow, kebutuhan pengguna, pengelolaan data, dashboard, reporting, dan integrasi sistem sesuai ruang lingkup project.</p>
                <div class="app-actions">
                    <a class="app-button" href="{{ $consultationUrl }}" @if($consultationExternal) target="_blank" rel="noopener noreferrer" @endif>Konsultasikan Kebutuhan Aplikasi</a>
                    <a class="app-button secondary" href="{{ route('portfolio.index') }}">Lihat Portfolio</a>
                </div>
                <ul class="app-benefits" aria-label="Manfaat layanan">
                    <li>Berbasis web dan responsif</li>
                    <li>Sesuai kebutuhan bisnis</li>
                    <li>Siap dikembangkan bertahap</li>
                </ul>
            </div>
            <aside class="app-dashboard" aria-label="Visualisasi generik dashboard aplikasi bisnis">
                <div class="app-dashboard-bar" aria-hidden="true"><span></span><span></span><span></span></div>
                <div class="app-dashboard-layout">
                    <div class="app-dashboard-side">
                        <div class="app-dashboard-brand"><i class="fa fa-cube" aria-hidden="true"></i><span>BUSINESS APP</span></div>
                        <div class="app-dashboard-nav"><span>Dashboard</span><span>Workflow</span><span>Customers</span><span>Reports</span><span>Settings</span></div>
                    </div>
                    <div class="app-dashboard-main">
                        <div class="app-dashboard-head"><strong>Operational Dashboard</strong><span>Overview</span></div>
                        <div class="app-summary-grid">
                            <div class="app-summary"><small>Open tasks</small><strong>24</strong></div>
                            <div class="app-summary"><small>In review</small><strong>08</strong></div>
                            <div class="app-summary"><small>Completed</small><strong>16</strong></div>
                        </div>
                        <div class="app-dashboard-panels">
                            <div class="app-dashboard-panel"><h3>Workflow activity</h3><div class="app-chart" aria-hidden="true"><span style="height: 36%"></span><span style="height: 58%"></span><span style="height: 45%"></span><span style="height: 78%"></span><span style="height: 63%"></span><span style="height: 90%"></span><span style="height: 72%"></span></div></div>
                            <div class="app-dashboard-panel"><h3>Recent activity</h3><div class="app-activity"><span><i></i>Request submitted</span><span><i></i>Review updated</span><span><i></i>Task assigned</span><span><i></i>Report prepared</span></div></div>
                            <div class="app-workflow"><div class="app-workflow-row"><span>Document approval</span><em>In review</em></div><div class="app-workflow-row"><span>Service request</span><em>Assigned</em></div></div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </section>

    <section class="app-section alt" aria-labelledby="business-problems-title"><div class="app-shell app-problem-layout">
        <div class="app-heading"><p class="app-eyebrow">BUSINESS PROBLEMS</p><h2 id="business-problems-title">Proses yang berkembang membutuhkan kontrol dan alur yang lebih jelas.</h2><p>Aplikasi custom mulai relevan ketika alat kerja yang ada menyulitkan tim melihat data dan menjalankan proses secara konsisten.</p><p class="app-note">Pertimbangkan sistem khusus ketika proses bisnis tidak lagi cocok dengan alur software siap pakai. Pelajari juga <a href="{{ route('insights.show', 'kapan-bisnis-membutuhkan-aplikasi-web-custom') }}">kapan bisnis membutuhkan aplikasi web custom</a>.</p></div>
        <div class="app-problem-grid">@foreach ([['fa-table','Spreadsheet sulit dikendalikan','File tersebar, versi data berbeda, atau akses mulai sulit dikelola.'],['fa-copy','Input data berulang','Informasi yang sama perlu dicatat kembali pada beberapa tempat.'],['fa-check-square-o','Approval belum terstruktur','Permintaan, status, dan riwayat keputusan belum berada dalam satu alur.'],['fa-link','Sistem tidak terhubung','Data dari beberapa alat perlu dipindahkan atau dicocokkan manual.'],['fa-file-text-o','Reporting masih manual','Tim perlu menggabungkan data sebelum laporan dapat digunakan.'],['fa-eye','Monitoring sulit dilakukan','Aktivitas dan status operasional belum mudah dipantau bersama.'],['fa-users','Akses pengguna berbeda','Setiap role memerlukan batas data dan tindakan yang tidak sama.'],['fa-sliders','Software siap pakai kurang sesuai','Fitur generik dapat membatasi workflow dan aturan bisnis yang penting.']] as [$icon, $title, $copy])<article class="app-problem"><span class="app-problem-icon"><i class="fa {{ $icon }}" aria-hidden="true"></i></span><div><h3>{{ $title }}</h3><p>{{ $copy }}</p></div></article>@endforeach</div>
    </div></section>

    <section class="app-section" aria-labelledby="solutions-title"><div class="app-shell"><div class="app-heading center"><p class="app-eyebrow">SOLUSI APLIKASI</p><h2 id="solutions-title">Solusi yang dipetakan dari kebutuhan operasional bisnis.</h2><p>Kategori berikut menggambarkan kemungkinan penggunaan, bukan fitur yang otomatis tersedia pada setiap project.</p></div><div class="app-solutions">
        @foreach ([['fa-address-book-o','CRM & Sales','Customer, lead, opportunity, aktivitas, serta tindak lanjut penjualan.'],['fa-headphones','Service Management','Ticketing, assignment, status layanan, dan riwayat penanganan.'],['fa-random','Workflow & Operational','Task, approval, status, monitoring, dan koordinasi proses internal.'],['fa-bar-chart','Dashboard & Reporting','Ringkasan, filter, indikator, dan laporan berdasarkan data yang tersedia.'],['fa-user-circle-o','Portal Pengguna','Portal pelanggan atau internal dengan multi-user, role, dan permission.'],['fa-exchange','Integrasi Sistem','Pertukaran data melalui API setelah kelayakan sistem terkait diperiksa.']] as [$icon, $title, $copy])<article class="app-solution"><span class="app-solution-icon"><i class="fa {{ $icon }}" aria-hidden="true"></i></span><h3>{{ $title }}</h3><p>{{ $copy }}</p></article>@endforeach
    </div></div></section>

    <section class="app-section alt" aria-labelledby="process-title"><div class="app-shell"><div class="app-heading center"><p class="app-eyebrow">DEVELOPMENT PROCESS</p><h2 id="process-title">Tahapan kerja dari konteks bisnis sampai sistem siap digunakan.</h2><p>Durasi setiap tahap mengikuti kompleksitas, kesiapan data, integrasi, review, dan ruang lingkup project.</p></div><div class="app-process">
        @foreach ([['Konsultasi / Discovery','Memahami tujuan, pengguna, masalah, dan batas awal.'],['Analisis Proses Bisnis','Memetakan workflow, data, role, dan prioritas.'],['Perancangan Sistem & UI','Menyusun struktur, interface, dan acceptance criteria.'],['Development','Membangun fungsi secara bertahap sesuai scope.'],['Testing','Memvalidasi fungsi dan menindaklanjuti hasil pengujian.'],['Deployment / Go Live','Menyiapkan environment dan mekanisme rilis.'],['Handover / Support','Menetapkan akses, dokumentasi, dan dukungan sesuai agreement.']] as [$title, $copy])<article><h3>{{ $title }}</h3><p>{{ $copy }}</p></article>@endforeach
    </div></div></section>

    <section class="app-section" aria-labelledby="capability-title"><div class="app-shell"><div class="app-heading"><p class="app-eyebrow">CAPABILITY &amp; MODULE OVERVIEW</p><h2 id="capability-title">Fondasi, kemampuan umum, dan kebutuhan yang perlu dievaluasi.</h2><p>Ruang lingkup final ditentukan melalui discovery dan perjanjian project. Tidak setiap aplikasi membutuhkan seluruh capability atau modul berikut.</p></div><div class="app-overview">
        <div class="app-overview-column"><h3>Core Capabilities</h3><ul class="app-checklist">@foreach (['Custom workflow','Web application','Multi-user','Role & permission','Dashboard & reporting','Data management','Status/lifecycle','Responsive interface','API integration'] as $item)<li>{{ $item }}</li>@endforeach</ul></div>
        <div class="app-overview-column"><h3>Generic Capabilities</h3><ul class="app-checklist">@foreach (['Approval flow','Customer/internal portal','Notifications','Data export','Operational monitoring','System documentation'] as $item)<li>{{ $item }}</li>@endforeach</ul></div>
        <div class="app-overview-column"><h3>Scope-dependent</h3><ul class="app-checklist">@foreach (['Automation & external API','AI integration','SaaS/multi-tenant','Subscription flow','Advanced audit trail','Data migration','Cloud architecture','Advanced security controls','Maintenance & scalability work'] as $item)<li>{{ $item }}</li>@endforeach</ul></div>
    </div><div class="app-modules" aria-label="Contoh modul aplikasi">
        @foreach ([['Users & Access','User management, roles, permissions, dan batas akses data.'],['Workflow & Approval','Tahap proses, assignment, approval, task, dan status.'],['Dashboard & Reporting','Ringkasan data, filter, laporan, serta export.'],['Notifications','Pemberitahuan berdasarkan event dan channel yang disepakati.'],['Integration','API, sinkronisasi, dan pertukaran data sesuai kelayakan.'],['History & Audit','Riwayat aktivitas atau audit trail sesuai tingkat kebutuhan.'],['Customer Portal','Akses layanan dan informasi bagi pengguna eksternal.'],['Internal Portal','Ruang kerja bagi tim dengan konteks role masing-masing.']] as [$title, $copy])<article class="app-module"><h3>{{ $title }}</h3><p>{{ $copy }}</p></article>@endforeach
    </div></div></section>

    <section class="app-section alt" aria-label="Integrasi, keamanan, dan skalabilitas"><div class="app-shell"><div class="app-technical">
        <article><h2>Integrasi &amp; Data Flow</h2><p>Integrasi dievaluasi berdasarkan ketersediaan API, dokumentasi, akses, batas provider, struktur data, dan kebutuhan sinkronisasi. Kelayakan pihak ketiga diperiksa sebelum menjadi komitmen project.</p></article>
        <article><h2>Security &amp; Access</h2><p>Pendekatan dapat mencakup role-based access, permission boundaries, validasi, data-access controls, secure configuration, dan testing sesuai ruang lingkup serta kebutuhan sistem.</p></article>
        <article><h2>Scalability &amp; Future Development</h2><p>Arsitektur dapat direncanakan untuk expected growth. Pengembangan modular dapat mendukung fase berikutnya, sementara infrastruktur dan optimasi mengikuti kebutuhan aktual.</p></article>
    </div></div></section>

    <section class="app-section" aria-labelledby="handover-title"><div class="app-shell app-handover"><div class="app-heading"><p class="app-eyebrow">OWNERSHIP &amp; HANDOVER</p><h2 id="handover-title">Tanggung jawab dan akses perlu jelas sebelum aplikasi diserahkan.</h2><p>Kepemilikan, akses, source code, deployment credentials, dokumentasi, data, dan bentuk handover ditetapkan dalam ruang lingkup serta perjanjian project. Maintenance dan support dibahas sesuai kebutuhan dan kesepakatan.</p></div><div class="app-handover-points" aria-label="Hal yang dibahas saat handover"><span>Source code &amp; akses</span><span>Deployment credentials</span><span>Dokumentasi sistem</span><span>Maintenance &amp; support</span></div></div></section>

    <section class="app-section alt" aria-labelledby="proof-title"><div class="app-shell"><div class="app-proof">
        <picture><source media="(max-width: 767px)" srcset="{{ asset('assets/startup2/img/optimized/feature-mobile.webp') }}"><source srcset="{{ asset('assets/startup2/img/optimized/feature-desktop.webp') }}"><img src="{{ asset('assets/startup2/img/feature.jpg') }}" alt="Perencanaan dan pengembangan sistem aplikasi bisnis" width="800" height="800" loading="lazy" decoding="async"></picture>
        <div class="app-proof-content"><p class="app-eyebrow">CAPABILITY PROOF</p><h2 id="proof-title">Tinjau jenis solusi dan capability yang telah dipublikasikan.</h2><p>Portfolio JASAIBNU mencakup kategori CRM, sales platform, service management, workflow, dashboard, SaaS, serta API dan system integration. Isinya digunakan sebagai konteks capability; kesesuaian dengan kebutuhan Anda tetap dibahas saat konsultasi.</p><p>Untuk memahami pendekatan solusi lintas kebutuhan, kunjungi juga <a href="{{ route('solutions.index') }}">halaman solusi JASAIBNU</a>.</p><a class="app-button" href="{{ route('portfolio.index') }}">Lihat Portfolio JASAIBNU</a></div>
    </div></div></section>

    <section class="app-section" aria-labelledby="faq-title"><div class="app-shell"><div class="app-heading"><p class="app-eyebrow">FAQ</p><h2 id="faq-title">Pertanyaan tentang pembuatan aplikasi bisnis custom.</h2></div><div class="app-faq-list">
        @foreach ($faqs as $index => [$question, $answer])<details class="app-faq" @if($index === 0) open @endif><summary><h3>{{ $question }}</h3></summary><p>{{ $answer }}</p></details>@endforeach
    </div></div></section>

    <section class="app-final" aria-labelledby="final-cta-title"><div class="app-shell app-final-row"><div><h2 id="final-cta-title">Diskusikan Kebutuhan Aplikasi Anda</h2><p>Ceritakan workflow, pengguna, data, fitur, serta integrasi yang perlu didukung agar ruang lingkup awal dapat dibahas dengan jelas. Anda juga dapat menggunakan <a class="app-inline-link" href="{{ route('contact') }}">form kontak JASAIBNU</a>.</p></div><div class="app-actions"><a class="app-button" href="{{ $consultationUrl }}" @if($consultationExternal) target="_blank" rel="noopener noreferrer" @endif>Konsultasikan Kebutuhan Aplikasi</a><a class="app-button secondary" href="{{ route('portfolio.index') }}">Lihat Portfolio</a></div></div></section>
@endsection
