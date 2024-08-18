@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="container-fluid d-flex align-items-center justify-content-center"
        style="min-height: 100vh; background: linear-gradient(80deg, #00325c, #008cff);">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-duration="1000">
            <div class="col-md-8 col-lg-6 resetpw-container p-4 bg-white rounded shadow" data-aos="zoom-in"
                data-aos-duration="1000">

                <div class="d-flex justify-content-start" data-aos="fade-left" data-aos-duration="1300" data-aos-delay="300">
                    <a href="{{ route('login') }}" class="text-decoration-none text-dark d-flex align-items-center fs-5"><i
                            class="bi bi-arrow-left fs-3 text-dark me-3"></i></a>
                </div>
                <h3 class="text-center mb-4" data-aos="fade-down" data-aos-duration="1500">Reset Password</h3>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <!-- Input for NIM or Email -->
                    <div class="form-floating mb-3" data-aos="zoom-in" data-aos-duration="1300" data-aos-delay="400">
                        <input type="text" class="form-control border" id="identifier" name="identifier"
                            value="{{ old('identifier') }}" placeholder="NIM or Email" required>
                        <label for="identifier" class="text-secondary">NIM or Email</label>
                        @error('identifier')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input for New Password -->
                    <div class="form-floating mb-3 position-relative" data-aos="zoom-in" data-aos-duration="1600" data-aos-delay="500">
                        <input type="password" class="form-control border" id="password" name="password" placeholder="New Password" required>
                        <label for="password" class="text-secondary">New Password</label>
                        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 toggle-password" data-target="password" style="cursor: pointer;"></i>
                        @error('password')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input for Confirm New Password -->
                    <div class="form-floating mb-3 position-relative" data-aos="zoom-in" data-aos-duration="1900" data-aos-delay="600">
                        <input type="password" class="form-control border" id="password_confirmation"
                            name="password_confirmation" placeholder="Confirm New Password" required>
                        <label for="password_confirmation" class="text-secondary">Confirm New Password</label>
                        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 toggle-password" data-target="password_confirmation" style="cursor: pointer;"></i>
                    </div>

                    <button type="submit" class="btn btn-secondary btn-gradient w-100 rounded-pill" data-aos="fade-up" data-aos-duration="2000"
                        data-aos-delay="700">Reset Password</button>
                </form>
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
