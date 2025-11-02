<!DOCTYPE html>
<html>
<head>
    <title>Doctor Appointments</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <h2>Appointments</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Service</th>
                <th>Date</th>
                <th>Time</th>
                <th>Patient</th>
                <th>Contact</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Symptom</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->service }}</td>
                <td>{{ $booking->date }}</td>
                <td>{{ $booking->time }}</td>
                <td>{{ $booking->name }}</td>
                <td>{{ $booking->email }}<br>{{ $booking->phone }}</td>
                <td>{{ $booking->age }}</td>
                <td>{{ $booking->gender }}</td>
                <td>{{ $booking->symptom }}</td>
                @php $st = strtolower($booking->status ?? ''); @endphp
                <td>
                    @if($st === 'accepted')
                        <span class="badge bg-success">Accepted</span>
                    @elseif($st === 'declined')
                        <span class="badge bg-danger">Declined</span>
                    @else
                        <form action="{{ route('bookings.accept', $booking->id) }}" method="POST" class="d-inline me-1">
                            @csrf
                            <button class="btn btn-success btn-sm">Accept</button>
                        </form>
                        <form action="{{ route('bookings.decline', $booking->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm">Decline</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
