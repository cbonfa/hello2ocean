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

        $this->create_drops($splash);

        $this->assertEquals(2, $splash->drops->count());
    }

    public function test_mass_sync(){
        $splash = Splash::factory()->create();
        $language = Language::factory(['id' => 1])->create();

        $this->create_drops($splash);

        $drop1 = $splash->drops()->first();
        # $drop2 = $splash->drops()->last();
        
        $splash->drops()->createUpdateOrDelete([ 
            [ 'id' => $drop1->id, 'name' => 'EDICAO'], // update
            [ 'id' => null, 'name' => 'Novo Registo'], // novo registro
            [ 'id' => null, 'name' => 'Novo Registo 2'], // novo registro
        ]); // Delete Você é Legal.
        $splash->refresh();
 
        $this->assertEquals(3, $splash->drops->count());

    }

    public function test_mass_sync_updated_drop(){
        $splash = Splash::factory()->create();
        $language = Language::factory(['id' => 1])->create();

        $this->create_drops($splash);

        $drop1 = $splash->drops()->first();
        # $drop2 = $splash->drops()->last();
        
        $splash->drops()->createUpdateOrDelete([ 
            [ 'id' => $drop1->id, 'name' => 'EDICAO'], // update
            [ 'id' => null, 'name' => 'Novo Registo'], // novo registro
            [ 'id' => null, 'name' => 'Novo Registo 2'], // novo registro
        ]); // Delete Você é Legal.
        $splash->refresh();
        $edit = false;
        foreach ($splash->drops as $drop)
        {
            if($drop->name == 'EDICAO'){
                $edit = ($drop->id == $drop1->id);
            }
        }
        $this->assertTrue($edit);
    }    

    public function test_mass_sync_new_drop(){
        $splash = Splash::factory()->create();
        $language = Language::factory(['id' => 1])->create();

        $this->create_drops($splash);    

        $drop1 = $splash->drops()->orderBy('id')->first();
        $drop2 = $splash->drops()->orderByDesc('id')->first();
       
        $splash->drops()->createUpdateOrDelete([ 
            [ 'id' => $drop1->id, 'name' => 'EDICAO'], // update
            [ 'id' => null, 'name' => 'NOVO'], // 
        ]); 
        $splash->refresh();
        $new = false;
        
        foreach ($splash->drops as $drop)
        {
            if($drop->name == 'NOVO'){
              $new = ( ($drop->id != $drop1->id) && ($drop->id != $drop2->id) );
            }
        }
        $this->assertTrue($new);
    }   
    
    
    public function test_mass_sync_deleted_drop(){
        $splash = Splash::factory()->create();
        $language = Language::factory(['id' => 1])->create();

        $this->create_drops($splash);

        $drop1 = $splash->drops()->orderBy('id')->first();
        $drop2 = $splash->drops()->orderByDesc('id')->first();

        echo "{$drop1->id} {$drop1->name} -";
        echo "{$drop2->id} {$drop2->name}";
        
        $splash->drops()->createUpdateOrDelete([ 
            [ 'id' => $drop1->id, 'name' => 'EDICAO'], // update
            [ 'id' => null, 'name' => 'NOVO'], // 
        ]); 
        
        $splash->refresh();
        $deleted = true;
        
        foreach ($splash->drops as $drop)
        {        

            if ($drop->id == $drop2->id) { $deleted = false; }
        }
        $this->assertTrue($deleted);
    } 

    private function create_drops(&$splash){
        $splash->drops()->createMany([
            ['name' => 'Item 1'],
            ['name' => 'Item 2'],
        ]);
        $splash->refresh();
    }



}
