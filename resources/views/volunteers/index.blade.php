<x-app-layout>
<!-- Add Tailwind CSS to ensure all styles work properly -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#00A4B8',
                }
            }
        }
    }
</script>

<!-- Add CSRF Token Meta Tag -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- navigation -->
<div class="flex">
        <div class="w-64 min-h-screen bg-[#1B4B5A] text-white">
            <div class="p-4 flex items-center space-x-2">
            <img src="{{ asset('image/logohauzhayag.jpg') }}" alt="Hauz Hayag Logo" class="h-16 w-auto rounded-lg shadow-md">
                <h1 class="text-2xl font-bold">Hauz Hayag</h1>
            </div>
            <nav class="mt-8">
                <a href="/dashboard" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">
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
                <a href="/volunteers" class="flex items-center px-4 py-3 bg-[#2C5F6E] hover:bg-[#2C5F6E] transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Volunteers
                </a>
                <a href="/jobs" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Jobs
                </a>
                <!-- Removed dropdown links -->
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


        <!-- Enhanced Main Content -->
        <div class="flex-1 p-6 bg-gray-50">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Volunteer Management</h1>
                <p class="text-gray-600">Manage volunteer applications, assignments, and information</p>
            </div>
            
            <!-- Stats Overview Section -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <!-- Active Volunteers -->
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-blue-500">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Active Volunteers</p>
                            <p class="text-xl font-bold text-gray-800 mt-1">
                                @if(isset($volunteers))
                                    {{ $volunteers->where('status', 'Active')->count() }}
                                @else
                                    24
                                @endif
                            </p>
                        </div>
                        <div class="rounded-full bg-blue-100 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Pending Applications -->
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-yellow-500">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pending Applications</p>
                            <p class="text-xl font-bold text-gray-800 mt-1">
                                @if(isset($volunteers))
                                    {{ $volunteers->where('status', 'Pending')->count() }}
                                @else
                                    7
                                @endif
                            </p>
                        </div>
                        <div class="rounded-full bg-yellow-100 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Hours Served -->
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-green-500">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Hours Served (Month)</p>
                            <p class="text-xl font-bold text-gray-800 mt-1">
                                @if(isset($totalHours))
                                    {{ $totalHours }}
                                @else
                                    432
                                @endif
                            </p>
                        </div>
                        <div class="rounded-full bg-green-100 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Events -->
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-purple-500">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Upcoming Events</p>
                            <p class="text-xl font-bold text-gray-800 mt-1">
                                @if(isset($upcomingEvents))
                                    {{ $upcomingEvents }}
                                @else
                                    5
                                @endif
                            </p>
                        </div>
                        <div class="rounded-full bg-purple-100 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-3 mb-6">
                <button id="add-volunteer-btn" type="button" class="inline-flex items-center px-3 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#2C5F6E] hover:bg-[#2C5F6E]/80">
                    <svg class="-ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add New Volunteer
                </button>
                
                <!-- <button id="export-data-btn" type="button" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <svg class="-ml-1 mr-2 h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    Export Data
                </button>
                
                <button id="view-reports-btn" type="button" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <svg class="-ml-1 mr-2 h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                    View Reports
                </button> -->
            </div>

            <!-- Tabs -->
            <div class="border-b border-gray-200 mb-6">
                <nav class="-mb-px flex space-x-8">
                    <a href="#" data-tab="all-volunteers-tab" class="volunteer-tab border-[#2C5F6E] text-[#2C5F6E] whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm">
                        All Volunteers
                    </a>
                    <a href="#" data-tab="pending-tab" class="volunteer-tab border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm">
                        Pending Applications
                    </a>
                    <a href="#" data-tab="assignments-tab" class="volunteer-tab border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm">
                        Event Assignments
                    </a>
                    <a href="#" data-tab="jobs-tab" class="volunteer-tab border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm">
                        Job Opportunities
                    </a>
                </nav>
            </div>

            <!-- Enhanced Search and Filter Bar -->
            <div class="flex flex-wrap gap-3 mb-4">
                <div class="relative flex-grow max-w-md">
                    <input 
                        type="text" 
                        id="search" 
                        placeholder="Search volunteers..." 
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#2C5F6E] focus:border-[#2C5F6E]"
                    >
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                
                <!-- Status Filter -->
                <div class="relative">
                    <select id="status-filter" class="appearance-none pl-3 pr-10 py-2 border border-gray-300 bg-white rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2C5F6E] focus:border-[#2C5F6E] text-sm">
                        <option>All Statuses</option>
                        <option>Active</option>
                        <option>Pending</option>
                        <option>Inactive</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>
                
                <!-- Skills Filter -->
                <div class="relative">
                    <select id="skills-filter" class="appearance-none pl-3 pr-10 py-2 border border-gray-300 bg-white rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2C5F6E] focus:border-[#2C5F6E] text-sm">
                        <option>All Skills</option>
                        <option>Teaching</option>
                        <option>Event Planning</option>
                        <option>Administration</option>
                        <option>Fundraising</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Tab Content Sections -->
            <div id="all-volunteers-tab" class="tab-content">
                <!-- Enhanced Volunteer List -->
                <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Skills</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
                        <tbody id="volunteer-list" class="bg-white divide-y divide-gray-200">
                            @if(isset($volunteers) && count($volunteers) > 0)
                                @foreach($volunteers as $volunteer)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                                                    {{ implode('', array_map(function($part) { return substr($part, 0, 1); }, explode(' ', $volunteer->name))) }}
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $volunteer->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $volunteer->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $volunteer->phone }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex flex-wrap gap-1">
                                                @php
                                                    $skills = is_string($volunteer->skills) ? json_decode($volunteer->skills, true) : $volunteer->skills;
                                                    if (!is_array($skills)) $skills = [];
                                                @endphp
                                                @foreach($skills as $skill)
                                                    <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">{{ $skill }}</span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $volunteer->status === 'Active' ? 'bg-green-100 text-green-800' : ($volunteer->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                                {{ $volunteer->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button type="button" data-volunteer-id="{{ $volunteer->id }}" class="view-volunteer-btn inline-flex items-center px-3 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#2C5F6E] hover:bg-[#2C5F6E]/80">
                                                <svg class="-ml-1 mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                </svg>
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <!-- Example row 1 - Only shown when no volunteers exist in the database -->
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                                                JD
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">John Doe</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">john@example.com</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">123-456-7890</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-wrap gap-1">
                                            <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">Teaching</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button type="button" data-volunteer-id="1" class="view-volunteer-btn inline-flex items-center px-3 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#2C5F6E] hover:bg-[#2C5F6E]/80">
                                            <svg class="-ml-1 mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                            </svg>
                                            View
                                        </button>
                </td>
            </tr>
                            @endif
        </tbody>
    </table>

                    <!-- Pagination -->
                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    @if(isset($volunteers) && $volunteers->count() > 0)
                                        Showing <span class="font-medium">1</span> to <span class="font-medium">{{ min($volunteers->count(), 10) }}</span> of <span class="font-medium">{{ $volunteers->count() }}</span> volunteers
                                    @else
                                        Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">24</span> volunteers
                                    @endif
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Previous</span>
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="#" data-page="1" class="pagination-link relative inline-flex items-center px-4 py-2 border border-gray-300 bg-[#2C5F6E]/10 text-sm font-medium text-[#2C5F6E]">1</a>
                                    @if(isset($volunteers) && $volunteers->count() > 10)
                                        <a href="#" data-page="2" class="pagination-link relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">2</a>
                                        @if($volunteers->count() > 20)
                                            <a href="#" data-page="3" class="pagination-link relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">3</a>
                                            @if($volunteers->count() > 30)
                                                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>
                                                <a href="#" data-page="{{ ceil($volunteers->count() / 10) }}" class="pagination-link relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">{{ ceil($volunteers->count() / 10) }}</a>
                                            @endif
                                        @endif
                                    @else
                                        <a href="#" data-page="2" class="pagination-link relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">2</a>
                                        <a href="#" data-page="3" class="pagination-link relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">3</a>
                                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>
                                        <a href="#" data-page="8" class="pagination-link relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">8</a>
                                    @endif
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Next</span>
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pending Applications Tab Content -->
            <div id="pending-tab" class="tab-content hidden">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Pending Volunteer Applications</h3>
                    <div class="space-y-4">
                        @if(isset($volunteers))
                            @php
                                $pendingVolunteers = $volunteers->where('status', 'Pending');
                            @endphp
                            
                            @if($pendingVolunteers->count() > 0)
                                @foreach($pendingVolunteers as $volunteer)
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex items-start justify-between">
                                            <div>
                                                <h4 class="text-md font-medium text-gray-900">{{ $volunteer->name }}</h4>
                                                <p class="text-sm text-gray-600 mt-1">Applied on: {{ $volunteer->created_at->format('M d, Y') }}</p>
                                            </div>
                                            <div class="flex space-x-2">
                                                <button type="button" data-volunteer-id="{{ $volunteer->id }}" class="approve-volunteer-btn inline-flex items-center px-3 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                                                    Approve
                                                </button>
                                                <button type="button" data-volunteer-id="{{ $volunteer->id }}" class="reject-volunteer-btn inline-flex items-center px-3 py-1 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                                    Reject
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            @php
                                                $skills = is_string($volunteer->skills) ? json_decode($volunteer->skills, true) : $volunteer->skills;
                                                if (!is_array($skills)) $skills = [];
                                            @endphp
                                            <p class="text-sm text-gray-600">Skills: {{ implode(', ', $skills) }}</p>
                                            <p class="text-sm text-gray-600">Email: {{ $volunteer->email }}</p>
                                            <p class="text-sm text-gray-600">Phone: {{ $volunteer->phone }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-gray-500 italic">No pending applications at this time.</p>
                            @endif
                        @else
                            <!-- Example pending applications (only shown when no volunteers exist in database) -->
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h4 class="text-md font-medium text-gray-900">Jane Smith</h4>
                                        <p class="text-sm text-gray-600 mt-1">Applied on: Oct 15, 2023</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button type="button" class="inline-flex items-center px-3 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                                            Approve
                                        </button>
                                        <button type="button" class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                            Reject
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-600">Skills: Event Planning</p>
                                    <p class="text-sm text-gray-600">Email: jane@example.com</p>
                                    <p class="text-sm text-gray-600">Phone: 987-654-3210</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Event Assignments Tab Content -->
            <div id="assignments-tab" class="tab-content hidden">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Volunteer Event Assignments</h3>
                    
                    <!-- Event cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Event 1 -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="text-md font-medium text-gray-900">Community Cleanup Day</h4>
                            <p class="text-sm text-gray-600 mt-1">Date: Nov 5, 2023 • 9:00 AM - 1:00 PM</p>
                            <p class="text-sm text-gray-600">Location: City Park</p>
                            
                            <div class="mt-3">
                                <h5 class="text-sm font-medium text-gray-700">Assigned Volunteers:</h5>
                                <ul class="mt-2 space-y-2">
                                    <li class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">John Doe</span>
                                        <button type="button" class="text-xs text-[#2C5F6E] hover:text-[#2C5F6E]/80">Change</button>
                                    </li>
                                    <li class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Robert Johnson</span>
                                        <button type="button" class="text-xs text-[#2C5F6E] hover:text-[#2C5F6E]/80">Change</button>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="mt-4">
                                <button type="button" class="inline-flex items-center px-3 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#2C5F6E] hover:bg-[#2C5F6E]/80">
                                    Assign More Volunteers
                                </button>
                            </div>
                        </div>
                        
                        <!-- Event 2 -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="text-md font-medium text-gray-900">Tutoring Session</h4>
                            <p class="text-sm text-gray-600 mt-1">Date: Nov 10, 2023 • 4:00 PM - 6:00 PM</p>
                            <p class="text-sm text-gray-600">Location: Community Center</p>
                            
                            <div class="mt-3">
                                <h5 class="text-sm font-medium text-gray-700">Assigned Volunteers:</h5>
                                <p class="mt-1 text-sm text-gray-500 italic">No volunteers assigned yet</p>
                            </div>
                            
                            <div class="mt-4">
                                <button type="button" class="inline-flex items-center px-3 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#2C5F6E] hover:bg-[#2C5F6E]/80">
                                    Assign Volunteers
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Job Opportunities Tab Content -->
            <div id="jobs-tab" class="tab-content hidden">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Available Volunteer Positions</h3>
                        <button type="button" class="inline-flex items-center px-3 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#2C5F6E] hover:bg-[#2C5F6E]/80">
                            <svg class="-ml-1 mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Add New Position
                        </button>
                    </div>
                    
                    <!-- Job listings -->
                    <div class="space-y-4">
                        <!-- Job 1 -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="text-md font-medium text-gray-900">Event Coordinator</h4>
                            <p class="text-sm text-gray-600 mt-1">Help organize and coordinate community events and fundraisers</p>
                            
                            <div class="mt-2 flex flex-wrap gap-1">
                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">Event Planning</span>
                                <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">Communication</span>
                                <span class="px-2 py-1 text-xs rounded bg-purple-100 text-purple-800">Leadership</span>
                            </div>
                            
                            <div class="mt-3">
                                <p class="text-sm text-gray-600"><span class="font-medium">Time Commitment:</span> 5-10 hours/week</p>
                                <p class="text-sm text-gray-600"><span class="font-medium">Duration:</span> 3 months</p>
                            </div>
                            
                            <div class="mt-4 flex justify-end space-x-2">
                                <button type="button" class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    Edit
                                </button>
                                <button type="button" class="inline-flex items-center px-3 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#2C5F6E] hover:bg-[#2C5F6E]/80">
                                    View Applicants (3)
                                </button>
                            </div>
                        </div>
                        
                        <!-- Job 2 -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="text-md font-medium text-gray-900">Teaching Assistant</h4>
                            <p class="text-sm text-gray-600 mt-1">Assist with after-school tutoring programs for elementary students</p>
                            
                            <div class="mt-2 flex flex-wrap gap-1">
                                <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">Teaching</span>
                                <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-800">Patience</span>
                            </div>
                            
                            <div class="mt-3">
                                <p class="text-sm text-gray-600"><span class="font-medium">Time Commitment:</span> 4 hours/week</p>
                                <p class="text-sm text-gray-600"><span class="font-medium">Duration:</span> School year</p>
                            </div>
                            
                            <div class="mt-4 flex justify-end space-x-2">
                                <button type="button" class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    Edit
                                </button>
                                <button type="button" class="inline-flex items-center px-3 py-1 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#2C5F6E] hover:bg-[#2C5F6E]/80">
                                    View Applicants (5)
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<!-- Add Volunteer Modal -->
<div id="add-volunteer-modal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="add-volunteer-form" method="POST" action="{{ route('volunteers.store') }}">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Add New Volunteer</h3>
                        <p class="mt-1 text-sm text-gray-500">Fill in the details to add a new volunteer to the system.</p>
                    </div>
                    
                    <div id="form-error-message" class="mb-4 text-red-500 text-sm hidden"></div>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <!-- Name -->
                        <div>
                            <label for="volunteer-name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" name="name" id="volunteer-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#2C5F6E] focus:ring-[#2C5F6E] sm:text-sm" required>
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label for="volunteer-email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" name="email" id="volunteer-email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#2C5F6E] focus:ring-[#2C5F6E] sm:text-sm" required>
                        </div>
                        
                        <!-- Phone -->
                        <div>
                            <label for="volunteer-phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input type="tel" name="phone" id="volunteer-phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#2C5F6E] focus:ring-[#2C5F6E] sm:text-sm" required>
                        </div>
                        
                        <!-- Skills -->
                        <div>
                            <label for="volunteer-skills" class="block text-sm font-medium text-gray-700">Skills</label>
                            <select id="volunteer-skills" name="skills[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#2C5F6E] focus:ring-[#2C5F6E] sm:text-sm" multiple>
                                <option value="Teaching">Teaching</option>
                                <option value="Event Planning">Event Planning</option>
                                <option value="Administration">Administration</option>
                                <option value="Fundraising">Fundraising</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Tutoring">Tutoring</option>
                            </select>
                            <p class="mt-1 text-xs text-gray-500">Hold Ctrl/Cmd to select multiple skills</p>
                        </div>
                        
                        <!-- Status -->
                        <div>
                            <label for="volunteer-status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="volunteer-status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#2C5F6E] focus:ring-[#2C5F6E] sm:text-sm">
                                <option value="Active">Active</option>
                                <option value="Pending" selected>Pending</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        
                        <!-- Start Date -->
                        <div>
                            <label for="volunteer-start-date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="start_date" id="volunteer-start-date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#2C5F6E] focus:ring-[#2C5F6E] sm:text-sm" required>
                        </div>
                        
                        <!-- Additional Information -->
                        <div>
                            <label for="volunteer-notes" class="block text-sm font-medium text-gray-700">Additional Notes</label>
                            <textarea id="volunteer-notes" name="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#2C5F6E] focus:ring-[#2C5F6E] sm:text-sm"></textarea>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#2C5F6E] text-base font-medium text-white hover:bg-[#2C5F6E]/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2C5F6E] sm:ml-3 sm:w-auto sm:text-sm">
                        Add Volunteer
                    </button>
                    <button type="button" id="close-modal-btn" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2C5F6E] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript for interactive functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modal functionality
        const addVolunteerBtn = document.getElementById('add-volunteer-btn');
        const modal = document.getElementById('add-volunteer-modal');
        const closeModalBtn = document.getElementById('close-modal-btn');
        const form = document.getElementById('add-volunteer-form');
        const errorMessage = document.getElementById('form-error-message');

        // Open modal
        addVolunteerBtn.addEventListener('click', function() {
            modal.classList.remove('hidden');
        });

        // Close modal
        closeModalBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
            form.reset();
            errorMessage.classList.add('hidden');
        });

        // Close modal when clicking outside
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
                form.reset();
                errorMessage.classList.add('hidden');
            }
        });

        // Form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Clear previous error messages
            errorMessage.classList.add('hidden');
            errorMessage.textContent = '';
            
            // Get form data
            const formData = new FormData(form);
            
            // Send AJAX request
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        if (data.errors) {
                            // Handle validation errors
                            const errorMessages = Object.values(data.errors).flat();
                            throw new Error(errorMessages.join('\n'));
                        }
                        throw new Error(data.message || 'An error occurred');
                    });
                }
                return response.json();
            })
            .then(data => {
                // Close modal
                modal.classList.add('hidden');
                form.reset();
                
                // Show success message
                alert('Volunteer added successfully!');
                
                // Reload page to show new volunteer
                window.location.reload();
            })
            .catch(error => {
                errorMessage.textContent = error.message;
                errorMessage.classList.remove('hidden');
                console.error('Error:', error);
            });
        });

        // Phone number validation
        const phoneInput = document.getElementById('volunteer-phone');
        phoneInput.addEventListener('input', function(e) {
            // Remove any non-digit characters
            let value = e.target.value.replace(/\D/g, '');
            
            // Format as (XXX) XXX-XXXX
            if (value.length > 0) {
                if (value.length <= 3) {
                    value = `(${value}`;
                } else if (value.length <= 6) {
                    value = `(${value.slice(0, 3)}) ${value.slice(3)}`;
                } else {
                    value = `(${value.slice(0, 3)}) ${value.slice(3, 6)}-${value.slice(6, 10)}`;
                }
            }
            
            e.target.value = value;
        });

        // Email validation
        const emailInput = document.getElementById('volunteer-email');
        emailInput.addEventListener('blur', function(e) {
            const email = e.target.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (!emailRegex.test(email)) {
                errorMessage.textContent = 'Please enter a valid email address.';
                errorMessage.classList.remove('hidden');
                e.target.focus();
            } else {
                errorMessage.classList.add('hidden');
            }
        });

        // Search functionality
        const searchInput = document.getElementById('search');
        const volunteerRows = document.querySelectorAll('#volunteer-list tr');
        
        searchInput.addEventListener('keyup', function() {
            const searchTerm = searchInput.value.toLowerCase();
            
            volunteerRows.forEach(row => {
                const name = row.querySelector('td:first-child').textContent.toLowerCase();
                const email = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const phone = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                
                if (name.includes(searchTerm) || email.includes(searchTerm) || phone.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
        
        // Status filter functionality
        const statusFilter = document.getElementById('status-filter');
        statusFilter.addEventListener('change', function() {
            const selectedStatus = statusFilter.value.toLowerCase();
            
            if (selectedStatus === 'all statuses') {
                volunteerRows.forEach(row => {
                    row.style.display = '';
                });
                return;
            }
            
            volunteerRows.forEach(row => {
                const status = row.querySelector('td:nth-child(5)').textContent.trim().toLowerCase();
                
                if (status === selectedStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
        
        // Skills filter functionality
        const skillsFilter = document.getElementById('skills-filter');
        skillsFilter.addEventListener('change', function() {
            const selectedSkill = skillsFilter.value.toLowerCase();
            
            if (selectedSkill === 'all skills') {
                volunteerRows.forEach(row => {
                    row.style.display = '';
                });
                return;
            }
            
            volunteerRows.forEach(row => {
                const skillsCell = row.querySelector('td:nth-child(4)');
                const skills = skillsCell.textContent.toLowerCase();
                
                if (skills.includes(selectedSkill)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
        
        // Tab navigation functionality
        const tabs = document.querySelectorAll('.volunteer-tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all tabs
                tabs.forEach(t => {
                    t.classList.remove('border-[#2C5F6E]', 'text-[#2C5F6E]');
                    t.classList.add('border-transparent', 'text-gray-500');
                });
                
                // Add active class to clicked tab
                this.classList.remove('border-transparent', 'text-gray-500');
                this.classList.add('border-[#2C5F6E]', 'text-[#2C5F6E]');
                
                // Show/hide appropriate content based on tab
                const tabId = this.getAttribute('data-tab');
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.add('hidden');
                });
                document.getElementById(tabId).classList.remove('hidden');
            });
        });
        
        // View volunteer profile functionality
        const viewButtons = document.querySelectorAll('.view-volunteer-btn');
        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                const volunteerId = this.getAttribute('data-volunteer-id');
                window.location.href = `/volunteers/${volunteerId}`;
            });
        });
        
        // Pagination functionality
        const paginationLinks = document.querySelectorAll('.pagination-link');
        paginationLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                const page = this.getAttribute('data-page');
                // Here you would typically make an AJAX request to load the next page of volunteers
                // For demo purposes, we'll just log it
                console.log(`Loading page ${page}`);
                
                // Update active state of pagination links
                paginationLinks.forEach(l => {
                    l.classList.remove('bg-[#2C5F6E]/10', 'text-[#2C5F6E]');
                    l.classList.add('bg-white', 'text-gray-700');
                });
                this.classList.remove('bg-white', 'text-gray-700');
                this.classList.add('bg-[#2C5F6E]/10', 'text-[#2C5F6E]');
            });
        });
    });
</script>
</x-app-layout>