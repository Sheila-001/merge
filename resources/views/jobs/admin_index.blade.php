<x-app-layout>
    <div class="flex">
        <div class="w-64 min-h-screen bg-[#1B4B5A] text-white">
            <div class="p-4 flex items-center space-x-2">
                <img src="{{ asset('image/logohauzhayag.jpg') }}" alt="Hauz Hayag Logo" class="h-16 w-auto rounded-lg shadow-md">
                <h1 class="text-2xl font-bold">Hauz Hayag</h1>
            </div>
            <nav class="mt-8">
                <a href="/dashboard" class="flex items-center px-4 py-3 bg-[#2C5F6E] hover:bg-[#2C5F6E] transition-colors">Dashboard</a>
                <a href="/admin/jobs" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors font-bold">Manage Jobs</a>
                <a href="/admin/jobs/create" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">Add Job</a>
                <div class="mt-auto pt-20">
                    <a href="/logout" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors text-red-300 hover:text-red-200">Logout</a>
                </div>
            </nav>
        </div>
        <div class="flex-1 p-8 bg-gray-50">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Manage Job Listings</h1>
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif
            <div class="overflow-x-auto bg-white rounded-lg shadow-md">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($jobs as $job)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $job->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $job->company }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $job->location }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($job->status === 'pending')
                                        <form action="{{ route('jobs.approve', $job->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900 mr-2">Approve</button>
                                        </form>
                                        <form action="{{ route('jobs.reject', $job->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-red-600 hover:text-red-900 mr-2">Reject</button>
                                        </form>
                                    @endif
                                    <a href="{{ route('jobs.edit', $job->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this job?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No jobs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout> 