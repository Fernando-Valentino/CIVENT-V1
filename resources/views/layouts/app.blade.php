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


    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="lib/animate/animate.min.css" />
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <!-- Customized Bootstrap Stylesheet -->
    {{-- <link href="{{ asset('assets/css/bootstrapcontact.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/contactstyle.css') }}" rel="stylesheet"> --}}

    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
</head>

<body>

    @yield('content')
    @stack('scripts')

    <footer class="bg-dark text-light pt-5 pb-4" style="background: linear-gradient(80deg, #00325c, #008cff);">
        <div class="container text-center text-md-start">
            <div class="row">
                <!-- Company Info -->
                <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-3">
                    <h2 class=" mb-4 font-weight-bold">CiVent</h2>
                    <h6 class="text-uppercase mb-4 font-weight-bold">UCIC Events</h6>
                    <p>
                        Temukan dan bergabunglah dengan acara-acara terbaik di komunitas UCIC. Tetap terhubung dan
                        jangan pernah melewatkan peluang menarik.
                    </p>
                </div>

                <!-- Useful Links -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h6 class="text-uppercase mb-4 font-weight-bold">Quick Links</h6>
                    <p>
                        <a href="{{ route('user.dashboard') }}" class="text-reset text-decoration-none">Dashboard</a>
                    </p>
                    {{-- <p>
                        <a href="{{ route('about') }}" class="text-reset text-decoration-none">About</a>
                    </p>
                    <p>
                        <a href="{{ route('contact') }}" class="text-reset text-decoration-none">Contact</a>
                    </p> --}}
                </div>

                <!-- Contact Info -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
                    <p>
                        <i class="fas fa-home mr-3"></i> Jl. Kesambi No.202, Drajat, Kec. Kesambi, Kota Cirebon, Jawa
                        Barat 45133
                    </p>
                    <p>
                        <i class="fas fa-envelope mr-3"></i> info@ucicevents.com
                    </p>
                    <p>
                        <i class="fas fa-phone mr-3"></i> (0231) 200418
                    </p>
                </div>

                <!-- Social Media -->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h6 class="text-uppercase mb-4 font-weight-bold">Follow Us</h6>
                    <a href="#" class="btn btn-light btn-floating m-1 text-reset">
                        <i class="bi bi-facebook text-dark"></i>
                    </a>
                    <a href="#" class="btn btn-light btn-floating m-1 text-reset">
                        <i class="bi bi-twitter  text-dark"></i>
                    </a>
                    <a href="#" class="btn btn-light btn-floating m-1 text-reset">
                        <i class="bi bi-instagram  text-dark"></i>
                    </a>
                    <a href="#" class="btn btn-light btn-floating m-1 text-reset">
                        <i class="bi bi-linkedin  text-dark"></i>
                    </a>
                </div>

            </div>

            <hr class="my-4">

            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-lg-8">
                    <p class="text-center text-white">
                        &copy; {{ now()->year }} UCIC Events. All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Include SweetAlert and other JS libraries -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- AOS Animation --}}
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/contact.js') }}"></script>
    <!-- Bootstrap and jQuery (include in your layout file) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- Bootstrap Bundle with Popper.js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
</body>

</html>
