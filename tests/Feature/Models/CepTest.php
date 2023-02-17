<?php

namespace Tests\Feature;

use App\Models\Cep;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CepTest extends TestCase
{
    use DatabaseTransactions;

    public function test_cep_database_has_expected_columns()
    {
        $this->assertTrue( 
          Schema::hasColumns('ceps', [
            'cep', 'logradouro', 'complemento', 'bairro', 'localidade', 'uf', 'ibge'
        ]), 1);
    }

    public function teste_create_cep(){
        $this->assertInstanceOf(Cep::class, Cep::factory()->create()); 
    }


}
