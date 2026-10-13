<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\FlightBooking;
use App\Models\FlightPassenger;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlightBookingController extends Controller
{
    public function store(Request $request, Flight $flight)
    {
        $request->validate([
            'seat_ids' => 'required|array',
            'seat_ids.*' => 'exists:seats,id',
            'passenger_count' => 'required|integer|min:1|max:9',
            'passengers' => 'required|array',
            'passengers.*.name' => 'required|string|max:255',
            'passengers.*.id_number' => 'required|string|max:255',
        ]);

        if (count($request->seat_ids) !== (int)$request->passenger_count) {
            return back()->with('error', 'Please select exactly ' . $request->passenger_count . ' seat(s).');
        }

        $seats = Seat::whereIn('id', $request->seat_ids)->get();

        foreach ($seats as $seat) {
            if ($seat->is_booked) {
                return back()->with('error', 'One or more selected seats are already booked.');
            }
        }

        $totalPrice = 0;
        foreach ($seats as $seat) {
            $totalPrice += ($seat->class === 'business' ? $flight->price_business : $flight->price_economy);
        }

        $booking = FlightBooking::create([
            'user_id' => Auth::id(),
            'flight_id' => $flight->id,
            'booking_date' => now(),
            'passenger_count' => $request->passenger_count,
            'status' => 'pending',
            'total_price' => $totalPrice,
        ]);

        $booking->seats()->attach($request->seat_ids);

        foreach ($request->passengers as $seatId => $passengerData) {
            FlightPassenger::create([
                'flight_booking_id' => $booking->id,
                'seat_id' => $seatId,
                'name' => $passengerData['name'],
                'identity_number' => $passengerData['id_number'],
            ]);
        }

        return redirect()->route('payment.checkout', ['type' => 'App-Models-FlightBooking', 'id' => $booking->id]);
    }

    public function index()
    {
        $bookings = FlightBooking::with(['flight.airline', 'seats', 'passengers'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.bookings', compact('bookings'));
    }

    public function showDetails($id)
    {
        $booking = FlightBooking::with(['flight.airline', 'seats', 'passengers.seat', 'user'])
            ->findOrFail($id);

        if ($booking->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403);
        }

        return view('user.booking-details', compact('booking'));
    }

    public function cancel($id)
    {
        $booking = FlightBooking::with('seats')->findOrFail($id);

        if ($booking->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403);
        }

        if ($booking->status === 'cancelled') {
            return back()->with('error', 'Pesanan ini sudah dibatalkan.');
        }

        // Jika sudah dibayar, bebaskan kembali kursi-kursinya
        if ($booking->status === 'paid') {
            foreach ($booking->seats as $seat) {
                $seat->update(['is_booked' => false]);
            }
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
