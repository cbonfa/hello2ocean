<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use App\Models\Wave;
use App\Models\Language;
use App\Models\Splash;

class WaveTest extends TestCase
{
    use DatabaseTransactions;

    public function test_wave_database_has_expected_columns()
    {
        $this->assertTrue( 
          Schema::hasColumns('waves', [
            'id','name', 'description', 'language_id'
        ]), 1);
    }

    public function teste_create_wave()
    {
        
        $this->assertInstanceOf(Wave::class, Wave::factory()->create()); 

        # $this->assertEquals(1, $price);
    }

    public function test_belongs_language() {
        $wave = Wave::factory()->create();
        $this->assertInstanceOf(Language::class, $wave->language); 
    }

    public function test_wave_has_many_splashs() {
        $wave = Wave::factory()->create();
        $splash = Splash::factory(['wave_id' => $wave->id])->create();
        # $this->assertEquals(1, $wave->splashs->count());
        $this->assertTrue($wave->splashs->contains($splash));
    }


}
