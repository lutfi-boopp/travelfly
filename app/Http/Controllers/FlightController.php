<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Airline;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $airlines = Airline::all();
        $origins = Flight::distinct()->pluck('origin');
        $destinations = Flight::distinct()->pluck('destination');
        $query = Flight::with('airline');

        if ($request->filled('origin')) {
            $query->where('origin', 'like', '%' . $request->origin . '%');
        }
        if ($request->filled('destination')) {
            $query->where('destination', 'like', '%' . $request->destination . '%');
        }
        if ($request->filled('date')) {
            $query->whereDate('departure_time', $request->date);
        }

        $flights = $query->orderBy('departure_time', 'asc')->get();

        return view('flights.index', compact('flights', 'origins', 'destinations'));
    }

    public function show(Flight $flight)
    {
        $flight->load('airline', 'seats');
        return view('flights.show', compact('flight'));
    }
}
