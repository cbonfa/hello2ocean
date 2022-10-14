<?php

namespace Tests\Feature\Models;

use App\Models\Drop;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DropTest extends TestCase
{
    use DatabaseTransactions;
    
    public function drop_database_has_expected_columns()
    {
        $this->assertTrue( 
          Schema::hasColumns('drops', [
            'id','name', 'description', 'language_id'
        ]), 1);
    }

    public function test_create_drop(){
        $this->assertInstanceOf(Drop::class, Drop::factory()->create()); 
    }

    public function test_belongs_splash(){
        $this->markTestSkipped('must be revisited.');
    }

    public function test_belongs_drop(){
        $this->markTestSkipped('must be revisited.');
    }

}
