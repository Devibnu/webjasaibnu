@extends('layouts.app')

@section('title', 'Services — JASAIBNU IT Solutions & Software Development')
@section('meta_description', 'Layanan PT JASA IBNU DEVELOPMENT untuk website development, SEO, web application, mobile application, SaaS development, AI integration, API integration, cloud server, dan IT maintenance.')

@section('content')
    <section class="page-hero">
        <div class="container page-hero-grid">
            <div>
                <p class="eyebrow">Services</p>
                <h1>Solusi IT untuk Kebutuhan Bisnis Anda</h1>
                <p>Halaman ini menjadi parent page untuk layanan JASAIBNU dan disiapkan agar dapat berkembang menjadi landing page SEO per layanan.</p>
            </div>
            <div class="page-note">
                <p>Service detail nantinya dapat dikembangkan sebagai URL seperti <strong>/services/website-development</strong>, <strong>/services/seo</strong>, dan layanan spesifik lainnya.</p>
            </div>
        </div>
    </section>

    <section class="section-pad">
        <div class="container page-list">
            @foreach ([
                'Website Development',
                'SEO Services',
                'Web Application',
                'Mobile Application',
                'Custom Software',
                'SaaS Development',
                'AI Integration',
                'API Integration',
                'Business Email',
                'Cloud Server',
                'IT Maintenance',
            ] as $service)
                <article class="page-list-item">
                    <h2>{{ $service }}</h2>
                    <p>Foundation konten layanan ini sudah disiapkan dan akan dikembangkan pada tahap berikutnya.</p>
                </article>
            @endforeach
        </div>
    </section>
@endsection
