<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FlightController;
use App\Http\Controllers\Admin\AirlineController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\PaymentController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Flights Management
Route::resource('flights', FlightController::class);

// Airlines Management
Route::resource('airlines', AirlineController::class);

// Bookings
Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::get('bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');

// Payments
Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
Route::post('payments/{id}/status', [PaymentController::class, 'updateStatus'])->name('payments.updateStatus');
