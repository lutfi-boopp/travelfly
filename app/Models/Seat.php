<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = ['flight_id', 'seat_number', 'class', 'is_booked'];

    protected $casts = [
        'is_booked' => 'boolean',
    ];

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function bookings()
    {
        return $this->belongsToMany(FlightBooking::class, 'flight_booking_seat');
    }

    public function passenger()
    {
        return $this->hasOne(FlightPassenger::class);
    }
}
