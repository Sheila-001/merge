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
            <a href="{{ route('volunteer.events') }}" class="flex items-center px-6 py-3 text-gray-700 bg-gray-100 border-r-4 border-primary">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Events
            </a>
            <a href="{{ route('volunteer.calendar') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
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
            <h1 class="text-2xl font-bold text-gray-900">Volunteer Events</h1>
            <p class="text-gray-600">Find and join upcoming volunteer opportunities</p>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" placeholder="Search events..." class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div class="flex gap-4">
                    <select class="px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">All Categories</option>
                        <option value="community">Community Service</option>
                        <option value="education">Education</option>
                        <option value="health">Health & Wellness</option>
                        <option value="environment">Environment</option>
                    </select>
                    <select class="px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">All Locations</option>
                        <option value="onsite">On-site</option>
                        <option value="remote">Remote</option>
                        <option value="hybrid">Hybrid</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Events Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Event Card 1 -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">Upcoming</span>
                        <span class="text-sm text-gray-600">March 25, 2024</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Community Clean-up Day</h3>
                    <p class="text-gray-600 mb-4">Join us for a day of cleaning and beautifying our local community spaces.</p>
                    <div class="flex items-center text-sm text-gray-600 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Central Park, New York
                    </div>
                    <div class="flex items-center text-sm text-gray-600 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        9:00 AM - 12:00 PM
                    </div>
                    <button class="w-full px-4 py-2 bg-primary text-white rounded-md hover:bg-opacity-90">Register Now</button>
                </div>
            </div>

            <!-- Event Card 2 -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">Upcoming</span>
                        <span class="text-sm text-gray-600">March 28, 2024</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Food Bank Volunteer Day</h3>
                    <p class="text-gray-600 mb-4">Help sort and distribute food to those in need at our local food bank.</p>
                    <div class="flex items-center text-sm text-gray-600 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Community Food Bank
                    </div>
                    <div class="flex items-center text-sm text-gray-600 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        10:00 AM - 2:00 PM
                    </div>
                    <button class="w-full px-4 py-2 bg-primary text-white rounded-md hover:bg-opacity-90">Register Now</button>
                </div>
            </div>

            <!-- Event Card 3 -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">Upcoming</span>
                        <span class="text-sm text-gray-600">April 2, 2024</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Youth Mentoring Program</h3>
                    <p class="text-gray-600 mb-4">Share your knowledge and experience with young students in our mentoring program.</p>
                    <div class="flex items-center text-sm text-gray-600 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Local Community Center
                    </div>
                    <div class="flex items-center text-sm text-gray-600 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        3:00 PM - 5:00 PM
                    </div>
                    <button class="w-full px-4 py-2 bg-primary text-white rounded-md hover:bg-opacity-90">Register Now</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 