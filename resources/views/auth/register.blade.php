@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="container-fluid d-flex align-items-center justify-content-center"
        style="min-height: 100vh; background: linear-gradient(80deg, #00325c, #008cff);">
        <div class="row justify-content-center py-3" data-aos="fade-up" data-aos-duration="1000">
            <div class="col-md-12 col-lg-12 register-container p-4 bg-white rounded shadow" data-aos="fade-right"
                data-aos-duration="1200">
                <div class="d-flex justify-content-start" data-aos="fade-left" data-aos-duration="1300" data-aos-delay="300">
                    <a href="{{ route('login') }}"
                        class="text-decoration-none text-dark d-flex align-items-center fs-5">
                        <i class="bi bi-arrow-left fs-3 text-dark me-3"></i>
                    </a>
                </div>
                <h3 class="text-center mb-4" data-aos="fade-down" data-aos-duration="1500">Register</h3>
                @error('register')
                    <div class="alert alert-danger mt-2" data-aos="zoom-in" data-aos-duration="1800">{{ $message }}</div>
                @enderror
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    @include('vendor.sweetalert')

                    <!-- Input for Name and NIM (side by side) -->
                    <div class="row mb-3" data-aos="zoom-in" data-aos-duration="1200">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control focus-ring focus-ring-primary text-decoration-none border"
                                    id="name" name="name" value="{{ old('name') }}" placeholder="Name" required>
                                <label for="name" class="text-secondary">Name</label>
                                @error('name')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control focus-ring focus-ring-primary text-decoration-none border"
                                    id="nim" name="nim" value="{{ old('nim') }}" placeholder="NIM" required>
                                <label for="nim" class="text-secondary">NIM</label>
                                @error('nim')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Input for Email  -->
                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control focus-ring focus-ring-primary text-decoration-none border"
                                    id="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                <label for="email" class="text-secondary">Email</label>
                                @error('email')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Input for Password and Confirm Password -->
                    <div class="row" data-aos="zoom-in" data-aos-duration="1400" data-aos-delay="200">
                        <div class="col-md-6">
                            <div class="form-floating position-relative">
                                <input type="password"
                                    class="form-control focus-ring focus-ring-primary text-decoration-none border"
                                    id="password" name="password" placeholder="Password" required>
                                <label for="password" class="text-secondary">Password</label>
                                <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 toggle-password"
                                   data-target="password" style="cursor: pointer;"></i>
                                @error('password')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating position-relative">
                                <input type="password"
                                    class="form-control focus-ring focus-ring-primary text-decoration-none border"
                                    id="password_confirmation" name="password_confirmation" placeholder="Confirm Password"
                                    required>
                                <label for="password_confirmation" class="text-secondary">Confirm Password</label>
                                <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 toggle-password"
                                   data-target="password_confirmation" style="cursor: pointer;"></i>
                                @error('password_confirmation')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="role" name="role" value="user">
                    @error('role')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn btn-white btn-gradient mt-3 w-100 rounded-pill" data-aos="fade-up"
                        data-aos-duration="1800" data-aos-delay="600">Register</button>
                </form>
                <div class="row mt-3">
                    <div class="col-md-12 d-flex justify-content-center align-items-center">
                        <span class="text-secondary">Already have an account?</span>
                        <a href="{{ route('login') }}"
                            class="text-primary ms-1 link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
