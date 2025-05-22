<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VolunteerController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Add the DELETE route for volunteers
Route::delete('/volunteers/{volunteer}', [VolunteerController::class, 'destroy']);
