<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets/img/favicon.png">
    <title>Gestor Frota</title>
    <base href="{{ url('/') }}">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> -->
    <!-- <script src="https://kit.fontawesome.com/a4c00a89bc.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/ju/dt-1.11.5/datatables.min.css"/> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <!-- CSS Files -->
    <link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />

    @stack('css')

</head>

<body class="g-sidenav-show bg-gray-100 {{ $class ?? '' }}">
    @guest
        @yield('content')
    @endguest

    @auth
        @if (str_contains(request()->url(), 'rtl') ||
            str_contains(request()->url(), 'pricing-page') ||
            in_array(
                request()->route()->getName(),
                ['signins', 'signups', 'resets', 'locks', 'verifications', 'errors']))
            @yield('content')
        @else
            @if (str_contains(request()->url(), 'landing'))
                @include('components.headers.hero', ['height' => 'h-100'])
                @include('layouts.navbars.auth.sidenav', [
                    'box' => 'box-shadow-none',
                    'logo' => '/assets/img/logo-ct.png',
                ])
            @elseif (!str_contains(request()->url(), 'vr'))
                @if (Route::currentRouteName() == 'profiles' || str_contains(request()->url(), 'new-product'))
                    @include('components.headers.image-hero')
                @else
                    @include('components.headers.hero')
                @endif
                @include('layouts.navbars.auth.sidenav', ['bg' => 'bg-white'])
            @endif

            <main class="main-content position-relative border-radius-lg">
                @yield('content')
                @include('components.fixed-plugin')
            </main>
        @endif
    @endauth

    <!--   Core JS Files   -->
    @stack('js')

    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>
    {{-- <script src="/assets/js/core/bootstrap.bundle.min.js"></script> --}}
    <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="/assets/js/plugins/fullcalendar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/assets/js/argon-dashboard.js"></script>
</body>

</html>
