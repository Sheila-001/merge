<x-app-layout>
<div class="flex">
        <div class="w-64 min-h-screen bg-[#1B4B5A] text-white">
            <div class="p-4 flex items-center space-x-2">
                <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <h1 class="text-2xl font-bold">Hauz Hayag</h1>
            </div>
            <nav class="mt-8">
                <a href="/dashboard" class="flex items-center px-4 py-3 bg-[#2C5F6E] hover:bg-[#2C5F6E] transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                <a href="/users" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    User Management
                </a>
                <a href="/events" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Events
                </a>
                <a href="/students" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Students
                </a>
                <a href="/volunteers" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Volunteers
                </a>
                <div class="mt-auto pt-20">
                    <a href="/logout" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors text-red-300 hover:text-red-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 bg-gray-100">
            <!-- Header -->
            <div class="bg-white p-4 flex justify-between items-center shadow-sm">
                <div>
                    <h2 class="text-xl font-semibold">Event Details</h2>
                    <p class="text-sm text-gray-600 mt-1">Viewing event information</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('events.index') }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-200">
                        Back to Events
                    </a>
                    <a href="{{ route('events.edit', $event) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                        Edit Event
                    </a>
                </div>
            </div>

            <!-- Event Details -->
            <div class="p-6">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Event Information -->
                            <div>
                                <h3 class="text-lg font-semibold mb-4">Event Information</h3>
                                <div class="space-y-4">
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Event Title</h4>
                                        <p class="mt-1 text-lg">{{ $event->title }}</p>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Description</h4>
                                        <p class="mt-1">{{ $event->description }}</p>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Location</h4>
                                        <p class="mt-1">{{ $event->location }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Date and Time Information -->
                            <div>
                                <h3 class="text-lg font-semibold mb-4">Date and Time</h3>
                                <div class="space-y-4">
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Start Date & Time</h4>
                                        <p class="mt-1">{{ $event->start_date->format('F j, Y g:i A') }}</p>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">End Date & Time</h4>
                                        <p class="mt-1">{{ $event->end_date->format('F j, Y g:i A') }}</p>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Duration</h4>
                                        <p class="mt-1">{{ $event->start_date->diffForHumans($event->end_date, true) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Event -->
                        <div class="mt-8 pt-6 border-t">
                            <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-900 font-medium"
                                        onclick="return confirm('Are you sure you want to delete this event?')">
                                    Delete Event
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>