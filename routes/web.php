<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\EventController;
use App\Models\Campaign;
use App\Http\Controllers\Admin\CalendarCampaignController;
use App\Http\Controllers\Admin\CalendarCategoryController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicDonationController;
use App\Http\Controllers\UserCalendarController;

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

// Public routes
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminController::class, 'login']);
});
Route::post('logout', [AdminController::class, 'logout'])->name('logout');

// Admin Protected Routes
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        
        // Events
        Route::get('events', [EventController::class, 'index'])->name('events.index');
        Route::get('events/create', [EventController::class, 'create'])->name('events.create');
        Route::post('events', [EventController::class, 'store'])->name('events.store');
        Route::get('events/{event}', [EventController::class, 'show'])->name('events.show');
        Route::get('events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::put('events/{event}', [EventController::class, 'update'])->name('events.update');
        Route::delete('events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
        Route::get('events/json', [EventController::class, 'getEventsJson'])->name('events.json');
        Route::get('events/upcoming', [EventController::class, 'getUpcomingEvents'])->name('events.upcoming');
        
        // Categories
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->names([
            'index' => 'categories.index',
            'create' => 'categories.create',
            'store' => 'categories.store',
            'show' => 'categories.show',
            'edit' => 'categories.edit',
            'update' => 'categories.update',
            'destroy' => 'categories.destroy'
        ]);
        
        // Calendar Routes
        Route::get('/calendar', [\App\Http\Controllers\Admin\CalendarController::class, 'index'])->name('calendar.index');
        Route::post('/calendar', [\App\Http\Controllers\Admin\CalendarController::class, 'store'])->name('calendar.store');
        Route::put('/calendar/{campaign}', [\App\Http\Controllers\Admin\CalendarController::class, 'update'])->name('calendar.update');
        Route::delete('/calendar/{campaign}', [\App\Http\Controllers\Admin\CalendarController::class, 'destroy'])->name('calendar.destroy');

        // Volunteers
        Route::get('volunteers', [AdminController::class, 'volunteerIndex'])->name('volunteers.index');
        Route::post('volunteers/{volunteer}/approve', [AdminController::class, 'approveVolunteer'])->name('volunteers.approve');
        Route::post('volunteers/{volunteer}/reject', [AdminController::class, 'rejectVolunteer'])->name('volunteers.reject');

        // Students
        Route::get('students', [StudentController::class, 'index'])->name('students.index');
        Route::post('students/{tracking_code}/approve', [StudentController::class, 'approve'])->name('students.approve');
        Route::post('students/{tracking_code}/reject', [StudentController::class, 'reject'])->name('students.reject');
        Route::delete('students/{tracking_code}', [StudentController::class, 'destroy'])->name('students.destroy');
        Route::delete('students/user/{id}', [StudentController::class, 'destroyUser'])->name('students.destroyUser');

        // Donations
        Route::get('donations', [DonationController::class, 'index'])->name('donations.index');
        Route::get('donations/create', [DonationController::class, 'create'])->name('donations.create');
        Route::post('donations', [DonationController::class, 'store'])->name('donations.store');
        Route::get('donations/dropoffs', [DonationController::class, 'dropoffs'])->name('donations.dropoffs');
        Route::get('donations/all', [DonationController::class, 'allDonors'])->name('donations.all');
        Route::get('donations/all-donors', [DonationController::class, 'allDonors'])->name('donations.all-donors');
        Route::get('donations/proof/{filename}', [DonationController::class, 'serveProofImage'])->name('donations.serve-proof');
        Route::get('donations/{donation}', [DonationController::class, 'show'])->name('donations.show');
        Route::get('donations/{donation}/edit', [DonationController::class, 'edit'])->name('donations.edit');
        Route::put('donations/{donation}', [DonationController::class, 'update'])->name('donations.update');
        Route::delete('donations/{donation}', [DonationController::class, 'destroy'])->name('donations.destroy');
        Route::patch('donations/{donation}/status', [DonationController::class, 'updateStatus'])->name('donations.update-status');

        
        // Campaigns
        Route::get('campaigns/dashboard', [CampaignController::class, 'dashboard'])->name('campaigns.dashboard');
        Route::resource('campaigns', \App\Http\Controllers\Admin\CampaignController::class)->names([
            'index' => 'campaigns.index',
            'create' => 'campaigns.create',
            'store' => 'campaigns.store',
            'show' => 'campaigns.show',
            'edit' => 'campaigns.edit',
            'update' => 'campaigns.update',
            'destroy' => 'campaigns.destroy',
        ]);
        Route::patch('campaigns/{campaign}/status', [CampaignController::class, 'updateStatus'])->name('campaigns.update-status');

        // Calendar Campaign Routes
        Route::get('calendar-campaigns/create', [\App\Http\Controllers\Admin\CalendarCampaignController::class, 'create'])->name('calendar-campaigns.create');
        Route::post('calendar-campaigns', [\App\Http\Controllers\Admin\CalendarCampaignController::class, 'store'])->name('calendar-campaigns.store');
        
        // Calendar Categories Routes
        Route::resource('calendar-categories', \App\Http\Controllers\Admin\CalendarCategoryController::class);

        // Campaigns Categories Routes
        Route::resource('campaigns-categories', App\Http\Controllers\Admin\CategoryController::class);
    });
});

