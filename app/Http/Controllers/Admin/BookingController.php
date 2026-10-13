<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlightBooking;

class BookingController extends Controller
{
    public function index()
    {
        $flightBookings = FlightBooking::with(['user', 'flight.airline', 'seats'])->latest()->paginate(10);

        return view('admin.bookings.index', compact('flightBookings'));
    }
}
