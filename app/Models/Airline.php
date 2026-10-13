<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    protected $fillable = ['name', 'code', 'logo'];

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }

    public function getLogoUrlAttribute()
    {
        if (!empty($this->logo)) {
            if (str_starts_with($this->logo, 'http://') || str_starts_with($this->logo, 'https://')) {
                return $this->logo;
            }
            if (file_exists(public_path($this->logo))) {
                return asset($this->logo);
            }
            return asset('storage/' . $this->logo);
        }

        $code = strtoupper(trim($this->code ?? ''));
        if (file_exists(public_path("images/airlines/{$code}.png"))) {
            return asset("images/airlines/{$code}.png");
        }

        // Dedicated verified logos for Indonesian & international carriers
        $onlineLogos = [
            'GA' => 'https://images.kiwi.com/airlines/128/GA.png', // Garuda Indonesia
            'QG' => 'https://images.kiwi.com/airlines/128/QG.png', // Citilink
            'JT' => 'https://images.kiwi.com/airlines/128/JT.png', // Lion Air
            'ID' => 'https://images.kiwi.com/airlines/128/ID.png', // Batik Air
            'IU' => 'https://images.kiwi.com/airlines/128/IU.png', // Super Air Jet
            'SJ' => 'https://images.kiwi.com/airlines/128/SJ.png', // Sriwijaya Air
            'QZ' => 'https://images.kiwi.com/airlines/128/QZ.png', // AirAsia Indonesia
            'IP' => 'https://images.kiwi.com/airlines/128/IP.png', // Pelita Air
            'SQ' => 'https://images.kiwi.com/airlines/128/SQ.png', // Singapore Airlines
            'QR' => 'https://images.kiwi.com/airlines/128/QR.png', // Qatar Airways
            'EK' => 'https://images.kiwi.com/airlines/128/EK.png', // Emirates
            'CX' => 'https://images.kiwi.com/airlines/128/CX.png', // Cathay Pacific
            'NH' => 'https://images.kiwi.com/airlines/128/NH.png', // ANA
            'TK' => 'https://images.kiwi.com/airlines/128/TK.png', // Turkish Airlines
            'MH' => 'https://images.kiwi.com/airlines/128/MH.png', // Malaysia Airlines
            'JL' => 'https://images.kiwi.com/airlines/128/JL.png', // Japan Airlines
        ];

        if (isset($onlineLogos[$code])) {
            return $onlineLogos[$code];
        }

        if (!empty($code)) {
            return "https://images.kiwi.com/airlines/128/{$code}.png";
        }

        return null;
    }
}
