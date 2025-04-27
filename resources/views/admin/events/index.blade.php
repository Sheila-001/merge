<x-app-layout>
    <div class="flex">
        <!-- Sidebar (same as dashboard) -->
        <div class="w-64 min-h-screen bg-[#1B4B5A] text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Hauz Hayag</h1>
            </div>
            <nav class="mt-8">
                <a href="/dashboard" class="block px-4 py-2 hover:bg-[#2C5F6E]">
                    Dashboard
                </a>
                <a href="/users" class="block px-4 py-2 hover:bg-[#2C5F6E]">
                    User Management
                </a>
                <a href="/events" class="block px-4 py-2 bg-[#2C5F6E] hover:bg-[#2C5F6E]">
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
                <h2 class="text-xl font-semibold">Event Management</h2>
                <button onclick="window.location.href='{{ route('events.create') }}'" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Create Event
                </button>
            </div>

            <!-- Calendar and Events Section -->
            <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Calendar View -->
                <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
                    <div id="calendar"></div>
                </div>

                <!-- Upcoming Events -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-4">Upcoming Events</h3>
                    <div class="space-y-4" id="upcoming-events">
                        <!-- Events will be populated via JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '{{ route("events.json") }}',
                eventClick: function(info) {
                    window.location.href = '/events/' + info.event.id;
                }
            });
            calendar.render();

            // Fetch and display upcoming events
            fetch('{{ route("events.upcoming") }}')
                .then(response => response.json())
                .then(events => {
                    const upcomingEventsDiv = document.getElementById('upcoming-events');
                    events.forEach(event => {
                        const eventEl = document.createElement('div');
                        eventEl.className = 'p-4 border rounded-lg hover:bg-gray-50 cursor-pointer';
                        eventEl.innerHTML = `
                            <h4 class="font-semibold">${event.title}</h4>
                            <p class="text-sm text-gray-600">${new Date(event.start_date).toLocaleDateString()}</p>
                            <p class="text-sm text-gray-500">${event.description}</p>
                        `;
                        eventEl.onclick = () => window.location.href = '/events/' + event.id;
                        upcomingEventsDiv.appendChild(eventEl);
                    });
                });
        });
    </script>
    @endpush
</x-app-layout>