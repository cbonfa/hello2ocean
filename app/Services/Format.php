<?php

namespace App\Services;

use App\Models\Cep;
use Illuminate\Support\Facades\Http;

class Format
{
    
    
    public static function cep($cep)
    {
        # Format CEP
        $cep = preg_replace('/[^0-9]/', '', $cep);
        $cep = str_pad($cep, 8, '0', STR_PAD_LEFT);
        $cep = substr($cep, 0, 5) . '-' . substr($cep, 5, 3);
        return $cep;

    }
}