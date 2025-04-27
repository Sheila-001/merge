<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
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