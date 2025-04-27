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
            <div class="bg-white p-4 shadow-sm">
                <h2 class="text-xl font-semibold">Create New Event</h2>
            </div>

            <!-- Create Event Form -->
            <div class="p-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <form action="{{ route('events.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Event Title</label>
                            <input type="text" name="title" id="title" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date & Time</label>
                                <input type="datetime-local" name="start_date" id="start_date" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date & Time</label>
                                <input type="datetime-local" name="end_date" id="end_date" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" name="location" id="location" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="4" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('events.index') }}" 
                               class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                Cancel
                            </a>
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Create Event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 