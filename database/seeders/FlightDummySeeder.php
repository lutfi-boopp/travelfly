<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Airline;
use App\Models\Flight;

class FlightDummySeeder extends Seeder
{
    public function run()
    {
        $airlines = Airline::all();
        $cities = ['Jakarta', 'Bali', 'Surabaya', 'Medan', 'Makassar', 'Yogyakarta', 'Bandung', 'Singapore', 'Kuala Lumpur', 'Bangkok'];
        
        foreach($airlines as $airline) {
            // Lewati jika maskapai sudah memiliki banyak penerbangan
            if (Flight::where('airline_id', $airline->id)->count() > 5) continue;

            for ($i = 0; $i < 5; $i++) {
                $origin = $cities[array_rand($cities)];
                do {
                    $dest = $cities[array_rand($cities)];
                } while ($dest === $origin);

                $dep = now()->addDays(rand(1, 30))->addHours(rand(0, 24))->setTime(rand(5, 23), 0);
                $arr = (clone $dep)->addHours(rand(1, 4));

                $flight = Flight::create([
                    'airline_id' => $airline->id,
                    'flight_number' => $airline->code . '-' . rand(100, 999),
                    'origin' => $origin,
                    'destination' => $dest,
                    'departure_time' => $dep,
                    'arrival_time' => $arr,
                    'price_economy' => rand(60, 250),
                    'price_business' => rand(300, 800),
                ]);

                // Generate Kursi Bisnis
                foreach (['1A', '1B', '1C', '1D'] as $seat) {
                    $flight->seats()->create(['seat_number' => $seat, 'class' => 'business', 'is_booked' => false]);
                }
                // Generate Kursi Ekonomi
                $economySeats = ['5A', '5B', '5C', '5D', '5E', '5F', '6A', '6B', '6C', '6D', '6E', '6F'];
                foreach ($economySeats as $seat) {
                    $flight->seats()->create(['seat_number' => $seat, 'class' => 'economy', 'is_booked' => false]);
                }
            }
        }
    }
}
