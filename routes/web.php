<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\FlightBookingController;
use App\Http\Controllers\PaymentController;
use App\Models\Airline;
use App\Models\Flight;

Route::get('/', function () {
    $origins = Flight::distinct()->pluck('origin');
    $destinations = Flight::distinct()->pluck('destination');
    
    // Ambil destinasi populer unik (maks 6) beserta harga termurahnya
    $popularDestinations = Flight::select('destination', DB::raw('MIN(price_economy) as min_price'))
        ->groupBy('destination')
        ->limit(6)
        ->get();

    return view('home', compact('origins', 'destinations', 'popularDestinations'));
})->name('home');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public User Routes
Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
Route::get('/flights/{flight}', [FlightController::class, 'show'])->name('flights.show');

// Protected User Routes
Route::middleware('auth')->group(function () {
    // Flight Booking
    Route::post('/flights/{flight}/book', [FlightBookingController::class, 'store'])->name('flight.book');

    // Payments
    Route::get('/payment/{type}/{id}', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');

    // E-Ticket
    Route::get('/ticket/{type}/{id}', [App\Http\Controllers\TicketController::class, 'show'])->name('ticket.print');

    // User Dashboard/Bookings
    Route::get('/my-bookings', [\App\Http\Controllers\FlightBookingController::class, 'index'])->name('user.bookings');
    Route::get('/bookings/{id}/details', [\App\Http\Controllers\FlightBookingController::class, 'showDetails'])->name('bookings.details');
    Route::post('/bookings/{id}/cancel', [\App\Http\Controllers\FlightBookingController::class, 'cancel'])->name('bookings.cancel');
});
