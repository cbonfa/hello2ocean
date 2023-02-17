<?php

namespace Tests\Feature\Services;

use App\Services\GetGeoLocation;
use Tests\TestCase;

class GetGeoLocationTest extends TestCase
{
    public function test_get_geo_location_by_address()
    {
        $retorno = GetGeoLocation::byAddress('238, Rua Casa Forte, Água Fria, São Paulo, SP, Brasil');
        $this->assertEquals($retorno['lat'], -23.4817811);
        $this->assertEquals($retorno['lng'], -46.6153578);
    }
}