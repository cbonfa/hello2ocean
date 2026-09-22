<?php

namespace Tests\Feature\Services;

use App\Services\GetGeoLocation;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GetGeoLocationTest extends TestCase
{
    public function test_get_geo_location_by_address()
    {
        Http::fake([
            'maps.googleapis.com/*' => Http::response([
                'status' => 'OK',
                'results' => [
                    ['geometry' => ['location' => ['lat' => -23.4817811, 'lng' => -46.6153578]]],
                ],
            ]),
        ]);

        $retorno = GetGeoLocation::byAddress('238, Rua Casa Forte,  Água Fria, São Paulo, SP, Brasil');

        $this->assertEquals(-23.4817811, $retorno->lat);
        $this->assertEquals(-46.6153578, $retorno->lng);
        $this->assertNull($retorno->error);
        Http::assertSent(fn (Request $request) => $request['address'] === '238, Rua Casa Forte, Água Fria, São Paulo, SP, Brasil');
    }

    public function test_get_geo_location_by_address_returns_error_when_not_found()
    {
        Http::fake([
            'maps.googleapis.com/*' => Http::response(['status' => 'ZERO_RESULTS', 'results' => []]),
        ]);

        $retorno = GetGeoLocation::byAddress('endereço inexistente');

        $this->assertNull($retorno->lat);
        $this->assertNull($retorno->lng);
        $this->assertNotNull($retorno->error);
    }

    public function test_get_geo_location_by_ip()
    {
        Http::fake([
            'ip-api.com/json/178.32.223.36*' => Http::response([
                'status' => 'success',
                'country' => 'France',
                'countryCode' => 'FR',
                'lat' => 48.8582,
                'lon' => 2.3387,
            ]),
        ]);

        $retorno = GetGeoLocation::byIP('178.32.223.36');

        $this->assertEquals('FR', $retorno->countryCode);
        $this->assertEquals('France', $retorno->countryName);
        $this->assertEquals(48.8582, $retorno->lat);
        $this->assertEquals(2.3387, $retorno->lng);
    }

    public function test_get_geo_location_by_ip_returns_null_when_lookup_fails()
    {
        Http::fake([
            'ip-api.com/*' => Http::response(['status' => 'fail', 'message' => 'private range']),
        ]);

        $this->assertNull(GetGeoLocation::byIP('127.0.0.1'));
    }

    public function test_get_geo_location_by_ip_returns_null_when_service_is_down()
    {
        Http::fake([
            'ip-api.com/*' => Http::response(null, 503),
        ]);

        $this->assertNull(GetGeoLocation::byIP('178.32.223.36'));
    }
}
