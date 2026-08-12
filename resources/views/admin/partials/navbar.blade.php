<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('admin.dashboard') }}">Admin</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">@yield('page', 'Dashboard')</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">@yield('page', 'Dashboard')</h6>
        </nav>

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item d-flex align-items-center me-3">
                    <a href="{{ route('home') }}" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-globe me-sm-1"></i>
                        <span class="d-sm-inline d-none">View Site</span>
                    </a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="nav-link text-body font-weight-bold px-0 border-0 bg-transparent">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">Sign Out</span>
                        </button>
                    </form>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
