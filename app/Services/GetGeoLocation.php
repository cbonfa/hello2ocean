<?php

namespace App\Services;

use App\Models\Cep;
use App\Models\Fisher;
use Illuminate\Support\Facades\Http;

class GetGeoLocation
{
    
    
    public static function byAddress($address)
    {
        
        $lat = null;
        $lng = null;
        $error = null;

        try {
            $address = trim(preg_replace('/\s+/', ' ', $address));
            $apiKey = env('GOOGLE_MAP_KEY');
            $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false&key='.$apiKey;
            $geocode=file_get_contents($url);
            $output= json_decode($geocode);
            $lat = $output->results[0]->geometry->location->lat;
            $lng = $output->results[0]->geometry->location->lng;
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }
        return ['lat' => $lat, 'lng' => $lng, 'error' => $error];

    }

    public static function byFisher($fisher) {
        if($fisher instanceof Fisher) {
            if (!empty($fisher->cep)) {
                $return = $this->byAddress("{$fisher->number}, {$fisher->address}, {$fisher->neighborhood}, {$fisher->city}, {$fisher->uf} Brasil");
            } else if (!empty($fisher->international_address)) {
                $return = $this->byAddress("{$fisher->international_address}, {$fisher->zipcode}, {$fisher->country()->name}");
            }
        }
        return $return;        
    }

    
}