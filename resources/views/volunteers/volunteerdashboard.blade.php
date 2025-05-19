@extends('layouts.app')

@section('content')
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <div class="w-64 min-h-screen bg-[#1B4B5A] text-white flex flex-col">
        <div class="p-4 flex items-center space-x-2">
            <img src="{{ asset('image/logohauzhayag.jpg') }}" alt="Hauz Hayag Logo" class="h-16 w-auto rounded-lg shadow-md">
            <h1 class="text-2xl font-bold">Hauz Hayag</h1>
        </div>
        <nav class="mt-8 flex-1">
            <a href="{{ route('volunteer.dashboard') }}" class="flex items-center px-4 py-3 bg-[#2C5F6E] hover:bg-[#2C5F6E] transition-colors mb-2">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('volunteer.events') }}" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors mb-2">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Events
            </a>
            <a href="{{ route('jobs.listings') }}" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors mb-2">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Jobs
            </a>
        </nav>
        <div class="mt-auto mb-8">
            <a href="{{ route('logout') }}" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors text-red-300 hover:text-red-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </a>
        </div>
    </div>
    <!-- Main Content -->
    <div class="flex-1 px-3 px-md-5 py-4 bg-gray-50">
        <!-- Post a Job Button above main content -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('volunteer.job.post') }}" class="btn btn-primary fw-bold shadow px-4 py-2 d-flex align-items-center" style="font-size: 1.1rem; border-radius: 0.6rem; gap: 0.5rem;">
                <i class="fas fa-plus-circle me-2" style="font-size: 1.3rem;"></i>
                Post a Job
            </a>
        </div>
        <!-- Header Row: Only Welcome Message -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0 text-gradient" style="font-size: 2.8rem; letter-spacing: 1px;">WELCOME, VOLUNTEER!</h2>
        </div>
        <!-- Header Card -->
        <div class="card border-0 shadow-sm mb-4 header-card p-4">
            <div>
                <div class="text-muted">Here's an overview of your activities and opportunities.</div>
            </div>
        </div>
        <!-- Stats Cards Row -->
        <div class="row g-4 mb-4 stats-row">
            <div class="col-12 col-md-4">
                <div class="card stat-card border-0 shadow-sm h-100 bg-primary-gradient cursor-pointer" id="events-stat-card">
                    <div class="card-body d-flex align-items-center p-4">
                        <div class="stat-icon me-3">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div>
                            <div class="fw-bold fs-2 mb-1 text-white">{{ $events->count() }}</div>
                            <div class="small text-white-50">Upcoming Events</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card stat-card border-0 shadow-sm h-100 bg-success-gradient">
                    <div class="card-body d-flex align-items-center p-4">
                        <div class="stat-icon me-3">
                            <i class="fas fa-clock-rotate-left"></i>
                        </div>
                        <div>
                            <div class="fw-bold fs-2 mb-1 text-white">{{ $hoursThisMonth }}</div>
                            <div class="small text-white-50">Hours This Month</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card stat-card border-0 shadow-sm h-100 bg-purple-gradient cursor-pointer" id="job-applications-card">
                    <div class="card-body d-flex align-items-center p-4">
                        <div class="stat-icon me-3">
                            <i class="fas fa-file-circle-check"></i>
                        </div>
                        <div>
                            <div class="fw-bold fs-2 mb-1 text-white">{{ $jobs->count() }}</div>
                            <div class="small text-white-50">Job Applications</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Recent Activity Section -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-3">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="fw-bold mb-0 text-primary">
                        <i class="fas fa-history me-2"></i>Recent Activity
                    </h4>
                </div>
                <div class="activity-timeline">
                    @forelse($recentActivities as $activity)
                        <div class="activity-item">
                            <div class="d-flex align-items-start">
                                <div class="activity-icon bg-primary text-white me-3">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="activity-content">
                                    <h6 class="fw-semibold mb-1">
                                        {{ $activity->event ? $activity->event->title : 'Volunteer Activity' }}
                                    </h6>
                                    <p class="text-muted mb-1">
                                        {{ $activity->hours }} hour(s) on {{ \Carbon\Carbon::parse($activity->date)->format('F d, Y') }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="far fa-clock me-1"></i>
                                            {{ \Carbon\Carbon::parse($activity->date)->diffForHumans() }}
                                        </small>
                                        <span class="badge bg-success">Completed</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-muted">No recent activity yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- Upcoming Events Section -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <h4 class="fw-bold mb-0 text-primary">
                        <i class="fas fa-calendar-alt me-2"></i>Upcoming Events
                    </h4>
                </div>
                <div class="events-list">
                    @forelse($events as $event)
                    <div class="event-card mb-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="event-details">
                                <h6 class="fw-bold text-primary mb-2">{{ $event->title }}</h6>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-calendar me-2"></i>{{ $event->start_date->format('F d, Y') }}
                                </p>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-clock me-2"></i>{{ $event->start_date->format('g:i A') }} - {{ $event->end_date->format('g:i A') }}
                                </p>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-map-marker-alt me-2"></i>{{ $event->location }}
                                </p>
                            </div>
                            <div class="d-flex flex-column align-items-end">
                                <span class="badge bg-success mb-2">Upcoming</span>
                                <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-info-circle me-1"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="no-events">
                        <div class="d-flex align-items-center">
                            <div class="no-events-icon me-3">
                                <i class="fas fa-calendar-times fa-2x text-muted"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">No Upcoming Events</h6>
                                <p class="text-muted mb-0">There are no events scheduled at the moment.</p>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Job Applications Modal -->
<div id="jobApplicationsModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-lg w-full relative">
        <button onclick="closeJobApplicationsModal()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        <h3 class="text-xl font-bold mb-4 text-primary">Approved Job Applications</h3>
        <div class="space-y-4 max-h-96 overflow-y-auto">
            @forelse($jobs as $job)
                <div class="border-b pb-2">
                    <div class="font-semibold text-lg">{{ $job->title }}</div>
                    <div class="text-gray-600 text-sm mb-1">{{ $job->company_name }}</div>
                    <a href="{{ route('jobs.show', $job) }}" class="text-blue-600 hover:underline text-sm">View Details</a>
                </div>
            @empty
                <div class="text-gray-500">No approved jobs posted by admin.</div>
            @endforelse
        </div>
    </div>
</div>

<!-- Events Modal -->
<div id="eventsModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-lg w-full relative">
        <button onclick="closeEventsModal()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        <h3 class="text-xl font-bold mb-4 text-primary">Upcoming Events</h3>
        <div class="space-y-4 max-h-96 overflow-y-auto">
            @forelse($events as $event)
                <div class="border-b pb-2">
                    <div class="font-semibold text-lg">{{ $event->title }}</div>
                    <div class="text-gray-600 text-sm mb-1">
                        {{ $event->start_date->format('F d, Y') }} @ {{ $event->location }}
                    </div>
                    <a href="{{ route('events.show', $event->id) }}" class="text-blue-600 hover:underline text-sm">View Details</a>
                </div>
            @empty
                <div class="text-gray-500">No upcoming events.</div>
            @endforelse
        </div>
    </div>
</div>

<script>
    const jobCard = document.getElementById('job-applications-card');
    const jobModal = document.getElementById('jobApplicationsModal');
    function openJobApplicationsModal() {
        jobModal.classList.remove('hidden');
    }
    function closeJobApplicationsModal() {
        jobModal.classList.add('hidden');
    }
    jobCard.addEventListener('click', openJobApplicationsModal);
    jobModal.addEventListener('click', function(e) {
        if (e.target === jobModal) closeJobApplicationsModal();
    });

    const eventsCard = document.getElementById('events-stat-card');
    const eventsModal = document.getElementById('eventsModal');
    function openEventsModal() {
        eventsModal.classList.remove('hidden');
    }
    function closeEventsModal() {
        eventsModal.classList.add('hidden');
    }
    eventsCard.addEventListener('click', openEventsModal);
    eventsModal.addEventListener('click', function(e) {
        if (e.target === eventsModal) closeEventsModal();
    });
</script>

<style>
.dashboard-container { 
    background: #f8fafc; 
}

.sidebar {
    width: 240px;
    min-width: 240px;
    min-height: 100vh;
    border-radius: 0 1rem 1rem 0;
    box-shadow: 2px 0 8px rgba(0,0,0,0.1);
    position: fixed;
    left: 0;
    top: 0;
    z-index: 100;
    background: linear-gradient(135deg, #0088a9 0%, #006d85 100%);
}

.sidebar-nav .nav-link {
    color: rgba(255, 255, 255, 0.9);
    font-weight: 600;
    border-radius: 0.5rem;
    padding: 0.85rem 1.25rem;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
}

.sidebar-nav .nav-link:hover {
    background: rgba(255, 255, 255, 0.15);
    color: #ffffff;
    transform: translateX(5px);
}

.sidebar-nav .nav-link.active {
    background: rgba(255, 255, 255, 0.2);
    color: #ffffff;
}

.sidebar .text-danger {
    color: #dc3545 !important;
    font-weight: 600;
}

.sidebar .text-danger:hover {
    color: #ff4d5d !important;
    background: rgba(220, 53, 69, 0.1);
}

.sidebar .fw-bold.fs-4 {
    font-size: 1.35rem !important;
    font-weight: 700 !important;
    letter-spacing: 0.5px;
}

.header-card {
    background: linear-gradient(90deg, #e9f0ff 0%, #f8fafc 100%);
    border-radius: 1rem;
}

.text-gradient {
    background: linear-gradient(135deg, #00A4B8 0%, #0088a9 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Stats Row Styling */
.stats-row {
    display: flex;
    flex-wrap: nowrap;
    margin: 0 -0.5rem;
}

.stats-row .col-md-4 {
    padding: 0 0.5rem;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
}

.stat-card {
    border-radius: 1rem;
    transition: all 0.3s ease;
    border: none;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.stat-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0.75rem;
    transition: all 0.3s ease;
    flex-shrink: 0;
    background: rgba(255, 255, 255, 0.2);
}

.stat-icon i {
    font-size: 1.5rem;
    color: #ffffff;
}

.bg-primary-gradient {
    background: linear-gradient(135deg, #00A4B8 0%, #0088a9 100%);
}

.bg-success-gradient {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

.bg-purple-gradient {
    background: linear-gradient(135deg, #6f42c1 0%, #a259ff 100%);
}

.stat-card:hover .stat-icon {
    transform: scale(1.1);
    background: rgba(255, 255, 255, 0.3);
}

/* Dashboard Grid Layout */
.dashboard-grid {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 1.5rem;
}

.dashboard-left {
    display: flex;
    flex-direction: column;
}

.dashboard-right {
    display: flex;
    flex-direction: column;
}

.event-card {
    background: #ffffff;
    border-radius: 1rem;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.timeline-icon {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 1.2rem;
}

.btn-primary {
    background: linear-gradient(135deg, #00A4B8 0%, #0088a9 100%);
    border: none;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,164,184,0.2);
}

.btn-outline-primary {
    color: #00A4B8;
    border-color: #00A4B8;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background: #00A4B8;
    color: white;
    transform: translateY(-2px);
}

@media (max-width: 1200px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
    
    .dashboard-left {
        order: 2;
    }
    
    .dashboard-right {
        order: 1;
    }
}

@media (max-width: 991.98px) {
    .sidebar { 
        width: 70px; 
        min-width: 70px; 
    }
    .sidebar .fw-bold, 
    .sidebar .fs-4, 
    .sidebar .d-md-inline { 
        display: none !important; 
    }
    .main-content { 
        margin-left: 70px !important; 
    }
    
    .stats-row {
        flex-wrap: wrap;
    }
    
    .stats-row .col-md-4 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}

@media (max-width: 575.98px) {
    .main-content { 
        padding-left: 0.5rem !important; 
        padding-right: 0.5rem !important; 
    }
    .header-card { 
        flex-direction: column !important; 
        align-items: flex-start !important; 
    }
}

/* Activity Timeline Styles */
.activity-timeline {
    position: relative;
}

.activity-item {
    position: relative;
    padding: 0.75rem;
    border-radius: 0.75rem;
    background: #f8f9fa;
    margin-bottom: 0.75rem;
}

.activity-item:last-child {
    margin-bottom: 0;
}

.activity-icon {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 0.9rem;
    flex-shrink: 0;
}

.activity-content {
    flex-grow: 1;
}

.activity-content h6 {
    font-size: 1rem;
    line-height: 1.3;
    margin-bottom: 0.25rem;
}

.activity-content p {
    font-size: 0.9rem;
    line-height: 1.4;
    margin-bottom: 0.25rem;
}

.activity-content small {
    font-size: 0.8rem;
}

.badge {
    padding: 0.35em 0.7em;
    font-size: 0.75rem;
    font-weight: 500;
    border-radius: 0.4rem;
    white-space: nowrap;
}

/* Event Card Styles */
.event-card {
    transition: all 0.3s ease;
    background: #f8f9fa;
    border-radius: 0.75rem;
    padding: 1rem;
    margin-bottom: 1rem;
}

.event-card:last-child {
    margin-bottom: 0;
}

.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.event-details p {
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.no-events {
    background: #f8f9fa;
    border-radius: 0.75rem;
    padding: 1rem;
}

.no-events-icon {
    color: #dee2e6;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.no-events h6 {
    font-size: 1rem;
    font-weight: 600;
}

.no-events p {
    font-size: 0.9rem;
}

/* Badge Styles */
.bg-success {
    background: rgba(40, 167, 69, 0.15) !important;
    color: #28a745 !important;
}

.bg-info {
    background: rgba(23, 162, 184, 0.15) !important;
    color: #17a2b8 !important;
}

.badge.bg-success:hover {
    background: rgba(40, 167, 69, 0.25) !important;
}

.badge.bg-info:hover {
    background: rgba(23, 162, 184, 0.25) !important;
}

/* Button Styles */
.btn-outline-primary {
    border-width: 2px;
    font-weight: 500;
}

.btn-outline-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,164,184,0.2);
}

/* Section Headers */
.card-body h4 {
    font-size: 1.25rem;
    letter-spacing: -0.5px;
    margin-bottom: 0;
}

.card-body {
    padding: 1rem;
}

.sidebar-nav .nav-link i {
    font-size: 1.5rem;
    width: 28px;
    text-align: center;
    color: #fff !important;
    transition: color 0.2s, transform 0.2s;
}

.sidebar-nav .nav-link.active i,
.sidebar-nav .nav-link:hover i {
    color: #fff !important;
    transform: scale(1.15);
}

.sidebar-brand {
    min-height: 70px;
    padding: 0;
}
.sidebar-title {
    font-weight: 800 !important;
    font-size: 1.7rem !important;
    letter-spacing: 1px;
    margin-left: 0;
}

.main-content {
    position: relative;
    z-index: 1;
}
</style>
@endsection
