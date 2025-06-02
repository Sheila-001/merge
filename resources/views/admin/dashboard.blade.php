@php use Illuminate\Support\Facades\Storage; @endphp
<x-app-layout>
    <div class="max-w-7xl mx-auto py-8">
        <!-- Header Row: Title and User Badge -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold">Dashboard Overview</h1>
            <div class="flex items-center gap-2">
                <span class="text-gray-500">Admin</span>
                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-bold">AD</span>
            </div>
        </div>

        <!-- Statistic Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start relative">
                <span class="text-gray-500 font-semibold">Total Users</span>
                <span class="text-3xl font-bold mt-2">{{ $totalUsers ?? 0 }}</span>
                <span class="absolute top-6 right-6 h-3 w-3 rounded-full bg-blue-100"></span>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start relative">
                <span class="text-gray-500 font-semibold">Pending Applicants</span>
                <span class="text-3xl font-bold mt-2">{{ $pendingApplicants ?? 0 }}</span>
                 <span class="absolute top-6 right-6 h-3 w-3 rounded-full bg-yellow-100"></span>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start relative">
                <span class="text-gray-500 font-semibold">Active Students</span>
                <span class="text-3xl font-bold mt-2">{{ $activeStudents ?? 0 }}</span>
                 <span class="absolute top-6 right-6 h-3 w-3 rounded-full bg-green-100"></span>
            </div>
            <div class="bg-white rounded-xl shadow p-6 flex flex-col items-start relative">
                <span class="text-gray-500 font-semibold">Active Events</span>
                <span class="text-3xl font-bold mt-2">{{ $activeEvents ?? 0 }}</span>
                 <span class="absolute top-6 right-6 h-3 w-3 rounded-full bg-purple-100"></span>
            </div>
        </div>

        <!-- Recent Events and Recent Activity Sections -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Recent Events -->
            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-bold text-lg">Recent Events</h2>
                    <a href="#" class="text-blue-600 hover:underline">View all</a>
                </div>
                @if($recentEvents->count() > 0)
                    <ul class="space-y-4">
                        @foreach($recentEvents as $event)
                            <li class="border-b pb-2 last:border-b-0 last:pb-0">
                                <p class="font-semibold">{{ $event->title }}</p>
                                <p class="text-sm text-gray-500">{{ $event->start_date->format('M d, Y H:i A') }} - {{ $event->end_date->format('M d, Y H:i A') }}</p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No recent events found.</p>
                @endif
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow p-6">
                <h2 class="font-bold text-lg mb-4">Recent Activity</h2>
                <p class="text-gray-500">No recent activity to display.</p>
                {{-- You would typically loop through recent activity data here --}}
            </div>
        </div>
    </div>
</x-app-layout>