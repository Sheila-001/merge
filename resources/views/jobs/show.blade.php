@extends('layouts.app')

@section('content')
<div class="py-10 bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                        &#8592; Back to Job Management
                    </a>
                @else
                    <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                        &#8592; Back to Listings
                    </a>
                @endif
            @else
                <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    &#8592; Back to Listings
                </a>
            @endauth
        </div>
        <div class="bg-white rounded-lg shadow p-8">
            <div class="mb-6">
                <h2 class="text-3xl font-bold text-primary mb-2">{{ $job->title }}</h2>
                <p class="text-lg text-gray-600 font-semibold mb-1">{{ $job->company_name ?? 'Not Specified' }}</p>
                <div class="flex flex-wrap gap-2 mb-2">
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Role: {{ $job->role }}</span>
                    <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Type: {{ $job->employment_type ?? 'N/A' }}</span>
                    <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Location: {{ $job->location ?? 'N/A' }}</span>
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
                <div class="text-sm text-gray-500 mb-4">
                    <span>Posted {{ $job->created_at->diffForHumans() }}</span>
                    @if($job->expires_at)
                        <span class="mx-2">•</span>
                        <span>Expires {{ $job->expires_at->format('M d, Y') }}</span>
                    @endif
                </div>
            </div>
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Job Description</h3>
                <div class="bg-gray-50 rounded p-4 text-gray-800">{!! nl2br(e($job->description)) !!}</div>
            </div>
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Qualifications</h3>
                <div class="bg-gray-50 rounded p-4 text-gray-800">{!! nl2br(e($job->qualifications)) !!}</div>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Contact Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-gray-50 rounded p-4">
                    <div>
                        <span class="font-semibold">Contact Person:</span><br>{{ $job->contact_person }}
                    </div>
                    <div>
                        <span class="font-semibold">Email:</span><br>{{ $job->contact_email }}
                    </div>
                    @if($job->contact_phone)
                        <div>
                            <span class="font-semibold">Phone:</span><br>{{ $job->contact_phone }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 