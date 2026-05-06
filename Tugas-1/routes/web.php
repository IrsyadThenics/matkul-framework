<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('About');
});

Route::get('/contact', function () {
    return view('Contact');
});

Route::get('/HalamanFitur', function () {
    return view('HalamanFitur');
});

// Auth Routes
//Route::get('/login', [AdminController::class, 'login'])->name('login');
//Route::post('/login', [AdminController::class, 'loginPost'])->name('login.post');
//Route::get('/register', [AdminController::class, 'register'])->name('register');
//Route::post('/register', [AdminController::class, 'store'])->name('register.post');
//Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

// Protected Routes
//Route::middleware(['auth'])->group(function () {
    // Dashboard Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // Resource routes
    Route::resource('admins', AdminController::class);
    Route::resource('courts', CourtController::class);
    Route::resource('jadwal', JadwalController::class);
//Route::resource('bookings', BookingController::class);
//});
