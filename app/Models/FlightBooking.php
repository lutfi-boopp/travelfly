<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{
    protected $fillable = ['user_id', 'flight_id', 'booking_date', 'status', 'total_price', 'passenger_count'];

    protected $casts = [
        'booking_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function seats()
    {
        return $this->belongsToMany(Seat::class, 'flight_booking_seat');
    }

    public function passengers()
    {
        return $this->hasMany(FlightPassenger::class);
    }

    public function payment()
    {
        return $this->morphOne(Payment::class, 'booking');
    }
}
