@extends('layouts.admin')

@section('title', 'Event Participants')

@section('content')
<div class="container">
    <h1 class="mb-4">Participants for: <span class="text-white">{{ $event->title }}</span></h1>
    @if($event->registrations->isNotEmpty())
        <div class="row">
            @foreach($event->registrations as $registration)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $registration->name }}</h5>
                            <p class="card-text text-white">
                                <strong>NIM:</strong> {{ $registration->nim }}<br>
                                <strong>Email:</strong> <a href="mailto:{{ $registration->email }}">{{ $registration->email }}</a>
                            </p>
                        </div>
                        <div class="card-footer">
                            <span class="badge bg-success">Registered</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning p-3" role="alert">
            No participants have registered for this event yet.
        </div>
    @endif
    <a href="{{ route('admin.events.index') }}" class="btn btn-primary mt-4">
        <i class="bi bi-arrow-left"></i> Back to Events
    </a>
</div>
@endsection
