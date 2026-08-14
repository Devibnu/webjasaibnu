<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php
        $adminLogoPath = $siteSettings->logo_dark_path ?: $siteSettings->logo_path;
        $adminSiteName = $siteSettings->company_name ?? 'JASAIBNU';
        $adminLegalName = $siteSettings->company_legal_name ?? 'PT JASA IBNU DEVELOPMENT';
        $adminFavicon = $siteSettings->favicon_path
            ? asset('storage/' . $siteSettings->favicon_path)
            : asset('assets/admin/img/logo-ct.png');
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin Login - {{ $adminSiteName }}</title>
    <link rel="icon" href="{{ $adminFavicon }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/nucleo-svg.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/soft-ui-dashboard.css') }}" rel="stylesheet">
    <style>
        .bg-gradient-info,
        .btn.bg-gradient-info {
            background-image: linear-gradient(310deg, #0B5ED7, #00AEEF) !important;
        }

        .text-info.text-gradient {
            color: #00AEEF !important;
        }

        .admin-brand-mark {
            width: 42px;
            height: 42px;
            border-radius: .85rem;
            background-image: linear-gradient(310deg, #0B5ED7, #00AEEF);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(0, 174, 239, .25);
        }

        .admin-login-logo {
            display: block;
            width: auto;
            max-width: 178px;
            max-height: 54px;
            object-fit: contain;
        }
    </style>
</head>
<body>
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <div class="d-flex align-items-center mb-4">
                                        @if ($adminLogoPath)
                                            <img class="admin-login-logo" src="{{ asset('storage/' . $adminLogoPath) }}" alt="{{ $adminSiteName }}">
                                        @else
                                            <span class="admin-brand-mark me-3">JI</span>
                                            <div>
                                                <h4 class="font-weight-bolder mb-0">{{ $adminSiteName }}</h4>
                                                <p class="text-xs text-uppercase font-weight-bold mb-0">Admin Panel</p>
                                            </div>
                                        @endif
                                    </div>
                                    <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                                    <p class="mb-0">{{ $adminLegalName }}</p>
                                </div>
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger text-white" role="alert">
                                            <ul class="mb-0 ps-3">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form role="form" method="POST" action="{{ route('admin.login.store') }}">
                                        @csrf
                                        <label for="email">Email</label>
                                        <div class="mb-3">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email') }}" aria-label="Email" autocomplete="email" required autofocus>
                                        </div>

                                        <label for="password">Password</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" aria-label="Password" autocomplete="current-password" required>
                                        </div>

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image: url('{{ asset('assets/admin/img/curved-images/curved6.jpg') }}')"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
