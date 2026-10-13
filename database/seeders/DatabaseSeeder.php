<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Airline;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@travelfly.com'],
            [
                'name' => 'Admin TravelFly',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]
        );

        $airlines = [
            ['name' => 'Garuda Indonesia', 'code' => 'GA'],
            ['name' => 'Singapore Airlines', 'code' => 'SQ'],
            ['name' => 'Qatar Airways', 'code' => 'QR'],
            ['name' => 'Citilink', 'code' => 'QG'],
            ['name' => 'Batik Air', 'code' => 'ID'],
            ['name' => 'Super Air Jet', 'code' => 'IU'],
            ['name' => 'Sriwijaya Air', 'code' => 'SJ'],
            ['name' => 'AirAsia Indonesia', 'code' => 'QZ'],
            ['name' => 'Pelita Air', 'code' => 'IP'],
            ['name' => 'Lion Air', 'code' => 'JT'],
            ['name' => 'Emirates', 'code' => 'EK'],
            ['name' => 'Cathay Pacific', 'code' => 'CX'],
            ['name' => 'ANA All Nippon Airways', 'code' => 'NH'],
            ['name' => 'Turkish Airlines', 'code' => 'TK'],
            ['name' => 'Malaysia Airlines', 'code' => 'MH'],
            ['name' => 'Japan Airlines', 'code' => 'JL']
        ];

        foreach ($airlines as $airline) {
            Airline::firstOrCreate(
                ['code' => $airline['code']],
                ['name' => $airline['name']]
            );
        }
    }
}
