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

    public function test_hydrosphere_waves_index_search(){
        $wave1 = Wave::factory(['name' => 'Find this 43533'])->create();
        $wave2 = Wave::factory(['name' => 'Do not find this 34328'])->create();
        $response = $this->actingAs($this->user)->get('/hydrosphere/waves');
        $response->assertSee('43533');
        $response->assertSee('34328');
        $response = $this->actingAs($this->user)->get('/hydrosphere/waves?search=43533');
        $response->assertSee('43533');
        $response->assertDontSee('34328');
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
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/hydrosphere/waves');
        $this->assertEquals(($last_count+1), Wave::count());
        $this->assertDatabaseHas('waves', [
                                            'name' => 'Education 413', 
                                            'description' => 'This is one text about Education'
                                        ]);
    }

    public function test_user_can_see_the_edit_wave(){
        $wave = Wave::factory()->create();
        $response = $this->actingAs($this->user)->get("/hydrosphere/waves/{$wave->id}/edit");
        $response->assertStatus(200);
        $response->assertSee($wave->name);
    }

    public function test_user_can_update_wave(){
        $tot = Wave::count();
        $wave = Wave::factory()->create();
        $this->assertCount(($tot+1), Wave::all());
        $response = $this->actingAs($this->user)->put("/hydrosphere/waves/{$wave->id}", [
            'name' => 'Wave Name 514', 
            'description' => 'Wave Description 515',
            'language_id' => $this->language_id
        ]);
        # after the update, the same registration count
        $this->assertCount(($tot+1), Wave::all());
        $response->assertSessionHasNoErrors();
        $response->assertRedirect("/hydrosphere/waves/{$wave->id}");
        $response->assertStatus(302);
        $this->assertDatabaseHas('waves', [
            'name' => 'Wave Name 514', 
            'description' => 'Wave Description 515'
        ]);
    }

    public function test_user_can_delete_wave(){
        $tot = Wave::count();
        $wave = Wave::factory()->create();
        $this->assertCount(($tot+1), Wave::all());
        $response = $this->actingAs($this->user)->delete("/hydrosphere/waves/{$wave->id}");
        $response->assertStatus(302);
        $this->assertCount($tot, Wave::all());
    }

}
