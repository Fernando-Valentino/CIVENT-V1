@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container-fluid d-flex align-items-center justify-content-center"
        style="min-height: 100vh; background: linear-gradient(80deg, #00325c, #008cff);">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-duration="1000">
            <div class="col-md-10 col-lg-12 login-container p-4 bg-white rounded shadow" data-aos="zoom-in" data-aos-duration="1000">
                <div class="d-flex justify-content-start" data-aos="fade-left" data-aos-duration="1300" data-aos-delay="300">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none text-dark d-flex align-items-center fs-5">
                        <i class="bi bi-arrow-left fs-3 text-dark me-3"></i>
                    </a>
                </div>
                <h3 class="text-center mb-4" data-aos="fade-down" data-aos-duration="1000">Login</h3>
                @error('login')
                    <div class="alert alert-danger mt-2" data-aos="fade-in" data-aos-duration="1000">{{ $message }}</div>
                @enderror
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Input for NIM or Email -->
                    <div class="form-floating mb-3" data-aos="fade-right" data-aos-duration="1000">
                        <input type="text" class="form-control focus-ring focus-ring-primary text-decoration-none border"
                            id="login" placeholder="NIM or Email" name="login" value="{{ old('login') }}" required>
                        <label for="login" class="text-secondary">NIM or Email</label>
                    </div>

                    <!-- Input for Password -->
                    <div class="form-floating position-relative" data-aos="fade-right" data-aos-duration="1000">
                        <input type="password" id="password" name="password"
                            class="form-control focus-ring focus-ring-primary text-decoration-none border"
                            placeholder="Password" required>
                        <label for="password" class="text-secondary">Password</label>
                        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 toggle-password" data-target="password" style="cursor: pointer;"></i>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-secondary btn-gradient mt-3 w-100 rounded-pill" data-aos="fade-up" data-aos-duration="1000">Login</button>
                </form>
                <div class="row mt-2">
                    <div class="col-md-12 d-flex justify-content-start align-items-center mb-2" data-aos="fade-left" data-aos-duration="1000">
                        <a href="{{ route('password.request') }}"
                            class="text-primary link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover ms-1">Forgot Password?</a>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center align-items-center">
                        <span class="text-secondary">Don't have an account?</span>
                        <a href="{{ route('register') }}"
                            class="text-primary ms-1 link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('vendor.sweetalert')

    <script>
        document.querySelectorAll('.toggle-password').forEach(item => {
            item.addEventListener('click', event => {
                const targetId = item.getAttribute('data-target');
                const target = document.getElementById(targetId);
                const icon = item;

                if (target.type === 'password') {
                    target.type = 'text';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                } else {
                    target.type = 'password';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                }
            });
        });
    </script>
@endsection
