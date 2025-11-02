<!DOCTYPE html>
<html>
<head>
    <title>Patient Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <h2>Book an Appointment</h2>
    <form action="{{ route('bookings.store') }}" method="POST" class="mt-3">
        @csrf

        <div class="mb-2">
            <label>Service</label>
            <input type="text" name="service" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Time</label>
            <input type="time" name="time" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Full Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Age</label>
            <input type="number" name="age" class="form-control" required>
        </div>

        <div class="mb-2">
            <label>Gender</label>
            <select name="gender" class="form-control" required>
                <option value="">--Select--</option>
                <option>Male</option>
                <option>Female</option>
            </select>
        </div>

        <div class="mb-2">
            <label>Symptom / Concern</label>
            <textarea name="symptom" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Booking</button>
    </form>
</body>
</html>
