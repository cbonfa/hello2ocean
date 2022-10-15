<?php

namespace Tests\Feature\Models;

use App\Models\Drop;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use App\Models\Splash;
use App\Models\Wave;
use App\Models\Language;

class SplashTest extends TestCase
{

    use DatabaseTransactions;

    public function test_splash_database_has_expected_columns()
    {
        $this->assertTrue( 
            Schema::hasColumns('splashes', [
              'id','name', 'description', 'image', 'wave_id', 
              'language_id', 'blocked', 'blocked_reason', 'days_to_expire'
          ]), 1);
    }

    public function teste_create_splash(){
        $this->assertInstanceOf(Splash::class, Splash::factory()->create()); 
    }

    public function test_belongs_language() {
        $model = Splash::factory()->create();
        $this->assertInstanceOf(Language::class, $model->language); 
    }

    public function test_belongs_wave() {
        $model = Splash::factory()->create();
        $this->assertInstanceOf(Wave::class, $model->wave); 
    }

    public function test_has_many_drops(){
        $model = Splash::factory()->create();

        $drop = Drop::factory(['splash_id' => $model->id])->create();
        $this->assertEquals(1, $model->drops->count());
        $this->assertTrue($model->drops->contains($drop));
    }

    public function test_mass_create(){
        $splash = Splash::factory()->create();
        $language = Language::factory(['id' => 1])->create();
        $splash->drops()->createMany([
            ['name' => 'Você gosta de Dirigir?'],
            ['name' => 'Você é legal?.'],
        ]);
        $splash->refresh();
        $this->assertEquals(2, $splash->drops->count());
    }

    public function test_mass_sync(){
        $splash = Splash::factory()->create();
        $language = Language::factory(['id' => 1])->create();
        $splash->drops()->createMany([
            ['name' => 'Você gosta de Dirigir?'],
            ['name' => 'Você é legal?.'],
        ]);
        $splash->refresh();
        $drop1 = $splash->drops()->first();
        # $drop2 = $splash->drops()->last();
        
        $splash->drops()->sync([ 
            [ 'id' => $drop1->id, 'name' => 'Birigui'],
            [ 'id' => null, 'name' => 'Birigui'],
        ]);
        #$splash->refresh();
        #dd($splash->drops());

    }



}
