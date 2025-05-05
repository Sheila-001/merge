<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Create New Event</h2>
                        <p class="text-gray-600 mt-1">Fill in the details below to create a new event.</p>
                    </div>

                    @if(session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('volunteer.events.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Event Title</label>
                            <input type="text" name="title" id="title" required 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#2C5F6E] focus:ring-[#2C5F6E]">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date & Time</label>
                                <input type="datetime-local" name="start_date" id="start_date" required 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#2C5F6E] focus:ring-[#2C5F6E]">
                                @error('start_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date & Time</label>
                                <input type="datetime-local" name="end_date" id="end_date" required 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#2C5F6E] focus:ring-[#2C5F6E]">
                                @error('end_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" name="location" id="location" required 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#2C5F6E] focus:ring-[#2C5F6E]">
                            @error('location')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="4" required 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#2C5F6E] focus:ring-[#2C5F6E]"></textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('volunteer.events') }}" 
                                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2C5F6E]">
                                Cancel
                            </a>
                            <button type="submit" 
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#2C5F6E] hover:bg-[#2C5F6E]/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2C5F6E]">
                                Create Event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 