<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Public Routes
Route::get('/', [KamarController::class, 'userHome'])->name('home');
Route::get('/room', [KamarController::class, 'userIndex'])->name('user.room');
Route::get('/room/{id}', [KamarController::class, 'show'])->name('room.detail');
Route::post('/check-availability', [BookingController::class, 'checkAvailability'])->name('checkAvailability');

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    // Booking Routes for Authenticated Users
    Route::resource('/booking', BookingController::class)->except(['create', 'edit']);
    Route::get('/payment/{kamar_id}', [BookingController::class, 'createPayment'])->name('booking.createPayment');
    Route::post('/payment/process/{kamar_id}', [BookingController::class, 'storePayment'])->name('booking.storePayment');
    Route::get('/bookings', [BookingController::class, 'userBookings'])->name('user.bookings');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('kategori', KategoriController::class);
    Route::resource('kamar', KamarController::class);
    Route::resource('pengunjung', UserController::class);
    Route::resource('booking', BookingController::class);
    Route::put('booking/{id}/confirm', [BookingController::class, 'confirm'])->name('booking.confirm');
});
