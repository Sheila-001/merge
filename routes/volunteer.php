<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\JobController;

Route::middleware(['auth'])->group(function () {
    Route::get('/volunteer_dashboard', [VolunteerController::class, 'dashboard'])->name('volunteer.dashboard');
    Route::get('/volunteer/events', [VolunteerController::class, 'viewEvents'])->name('volunteer.events');
    Route::get('/volunteers/calendar', [VolunteerController::class, 'viewCalendar'])->name('volunteer.calendar');
    Route::post('/volunteers/job-offers', [VolunteerController::class, 'addJobOffer'])->name('volunteer.addJobOffer');
}); 