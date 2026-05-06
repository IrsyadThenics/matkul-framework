<?php

use App\Http\Controllers\api\BookingController;
use Illuminate\Support\Facades\Route;

// Gunakan middleware 'api' agar tidak mengecek CSRF token (cocok untuk REST API)
Route::middleware('api')->group(function () {
    
    // apiResource sudah mencakup: index, store, show, update, destroy
    Route::apiResource('bookings', BookingController::class);
    
    // Route tambahan (Gunakan PATCH/POST)
    Route::patch('/bookings/{id}/approve', [BookingController::class, 'approve']);
    Route::patch('/bookings/{id}/reject', [BookingController::class, 'reject']);
    Route::get('/users/{userId}/bookings', [BookingController::class, 'byUser']);
});