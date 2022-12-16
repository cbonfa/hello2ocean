<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Language;
use App\Models\Wave;

class WaveCrudTest extends TestCase
{
    use DatabaseTransactions;

    private $user;
    private $language_id;

    public function setup(): void
    {
        parent::setup();
        $this->user = User::factory()->create();
        $this->language_id = (Language::count() == 0) ? Language::factory()->create()->id : Language::first()->id;
    }

    public function test_hydrosphere_waves_route_return_ok()
    {
        $response = $this->actingAs($this->user)->get('/hydrosphere/waves');
        $response->assertStatus(200);
        $response->assertSee(__('waves.index'));
    }

    public function test_unath_user_cannot_see_hydrosphere_waves()
    {
        $response = $this->get('/hydrosphere/waves');
        $response->assertStatus(302);
        $response->assertDontSee(__('waves.index'));
        $response->assertRedirect('/login');
    }

    public function test_unath_user_cannot_see_hydrosphere_create_waves()
    {
        $response = $this->get('/hydrosphere/waves/create');
        $response->assertStatus(302);
        $response->assertDontSee(__('waves.create'));
        $response->assertRedirect('/login');
    }    

    public function test_admin_user_can_store_new_wave()
    {
        
        $last_count = Wave::count();

        $response = $this->actingAs($this->user)->post('/hydrosphere/waves', [
                'name' => 'Education 413',
                'description' => 'This is one text about Education',
                'language_id' => $this->language_id
            ]
        );
        $response->assertRedirect('/hydrosphere/waves');
        $this->assertEquals(($last_count+1), Wave::count());
        $this->assertDatabaseHas('waves', [
                                            'name' => 'Education 413', 
                                            'description' => 'This is one text about Education'
                                        ]);
    }

    public function test_user_can_see_edit_wave(){
        $wave = Wave::factory()->create();
        print "/hydrosphee/waves/{$wave->id}/edit";
        $response = $this->actingAs($this->user)->get("/hydrosphere/waves/{$wave->id}/edit");
        $response->assertStatus(200);
        # https://www.youtube.com/watch?v=3t53jcEwrbQ&t=1s
    }

}
