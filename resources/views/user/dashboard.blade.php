@extends('layouts.app')

@section('title', 'Dashboard')

@include('layouts.nav.navbar_user')

@section('content')

    <div class="container mt-5">

        @if ($isLoggedIn)

            <!-- Breadcrumb Navigation -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light p-3 rounded">
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
            <!-- For logged-in users -->
            <div class="text-center mb-4">
                <h1 data-aos="fade-in" data-aos-duration="1000" class="display-4 fw-bold">Welcome, {{ Auth::user()->name }}!
                </h1>
                <p data-aos="fade-up" data-aos-duration="1200" class="text-secondary">Explore the latest events below and
                    stay updated!</p>
            </div>

            <!-- Combined Search Form -->
            <div class="mt-5">
                <form action="{{ route('events.search') }}" method="GET" class="d-flex justify-content-center">
                    <div class="row w-75">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border border-end-0">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" name="title" class="form-control border border-start-0"
                                    placeholder="Event Name" value="{{ request('title') }}" style="box-shadow: none;">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border border-end-0">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                                <input type="date" name="date" class="form-control border border-start-0"
                                    placeholder="Event Date" value="{{ request('date') }}" style="box-shadow: none;">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-50 p-2" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Search">
                                <i class="fas fa-arrow-right"></i>
                            </button>

                        </div>
                    </div>
                </form>
            </div>


            <!-- Reload Button -->
            <div class="text-center mb-4">
                <button onclick="window.location.href='{{ route('dashboard') }}';" class="btn btn-outline-secondary">
                    <i class="fas fa-sync-alt"></i> Reload
                </button>
            </div>

            <!-- Event Listing -->
            <div class="container-fluid event">
                <div class="container py-3">
                    <div class="mx-auto text-center mb-5 border-bottom" style="max-width: 800px;">
                        <h1 class="display-3" data-aos="fade-up" data-aos-duration="1400">UCIC Event</h1>
                    </div>

                    @if ($events->isEmpty())
                        <!-- Alert if no events found -->
                        <div class="alert alert-warning text-center" role="alert" data-aos="fade-in"
                            data-aos-duration="1500">
                            No events found. Please try a different search.
                        </div>
                    @else
                        <div class="row g-4" id="event-container">
                            @foreach ($events as $event)
                                <div class="col-lg-6 col-md-6 mt-3" data-aos="zoom-in" data-aos-duration="1500">
                                    <div class="card border-0 shadow-sm rounded mb-4 card-event"
                                        style="position: relative; background-image: url('{{ asset('storage/images/events/' . $event->image) }}'); background-size: cover; background-position: center; height: 250px;">
                                        <div class="overlay rounded"
                                            style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5);">
                                        </div>
                                        <div class="card-body text-white d-flex flex-column justify-content-between"
                                            style="position: relative; z-index: 2; height: 100%;">
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <!-- Display the badge if the event is created in the last 3 days -->
                                                    @if (\Carbon\Carbon::parse($event->created_at)->gt(\Carbon\Carbon::now()->subDays(3)))
                                                        <span class="badge bg-success">Event Terbaru</span>
                                                    @else
                                                        <span class="d-none">Event</span>
                                                    @endif
                                                </div>
                                                <h3 class="mt-3">{{ $event->title }}</h3>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                                <div>
                                                    <small class="text-muted">
                                                        <i class="fas fa-calendar-alt me-1"></i>
                                                        {{ \Carbon\Carbon::parse($event->event_date)->locale('id')->translatedFormat('d F Y') }}
                                                    </small>
                                                    <small class="text-muted ms-3">
                                                        <i class="fas fa-clock me-1"></i>
                                                        {{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }}
                                                    </small>
                                                </div>
                                                <a href="{{ route('events.show', $event->id) }}"
                                                    class="text-white stretched-link"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $events->links('vendor.pagination') }}
                        </div>
                    @endif
                </div>
            </div>
        @else
            <!-- For users not logged in -->
            <div class="text-center mb-5">
                <h1 data-aos="fade-in" data-aos-duration="1000" class="display-4 fw-bold">Welcome to UCIC Events</h1>
                <p data-aos="fade-up" data-aos-duration="1200" class="text-secondary"><span
                        class="fw-bold text-primary">Login</span> to view and register for the latest events.</p>
            </div>

            <div class="container-fluid event">
                <div class="container py-3">
                    <div class="mx-auto text-center mb-5 border-bottom" style="max-width: 800px;">
                        <h1 class="display-3" data-aos="fade-up" data-aos-duration="1400">UCIC Event</h1>
                    </div>

                    @if ($events->isEmpty())
                        <!-- Alert if no events found -->
                        <div class="alert alert-warning text-center" role="alert" data-aos="fade-in"
                            data-aos-duration="1500">
                            No events found.
                        </div>
                    @else
                        <div class="row g-4" id="event-container">
                            @foreach ($events as $event)
                                <div class="col-lg-6 col-md-6 mt-3" data-aos="zoom-in" data-aos-duration="1500">
                                    <div class="card border-0 shadow-sm rounded mb-4 card-event"
                                        style="position: relative; background-image: url('{{ asset('storage/images/events/' . $event->image) }}'); background-size: cover; background-position: center; height: 250px;">
                                        <div class="overlay rounded"
                                            style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5);">
                                        </div>
                                        <div class="card-body text-white d-flex flex-column justify-content-between"
                                            style="position: relative; z-index: 2; height: 100%;">
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <!-- Display the badge if the event is created in the last 3 days -->
                                                    @if (\Carbon\Carbon::parse($event->created_at)->gt(\Carbon\Carbon::now()->subDays(3)))
                                                        <span class="badge bg-success">Event Terbaru</span>
                                                    @else
                                                        <span class="d-none">Event</span>
                                                    @endif
                                                </div>
                                                <h3 class="mt-3">{{ $event->title }}</h3>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                                <div>
                                                    <small class="text-muted">
                                                        <i class="fas fa-calendar-alt me-1"></i>
                                                        {{ \Carbon\Carbon::parse($event->event_date)->locale('id')->translatedFormat('d F Y') }}
                                                    </small>
                                                    <small class="text-muted ms-3">
                                                        <i class="fas fa-clock me-1"></i>
                                                        {{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }}
                                                    </small>
                                                </div>
                                                <a href="{{ route('events.show', $event->id) }}"
                                                    class="text-white stretched-link"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $events->links('vendor.pagination') }}
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>

    @if ($isLoggedIn)
        <!-- Modal for Image View -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Event Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="" id="modalImage" class="img-fluid" alt="Event Image">
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Modal for Image View (not logged in) -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Event Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center alert alert-danger">Please login to view event images.</div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($isLoggedIn)
        <!-- Logout Form (Hidden) -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <script>
            document.getElementById('logout-button')?.addEventListener('click', function(event) {
                event.preventDefault();
                document.getElementById('logout-form').submit();
            });

            document.querySelectorAll('.event-image').forEach(image => {
                image.addEventListener('click', function() {
                    const imgSrc = this.getAttribute('data-image');
                    document.getElementById('modalImage').setAttribute('src', imgSrc);
                });
            });

            // Initialize all tooltips on the page
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        </script>
    @endif

@endsection
