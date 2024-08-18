<!-- Navbar start -->
<div class="container-fluid sticky-top px-0">
    <div class="container-fluid" style="background: linear-gradient(80deg, #00325c, #008cff);">
        <div class="container px-0">
            <nav class="navbar navbar-dark navbar-expand-xl">
                <a href="{{ route('user.dashboard') }}" class="navbar-brand">
                    <h1 class="text-white display-4">CiVent</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    aria-expanded="false" aria-label="Toggle navigation" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse py-3" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="{{ route('dashboard') }}"
                            class="nav-item nav-link text-white {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }} mx-3">
                            Dashboard
                        </a>
                        <a href="{{ route('events.myEvents') }}"
                            class="nav-item nav-link text-white {{ Route::currentRouteName() == 'events.myEvents' ? 'active' : '' }} mx-3">
                            My Events
                        </a>
                        <a href="{{ route('user.contact') }}"
                            class="nav-item nav-link text-white {{ Route::currentRouteName() == 'user.contact' ? 'active' : '' }} mx-3">
                            Kontak Kami
                        </a>
                    </div>
                    <div class="d-flex align-items-center flex-nowrap pt-xl-0">
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-gradient rounded-pill shadow">Login</a>
                            <a href="{{ route('register') }}"
                                class="btn btn-light rounded-pill ms-2 text-primary">Register</a>
                        @else
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger mt-2 ms-3">Logout</button>
                            </form>
                        @endguest
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar End -->

@include('vendor.sweetalert')
