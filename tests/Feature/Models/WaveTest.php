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

    public function test_main_wave() {
        $main_wave = Wave::factory()->create();
        $wave = Wave::factory(['wave_id_main' => $main_wave])->create();

        $this->assertInstanceOf(Wave::class, $wave->main_wave); 
        $this->assertTrue($wave->main_wave->id == $main_wave->id);
    }

    public function test_main_language_wave() {
        $main_language = Wave::factory()->create();
        $wave = Wave::factory(['wave_id_language' => $main_language])->create();

        $this->assertInstanceOf(Wave::class, $wave->main_wave_language); 
        $this->assertTrue($wave->main_wave_language->id == $main_language->id);
    }    


}
