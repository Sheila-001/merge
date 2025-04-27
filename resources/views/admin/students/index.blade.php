<x-app-layout>
    <!-- Add the flex container and sidebar -->
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 min-h-screen bg-[#1B4B5A] text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Hauz Hayag</h1> {{-- Consider making this dynamic --}}
            </div>
            <nav class="mt-8">
                <a href="/dashboard" class="block px-4 py-2 hover:bg-[#2C5F6E]"> {{-- Remove active class bg-[#2C5F6E] --}}
                    Dashboard
                </a>
                <a href="/users" class="block px-4 py-2 hover:bg-[#2C5F6E]">
                    User Management
                </a>
                <a href="/events" class="block px-4 py-2 hover:bg-[#2C5F6E]">
                    Events
                </a>
                <a href="/students" class="block px-4 py-2 bg-[#2C5F6E] hover:bg-[#2C5F6E]"> {{-- Add active class bg-[#2C5F6E] --}}
                    Students
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

        <!-- Main Content Area -->
        <div class="flex-1 bg-gray-100">
             <!-- Optional Header for the Students Page -->
            <div class="bg-white p-4 flex justify-between items-center shadow-sm">
                <h2 class="text-xl">Student Applications</h2>
                 {{-- You can add admin user info here if needed, similar to dashboard --}}
                {{-- <div class="flex items-center space-x-2">
                    <span>Admin</span>
                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-sm">AD</span>
                </div> --}}
            </div>

            {{-- Original content of the students index view --}}
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-2xl font-semibold mb-6">Scholarship Applications</h3>

                            @if(session('success'))
                                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date Submitted
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Full Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Email
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Phone Number
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Transcript
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse ($applications as $application)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $application->created_at->format('M d, Y H:i') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $application->full_name ?? 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $application->email }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $application->phone_number ?? 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    @php
                                                        $status = $application->status ?? 'pending';
                                                        $color = 'yellow';
                                                        if (strtolower($status) === 'approved' || strtolower($status) === 'accepted') $color = 'green';
                                                        if (strtolower($status) === 'rejected') $color = 'red';
                                                    @endphp
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{$color}}-100 text-{{$color}}-800">
                                                        {{ ucfirst($status) }}
                                                    </span>
                                                </td>
                                                 <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    @if($application->transcript_path)
                                                        <a href="{{ Storage::url($application->transcript_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 underline">View</a>
                                                    @else
                                                        <span>No Transcript</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                    No scholarship applications found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>