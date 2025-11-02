<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments - Green Pulse Clinic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clinic: {
                            100: '#ECFDF5',
                            500: '#10B981',
                            600: '#059669'
                        }
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        .sidebar {
            transition: all 0.3s ease;
        }
        .active-tab {
            background-color: #ECFDF5;
            border-left: 4px solid #10B981;
            color: #059669;
        }
        .calendar-day {
            transition: all 0.2s ease;
        }
        .calendar-day:hover {
            background-color: #ECFDF5;
        }
        .calendar-day.selected {
            background-color: #10B981;
            color: white;
        }
        .appointment-card {
            transition: all 0.2s ease;
        }
        .appointment-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar bg-white w-64 shadow-md flex flex-col">
            <div class="p-6">
                <div class="flex items-center space-x-2">
                    <i data-feather="heart" class="text-clinic-500 w-6 h-6"></i>
                    <h1 class="text-xl font-bold text-gray-800">Green Pulse Clinic</h1>
                </div>
                <p class="mt-1 text-sm text-gray-500">Doctor Dashboard</p>
            </div>
            
            <nav class="flex-1 px-4 py-6">
                <ul class="space-y-2">
                    <li>
                        <a href="/doctor/dashboard" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i data-feather="home" class="w-5 h-5 mr-3"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/doctor/appointments" class="flex items-center px-4 py-3 text-gray-700 rounded-lg active-tab">
                            <i data-feather="calendar" class="w-5 h-5 mr-3"></i>
                            <span>My Appointments</span>
                        </a>
                    </li>
                    <li>
                        <a href="/doctor/availability" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i data-feather="clock" class="w-5 h-5 mr-3"></i>
                            <span>Availability</span>
                        </a>
                    </li>
                    <li>
                        <a href="/doctor/notifications" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i data-feather="bell" class="w-5 h-5 mr-3"></i>
                            <span>Notifications</span>
                            <span class="ml-auto bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                        </a>
                    </li>
                    <li>
                        <a href="/doctor/profile" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i data-feather="user" class="w-5 h-5 mr-3"></i>
                            <span>Profile Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-clinic-500 rounded-full flex items-center justify-center text-white font-medium">DR</div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">Dr. Sarah Johnson</p>
                        <p class="text-xs text-gray-500">Cardiologist</p>
                    </div>
                </div>
                <button class="w-full mt-4 flex items-center justify-center space-x-2 text-gray-600 hover:text-gray-800 py-2 rounded-lg hover:bg-gray-100">
                    <i data-feather="log-out" class="w-4 h-4"></i>
                    <span>Logout</span>
                </button>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Header -->
            <header class="bg-white shadow-sm py-4 px-6 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">My Appointments</h2>
                    <p class="text-sm text-gray-500">Manage your patient appointments</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <a href="notifications.html" class="p-2 rounded-full hover:bg-gray-100">
                            <i data-feather="bell" class="w-5 h-5 text-gray-600"></i>
                        </a>
                        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full w-2 h-2"></span>
                    </div>
                    <div class="w-8 h-8 bg-clinic-500 rounded-full flex items-center justify-center text-white font-medium">SJ</div>
                </div>
            </header>
            
            <!-- Appointments Content -->
            <main class="p-6">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">My Appointments</h3>
                        <div class="flex space-x-2">
                            <button class="px-4 py-2 bg-clinic-500 text-white rounded-lg text-sm font-medium">Day</button>
                            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium">Week</button>
                            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium">Month</button>
                        </div>
                    </div>
                    
                    <!-- Calendar -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <button class="p-2 rounded-lg hover:bg-gray-100">
                                <i data-feather="chevron-left" class="w-5 h-5 text-gray-600"></i>
                            </button>
                            <h4 class="text-lg font-medium text-gray-800">October 2023</h4>
                            <button class="p-2 rounded-lg hover:bg-gray-100">
                                <i data-feather="chevron-right" class="w-5 h-5 text-gray-600"></i>
                            </button>
                        </div>
                        
                        <div class="grid grid-cols-7 gap-2 text-center">
                            <div class="text-sm font-medium text-gray-500 py-2">Sun</div>
                            <div class="text-sm font-medium text-gray-500 py-2">Mon</div>
                            <div class="text-sm font-medium text-gray-500 py-2">Tue</div>
                            <div class="text-sm font-medium text-gray-500 py-2">Wed</div>
                            <div class="text-sm font-medium text-gray-500 py-2">Thu</div>
                            <div class="text-sm font-medium text-gray-500 py-2">Fri</div>
                            <div class="text-sm font-medium text-gray-500 py-2">Sat</div>
                            
                            <!-- Calendar days would go here -->
                            <div class="calendar-day py-2 rounded-lg">1</div>
                            <div class="calendar-day py-2 rounded-lg">2</div>
                            <div class="calendar-day py-2 rounded-lg">3</div>
                            <div class="calendar-day py-2 rounded-lg">4</div>
                            <div class="calendar-day py-2 rounded-lg">5</div>
                            <div class="calendar-day py-2 rounded-lg">6</div>
                            <div class="calendar-day py-2 rounded-lg">7</div>
                            
                            <div class="calendar-day py-2 rounded-lg">8</div>
                            <div class="calendar-day py-2 rounded-lg">9</div>
                            <div class="calendar-day py-2 rounded-lg">10</div>
                            <div class="calendar-day py-2 rounded-lg">11</div>
                            <div class="calendar-day py-2 rounded-lg">12</div>
                            <div class="calendar-day py-2 rounded-lg">13</div>
                            <div class="calendar-day py-2 rounded-lg">14</div>
                            
                            <div class="calendar-day py-2 rounded-lg">15</div>
                            <div class="calendar-day py-2 rounded-lg">16</div>
                            <div class="calendar-day selected py-2 rounded-lg text-white">17</div>
                            <div class="calendar-day py-2 rounded-lg">18</div>
                            <div class="calendar-day py-2 rounded-lg">19</div>
                            <div class="calendar-day py-2 rounded-lg">20</div>
                            <div class="calendar-day py-2 rounded-lg">21</div>
                            
                            <div class="calendar-day py-2 rounded-lg">22</div>
                            <div class="calendar-day py-2 rounded-lg">23</div>
                            <div class="calendar-day py-2 rounded-lg">24</div>
                            <div class="calendar-day py-2 rounded-lg">25</div>
                            <div class="calendar-day py-2 rounded-lg">26</div>
                            <div class="calendar-day py-2 rounded-lg">27</div>
                            <div class="calendar-day py-2 rounded-lg">28</div>
                            
                            <div class="calendar-day py-2 rounded-lg">29</div>
                            <div class="calendar-day py-2 rounded-lg">30</div>
                            <div class="calendar-day py-2 rounded-lg">31</div>
                            <div class="calendar-day py-2 rounded-lg"></div>
                            <div class="calendar-day py-2 rounded-lg"></div>
                            <div class="calendar-day py-2 rounded-lg"></div>
                            <div class="calendar-day py-2 rounded-lg"></div>
                        </div>
                    </div>
                    
                    <!-- Appointment List -->
                    <div>
                        <h4 class="text-lg font-medium text-gray-800 mb-4">Today's Appointments</h4>
                        
                        <div class="space-y-4">
                          @if(session('status'))
                            <div class="p-3 bg-green-50 text-clinic-500 rounded">{{ session('status') }}</div>
                          @endif
      
                          @forelse($bookings as $booking)
                            <div class="appointment-card bg-white border border-gray-200 rounded-lg p-4">
                              <div class="flex justify-between items-start">
                                <div class="flex items-center space-x-4">
                                  <div class="w-12 h-12 bg-clinic-100 rounded-full flex items-center justify-center">
                                    <i data-feather="user" class="w-5 h-5 text-clinic-500"></i>
                                  </div>
                                  <div>
                                    <p class="font-medium text-gray-800">{{ $booking->patient_name }}</p>
                                    <p class="text-sm text-gray-500">{{ $booking->doctor_name }} — {{ $booking->status ?? 'pending' }}</p>
                                    <div class="flex items-center mt-1 space-x-2">
                                      <i data-feather="calendar" class="w-4 h-4 text-gray-500"></i>
                                      <p class="text-sm text-gray-500">
                                        {{ optional($booking->appointment_date)->format('M d, Y') }}
                                        @if($booking->appointment_time)
                                          at {{ optional($booking->appointment_time)->format('h:i A') }}
                                        @endif
                                      </p>
                                    </div>
                                  </div>
                                </div>
      
                                <div class="text-right">
                                  <p class="font-medium text-gray-800">
                                    {{ optional($booking->appointment_time)->format('h:i A') ?: optional($booking->appointment_date)->format('h:i A') }}
                                  </p>
                                  <p class="text-sm text-gray-500">Duration: 30 minutes</p>
      
                                  <div class="flex space-x-2 mt-2">
                                    @if($booking->status !== 'accepted')
                                      <form method="POST" action="{{ route('doctor.appointments.updateStatus', $booking) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="accepted">
                                        <button type="submit" class="px-3 py-1 bg-clinic-500 text-white rounded-lg text-sm">Accept</button>
                                      </form>
                                    @endif
      
                                    @if($booking->status !== 'declined')
                                      <form method="POST" action="{{ route('doctor.appointments.updateStatus', $booking) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="declined">
                                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-lg text-sm">Decline</button>
                                      </form>
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>
                          @empty
                            <p class="text-sm text-gray-500">No bookings found.</p>
                          @endforelse
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        feather.replace();
        
        // Calendar day selection
        const calendarDays = document.querySelectorAll('.calendar-day');
        calendarDays.forEach(day => {
            day.addEventListener('click', function() {
                calendarDays.forEach(d => d.classList.remove('selected'));
                this.classList.add('selected');
            });
        });
    </script>
</body>
</html>