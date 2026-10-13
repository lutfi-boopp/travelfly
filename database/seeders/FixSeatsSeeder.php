<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Flight;

class FixSeatsSeeder extends Seeder
{
    public function run()
    {
        $flights = Flight::all();
        foreach($flights as $flight) {
            // Jika kursi sudah banyak (lebih dari 30), lewati saja agar tidak menimpa data yang valid
            if ($flight->seats()->count() > 30) continue; 
            
            // Hapus kursi lama yang sedikit
            $flight->seats()->delete();

            // Buat kursi Bisnis (Baris 1-3, 4 kursi per baris)
            for ($r = 1; $r <= 3; $r++) {
                foreach(['A', 'B', 'C', 'D'] as $c) {
                    $flight->seats()->create(['seat_number' => $r.$c, 'class' => 'business', 'is_booked' => false]);
                }
            }

            // Buat kursi Ekonomi (Baris 4-15, 6 kursi per baris)
            for ($r = 4; $r <= 15; $r++) {
                foreach(['A', 'B', 'C', 'D', 'E', 'F'] as $c) {
                    $flight->seats()->create(['seat_number' => $r.$c, 'class' => 'economy', 'is_booked' => false]);
                }
            }
        }
    }
}
