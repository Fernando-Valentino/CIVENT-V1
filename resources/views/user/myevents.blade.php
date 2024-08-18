@extends('layouts.app')

@section('title', 'My Events')

@include('layouts.nav.navbar_user')

@section('content')
    <div class="container my-5">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-3 rounded">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Events</li>
            </ol>
        </nav>

        <!-- Success & Error Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row mt-4">
            @if ($registrations->isEmpty())
                <div class="alert alert-warning text-center" role="alert">
                    You have not registered for any events.
                </div>
            @else
                @foreach ($registrations as $registration)
                    @php
                        $eventDate = \Carbon\Carbon::parse($registration->event->event_date)->format('Y-m-d');
                        $eventTime = trim($registration->event->event_time);
                        $eventDateTimeString = $eventDate . ' ' . $eventTime;
                        $eventDateTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $eventDateTimeString);
                        $currentDateTime = \Carbon\Carbon::now();
                        $daysBeforeEvent = $eventDateTime->diffInDays($currentDateTime);
                        $cancellationAllowed = $daysBeforeEvent > 3;

                        if ($eventDateTime->isFuture()) {
                            $status = 'Belum Mulai';
                            $badgeClass = 'badge bg-primary';
                        } elseif ($eventDateTime->isToday()) {
                            $status = 'Berlangsung';
                            $badgeClass = 'badge bg-warning text-dark';
                        } else {
                            $status = 'Selesai';
                            $badgeClass = 'badge bg-success';
                        }
                    @endphp
                    <div class="col-md-3 mb-4">
                        <div class="card shadow border-0 rounded-lg">
                            @if ($registration->event->image)
                                <img src="{{ asset('storage/images/events/' . $registration->event->image) }}"
                                    class="card-img-top rounded-top img-fixed-size event-image"
                                    alt="{{ $registration->event->title }}" data-bs-toggle="modal"
                                    data-bs-target="#imageModal"
                                    data-image="{{ asset('storage/images/events/' . $registration->event->image) }}" style="cursor: pointer"> 
                            @else
                                <img src="{{ asset('storage/images/default.jpg') }}"
                                    class="card-img-top rounded-top img-fixed-size" alt="Default Image">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title mb-2 fw-bold">{{ $registration->event->title }}</h5>
                                <p class="card-text">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    {{ \Carbon\Carbon::parse($registration->event->event_date)->locale('id')->translatedFormat('d F Y') }}<br>
                                    <i class="bi bi-clock me-1"></i>
                                    {{ \Carbon\Carbon::parse($registration->event->event_time)->format('H:i') }}<i class="bi bi-dash-lg fw-bold mx-1"></i>{{ \Carbon\Carbon::parse($registration->event->event_end_time)->format('H:i') }}
                                    WIB<br>
                                    <i class="bi bi-geo-alt me-1"></i>
                                    {{ $registration->event->location }}<br>
                                    <span class="badge {{ $badgeClass }} mt-2">{{ $status }}</span>
                                </p>
                                <div class="d-flex justify-content-end mt-3">
                                    @if ($cancellationAllowed && $eventDateTime->isFuture())
                                        <button type="button" class="btn btn-outline-danger btn-md me-2"
                                            data-bs-toggle="modal"
                                            data-bs-target="#cancelRegistrationModal{{ $registration->id }}">
                                            Cancel
                                        </button>
                                    @endif
                                    <a href="{{ route('events.detail_myevents', $registration->event_id) }}"
                                        class="btn btn-outline-primary btn-md">
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Cancel Registration Modal Structure -->
                        <div class="modal fade" id="cancelRegistrationModal{{ $registration->id }}" tabindex="-1"
                            aria-labelledby="cancelRegistrationModalLabel{{ $registration->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="cancelRegistrationModalLabel{{ $registration->id }}">
                                            Cancel Registration</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to cancel your registration for this event?</p>
                                        <form id="cancelRegistrationForm{{ $registration->id }}"
                                            action="{{ route('events.cancelRegistration') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="event_id" value="{{ $registration->event_id }}">
                                            <button type="submit" class="btn btn-danger float-end">Yes, Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for Image View -->
                        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="imageModalLabel">Event Image</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="" id="modalImage" class="img-fluid" alt="Event Image">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.event-image').forEach(image => {
            image.addEventListener('click', function() {
                const imgSrc = this.getAttribute('data-image');
                document.getElementById('modalImage').setAttribute('src', imgSrc);
            });
        });
    });
</script>
