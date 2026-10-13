<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Airline;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::with('airline')->paginate(10);
        return view('admin.flights.index', compact('flights'));
    }

    public function create()
    {
        $airlines = Airline::all();
        return view('admin.flights.create', compact('airlines'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'airline_id' => 'required|exists:airlines,id',
            'flight_number' => 'required|string',
            'origin' => 'required|string',
            'destination' => 'required|string',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'price_economy' => 'required|numeric',
            'price_business' => 'required|numeric',
        ]);

        $flight = Flight::create($validated);
        
        // Generate seats automatically (Airplane Layout)
        // Business Class (Rows 1-4, Seats A,B and E,F)
        for ($row = 1; $row <= 4; $row++) {
            foreach (['A', 'B', 'E', 'F'] as $letter) {
                \App\Models\Seat::create([
                    'flight_id' => $flight->id,
                    'seat_number' => $row . $letter,
                    'class' => 'business',
                    'is_booked' => false,
                ]);
            }
        }
        
        // Economy Class (Rows 5-14, Seats A,B,C and D,E,F)
        for ($row = 5; $row <= 14; $row++) {
            foreach (['A', 'B', 'C', 'D', 'E', 'F'] as $letter) {
                \App\Models\Seat::create([
                    'flight_id' => $flight->id,
                    'seat_number' => $row . $letter,
                    'class' => 'economy',
                    'is_booked' => false,
                ]);
            }
        }

        return redirect()->route('admin.flights.index')->with('success', 'Flight created successfully.');
    }

    public function edit(Flight $flight)
    {
        $airlines = Airline::all();
        return view('admin.flights.edit', compact('flight', 'airlines'));
    }

    public function update(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'airline_id' => 'required|exists:airlines,id',
            'flight_number' => 'required|string',
            'origin' => 'required|string',
            'destination' => 'required|string',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'price_economy' => 'required|numeric',
            'price_business' => 'required|numeric',
        ]);

        $flight->update($validated);
        return redirect()->route('admin.flights.index')->with('success', 'Flight updated successfully.');
    }

    public function destroy(Flight $flight)
    {
        // Delete associated seats and bookings first if needed (usually handled by DB cascade or manually)
        $flight->seats()->delete();
        \App\Models\FlightBooking::where('flight_id', $flight->id)->delete();
        $flight->delete();

        return redirect()->route('admin.flights.index')->with('success', 'Flight deleted successfully.');
    }
}
