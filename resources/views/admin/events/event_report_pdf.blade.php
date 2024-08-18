<!DOCTYPE html>
<html>
<head>
    <title>Event Report - {{ $event->title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #0056b3;
        }
        h2 {
            font-size: 20px;
            margin-top: 20px;
            border-bottom: 2px solid #0056b3;
            padding-bottom: 5px;
            color: #0056b3;
        }
        p {
            font-size: 14px;
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
            color: #333;
            font-weight: bold;
        }
        .no-participants {
            text-align: center;
            font-weight: bold;
            color: #d9534f;
            padding: 20px;
        }
    </style>
</head>
<body>
    <h1>Event Report - {{ $event->title }}</h1>
    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->locale('id')->translatedFormat('d F Y') }}</p>
    <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->event_end_time)->format('H:i') }} WIB</p>
    <p><strong>Location:</strong> {{ $event->location }}</p>
    
    <h2>Participants</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Registration ID</th>
                <th>Name</th>
                <th>NIM</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @if($event->registrations->count() > 0)
                @foreach($event->registrations as $index => $registration)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $registration->registration_id }}</td>
                        <td>{{ $registration->name }}</td>
                        <td>{{ $registration->nim }}</td>
                        <td>{{ $registration->email }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="no-participants">No participants available for this event.</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>
</html>