// Job Routes (both public and admin)
Route::middleware(['auth'])->group(function () {
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
    Route::post('/jobs/{job}/approve', [JobController::class, 'approve'])->name('jobs.approve');
    Route::post('/jobs/{job}/reject', [JobController::class, 'reject'])->name('jobs.reject');
});

// Scholarship Routes
Route::group(['prefix' => 'scholarship'], function () {
    Route::get('/apply', [ScholarshipController::class, 'showApplyForm'])->name('scholarship.apply.form');
    Route::post('/apply', [ScholarshipController::class, 'apply'])->name('scholarship.apply');
    Route::get('/status/{tracking_code}', [ScholarshipController::class, 'show'])->name('scholarship.show');
    Route::match(['get', 'post'], '/track', [ScholarshipController::class, 'track'])->name('scholarship.track');
    // Resend tracking code by email
    Route::post('/resend', [ScholarshipController::class, 'resendCode'])->name('scholarship.resend');
});

// Student routes
Route::middleware(['auth', \App\Http\Middleware\RedirectIfNotStudent::class])->prefix('student')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('student.dashboard');
});

// Other routes...

// Dashboard and User Management routes without auth
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DonationController::class, 'index'])->name('dashboard');
});

// Public Volunteer Dashboard Route (no auth required)
Route::get('/volunteer_dashboard', [VolunteerController::class, 'dashboard'])->name('volunteer.dashboard');

// User management routes with auth
Route::middleware(['auth'])->group(function () {
    // Route::get('/users', [UserController::class, 'index'])->name('users.index');
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

   
    // Category Management
    Route::resource('categories', CategoryController::class)->names('admin.categories');
});

// Admin Scholars Route
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/scholars', [AdminController::class, 'showScholars'])->name('admin.scholars');
});

// Admin Settings Route
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/settings', [AdminController::class, 'showSettings'])->name('admin.settings');
});

// Public Job Listing Routes
Route::get('/jobs/listings', [JobController::class, 'index'])->name('jobs.listings');

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
Route::get('/jobs/listings', [JobController::class, 'index'])->name('jobs.listings');

Route::get('/admin/jobs/create', [JobController::class, 'create'])->name('jobs.create');
Route::post('/admin/jobs', [JobController::class, 'store'])->name('jobs.store');

Route::get('/admin/jobs', [JobController::class, 'index'])->name('jobs.admin.index');
Route::get('/admin/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
Route::put('/admin/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
Route::delete('/admin/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');

Route::post('/admin/jobs/{job}/approve', [JobController::class, 'approve'])->name('jobs.approve');
Route::post('/admin/jobs/{job}/reject', [JobController::class, 'reject'])->name('jobs.reject');

// Public Donation Routes (no auth required)
Route::get('/donate', function () {
    $topDonors = \App\Models\Donation::where('type', 'monetary')
        ->where('status', 'completed')
        ->where('is_anonymous', false)
        ->orderBy('amount', 'desc')
        ->take(3)
        ->get();
    
    return view('donation.donation', compact('topDonors'));
})->name('donation');

Route::get('/donation', [DonationController::class, 'index'])->name('admin.donation.index');

Route::post('/monetary-donation/submit', [App\Http\Controllers\PublicDonationController::class, 'submitMonetaryDonation'])->name('monetary_donation.submit');

// Add non-monetary donation route
Route::get('/non-monetary-donation', function () {
    return view('donation.nonmonetary');
})->name('non_monetary');

// Public User Calendar Route (for Join Campaign button)
Route::get('/user-calendar', [UserCalendarController::class, 'index'])->name('user.calendar');

Route::get('/monetary-donation', function () {
    return view('donation.monetary');
})->name('monetary_donation');

// Admin redirect
Route::get('/admin', function () {
    return redirect()->route('admin.donations.index');
});

Route::get('/debug-database', [App\Http\Controllers\PublicDonationController::class, 'debugDatabase']);

// For monetary donations
Route::post('/donations/monetary', [App\Http\Controllers\PublicDonationController::class, 'storeMonetary'])->name('donations.monetary.store');

// For non-monetary donations
Route::post('/donations/non-monetary', [App\Http\Controllers\PublicDonationController::class, 'storeNonMonetary'])->name('donations.non-monetary.store');

Route::post('/non-monetary-donation', [PublicDonationController::class, 'submitNonMonetaryDonation'])->name('non_monetary.submit');

// Get total monetary donations (moved to DonationController)
Route::get('/donations/total', [App\Http\Controllers\PublicDonationController::class, 'getMonetaryTotal'])->name('donations.total');