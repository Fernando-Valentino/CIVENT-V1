@extends('layouts.app')

@section('title', 'Event Details')

@include('layouts.nav.navbar_user')

@section('content')
    <div class="container my-5">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-3 rounded">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Detail Event {{ $event->title }}</li>
            </ol>
        </nav>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header border-0 bg-light">
                        <h2 class="text-center">{{ $event->title }}</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Image Section -->
                            <div class="col-md-5">
                                @if ($event->image)
                                    <img src="{{ asset('storage/images/events/' . $event->image) }}"
                                        class="img-fluid mb-3 rounded" alt="{{ $event->title }}">
                                @else
                                    <img src="{{ asset('storage/images/default.jpg') }}" class="img-fluid mb-3 rounded"
                                        alt="Default Image">
                                @endif

                            </div>

                            <!-- Event Details Section -->
                            <div class="col-md-7">
                                <p class=" fs-5">
                                    <i class="bi bi-geo-alt me-1"></i>{{ $event->location }}
                                </p>
                                <p class=" fs-6">
                                    <i
                                        class="bi bi-calendar2-week me-1"></i>{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}
                                    <span class="ms-3"><i
                                            class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }}</span>
                                    <span class=""><i
                                            class="bi bi-dash-lg fw-bold mx-1"></i>{{ \Carbon\Carbon::parse($event->event_end_time)->format('H:i') }}
                                        WIB</span>
                                </p>

                                <!-- Display Remaining Quota -->
                                <div class="d-flex align-items-center mb-4">
                                    <i class="bi bi-people me-2"></i>
                                    <p class="fw-bold mb-0">Kuota Peserta :
                                        {{ $event->quota - $event->registered_participants }}</p>
                                    <div class="progress ms-3 flex-grow-1">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ ($event->registered_participants / $event->quota) * 100 }}%;"
                                            aria-valuenow="{{ $event->registered_participants }}" aria-valuemin="0"
                                            aria-valuemax="{{ $event->quota }}"></div>
                                    </div>
                                </div>




                                @php
                                    $eventDate = \Carbon\Carbon::parse($event->event_date)->setTimezone('Asia/Jakarta');
                                    $eventTime = \Carbon\Carbon::parse($event->event_time)->format('H:i');
                                    $eventStartDateTime = $eventDate->setTimeFromTimeString($eventTime);
                                    $currentDateTime = \Carbon\Carbon::now()->setTimezone('Asia/Jakarta');
                                    $threeHoursBeforeEvent = $eventStartDateTime->copy()->subHours(3);
                                @endphp

                                <!-- Registration Button Logic -->
                                <div class="d-flex justify-content-center">
                                    @if ($registrations->contains('event_id', $event->id))
                                        <button type="button" class="btn btn-secondary w-100" disabled>
                                            Already Registered
                                        </button>
                                    @elseif ($event->registered_participants >= $event->quota)
                                        <button type="button" class="btn btn-secondary w-100" disabled>
                                            Fully Booked
                                        </button>
                                    @elseif (
                                        $currentDateTime->greaterThanOrEqualTo($eventStartDateTime) ||
                                            $currentDateTime->greaterThanOrEqualTo($threeHoursBeforeEvent))
                                        <button type="button" class="btn btn-secondary w-100" disabled>
                                            Registration Closed
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                                            data-bs-target="#registrationModal">
                                            Register For Event
                                        </button>
                                    @endif
                                </div>

                                <div class="alert alert-info mt-2">
                                    <i class="bi bi-info-circle me-1"></i>Registrasi hanya dapat dilakukan pada <span
                                        class="fw-bold">Waktu
                                        Tersedia</span>, Baca Informasi dibawah terlebih dahulu sebelum melakukan
                                    Registrasi..!!
                                </div>

                                <div id="countdown" class="mt-3 d-none text-center">
                                    <p class="fs-5 text-danger mb-2"><i class="bi bi-hourglass-split me-1"></i> Waktu
                                        Tersisa Untuk Registrasi:</p>
                                    <div id="countdown-timer" class="d-flex justify-content-center gap-3">
                                        <div class="countdown-item">
                                            <span class="countdown-number" id="days">00</span>
                                            <span class="countdown-label">Hari</span>
                                        </div>
                                        <div class="countdown-item">
                                            <span class="countdown-number" id="hours">00</span>
                                            <span class="countdown-label">Jam</span>
                                        </div>
                                        <div class="countdown-item">
                                            <span class="countdown-number" id="minutes">00</span>
                                            <span class="countdown-label">Menit</span>
                                        </div>
                                        <div class="countdown-item">
                                            <span class="countdown-number" id="seconds">00</span>
                                            <span class="countdown-label">Detik</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row p-1">
                            <div class="col-md-12 ">
                                <!-- Event Information -->
                                <p class="card-text mt-3">
                                    <i class="bi bi-info-circle me-1"></i>Informasi : {!! $event->description !!}
                                </p>
                            </div>
                        </div>

                        <!-- Modal Structure -->
                        <div class="modal fade" id="registrationModal" tabindex="-1"
                            aria-labelledby="registrationModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="registrationModalLabel">Event Registration</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-warning" role="alert">"Anda <span
                                                class="text-danger fw-bold">tidak dapat membatalkan</span> pendaftaran jika
                                            event sudah mendekati <span class="text-danger fw-bold">3 hari sebelum tanggal
                                                event dimulai</span> <br><span
                                                class="text-dark fw-bold">{{ \Carbon\Carbon::parse($event->event_date)->format('d F Y') }}</span>"
                                        </div>

                                        <form id="registrationForm" action="{{ route('events.register') }}"
                                            method="POST">
                                            @csrf

                                            <input type="hidden" name="event_id" value="{{ $event->id }}">

                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Name" value="{{ Auth::user()->name }}" readonly>
                                                <label for="name" class="form-label">Name</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="nim" name="nim"
                                                    placeholder="NIM" value="{{ Auth::user()->nim }}" readonly>
                                                <label for="nim" class="form-label">NIM</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Email" value="{{ Auth::user()->email }}" readonly>
                                                <label for="email" class="form-label">Email</label>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div class="row mb-3">
                                                    <label for="registration_id"
                                                        class="col-sm-4 col-form-label fw-bold text-sm-end">Registration
                                                        ID:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control fw-bold"
                                                            id="registration_id" name="registration_id"
                                                            value="{{ $registrationId }}" readonly>
                                                    </div>
                                                </div>

                                                <div class="alert alert-info mt-1">
                                                    *Harap memberitahukan <span class="text-dark fw-bold">Event
                                                        ID</span> anda, jika ingin masuk ke ruangan <span
                                                        class="text-dark fw-bold">{{ $event->location }}</span>
                                                </div>

                                            </div>

                                            <button type="submit" class="btn btn-primary w-100">Register</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const threeHoursBeforeEvent = new Date("{{ $threeHoursBeforeEvent }}");

            const countdownElement = document.getElementById('countdown');
            const daysElement = document.getElementById('days');
            const hoursElement = document.getElementById('hours');
            const minutesElement = document.getElementById('minutes');
            const secondsElement = document.getElementById('seconds');

            const now = new Date();
            if (now >= threeHoursBeforeEvent) {
                countdownElement.classList.add('d-none');
            } else {
                countdownElement.classList.remove('d-none');
                updateCountdown();
                setInterval(updateCountdown, 1000);
            }

            function updateCountdown() {
                const now = new Date();
                const distance = threeHoursBeforeEvent - now;

                if (distance < 0) {
                    countdownElement.classList.add('d-none');
                    location.reload(); // Reload halaman ketika countdown selesai
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                daysElement.innerText = days.toString().padStart(2, '0');
                hoursElement.innerText = hours.toString().padStart(2, '0');
                minutesElement.innerText = minutes.toString().padStart(2, '0');
                secondsElement.innerText = seconds.toString().padStart(2, '0');
            }
        });
    </script>
@endpush
