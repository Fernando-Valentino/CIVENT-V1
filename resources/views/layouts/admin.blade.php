<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Meta tags, CSS, etc. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    

    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- Vector CSS -->
    <link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <!-- simplebar CSS-->
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <!-- Bootstrap core CSS-->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <!-- Sidebar CSS-->
    <link href="{{ asset('assets/css/sidebar-menu.css') }}" rel="stylesheet" />
    <!-- Custom Style-->
    <link href="{{ asset('assets/css/app-style.css') }}" rel="stylesheet" />
</head>

<body class="bg-theme bg-theme1">

    <!-- Start wrapper-->
    <div id="wrapper">

        @include('layouts.nav.navbar_admin')

        <div class="clearfix"></div>

        <div class="content-wrapper">
            <div class="container-fluid">

                <!--Start Dashboard Content-->

                @yield('content')
                <!--End Dashboard Content-->

               

            </div>
            <!-- End container-fluid-->

        </div><!--End content-wrapper-->
        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->

        <!--Start footer-->
        <footer class="footer">
            <div class="container">
                <div class="text-center">
                    &copy; {{ now()->year }} UCIC Events. All Rights Reserved.
                </div>
            </div>
        </footer>
        <!--End footer-->

        <!--start color switcher-->
        <div class="right-sidebar">
            <div class="switcher-icon">
                <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
            </div>
            <div class="right-sidebar-content">

                <p class="mb-0">Gaussion Texture</p>
                <hr>

                <ul class="switcher">
                    <li id="theme1"></li>
                    <li id="theme2"></li>
                    <li id="theme3"></li>
                    <li id="theme4"></li>
                    <li id="theme5"></li>
                    <li id="theme6"></li>
                </ul>

                <p class="mb-0">Gradient Background</p>
                <hr>

                <ul class="switcher">
                    <li id="theme7"></li>
                    <li id="theme8"></li>
                    <li id="theme9"></li>
                    <li id="theme10"></li>
                    <li id="theme11"></li>
                    <li id="theme12"></li>
                    <li id="theme13"></li>
                    <li id="theme14"></li>
                    <li id="theme15"></li>
                </ul>

            </div>
        </div>
        <!--end color switcher-->

    </div><!--End wrapper-->



    <!-- Include SweetAlert and other JS libraries -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- AOS Animation --}}
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="{{ asset('assets/js/index.js') }}"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- simplebar js -->
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.js') }}"></script>
    <!-- sidebar-menu js -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <!-- loader scripts -->
    <script src="{{ asset('assets/js/jquery.loading-indicator.js') }}"></script>
    <!-- Custom scripts -->
    <script src="{{ asset('assets/js/app-script.js') }}"></script>
    <!-- Chart js -->

    <script src="{{ asset('assets/plugins/Chart.js/Chart.min.js') }}"></script>

    <!-- Index js -->
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
