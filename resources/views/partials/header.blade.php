@php
    $navigation = [
        ['label' => 'Home', 'route' => 'home'],
        ['label' => 'Services', 'route' => 'services.index'],
        ['label' => 'Solutions', 'route' => 'solutions.index'],
        ['label' => 'Portfolio', 'route' => 'portfolio.index'],
        ['label' => 'Insights', 'route' => 'insights.index'],
        ['label' => 'About', 'route' => 'about'],
        ['label' => 'Contact', 'route' => 'contact'],
    ];
@endphp

<header class="site-header" data-site-header>
    <div class="container header-inner">
        <a class="brand" href="{{ route('home') }}" aria-label="PT JASA IBNU DEVELOPMENT home">
            <span class="brand-mark" aria-hidden="true">JI</span>
            <span class="brand-text">
                <strong>JASAIBNU</strong>
                <span>PT JASA IBNU DEVELOPMENT</span>
            </span>
        </a>

        <button class="menu-toggle" type="button" aria-label="Open navigation" aria-controls="primary-navigation" aria-expanded="false" data-menu-toggle>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </button>

        <nav class="primary-nav" id="primary-navigation" aria-label="Primary navigation" data-primary-nav>
            @foreach ($navigation as $item)
                <a href="{{ route($item['route']) }}" @if (request()->routeIs($item['route'])) aria-current="page" @endif>{{ $item['label'] }}</a>
            @endforeach
            <a class="button button-small button-primary nav-cta" href="{{ route('contact') }}">Konsultasi Gratis</a>
        </nav>
    </div>
</header>
