<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JetskiPackageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PaymentApiController;

// Public routes
Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::post('/dashboard/book', [DashboardController::class, 'book']);
    Route::post('/dashboard/book', [BookingController::class, 'store'])->name('booking.store');

});

Route::post('/api/payment/token', [PaymentApiController::class, 'createToken'])->name('api.payment.token')->middleware('auth');

Route::middleware('auth')->prefix('dashboard')->group(function () {
    // Halaman dashboard user
    Route::get('/user', [UserController::class, 'dashboard'])->name('dashboard.user');

    // Halaman dashboard admin
    Route::get('/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
});

// Management User routes
Route::resource('/dashboard/users', UserController::class, ['as' => 'backend'])->middleware('auth');
Route::resource('/dashboard/bookings', BookingController::class, ['as' => 'backend'])->middleware('auth');
Route::resource('/dashboard/jetskipackages', JetskiPackageController::class, ['as' => 'backend'])->middleware('auth');
Route::resource('/dashboard/v_index', DashboardController::class, ['as' => 'backend'])->middleware('auth');
Route::get('/booking/success', [BookingController::class, 'paymentSuccess'])->name('payment.success')->middleware('auth');