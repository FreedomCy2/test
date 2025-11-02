<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Management - Clinic Flow</title>
    <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- CSRF token for AJAX -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .sidebar-item:hover .sidebar-icon {
            transform: translateX(5px);
            transition: all 0.3s ease;
        }
        .active-route {
            background-color: #68D6EC;
            color: white;
        }
        .active-route .sidebar-icon {
            color: white;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background-color: white;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            padding: 24px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans flex">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg h-screen fixed">
        <div class="p-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-[#68D6EC] flex items-center">
                <i data-feather="activity" class="mr-2"></i>
                Clinic Flow
            </h1>
        </div>
        <nav class="mt-6">
            <div class="px-4">
                <h3 class="text-xs uppercase text-gray-500 font-semibold tracking-wider">Main</h3>
            </div>
            <div class="mt-3">
                <a href="/admin/dashboard" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item">
                    <i data-feather="home" class="sidebar-icon mr-3 text-blue-500"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="/admin/booking" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item active-route">
                    <i data-feather="calendar" class="sidebar-icon mr-3 text-green-500"></i>
                    <span class="font-medium">Booking</span>
                </a>
                <a href="/admin/doctors" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item">
                    <i data-feather="user" class="sidebar-icon mr-3 text-purple-500"></i>
                    <span class="font-medium">Doctors</span>
                </a>
                <a href="/admin/manage-users" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item">
                    <i data-feather="users" class="sidebar-icon mr-3 text-red-500"></i>
                    <span class="font-medium">Manage Users</span>
                </a>
                <a href="/admin/reminders" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item">
                    <i data-feather="bell" class="sidebar-icon mr-3 text-yellow-500"></i>
                    <span class="font-medium">Reminders</span>
                </a>
                <a href="/admin/schedule" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item">
                    <i data-feather="clock" class="sidebar-icon mr-3 text-indigo-500"></i>
                    <span class="font-medium">Schedule</span>
                </a>
                <a href="/admin/records" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item">
                    <i data-feather="file-text" class="sidebar-icon mr-3 text-teal-500"></i>
                    <span class="font-medium">Records</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 ml-64 p-8">
        <!-- Header -->
        <header class="bg-white rounded-lg shadow-sm p-4 mb-6 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Booking Management</h2>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <i data-feather="search" class="absolute left-3 top-2.5 text-gray-400"></i>
                    <input type="text" placeholder="Search bookings..." class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#68D6EC] focus:border-transparent">
                </div>
                <button id="addBookingBtn" class="bg-[#68D6EC] hover:bg-[#68D6EC]/90 text-white px-4 py-2 rounded-lg flex items-center">
                    <i data-feather="plus" class="mr-2"></i>
                    Add Booking
                </button>
                <div class="relative">
                    <i data-feather="bell" class="text-gray-500 cursor-pointer hover:text-[#68D6EC]"></i>
                    <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                </div>
                <div class="flex items-center">
                    <img src="http://static.photos/people/200x200/1" alt="Admin" class="w-8 h-8 rounded-full mr-2">
                    <span class="font-medium">Admin</span>
                </div>
            </div>
        </header>

        <!-- Stats Cards removed to use DB-driven bookings and tighten layout -->

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-sm p-4 mb-4">
            <div class="flex flex-wrap gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select class="rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#68D6EC] focus:border-transparent">
                        <option value="">All Status</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="pending">Pending</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
                    <input type="date" class="rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#68D6EC] focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Doctor</label>
                    <select class="rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#68D6EC] focus:border-transparent">
                        <option value="">All Doctors</option>
                        <option value="1">Dr. Sarah Johnson</option>
                        <option value="2">Dr. Michael Chen</option>
                        <option value="3">Dr. Emily Wong</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button class="bg-[#68D6EC] hover:bg-[#68D6EC]/90 text-white px-4 py-2 rounded-lg">
                        Apply Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Bookings Table -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">All Bookings</h3>
                <div class="flex items-center space-x-2">
                    <button class="text-gray-500 hover:text-gray-700">
                        <i data-feather="download"></i>
                    </button>
                    <button class="text-gray-500 hover:text-gray-700">
                        <i data-feather="printer"></i>
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($appointments ?? [] as $appointment)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="{{ optional($appointment->patient)->avatar_url ?? 'http://static.photos/people/200x200/2' }}" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ optional($appointment->patient)->name ?? 'Unknown' }}</div>
                                            <div class="text-sm text-gray-500">{{ optional($appointment->patient)->email ?? '—' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ optional($appointment->doctor)->name ?? ($appointment->doctor_id ? 'Doctor #' . $appointment->doctor_id : '—') }}</div>
                                    <div class="text-sm text-gray-500">{{ optional($appointment->doctor)->specialty ?? '' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $appointment->date ?? '—' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-900">{{ $appointment->time ?? '—' }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php $st = strtolower($appointment->status ?? 'pending'); @endphp
                                    @if($st === 'confirmed')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Confirmed</span>
                                    @elseif($st === 'pending')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                    @elseif($st === 'cancelled')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">{{ ucfirst($st) }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="text-[#68D6EC] hover:text-[#68D6EC]/80 mr-3 edit-booking" data-id="{{ $appointment->id }}">Edit</button>
                                    <button class="text-red-600 hover:text-red-900 delete-booking" data-id="{{ $appointment->id }}">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" colspan="6">No bookings found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="flex items-center justify-between mt-6">
                <div class="text-sm text-gray-700">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">97</span> results
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 rounded-lg border border-gray-300 text-sm hover:bg-gray-50">Previous</button>
                    <button class="px-3 py-1 rounded-lg bg-[#68D6EC] text-white text-sm">1</button>
                    <button class="px-3 py-1 rounded-lg border border-gray-300 text-sm hover:bg-gray-50">2</button>
                    <button class="px-3 py-1 rounded-lg border border-gray-300 text-sm hover:bg-gray-50">3</button>
                    <button class="px-3 py-1 rounded-lg border border-gray-300 text-sm hover:bg-gray-50">Next</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit Booking Modal -->
    <div id="bookingModal" class="modal">
        <div class="modal-content">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold" id="modalTitle">Add New Booking</h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form id="bookingForm">
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Patient</label>
                        <input id="patient_name" name="patient_name" type="text" placeholder="Patient name" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#68D6EC] focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Doctor</label>
                        <input id="doctor_name" name="doctor_name" type="text" placeholder="Doctor name" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#68D6EC] focus:border-transparent">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <input id="appointment_date" name="appointment_date" type="date" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#68D6EC] focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                            <input id="appointment_time" name="appointment_time" type="time" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#68D6EC] focus:border-transparent">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="status" name="status" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#68D6EC] focus:border-transparent">
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Notes (Optional)</label>
                        <textarea id="notes" name="notes" rows="3" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#68D6EC] focus:border-transparent"></textarea>
                    </div>
                </div>
                <div class="flex justify-end mt-6 space-x-3">
                    <button type="button" id="cancelBooking" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-[#68D6EC] text-white rounded-lg hover:bg-[#68D6EC]/90">Save Booking</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        feather.replace();
        
        // Highlight current route in sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname.split('/').pop() || 'dashboard';
            const sidebarItems = document.querySelectorAll('.sidebar-item');
            
            sidebarItems.forEach(item => {
                const href = item.getAttribute('href').split('/').pop();
                if (href === currentPath || (currentPath === '' && href === 'dashboard')) {
                    item.classList.add('active-route');
                } else {
                    item.classList.remove('active-route');
                }
            });

            // Modal functionality
            const modal = document.getElementById('bookingModal');
            const addBookingBtn = document.getElementById('addBookingBtn');
            const closeModal = document.getElementById('closeModal');
            const cancelBooking = document.getElementById('cancelBooking');
            const editButtons = document.querySelectorAll('.edit-booking');
            const deleteButtons = document.querySelectorAll('.delete-booking');

            // Open modal for adding new booking
            addBookingBtn.addEventListener('click', function() {
                document.getElementById('modalTitle').textContent = 'Add New Booking';
                modal.style.display = 'flex';
            });

            // Open modal for editing booking
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    document.getElementById('modalTitle').textContent = 'Edit Booking';
                    modal.style.display = 'flex';
                    // In a real app, you would populate the form with existing data here
                });
            });

            // Delete booking (AJAX) - assumes delete buttons include data-id attribute
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    if (! id) {
                        return alert('Missing booking id');
                    }

                    if (! confirm('Are you sure you want to delete this booking?')) return;

                    fetch(`/admin/bookings/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                        }
                    }).then(res => {
                        if (! res.ok) throw res;
                        return res.json();
                    }).then(json => {
                        alert(json.message || 'Deleted');
                        // Optionally remove the row from the table
                        this.closest('tr').remove();
                    }).catch(async err => {
                        let msg = 'Failed to delete';
                        try { const j = await err.json(); msg = j.message || msg; } catch(e){}
                        alert(msg);
                    });
                });
            });

            // Close modal
            function closeModalFunc() {
                modal.style.display = 'none';
            }

            closeModal.addEventListener('click', closeModalFunc);
            cancelBooking.addEventListener('click', closeModalFunc);

            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    closeModalFunc();
                }
            });

            // Form submission (AJAX create)
            document.getElementById('bookingForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const payload = {
                    patient_name: document.getElementById('patient_name').value,
                    doctor_name: document.getElementById('doctor_name').value,
                    appointment_date: document.getElementById('appointment_date').value,
                    appointment_time: document.getElementById('appointment_time').value,
                    status: document.getElementById('status').value,
                };

                fetch('/admin/bookings', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(payload),
                }).then(async res => {
                    if (res.status === 422) {
                        const j = await res.json();
                        let errors = j.errors || {}; 
                        let msgs = Object.values(errors).flat().join('\n');
                        return alert(msgs || j.message || 'Validation failed');
                    }

                    if (! res.ok) throw res;
                    return res.json();
                }).then(json => {
                    alert(json.message || 'Booking created');
                    closeModalFunc();
                    // Optionally prepend the new booking to the table or reload
                    location.reload();
                }).catch(async err => {
                    let msg = 'Failed to save booking';
                    try { const j = await err.json(); msg = j.message || msg; } catch(e){}
                    alert(msg);
                });
            });
        });
    </script>
</body>
</html>