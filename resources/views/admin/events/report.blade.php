@extends('layouts.admin')

@section('title', 'Event Report')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Event Report</h1>
        <a href="{{ route('admin.events.report.pdf', ['month' => request('month', date('m')), 'year' => request('year', date('Y')), 'pdf' => true]) }}" class="btn btn-success" target="_blank">
            <i class="bi bi-file-earmark-pdf"></i> Download PDF
        </a>
    </div>

    <form method="GET" action="{{ route('admin.events.report') }}" class="row g-3">
        <div class="col-md-4">
            <label for="month" class="form-label">Month:</label>
            <input type="number" name="month" id="month" class="form-control" value="{{ request('month', date('m')) }}" min="1" max="12">
        </div>
        <div class="col-md-4">
            <label for="year" class="form-label">Year:</label>
            <input type="number" name="year" id="year" class="form-control" value="{{ request('year', date('Y')) }}" min="2000" max="{{ date('Y') }}">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Generate Report</button>
        </div>
    </form>

    @if ($events->count())
        <div class="table-responsive mt-4">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">Title</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Location</th>
                        <th class="text-center">Participants</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td class="text-center">{{ $event->title }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($event->event_date)->locale('id')->translatedFormat('d F Y') }}</td>
                            <td class="text-center">{{ $event->location }}</td>
                            <td class="text-center">{{ $event->registrations->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning mt-4" role="alert">
            No events found for the selected month and year.
        </div>
    @endif

    <div class="d-flex justify-content-center">
        {{ $events->links('vendor.pagination') }}
    </div>
</div>
@endsection
