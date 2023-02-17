<?php

namespace Tests\Feature\Services;

use App\Services\GetCep;
use Tests\TestCase;

class GetCepTest extends TestCase
{
    public function test_get_geo_location_by_address()
    {
        $retorno = GetCep::find('02236-040');
        $this->assertEquals($retorno['lat'], -23.4817811);
        $this->assertEquals($retorno['lng'], -46.6153578);
    }    
}
