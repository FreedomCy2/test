<!DOCTYPE html>
<html>
<head>
    <title>Admin Edit Bookings</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <h2>Manage Bookings</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Service</th>
                <th>Date</th>
                <th>Time</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Symptom</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr data-booking-id="{{ $booking->id }}">
                <form action="{{ route('admin.update', $booking->id) }}" method="POST" class="update-form">
                    @csrf
                    @method('PUT')
                    <td><input type="text" name="service" value="{{ $booking->service }}" class="form-control editable-input" disabled></td>
                    <td><input type="date" name="date" value="{{ $booking->date }}" class="form-control editable-input" disabled></td>
                    <td><input type="time" name="time" value="{{ $booking->time }}" class="form-control editable-input" disabled></td>
                    <td><input type="text" name="name" value="{{ $booking->name }}" class="form-control editable-input" disabled></td>
                    <td><input type="email" name="email" value="{{ $booking->email }}" class="form-control editable-input" disabled></td>
                    <td><input type="text" name="phone" value="{{ $booking->phone }}" class="form-control editable-input" disabled></td>
                    <td><input type="number" name="age" value="{{ $booking->age }}" class="form-control editable-input" disabled></td>
                    <td><input type="text" name="gender" value="{{ $booking->gender }}" class="form-control editable-input" disabled></td>
                    <td><input type="text" name="symptom" value="{{ $booking->symptom }}" class="form-control editable-input" disabled></td>
                    <td>
                        <button type="button" class="btn btn-secondary btn-sm edit-toggle mb-1">Edit</button>
                        <button type="submit" class="btn btn-primary btn-sm mb-1 update-btn d-none">Update</button>
                </form>
                        <form action="{{ route('admin.delete', $booking->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.edit-toggle').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var tr = btn.closest('tr');
                    var inputs = tr.querySelectorAll('.editable-input');
                    var updateBtn = tr.querySelector('.update-btn');

                    var isEditing = btn.classList.contains('editing');

                    if (! isEditing) {
                        // enter edit mode: store original values and enable inputs
                        inputs.forEach(function(input) {
                            if (! input.hasAttribute('data-original')) {
                                input.setAttribute('data-original', input.value);
                            }
                            input.removeAttribute('disabled');
                        });
                        updateBtn.classList.remove('d-none');
                        btn.classList.add('editing');
                        btn.textContent = 'Cancel';
                    } else {
                        // cancel edit: restore original values and disable inputs
                        inputs.forEach(function(input) {
                            if (input.hasAttribute('data-original')) {
                                input.value = input.getAttribute('data-original');
                                input.removeAttribute('data-original');
                            }
                            input.setAttribute('disabled', 'disabled');
                        });
                        updateBtn.classList.add('d-none');
                        btn.classList.remove('editing');
                        btn.textContent = 'Edit';
                    }
                });
            });
        });
    </script>
    </html>
</body>
</html>
