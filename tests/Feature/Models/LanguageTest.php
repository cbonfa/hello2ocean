<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

use App\Models\Splash;
use App\Models\Wave;
use App\Models\Language;

class LanguageTest extends TestCase
{

    use DatabaseTransactions;

    public function test_splash_database_has_expected_columns()
    {
        $this->assertTrue( 
            Schema::hasColumns('languages', [
              'id','country', 'country_code', 'locale', 'active'
          ]), 1);
    }

    public function teste_create_language(){
        $this->assertInstanceOf(Language::class, Language::factory()->create()); 
    }    

    public function test_language_has_many_waves() {
        $language = Language::factory()->create();
        $wave = Wave::factory(['language_id' => $language->id])->create();
        # $this->assertEquals(1, $wave->splashs->count());
        $this->assertTrue($language->waves->contains($wave));
    }
    public function test_language_has_many_splashs() {
        $language = Language::factory()->create();
        $splash = Splash::factory(['language_id' => $language->id])->create();
        $this->assertTrue($language->splashs->contains($splash));
    }    

}
