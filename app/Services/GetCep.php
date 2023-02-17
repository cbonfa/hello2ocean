<?php

namespace App\Services;

use App\Models\Cep;
use Illuminate\Support\Facades\Http;

class GetCep
{
    
    
    public static function find($cep)
    {
        # find CEP
        $infosCep = Cep::whereCep($cep)->first();
        if(empty($infosCep)){
            $response = Http::acceptJson()->get("https://viacep.com.br/ws/{$cep}/json/");
            if (!empty($response)){
                $cep = Cep::create(
                                (array) json_decode($response->body())
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