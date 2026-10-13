<?php

namespace App\Http\Controllers;

use App\Models\FlightBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function show($type, $id)
    {
        $bookingType = str_replace('-', '\\', $type);
        if ($bookingType !== 'App\Models\FlightBooking') {
            return redirect('/')->with('error', 'Invalid booking type.');
        }

        $booking = $bookingType::with(['flight.airline', 'seats'])->findOrFail($id);

        if ($booking->user_id !== Auth::id() && !Auth::user()->is_admin) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        if ($booking->status !== 'paid') {
            return redirect()->route('user.bookings')->with('error', 'Cannot print ticket for unpaid booking.');
        }

        return view('tickets.flight', compact('booking'));
    }
}
