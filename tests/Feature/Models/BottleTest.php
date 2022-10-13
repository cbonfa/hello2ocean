<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class BottleTest extends TestCase
{
    use DatabaseTransactions;
    
    public function bottle_database_has_expected_columns()
    {
        $this->assertTrue( 
          Schema::hasColumns('bottles', [
            'id','name', 'description', 'language_id'
        ]), 1);
    }

}
