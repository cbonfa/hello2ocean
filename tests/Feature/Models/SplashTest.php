<?php

namespace Tests\Feature\Models;

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

}
