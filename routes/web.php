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
use App\Http\Controllers\DonationController;
use App\Http\Controllers\UrgentFundsController;
use App\Http\Controllers\Admin\CampaignController as AdminCampaignController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//login Routes

// Admin Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/applications', [ScholarshipController::class, 'index'])->name('admin.applications.index');
    Route::post('/applications/{id}/status', [ScholarshipController::class, 'updateStatus'])->name('admin.applications.updateStatus');
    Route::get('/scholars', [AdminController::class, 'showScholars'])->name('admin.scholars');
    Route::get('/settings', [AdminController::class, 'showSettings'])->name('admin.settings');
    Route::put('/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
    Route::resource('jobs', \App\Http\Controllers\Admin\JobListingController::class);
    Route::post('jobs/{job}/approve', [\App\Http\Controllers\Admin\JobListingController::class, 'approve'])->name('jobs.approve');
    Route::post('jobs/{job}/reject', [\App\Http\Controllers\Admin\JobListingController::class, 'reject'])->name('jobs.reject');

    // Admin Volunteer Management Routes
    Route::get('/admin/volunteers', [App\Http\Controllers\AdminController::class, 'volunteerIndex'])->name('admin.volunteers.index');
    Route::post('/admin/volunteers/{volunteer}/approve', [App\Http\Controllers\AdminController::class, 'approveVolunteer'])->name('admin.volunteers.approve');
    Route::post('/admin/volunteers/{volunteer}/reject', [App\Http\Controllers\AdminController::class, 'rejectVolunteer'])->name('admin.volunteers.reject');

    // Admin Donation Routes
    Route::get('/donations', [App\Http\Controllers\Admin\DonationController::class, 'adminDonation'])->name('admin.donations.index');
    Route::get('/admin/donations', [App\Http\Controllers\Admin\DonationController::class, 'adminDonation'])->name('admin.donations.add');
    Route::patch('/donations/{donation}/status', [App\Http\Controllers\Admin\DonationController::class, 'updateStatus'])->name('admin.donations.update-status');

    // Route to serve private donation proof images
    Route::get('/donations/proof/{filename}', [App\Http\Controllers\Admin\DonationController::class, 'serveProofImage'])->name('admin.donations.serve-proof');
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

// Student routes
Route::middleware(['auth', \App\Http\Middleware\RedirectIfNotStudent::class])->prefix('student')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('student.dashboard');
});

// Other routes...

// Dashboard and User Management routes without auth
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Public Volunteer Dashboard Route (no auth required)
Route::get('/volunteer_dashboard', [VolunteerController::class, 'dashboard'])->name('volunteer.dashboard');

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

// Volunteer routes with auth (moved outside the main authenticated group)
Route::middleware(['auth'])->group(function () {
    Route::post('/volunteers', [VolunteerController::class, 'store'])->name('volunteers.store');
    Route::get('/volunteer/events', [VolunteerController::class, 'viewEvents'])->name('volunteer.events');
    Route::get('/volunteers/calendar', [VolunteerController::class, 'viewCalendar'])->name('volunteer.calendar');
    Route::post('/volunteers/job-offers', [VolunteerController::class, 'addJobOffer'])->name('volunteer.addJobOffer');
    Route::post('/volunteers/{volunteer}/status', [VolunteerController::class, 'updateStatus'])->name('volunteers.updateStatus');

    // New routes for volunteer dashboard and job post
    Route::get('/volunteer/dashboard', [VolunteerController::class, 'dashboard'])->name('volunteer.dashboard');
    Route::get('/volunteer/job-post', [VolunteerController::class, 'jobPost'])->name('volunteer.job-post');
    // Route to handle volunteer job post submission
    Route::post('/volunteer/job-post', [VolunteerController::class, 'storeJobPost'])->name('volunteer.jobs.store');
});

// Student Applications Route with auth
Route::middleware(['auth'])->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('admin.students.index');
});

