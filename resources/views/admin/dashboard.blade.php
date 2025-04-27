<x-app-layout>
    <!-- Sidebar -->
    <div class="flex">
        <div class="w-64 min-h-screen bg-[#1B4B5A] text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Hauz Hayag</h1>
            </div>
            <nav class="mt-8">
                <a href="/dashboard" class="block px-4 py-2 bg-[#2C5F6E] hover:bg-[#2C5F6E]">
                    Dashboard
                </a>
                <a href="/users" class="block px-4 py-2 hover:bg-[#2C5F6E]">
                    User Management
                </a>
                <a href="/events" class="block px-4 py-2 hover:bg-[#2C5F6E]">
                    Events
                </a>
                <a href="/students" class="block px-4 py-2 hover:bg-[#2C5F6E]">
                    Students
                </a>
                <a href="/volunteers" class="block px-4 py-2 hover:bg-[#2C5F6E]">
                    Volunteers
                </a>
                <div class="mt-auto pt-20">
                    <a href="/logout" class="block px-4 py-2 hover:bg-[#2C5F6E]">
                        Logout
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 bg-gray-100">
            <!-- Header -->
            <div class="bg-white p-4 flex justify-between items-center shadow-sm">
                <h2 class="text-xl">Dashboard Overview</h2>
                <div class="flex items-center space-x-2">
                    <span>Admin</span>
                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-sm">AD</span>
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Total Users -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600">Total Users</p>
                                <h3 class="text-2xl font-bold mt-1">{{ $totalUsers }}</h3>
                            </div>
                            <span class="bg-blue-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <!-- Total Volunteers -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600">Total Volunteers</p>
                                <h3 class="text-2xl font-bold mt-1">{{ $totalVolunteers }}</h3>
                            </div>
                            <span class="bg-green-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <!-- Total Events -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600">Total Events</p>
                                <h3 class="text-2xl font-bold mt-1">{{ $totalEvents }}</h3>
                            </div>
                            <span class="bg-purple-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Events Section -->
                <div class="mt-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-700">Upcoming Events</h3>
                            <a href="{{ route('events.create') }}" class="text-sm text-indigo-600 hover:text-indigo-800">+ Add Event</a>
                        </div>
                        <div class="space-y-4" id="dashboard-upcoming-events">
                            <!-- Events will be populated via JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Fetch and display upcoming events
        fetch('{{ route("events.upcoming") }}')
            .then(response => response.json())
            .then(events => {
                const upcomingEventsDiv = document.getElementById('dashboard-upcoming-events');
                if (events.length === 0) {
                    upcomingEventsDiv.innerHTML = '<p class="text-gray-500 text-center py-4">No upcoming events</p>';
                    return;
                }
                events.forEach(event => {
                    const eventEl = document.createElement('div');
                    eventEl.className = 'flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50';
                    
                    const startDate = new Date(event.start_date);
                    const formattedDate = startDate.toLocaleDateString('en-US', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    eventEl.innerHTML = `
                        <div class="flex-1">
                            <h4 class="font-semibold text-lg">${event.title}</h4>
                            <p class="text-sm text-gray-600">${formattedDate}</p>
                            <p class="text-sm text-gray-500 mt-1">${event.location}</p>
                        </div>
                        <a href="/events/${event.id}" class="text-indigo-600 hover:text-indigo-800 text-sm">
                            View Details →
                        </a>
                    `;
                    upcomingEventsDiv.appendChild(eventEl);
                });
            })
            .catch(error => {
                console.error('Error fetching events:', error);
                const upcomingEventsDiv = document.getElementById('dashboard-upcoming-events');
                upcomingEventsDiv.innerHTML = '<p class="text-red-500 text-center py-4">Error loading events</p>';
            });
    </script>
    @endpush
</x-app-layout>