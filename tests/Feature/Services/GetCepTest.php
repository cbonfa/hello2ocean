<?php

namespace Tests\Feature\Services;

use App\Services\GetCep;
use Tests\TestCase;

class GetCepTest extends TestCase
{
    public function test_get_cep_address()
    {
        $retorno = GetCep::find('02336-040');
        $this->assertEquals($retorno->cep, '02336-040');
        $this->assertEquals($retorno->logradouro, 'Rua Casa Forte');
        
    }    
}
