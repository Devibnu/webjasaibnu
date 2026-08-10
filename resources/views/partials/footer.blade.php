@php
    $footerLinks = [
        ['label' => 'Services', 'route' => 'services.index'],
        ['label' => 'Solutions', 'route' => 'solutions.index'],
        ['label' => 'Portfolio', 'route' => 'portfolio.index'],
        ['label' => 'Insights', 'route' => 'insights.index'],
        ['label' => 'About', 'route' => 'about'],
        ['label' => 'Contact', 'route' => 'contact'],
    ];
@endphp

<footer class="site-footer">
    <div class="container footer-grid">
        <div>
            <a class="brand footer-brand" href="{{ route('home') }}" aria-label="PT JASA IBNU DEVELOPMENT home">
                <span class="brand-mark" aria-hidden="true">JI</span>
                <span class="brand-text">
                    <strong>JASAIBNU</strong>
                    <span>PT JASA IBNU DEVELOPMENT</span>
                </span>
            </a>
            <p class="footer-copy">IT Solutions • Software Development • SaaS • AI Integration</p>
        </div>

        <nav class="footer-nav" aria-label="Footer navigation">
            @foreach ($footerLinks as $link)
                <a href="{{ route($link['route']) }}">{{ $link['label'] }}</a>
            @endforeach
        </nav>

        <div class="footer-legal" aria-label="Legal links">
            <span>Privacy Policy</span>
            <span>Terms</span>
        </div>
    </div>

    <div class="container footer-bottom">
        <p>&copy; {{ now()->year }} PT JASA IBNU DEVELOPMENT. All rights reserved.</p>
    </div>
</footer>
