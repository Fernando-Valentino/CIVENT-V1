@extends('layouts.app')

@section('title', 'Manage Events')

@section('content')
<div class="container mt-5">
    <h1>Manage Events</h1>

    <!-- SweetAlert for Success and Error Handling -->
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                showConfirmButton: true,
            });
        </script>
    @elseif(session('error'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                showConfirmButton: true,
            });
        </script>
    @endif

    <div class="row">
        @foreach($events as $event)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $event->image_url }}" class="card-img-top" alt="{{ $event->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                        <p class="card-text"><small class="text-muted">Date: {{ $event->date }}</small></p>
                        @if($event->status == 'pending')
                            <a href="{{ route('admin.events.confirm', $event->id) }}" class="btn btn-success">Approve Event</a>
                        @else
                            <span class="badge bg-success">Approved</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
