<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - JASAIBNU</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/admin/img/logo-ct.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/admin/img/logo-ct.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/nucleo-svg.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link id="pagestyle" href="{{ asset('assets/admin/css/soft-ui-dashboard.css') }}" rel="stylesheet">
    <style>
        :root {
            --jasaibnu-admin-primary: #00AEEF;
            --jasaibnu-admin-deep: #0B5ED7;
        }

        .bg-gradient-info,
        .btn.bg-gradient-info,
        .navbar-vertical .navbar-nav > .nav-item .nav-link.active .icon {
            background-image: linear-gradient(310deg, var(--jasaibnu-admin-deep), var(--jasaibnu-admin-primary)) !important;
        }

        .text-info,
        .text-info.text-gradient {
            color: var(--jasaibnu-admin-primary) !important;
        }

        .admin-brand-mark {
            width: 34px;
            height: 34px;
            border-radius: .75rem;
            background-image: linear-gradient(310deg, var(--jasaibnu-admin-deep), var(--jasaibnu-admin-primary));
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(0, 174, 239, .25);
        }
    </style>
    @stack('head')
</head>
<body class="g-sidenav-show bg-gray-100">
    @include('admin.partials.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        @include('admin.partials.navbar')

        <div class="container-fluid py-4">
            @yield('content')
        </div>
    </main>

    <script src="{{ asset('assets/admin/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/soft-ui-dashboard.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
