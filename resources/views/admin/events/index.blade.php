<x-app-layout>
<div class="flex min-h-screen bg-gray-50">
    <!-- Sidebar -->
    <div class="w-64 min-h-screen bg-[#1B4B5A] text-white flex flex-col">
        <div class="p-4 flex items-center space-x-2">
            <img src="{{ asset('image/logohauzhayag.jpg') }}" alt="Hauz Hayag Logo" class="h-14 w-auto rounded-lg shadow-md">
            <h1 class="text-2xl font-bold">Hauz Hayag</h1>
        </div>
        <nav class="mt-8 flex-1">
            <a href="/dashboard" class="flex items-center px-4 py-3 bg-[#2C5F6E] hover:bg-[#25697e] rounded transition-colors mb-2">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>
            <a href="/users" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] rounded transition-colors mb-2">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                User Management
            </a>
            <a href="/events" class="flex items-center px-4 py-3 bg-[#2C5F6E] hover:bg-[#25697e] rounded transition-colors mb-2">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Events
            </a>
            <a href="/students" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] rounded transition-colors mb-2">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Students
            </a>
            <a href="{{ route('admin.volunteers.index') }}" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Volunteers
                    </a>
            <a href="/jobs" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] rounded transition-colors mb-2">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Jobs
            </a>
        </nav>
        <div class="mt-auto pt-20 pb-6 px-4">
            <a href="/logout" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] rounded transition-colors text-red-300 hover:text-red-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </a>
        </div>
    </div>
    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <div class="bg-white p-6 flex flex-col md:flex-row md:justify-between md:items-center shadow-sm border-b mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Event Management</h2>
            <button onclick="window.location.href='{{ route('events.create') }}'" class="mt-4 md:mt-0 bg-[#1B4B5A] text-white px-6 py-2 rounded-md font-semibold hover:bg-[#25697e] transition">Create Event</button>
        </div>
        <!-- Calendar and Events Section -->
        <div class="flex-1 p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Calendar View -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
                <div id="calendar"></div>
            </div>
            <!-- Upcoming Events -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">Upcoming Events</h3>
                <div class="space-y-4" id="upcoming-events"></div>
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