// Admin routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/applications', [ScholarshipController::class, 'index'])->name('admin.applications.index');
    Route::post('/applications/{id}/status', [ScholarshipController::class, 'updateStatus'])->name('admin.applications.updateStatus');
    // Student management
    Route::get('/students', [App\Http\Controllers\Admin\StudentController::class, 'index'])
        ->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
        ->name('admin.students.index.shortcut');
    Route::post('/students/{tracking_code}/approve', [App\Http\Controllers\Admin\StudentController::class, 'approve'])->name('admin.students.approve');
    Route::post('/students/{tracking_code}/reject', [App\Http\Controllers\Admin\StudentController::class, 'reject'])->name('admin.students.reject');
    // Delete student application
    Route::delete('/students/{tracking_code}', [App\Http\Controllers\Admin\StudentController::class, 'destroy'])->name('admin.students.destroy');

    // Delete student user
    Route::delete('/students/user/{id}', [App\Http\Controllers\Admin\StudentController::class, 'destroyUser'])->name('admin.students.destroyUser');

    // Admin Volunteer Management
    Route::get('/volunteers', [App\Http\Controllers\AdminController::class, 'volunteerIndex'])->name('admin.volunteers.index');

    // Urgent Funds Routes
    Route::get('/urgent-funds', [UrgentFundsController::class, 'index'])->name('admin.urgent-funds.index');
    Route::get('/urgent-funds/create', [UrgentFundsController::class, 'create'])->name('admin.urgent-funds.create');
    Route::post('/urgent-funds', [UrgentFundsController::class, 'store'])->name('admin.urgent-funds.store');
    Route::get('/urgent-funds/{campaign}/edit', [UrgentFundsController::class, 'edit'])->name('admin.urgent-funds.edit');
    Route::put('/urgent-funds/{campaign}', [UrgentFundsController::class, 'update'])->name('admin.urgent-funds.update');
    Route::delete('/urgent-funds/{campaign}', [UrgentFundsController::class, 'destroy'])->name('admin.urgent-funds.destroy');

    // Campaign Management Routes
    Route::resource('/campaigns', AdminCampaignController::class)->names('admin.campaigns');

    // Donations Routes
    Route::get('/donations', [App\Http\Controllers\Admin\DonationController::class, 'index'])->name('admin.donations.index');
    Route::get('/donations/create', [App\Http\Controllers\Admin\DonationController::class, 'create'])->name('admin.donations.create');
    Route::post('/donations', [App\Http\Controllers\Admin\DonationController::class, 'store'])->name('admin.donations.store');
    Route::get('/donations/{donation}', [App\Http\Controllers\Admin\DonationController::class, 'show'])->name('admin.donations.show');
    Route::get('/donations/{donation}/edit', [App\Http\Controllers\Admin\DonationController::class, 'edit'])->name('admin.donations.edit');
    Route::put('/donations/{donation}', [App\Http\Controllers\Admin\DonationController::class, 'update'])->name('admin.donations.update');
    Route::delete('/donations/{donation}', [App\Http\Controllers\Admin\DonationController::class, 'destroy'])->name('admin.donations.destroy');
    Route::put('/donations/{donation}/status', [App\Http\Controllers\Admin\DonationController::class, 'updateStatus'])->name('admin.donations.update-status');
    Route::get('/donations/dropoffs', [App\Http\Controllers\Admin\DonationController::class, 'dropoffs'])->name('admin.donations.dropoffs');

    // Category Management
    Route::resource('categories', CategoryController::class);
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

// Public Job Listing Routes
Route::get('/jobs', [JobListingController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobListingController::class, 'show'])->name('jobs.show');
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
Route::get('/jobs/listings', [JobListingController::class, 'index'])->name('jobs.listings');

Route::get('/admin/jobs/create', [JobListingController::class, 'create'])->name('jobs.create');
Route::post('/admin/jobs', [JobListingController::class, 'store'])->name('jobs.store');

Route::get('/admin/jobs', [JobListingController::class, 'adminIndex'])->name('jobs.admin.index');
Route::get('/admin/jobs/{job}/edit', [JobListingController::class, 'edit'])->name('jobs.edit');
Route::put('/admin/jobs/{job}', [JobListingController::class, 'update'])->name('jobs.update');
Route::delete('/admin/jobs/{job}', [JobListingController::class, 'destroy'])->name('jobs.destroy');

Route::post('/admin/jobs/{job}/approve', [JobListingController::class, 'approve'])->name('jobs.approve');
Route::post('/admin/jobs/{job}/reject', [JobListingController::class, 'reject'])->name('jobs.reject');

// Public Donation Routes (no auth required)
Route::get('/donate', function () {
    return view('donation.donation');
})->name('donation');

Route::get('/donation', function () {
    return view('donation.donation');
})->name('donation');

Route::post('/monetary-donation/submit', [DonationController::class, 'submitMonetaryDonation'])->name('monetary_donation.submit');

// Non-Monetary Donation Routes
Route::get('/non-monetary-donation', function () {
    return view('donation.nonmonetary');
})->name('non_monetary');

Route::post('/non-monetary-donation/submit', [DonationController::class, 'submitNonMonetaryDonation'])->name('non_monetary.submit');

// Campaign Calendar Route
Route::get('/user/calendar', function () {
    return view('donation.usercalendar');
})->name('user.calendar');

Route::get('/monetary-donation', function () {
    return view('donation.monetary');
})->name('monetary_donation');

// Admin Donation Routes (protected by auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/donations', [App\Http\Controllers\Admin\DonationController::class, 'adminDonation'])->name('admin.donations.add');
    Route::get('/admin/donation', [App\Http\Controllers\Admin\DonationController::class, 'index'])->name('admin.donation.index');
    Route::patch('/donations/{donation}/status', [App\Http\Controllers\Admin\DonationController::class, 'updateStatus'])->name('admin.donations.update-status');
});

// Admin redirect
Route::get('/admin', function () {
    return redirect()->route('admin.donations.add');
});