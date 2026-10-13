<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\FlightBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function checkout($type, $id)
    {
        // $type will be 'App\Models\FlightBooking' or 'App\Models\HotelBooking'
        // For safer routing, we can sanitize or match it
        
        $bookingType = str_replace('-', '\\', $type);
        if ($bookingType !== 'App\Models\FlightBooking') {
            return redirect('/')->with('error', 'Invalid booking type.');
        }

        $booking = $bookingType::with(['flight.airline', 'seats', 'passengers.seat'])->findOrFail($id);

        if ($booking->user_id !== Auth::id()) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        if ($booking->status === 'paid') {
            return redirect('/')->with('error', 'Booking is already paid.');
        }

        if ($booking->status === 'cancelled') {
            return redirect('/')->with('error', 'Pesanan ini sudah dibatalkan dan tidak bisa dibayar.');
        }

        return view('payments.checkout', compact('booking', 'type'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|integer',
            'booking_type' => 'required|string',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string'
        ]);

        $type = str_replace('-', '\\', $request->booking_type);
        $booking = $type::findOrFail($request->booking_id);

        $payment = Payment::create([
            'user_id' => Auth::id(),
            'booking_id' => $booking->id,
            'booking_type' => $type,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'status' => 'success', // Simulated success
        ]);

        // Update booking status
        $booking->update(['status' => 'paid']);

        // Update Seat metrics if flight
        if ($type === 'App\Models\FlightBooking') {
            foreach ($booking->seats as $seat) {
                $seat->update(['is_booked' => true]);
            }
        }

        return redirect()->route('user.bookings')->with('success', 'Payment successful! Your booking is confirmed.');
    }
}
