@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg">
        <div class="flex items-center justify-center h-16 border-b">
            <img src="{{ asset('image/logohauzhayag.jpg') }}" alt="Hauz Hayag Logo" class="h-8 w-auto">
            <span class="ml-2 text-xl font-semibold text-gray-800">Volunteer Portal</span>
        </div>
        <nav class="mt-6">
            <a href="{{ route('volunteer.dashboard') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('volunteer.events') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Events
            </a>
            <a href="{{ route('volunteer.calendar') }}" class="flex items-center px-6 py-3 text-gray-700 bg-gray-100 border-r-4 border-primary">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Calendar
            </a>
            <a href="{{ route('volunteer.jobs') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Job Listings
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Volunteer Calendar</h1>
            <p class="text-gray-600">View and manage your volunteer schedule</p>
        </div>

        <!-- Calendar Navigation -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-4">
                    <button class="p-2 hover:bg-gray-100 rounded-full">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <h2 class="text-xl font-semibold text-gray-900">March 2024</h2>
                    <button class="p-2 hover:bg-gray-100 rounded-full">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex space-x-2">
                    <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Today</button>
                    <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">Week</button>
                    <button class="px-4 py-2 text-sm font-medium text-white bg-primary rounded-md hover:bg-opacity-90">Month</button>
                </div>
            </div>

            <!-- Calendar Grid -->
            <div class="grid grid-cols-7 gap-px bg-gray-200">
                <!-- Days of Week -->
                <div class="bg-white p-2 text-center text-sm font-medium text-gray-500">Sun</div>
                <div class="bg-white p-2 text-center text-sm font-medium text-gray-500">Mon</div>
                <div class="bg-white p-2 text-center text-sm font-medium text-gray-500">Tue</div>
                <div class="bg-white p-2 text-center text-sm font-medium text-gray-500">Wed</div>
                <div class="bg-white p-2 text-center text-sm font-medium text-gray-500">Thu</div>
                <div class="bg-white p-2 text-center text-sm font-medium text-gray-500">Fri</div>
                <div class="bg-white p-2 text-center text-sm font-medium text-gray-500">Sat</div>

                <!-- Calendar Days -->
                @for ($i = 1; $i <= 31; $i++)
                    <div class="bg-white p-2 min-h-[100px]">
                        <div class="text-sm text-gray-900">{{ $i }}</div>
                        @if ($i == 25)
                            <div class="mt-1 p-1 text-xs bg-blue-100 text-blue-800 rounded">Community Clean-up</div>
                        @endif
                        @if ($i == 28)
                            <div class="mt-1 p-1 text-xs bg-green-100 text-green-800 rounded">Food Bank</div>
                        @endif
                    </div>
                @endfor
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h2 class="text-lg font-semibold text-gray-900">Upcoming Events</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Community Clean-up Day</h3>
                            <p class="text-sm text-gray-600">March 25, 2024 • 9:00 AM - 12:00 PM</p>
                        </div>
                        <button class="px-4 py-2 bg-primary text-white rounded-md hover:bg-opacity-90">View Details</button>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Food Bank Volunteer Day</h3>
                            <p class="text-sm text-gray-600">March 28, 2024 • 10:00 AM - 2:00 PM</p>
                        </div>
                        <button class="px-4 py-2 bg-primary text-white rounded-md hover:bg-opacity-90">View Details</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection