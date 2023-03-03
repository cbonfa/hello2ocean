<?php

namespace App\Services;

use App\Models\Cep;
use Illuminate\Support\Facades\Http;

class GetCep
{
    
    
    public static function find($cep)
    {
        # Format CEP
        $cep = Format::cep($cep);
        # find CEP
        $infosCep = Cep::whereCep($cep)->first();
        if(empty($infosCep)){
            $response = Http::acceptJson()->get("https://viacep.com.br/ws/{$cep}/json/");
            if ( !empty($response) && ($response->status() == 200) ) { 
                $arrayCep = (array) json_decode($response->body());
            }

            if (!empty($arrayCep['cep'])){
                $cep = Cep::create(
                                $arrayCep       
                            );
                return $cep;
            } else { 
                return (new Cep);
            }
        } else {
            return $infosCep;
        }

    }
}