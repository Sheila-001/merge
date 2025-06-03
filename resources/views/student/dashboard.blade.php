<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    
    <!-- Add Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2C5F6E',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Navigation -->
        <div class="w-64 bg-[#1B4B5A] text-white flex flex-col fixed h-full">
            <div class="p-4 flex items-center space-x-2">
                <img src="{{ asset('image/logohauzhayag.jpg') }}" alt="Hauz Hayag Logo" class="h-16 w-auto rounded-lg shadow-md">
                <h1 class="text-2xl font-bold">Hauz Hayag</h1>
            </div>
            <nav class="mt-8 flex-1 flex flex-col">
                <a href="{{ route('student.dashboard') }}" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('jobs.listings') }}" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Job Listings
                </a>
                <a href="{{ route('student.events.index') }}" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Events
                </a>
                <div class="mt-auto pt-20">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors text-red-300 hover:text-red-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6 bg-gray-50 ml-64 overflow-y-auto h-screen">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Student Dashboard</h1>
                <p class="text-gray-600">Welcome back, {{ Auth::user()->name }}! Here's an overview of your academic journey.</p>
            </div>

            <!-- Notifications -->
            @if($notifications->count() > 0)
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-medium text-gray-900">Notifications</h2>
                    <form method="POST" action="{{ route('notifications.markAllAsRead') }}">
                        @csrf
                        <button type="submit" class="text-primary hover:underline">Mark all as read</button>
                    </form>
                </div>
                <div class="space-y-4">
                    @foreach($notifications as $notification)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-md font-medium text-gray-900">{{ $notification->data['title'] }}</h3>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ \Carbon\Carbon::parse($notification->data['start_date'])->format('F j, Y g:i A') }}
                                </p>
                                <p class="text-sm text-gray-600">Location: {{ $notification->data['location'] }}</p>
                            </div>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                New Event
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <!-- Upcoming Events -->
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-green-500">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Upcoming Events</p>
                            <p class="text-xl font-bold text-gray-800 mt-1">{{ isset($eventCount) ? $eventCount : 0 }}</p>
                        </div>
                        <div class="rounded-full bg-green-100 p-2">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Job Applications -->
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-purple-500">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Available Jobs</p>
                            <p class="text-xl font-bold text-gray-800 mt-1">{{ isset($jobCount) ? $jobCount : 0 }}</p>
                        </div>
                        <div class="rounded-full bg-purple-100 p-2">
                            <svg class="h-5 w-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Latest Events Preview -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-medium text-gray-900">Latest Events</h2>
                    <a href="{{ route('events.index') }}" class="text-primary hover:underline">View All Events</a>
                </div>
                <div class="space-y-4">
                    @forelse(($upcomingEvents ?? []) as $event)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-md font-medium text-gray-900">{{ $event->title }}</h3>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ \Carbon\Carbon::parse($event->start_date)->format('F j, Y g:i A') }}
                                    -
                                    {{ \Carbon\Carbon::parse($event->end_date)->format('F j, Y g:i A') }}
                                </p>
                                <p class="text-sm text-gray-600">Location: {{ $event->location }}</p>
                            </div>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $event->status }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-gray-500 py-4">
                        No upcoming events found.
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Latest Job Listings -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-medium text-gray-900">Latest Job Listings</h2>
                    <a href="{{ route('jobs.listings') }}" class="text-primary hover:underline">View All Jobs</a>
                </div>
                <div class="space-y-4">
                    @forelse(($latestJobs ?? []) as $job)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-md font-medium text-gray-900">{{ $job->title }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $job->company_name ?? $job->company }}</p>
                                <p class="text-sm text-gray-600">{{ $job->location }}</p>
                                <div class="mt-2 flex flex-wrap gap-2">
                                    @if($job->employment_type)
                                        <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">
                                            {{ $job->employment_type }}
                                        </span>
                                    @endif
                                    @if($job->type)
                                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">
                                            {{ $job->type }}
                                        </span>
                                    @endif
                                    @if($job->salary_min && $job->salary_max)
                                        <span class="px-2 py-1 text-xs rounded bg-purple-100 text-purple-800">
                                            ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-600 mt-2">{{ \Illuminate\Support\Str::limit($job->description, 100) }}</p>
                            </div>
                            <div class="flex flex-col items-end">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 mb-2">
                                    {{ $job->status }}
                                </span>
                                <a href="{{ route('jobs.show', $job->id) }}" class="text-primary hover:underline text-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-gray-500 py-4">
                        No job listings found.
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Admin-Created Events -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-medium text-gray-900">Admin-Created Events</h2>
                    <a href="{{ route('events.index') }}" class="text-primary hover:underline">View All Events</a>
                </div>
                <div class="space-y-4">
                    @forelse(($adminEvents ?? []) as $event)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-md font-medium text-gray-900">{{ $event->title }}</h3>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ \Carbon\Carbon::parse($event->start_date)->format('F j, Y g:i A') }}
                                    -
                                    {{ \Carbon\Carbon::parse($event->end_date)->format('F j, Y g:i A') }}
                                </p>
                                <p class="text-sm text-gray-600">Location: {{ $event->location }}</p>
                            </div>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                Admin Posted
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-gray-500 py-4">
                        No admin-created events found.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</body>
</html> 