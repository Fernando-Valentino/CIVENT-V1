@extends('layouts.admin')

@section('title', 'Daftar Events')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Daftar Events</h1>
            <!-- Optional button for additional actions -->
            <!-- <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Event
            </a> -->
        </div>

        @if ($events->count())
            <div class="row">
                @foreach ($events as $event)
                    <div class="col-md-4 mb-4">
                        <div class="card bg-light border-light shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->title }}</h5>
                                <p class="card-text text-white">
                                    <strong>Date:</strong> {{ $event->event_date->format('d M Y') }}<br>
                                    <strong>Time:</strong> {{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->event_end_time)->format('H:i') }} WIB
                                </p>
                                <div class="d-flex justify-content-end">
                                    <div class="btn-group" role="group" aria-label="Actions">
                                        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning btn-md" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Event">
                                            <i class="bi bi-pencil fs-6"></i> 
                                        </a>
                                        <a href="{{ route('admin.events.attendees', $event->id) }}" class="btn btn-primary btn-md" data-bs-toggle="tooltip" data-bs-placement="top" title="View Attendees">
                                            <i class="bi bi-people fs-6"></i> 
                                        </a>
                                        <a href="{{ route('admin.events.report.event', $event->id) }}" target="_blank" class="btn btn-info btn-md" data-bs-toggle="tooltip" data-bs-placement="top" title="View Report">
                                            <i class="bi bi-eye fs-6"></i> 
                                        </a>
                                        <a href="{{ route('admin.events.report.event.pdf', $event->id) }}" class="btn btn-success btn-md" data-bs-toggle="tooltip" data-bs-placement="top" title="Download PDF">
                                            <i class="bi bi-download fs-6"></i> 
                                        </a>
                                        <button type="button" class="btn btn-danger btn-md" onclick="confirmDelete({{ $event->id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Event">
                                            <i class="bi bi-trash fs-6"></i> 
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $event->id }}" action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $events->links('vendor.pagination') }}
            </div>
        @else
            <div class="alert alert-warning mt-4 p-3 text-center" role="alert">
                No events available.
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            // Initialize all tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        </script>
    @endpush
@endsection
