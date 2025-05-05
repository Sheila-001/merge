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
            <a href="{{ route('volunteer.calendar') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Calendar
            </a>
            <a href="{{ route('volunteer.jobs') }}" class="flex items-center px-6 py-3 text-gray-700 bg-gray-100 border-r-4 border-primary">
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
            <h1 class="text-2xl font-bold text-gray-900">Job Listings</h1>
            <p class="text-gray-600">Find volunteer opportunities that match your skills and interests</p>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" placeholder="Search jobs..." class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div class="flex gap-4">
                    <select class="px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">All Categories</option>
                        <option value="event">Event Management</option>
                        <option value="education">Education</option>
                        <option value="health">Healthcare</option>
                        <option value="tech">Technology</option>
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

        <!-- Job Listings Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Job Card 1 -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-3 py-1 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full">Full-time</span>
                        <span class="text-sm text-gray-600">Posted 2 days ago</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Event Coordinator</h3>
                    <p class="text-gray-600 mb-4">Coordinate and manage community events, ensuring smooth execution and positive participant experience.</p>
                    <div class="flex items-center text-sm text-gray-600 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Remote
                    </div>
                    <div class="flex items-center text-sm text-gray-600 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        40 hours/week
                    </div>
                    <button class="w-full px-4 py-2 bg-primary text-white rounded-md hover:bg-opacity-90">Apply Now</button>
                </div>
            </div>

            <!-- Job Card 2 -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">Part-time</span>
                        <span class="text-sm text-gray-600">Posted 1 week ago</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Community Outreach Specialist</h3>
                    <p class="text-gray-600 mb-4">Develop and maintain relationships with community partners and coordinate outreach programs.</p>
                    <div class="flex items-center text-sm text-gray-600 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        On-site
                    </div>
                    <div class="flex items-center text-sm text-gray-600 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        20 hours/week
                    </div>
                    <button class="w-full px-4 py-2 bg-primary text-white rounded-md hover:bg-opacity-90">Apply Now</button>
                </div>
            </div>

            <!-- Job Card 3 -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-3 py-1 text-sm font-semibold text-purple-800 bg-purple-100 rounded-full">Contract</span>
                        <span class="text-sm text-gray-600">Posted 3 days ago</span>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Youth Program Coordinator</h3>
                    <p class="text-gray-600 mb-4">Develop and implement educational programs for youth in the community.</p>
                    <div class="flex items-center text-sm text-gray-600 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Hybrid
                    </div>
                    <div class="flex items-center text-sm text-gray-600 mb-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        30 hours/week
                    </div>
                    <button class="w-full px-4 py-2 bg-primary text-white rounded-md hover:bg-opacity-90">Apply Now</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection