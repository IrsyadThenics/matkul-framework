<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\Api\BookingController;
use Illuminate\Support\Facades\Route;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Endpoint: http://127.0.0.1:8001/api/bookings
Route::get('/bookings', [BookingController::class, 'index']);