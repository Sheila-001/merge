<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\VolunteerController;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationReceived;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\JobListingController;



Route::get('/', function () {
    return view('welcome');
});

//login Routes

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'login']);
});

// Admin Protected Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/students', [StudentController::class, 'index'])->name('admin.students.index');
    Route::post('/admin/students/{tracking_code}/approve', [StudentController::class, 'approve'])->name('admin.students.approve');
    Route::post('/admin/students/{tracking_code}/reject', [StudentController::class, 'reject'])->name('admin.students.reject');
    Route::delete('/admin/students/{tracking_code}', [StudentController::class, 'destroy'])->name('admin.students.destroy');
    
    // Applications routes
    Route::get('/admin/applications', [ScholarshipController::class, 'index'])->name('admin.applications.index');
    Route::post('/admin/applications/{id}/status', [ScholarshipController::class, 'updateStatus'])->name('admin.applications.updateStatus');
    
    // Scholars route
    Route::get('/scholars', [AdminController::class, 'showScholars'])->name('admin.scholars');
    
    // Settings routes
    Route::get('/admin/settings', [AdminController::class, 'showSettings'])->name('admin.settings');
    Route::put('/admin/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
});

// Scholarship Routes
Route::group(['prefix' => 'scholarship'], function () {
    Route::get('/apply', [ScholarshipController::class, 'showApplyForm'])->name('scholarship.apply.form');
    Route::post('/apply', [ScholarshipController::class, 'apply'])->name('scholarship.apply');
    Route::get('/status/{tracking_code}', [ScholarshipController::class, 'show'])->name('scholarship.show');
    Route::match(['get', 'post'], '/track', [ScholarshipController::class, 'track'])->name('scholarship.track');
    // Resend tracking code by email
    Route::post('/resend', [ScholarshipController::class, 'resendCode'])->name('scholarship.resend');
    Route::get('/scholarship/success/{tracking_code}', function ($tracking_code) {
        return view('scholarship.success', compact('tracking_code'));
    })->name('scholarship.success');
});

// Authentication routes
Auth::routes();
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Other routes...

// Dashboard and User Management routes without auth
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Volunteer routes under dashboard
// Route::middleware(['auth', 'role:volunteers'])->prefix('dashboard')->group(function () {
//     Route::get('/volunteers', [VolunteerController::class, 'index'])->name('volunteers.index'); // Ensure this route is correct
     Route::get('/volunteer/events', [VolunteerController::class, 'viewEvents'])->name('volunteer.events');
//     Route::post('/volunteers/events/apply', [VolunteerController::class, 'applyEvent'])->name('volunteers.applyEvent');
     Route::get('/volunteers/calendar', [VolunteerController::class, 'viewCalendar'])->name('volunteer.calendar');
     Route::post('/volunteers/job-offers', [VolunteerController::class, 'addJobOffer'])->name('volunteer.addJobOffer');
    Route::get('/volunteers', function () {
        // Volunteer page logic
        return view('volunteers.index'); // Updated to match the correct view path
    });

// User management routes with auth
Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Event routes with auth
Route::middleware(['auth'])->group(function () {
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/json', [EventController::class, 'getEventsJson'])->name('events.json');
    Route::get('/events/upcoming', [EventController::class, 'getUpcomingEvents'])->name('events.upcoming');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
});

// Student Applications Route with auth
Route::middleware(['auth'])->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('admin.students.index');
});

// Volunteer routes with auth
Route::middleware(['auth'])->group(function () {
    Route::get('/volunteers', [VolunteerController::class, 'index'])->name('volunteers.index');
    Route::post('/volunteers', [VolunteerController::class, 'store'])->name('volunteers.store');
    Route::get('/volunteer/events', [VolunteerController::class, 'viewEvents'])->name('volunteer.events');
    Route::get('/volunteers/calendar', [VolunteerController::class, 'viewCalendar'])->name('volunteer.calendar');
    Route::post('/volunteers/job-offers', [VolunteerController::class, 'addJobOffer'])->name('volunteer.addJobOffer');
    Route::post('/volunteers/{volunteer}/status', [VolunteerController::class, 'updateStatus'])->name('volunteers.updateStatus');
});

// Profile routes with auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Admin routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/applications', [ScholarshipController::class, 'index'])->name('admin.applications.index');
    Route::post('/applications/{id}/status', [ScholarshipController::class, 'updateStatus'])->name('admin.applications.updateStatus');
    // Student management
    Route::get('/students', [App\Http\Controllers\Admin\StudentController::class, 'index'])->name('admin.students.index');
    Route::post('/students/{tracking_code}/approve', [App\Http\Controllers\Admin\StudentController::class, 'approve'])->name('admin.students.approve');
    Route::post('/students/{tracking_code}/reject', [App\Http\Controllers\Admin\StudentController::class, 'reject'])->name('admin.students.reject');
    // Delete student application
    Route::delete('/students/{tracking_code}', [App\Http\Controllers\Admin\StudentController::class, 'destroy'])->name('admin.students.destroy');
});

// Admin Scholars Route
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/scholars', [AdminController::class, 'showScholars'])->name('admin.scholars');
});

// Admin Settings Route
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/settings', [AdminController::class, 'showSettings'])->name('admin.settings');
});

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Define the route for viewing jobs
Route::get('/jobs/listings', [JobListingController::class, 'index'])->name('jobs.listings');

// API route for job details (for modal)
Route::get('/api/job-listings/{id}', function($id) {
    return \App\Models\JobListing::findOrFail($id);
});

// Scholarship Application Routes
Route::get('/scholarship/apply', [App\Http\Controllers\ScholarshipController::class, 'showApplyForm'])->name('scholarship.apply.form');
Route::post('/scholarship/apply', [App\Http\Controllers\ScholarshipController::class, 'apply'])->name('scholarship.apply');
Route::get('/scholarship/success/{tracking_code}', [App\Http\Controllers\ScholarshipController::class, 'success'])->name('scholarship.success');
Route::match(['get', 'post'], '/scholarship/track', [App\Http\Controllers\ScholarshipController::class, 'track'])->name('scholarship.track');
Route::get('/scholarship/track/{tracking_code}', [App\Http\Controllers\ScholarshipController::class, 'show'])->name('scholarship.show');

// New route for students to view job listings
// Route::get('/jobs/listings', [JobListingController::class, 'index'])->name('jobs.listings');

// API route for job details (for modal)
// Route::get('/api/job-listings/{id}', function($id) {
//     return \App\Models\JobListing::findOrFail($id);
// });

// Route::get('/jobs', [JobListingController::class, 'index'])->name('jobs.index');

// Route::get('/admin/jobs/create', [JobListingController::class, 'create'])->name('jobs.create');
// Route::post('/admin/jobs', [JobListingController::class, 'store'])->name('jobs.store');

// Route::get('/admin/jobs', [JobListingController::class, 'adminIndex'])->name('jobs.admin.index');
// Route::get('/admin/jobs/{job}/edit', [JobListingController::class, 'edit'])->name('jobs.edit');
// Route::put('/admin/jobs/{job}', [JobListingController::class, 'update'])->name('jobs.update');
// Route::delete('/admin/jobs/{job}', [JobListingController::class, 'destroy'])->name('jobs.destroy');

// Route::post('/admin/jobs/{job}/approve', [JobListingController::class, 'approve'])->name('jobs.approve');
// Route::post('/admin/jobs/{job}/reject', [JobListingController::class, 'reject'])->name('jobs.reject');
