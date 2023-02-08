<?php

namespace Tests\Feature;

use App\Models\Country;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CountryTest extends TestCase
{
    use DatabaseTransactions;

    public function test_country_database_has_expected_columns()
    {
        $this->assertTrue( 
          Schema::hasColumns('countries', [
            'name', 'code'
        ]), 1);
    }

    public function teste_create_country(){
        $this->assertInstanceOf(Country::class, Country::factory()->create()); 
    }


}
