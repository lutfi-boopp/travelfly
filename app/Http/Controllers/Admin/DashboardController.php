<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Flight;
use App\Models\FlightBooking;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_users = User::count();
        $total_flights = Flight::count();
        $total_flight_bookings = FlightBooking::count();
        $total_revenue = Payment::where('status', 'success')->sum('amount');

        $recent_bookings = Payment::with('user')->orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'total_users', 'total_flights', 
            'total_flight_bookings', 
            'total_revenue', 'recent_bookings'
        ));
    }
}
