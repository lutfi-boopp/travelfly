<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightPassenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_booking_id',
        'seat_id',
        'name',
        'identity_number',
    ];

    public function booking()
    {
        return $this->belongsTo(FlightBooking::class, 'flight_booking_id');
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}
