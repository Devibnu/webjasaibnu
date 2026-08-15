<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main">
    @php
        $adminLogoPath = $siteSettings->logo_dark_path ?: $siteSettings->logo_path;
        $adminSiteName = $siteSettings->company_name ?? 'JASAIBNU';
        $adminLegalName = $siteSettings->company_legal_name ?? 'PT JASA IBNU DEVELOPMENT';
    @endphp
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('admin.dashboard') }}">
            @if ($adminLogoPath)
                <img class="admin-brand-logo" src="{{ asset('storage/' . $adminLogoPath) }}" alt="{{ $adminSiteName }}">
            @else
                <span class="admin-brand-mark">JI</span>
                <span class="ms-3">
                    <span class="font-weight-bold d-block">{{ $adminSiteName }}</span>
                    <span class="text-xs text-uppercase font-weight-bold opacity-7">Admin Panel</span>
                </span>
            @endif
        </a>
    </div>
    <hr class="horizontal dark mt-0">

    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-shop {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-dark' }} text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Content</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/hero-slides*') ? 'active' : '' }}" href="{{ route('admin.hero-slides.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-camera-compact {{ request()->is('admin/hero-slides*') ? 'text-white' : 'text-dark' }} text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Hero Slider</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/insights*') ? 'active' : '' }}" href="{{ route('admin.insights.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-copy-04 {{ request()->is('admin/insights*') ? 'text-white' : 'text-dark' }} text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Insights</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/insight-categories*') ? 'active' : '' }}" href="{{ route('admin.insight-categories.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tag {{ request()->is('admin/insight-categories*') ? 'text-white' : 'text-dark' }} text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Insight Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/portfolio') || request()->is('admin/portfolio/*') ? 'active' : '' }}" href="{{ route('admin.portfolio.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-briefcase-24 {{ request()->is('admin/portfolio') || request()->is('admin/portfolio/*') ? 'text-white' : 'text-dark' }} text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Portfolio</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/portfolio-page-settings') ? 'active' : '' }}" href="{{ route('admin.portfolio-page-settings.edit') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-settings {{ request()->is('admin/portfolio-page-settings') ? 'text-white' : 'text-dark' }} text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Portfolio Page Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/portfolio-categories*') ? 'active' : '' }}" href="{{ route('admin.portfolio-categories.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tag {{ request()->is('admin/portfolio-categories*') ? 'text-white' : 'text-dark' }} text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Portfolio Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/services') || request()->is('admin/services/*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-app {{ request()->is('admin/services') || request()->is('admin/services/*') ? 'text-white' : 'text-dark' }} text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Services</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/service-technologies*') ? 'active' : '' }}" href="{{ route('admin.service-technologies.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-spaceship {{ request()->is('admin/service-technologies*') ? 'text-white' : 'text-dark' }} text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Service Technologies</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/solutions') || request()->is('admin/solutions/*') ? 'active' : '' }}" href="{{ route('admin.solutions.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bulb-61 {{ request()->is('admin/solutions') || request()->is('admin/solutions/*') ? 'text-white' : 'text-dark' }} text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Solutions</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/about') ? 'active' : '' }}" href="{{ route('admin.about.edit') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 {{ request()->is('admin/about') ? 'text-white' : 'text-dark' }} text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">About</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/site-settings') ? 'active' : '' }}" href="{{ route('admin.site-settings.edit') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-settings {{ request()->is('admin/site-settings') ? 'text-white' : 'text-dark' }} text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Site Settings</span>
                </a>
            </li>

            <li class="nav-item mt-2">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Messages</h6>
            </li>
            <li class="nav-item">
                @php($unreadContactMessages = \App\Models\ContactMessage::unread()->count())
                <a class="nav-link {{ request()->is('admin/contact') || request()->is('admin/contact/*') ? 'active' : '' }}" href="{{ route('admin.contact.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-email-83 {{ request()->is('admin/contact') || request()->is('admin/contact/*') ? 'text-white' : 'text-dark' }} text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Contact Inbox</span>
                    @if ($unreadContactMessages > 0)
                        <span class="badge badge-sm bg-gradient-warning ms-auto">{{ $unreadContactMessages }}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/administrators*') ? 'active' : '' }}" href="{{ route('admin.administrators.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-circle-08 {{ request()->is('admin/administrators*') ? 'text-white' : 'text-dark' }} text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Administrators</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidenav-footer mx-3">
        <div class="card card-background shadow-none card-background-mask-secondary" id="sidenavCard">
            <div class="full-background" style="background-image: url('{{ asset('assets/admin/img/curved-images/white-curved.jpeg') }}')"></div>
            <div class="card-body text-start p-3 w-100">
                <div class="icon icon-shape icon-sm bg-white shadow text-center mb-3 d-flex align-items-center justify-content-center border-radius-md">
                    <i class="ni ni-diamond text-dark text-gradient text-lg top-0" aria-hidden="true"></i>
                </div>
                <div class="docs-info">
                    <h6 class="text-white up mb-0">{{ $adminLegalName }}</h6>
                    <p class="text-xs font-weight-bold">CMS foundation</p>
                </div>
            </div>
        </div>
    </div>
</aside>
