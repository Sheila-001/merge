@extends('layouts.app')

@section('content')
<div class="py-10 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Available Job Listings</h2>
            @auth
                @if(auth()->user()->is_admin)
                    <a href="/admin/jobs" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                        &#8592; Back to Job Management
                    </a>
                @endif
            @endauth
        </div>
        @if($jobs->isEmpty())
            <div class="bg-white p-8 rounded shadow text-center text-gray-500">
                No job listings available at the moment.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($jobs as $job)
                    <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col justify-between h-full transition transform hover:scale-105 hover:shadow-xl">
                        <div>
                            <h3 class="text-xl font-bold text-primary mb-1">{{ $job->title }}</h3>
                            <p class="text-gray-600 font-semibold mb-2">{{ $job->company_name ?? 'Company Not Specified' }}</p>
                            <div class="mb-2">
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded mr-2 mb-1">Role: {{ $job->role }}</span>
                                <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded mr-2 mb-1">Type: {{ $job->employment_type ?? 'N/A' }}</span>
                                <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded mb-1">Location: {{ $job->location ?? 'N/A' }}</span>
                            </div>
                            @if($job->salary_min || $job->salary_max)
                                <div class="mb-2">
                                    <span class="font-semibold text-gray-700">Salary Range:</span>
                                    <span class="text-gray-800">
                                        @if($job->salary_min && $job->salary_max)
                                            ${{ number_format($job->salary_min, 2) }} - ${{ number_format($job->salary_max, 2) }}
                                        @elseif($job->salary_min)
                                            From ${{ number_format($job->salary_min, 2) }}
                                        @else
                                            Up to ${{ number_format($job->salary_max, 2) }}
                                        @endif
                                    </span>
                                </div>
                            @endif
                            <div class="mb-4 text-sm text-gray-500">
                                <span>Posted {{ $job->created_at->diffForHumans() }}</span>
                                @if($job->expires_at)
                                    <span class="mx-2">•</span>
                                    <span>Expires {{ $job->expires_at->format('M d, Y') }}</span>
                                @endif
                            </div>
                            <p class="text-gray-700 line-clamp-3 mb-4">{{ Str::limit($job->description, 120) }}</p>
                        </div>
                        <div class="mt-auto">
                            <a href="{{ route('jobs.show', $job) }}" class="w-full block text-center px-4 py-2 bg-primary text-white font-semibold rounded hover:bg-primary/90 transition">View Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-10 flex justify-center">
                {{ $jobs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection