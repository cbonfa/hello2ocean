<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class BottleTest extends TestCase
{
    use DatabaseTransactions;
    
    public function test_bottle_database_has_expected_columns()
    {
        $this->assertTrue( 
          Schema::hasColumns('bottles', [
            'id','fisher_id', 'splash_id', 'drop_id',
            'answer', 'ignore'
        ]), 1);
    }

}
