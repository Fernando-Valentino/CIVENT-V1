<!DOCTYPE html>
<html>

<head>
    <title>Event Report - {{ $month }}/{{ $year }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .no-data {
            text-align: center;
            font-weight: bold;
            color: #ff0000;
            margin: 20px 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>CiVent Report - {{ \Carbon\Carbon::createFromFormat('m', $month)->locale('id')->translatedFormat('F') }} {{ $year }}</h1>

        @if ($noEvents)
            <p class="no-data">No events found for the selected month and year.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Participants</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $event->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</td>
                            <td>{{ $event->location }}</td>
                            <td>{{ $event->registrations->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="footer">
        CiVent Report - {{ \Carbon\Carbon::now()->format('d M Y H:i:s') }}
    </div>
</body>

</html>
