@extends('layouts.admin')

@section('title', 'Attendees for ' . $event->title)

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Attendees for {{ $event->title }}</h3>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary btn-md">
                <i class="bi bi-arrow-left"></i> Back to Events
            </a>
        </div>

        <div class="row">
            <div class="col-md-6">
                <form method="GET" action="{{ route('admin.events.attendees', $event->id) }}" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                            placeholder="Search by NIM, Registration ID, or Name" value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>


        @if ($attendees->count())
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Registration ID</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">NIM</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Registration Date</th>
                            <th class="text-center">Actions</th> <!-- New column for actions -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendees as $index => $registration)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $registration->registration_id }}</td>
                                <td class="text-center">{{ $registration->user->name }}</td>
                                <td class="text-center">{{ $registration->user->nim }}</td>
                                <td class="text-center">{{ $registration->user->email }}</td>
                                <td class="text-center">{{ $registration->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <button class="btn btn-danger btn-sm delete-attendee"
                                        data-id="{{ $registration->id }}">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        @else
            <div class="alert alert-warning mt-4 text-center p-3" role="alert">
                No attendees found.
            </div>
        @endif
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-attendee').forEach(button => {
            button.addEventListener('click', function() {
                const registrationId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/admin/events/attendees/${registrationId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                }
                            }).then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        'The attendee has been deleted.',
                                        'success'
                                    ).then(() => location.reload());
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'There was an issue deleting the attendee.',
                                        'error'
                                    );
                                }
                            });
                    }
                });
            });
        });
    </script>

@endsection
