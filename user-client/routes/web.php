<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//untuk menampilkan data di view untuk form booking
Route::get('/bookings', [App\Http\Controllers\BookingController::class, 'index'])->name('booking.index');