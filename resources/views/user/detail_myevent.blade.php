@extends('layouts.app')

@section('title', 'Detail My Event')

@include('layouts.nav.navbar_user')

@section('content')
    <div class="container my-5">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-3 rounded">
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('events.myEvents') }}" class="text-decoration-none">My Events</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $event->title }}</li>
            </ol>
        </nav>

        <div class="row">

            <!-- Participants Information -->
            <div class="col-md-5 mb-4">
                <div class="card shadow-sm border-light">
                    <div class="card-body">
                        <h5 class="card-title mb-2 text-center">Participants</h5>
                        <ul class="list-group list-group-flush">
                            @if ($event->participants->isEmpty())
                                <li class="list-group-item text-center text-muted">No participants found for this event.
                                </li>
                            @else
                                @foreach ($event->participants as $participant)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-5 p-0"><strong>Name</strong></div>
                                            <div class="col-7 p-0">: {{ $participant->name }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5 p-0"><strong>NIM</strong></div>
                                            <div class="col-7 p-0">: {{ $participant->nim }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5 p-0"><strong>Email</strong></div>
                                            <div class="col-7 p-0">: {{ $participant->email }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5 p-0"><strong>Registered</strong></div>
                                            <div class="col-7 p-0">:
                                                <small>{{ \Carbon\Carbon::parse($participant->pivot->created_at)->locale('id')->translatedFormat('d M Y | H:i') }}
                                                    WIB</small>
                                            </div>
                                        </div>
                                        @if ($event->registrations->isNotEmpty())
                                            @foreach ($event->registrations as $registration)
                                                @if ($registration->user_id == Auth::id())
                                                    <div class="row">
                                                        <div class="col-5 p-0"><strong>Registration ID</strong></div>
                                                        <div class="col-7 p-0">:
                                                            <strong>{{ $registration->registration_id }}</strong></div>
                                                        <div class="alert alert-info mt-2">
                                                            *Harap memberitahukan <span
                                                                class="text-dark fw-bold">Registration ID</span> anda, jika
                                                            ingin masuk ke ruangan <span
                                                                class="text-dark fw-bold">{{ $event->location }}</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <div class="alert alert-warning">You are not registered for this event.</div>
                                        @endif

                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Event Information -->
            <div class="col-md-7 mb-4">
                <div class="card shadow-sm border-light">
                    <div class="card-body">
                        <h4 class="card-title mb-3">{{ $event->title }}</h4>
                        @if ($event->image)
                            <img src="{{ asset('storage/images/events/' . $event->image) }}" class="img-fluid rounded mb-3"
                                alt="{{ $event->title }}">
                        @else
                            <img src="{{ asset('storage/images/default.jpg') }}" class="img-fluid rounded mb-3"
                                alt="Default Image">
                        @endif

                        <!-- Event Status -->
                        @php
                            $eventDate = \Carbon\Carbon::parse($event->event_date)->format('Y-m-d');
                            $eventTime = trim($event->event_time);
                            $eventDateTimeString = $eventDate . ' ' . $eventTime;
                            $eventDateTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $eventDateTimeString);
                            $currentDateTime = \Carbon\Carbon::now();

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
                        <p class="card-text mb-2 ">
                            <span class="badge {{ $badgeClass }} w-25">{{ $status }}</span>
                        </p>

                        <p class="card-text mb-2">
                            <i class="bi bi-geo-alt me-1"></i>{{ $event->location }}
                        </p>
                        <p class="card-text mb-2">
                            <i
                                class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($event->event_date)->locale('id')->translatedFormat('d F Y') }}
                        </p>
                        <p class="card-text mb-2">
                            <i class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }}
                            - {{ \Carbon\Carbon::parse($event->event_end_time)->format('H:i') }} WIB
                        </p>
                        <p class="card-text">
                            <i class="bi bi-info-circle me-1"></i>Informasi : {!! $event->description !!}
                        </p>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
@endsection
