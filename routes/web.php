<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/', [KamarController::class, 'userHome'])->name('home');
Route::get('/room', [KamarController::class, 'userIndex'])->name('user.room');
Route::get('/room/{id}', [KamarController::class, 'show'])->name('room.detail');
Route::get('/check-availability', [BookingController::class, 'checkAvailability'])->name('checkAvailability');



Route::middleware(['auth'])->group(function () {
    Route::resource('/booking', BookingController::class)->except(['create', 'edit']);
    Route::get('/payment/{kamar_id}', [BookingController::class, 'createPayment'])->name('booking.createPayment');
    Route::post('/payment/process/{kamar_id}', [BookingController::class, 'storePayment'])->name('booking.storePayment');
    Route::get('/bookings', [BookingController::class, 'userBookings'])->name('user.bookings');
    Route::get('/profile', [UserController::class, 'edit'])->name('user.profile');
    Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update');
    Route::get('/booking/download/{id}', [BookingController::class, 'downloadPdf'])->name('booking.download');
   
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('kategori', KategoriController::class);
    Route::resource('kamar', KamarController::class);
    Route::resource('booking', BookingController::class);
    Route::resource('about', AboutController::class);
    Route::put('booking/{id}/confirm', [BookingController::class, 'confirm'])->name('booking.confirm');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/download', [LaporanController::class, 'downloadPDF'])->name('laporan.download');
    Route::get('/laporan/user-pdf', [LaporanController::class, 'downloadUserPDF'])->name('laporan.downloadUserPDF');
    Route::post('/admin/laporan/keuangan', [LaporanController::class, 'downloadKeuanganPDF'])->name('laporan.keuangan.pdf');



    Route::resource('pengunjung', UserController::class)->names([
        'index' => 'admin.pengunjung',
        'create' => 'admin.pengunjung.create',
        'store' => 'admin.pengunjung.store',
        'show' => 'admin.pengunjung.show',
        'edit' => 'admin.pengunjung.edit',
        'destroy' => 'admin.pengunjung.destroy',
    ]);
    Route::put('pengunjung/{user}', [UserController::class, 'update'])->name('admin.pengunjung.updatez');

});
