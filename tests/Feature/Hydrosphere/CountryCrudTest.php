<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CountryCrudTest extends TestCase
{
    use DatabaseTransactions;

    private $user;
    private $country_id;

    public function setup(): void
    {
        parent::setup();
        $this->user = User::factory()->create();
    }

    public function test_hydrosphere_countries_route_return_ok()
    {
        $response = $this->actingAs($this->user)->get('/hydrosphere/countries');
        $response->assertStatus(200);
        $response->assertSee(__('countries.index'));
    }

    public function test_hydrosphere_countries_index_search(){
        $wave1 = Country::factory(['name' => 'Find this number 3452'])->create();
        $wave2 = Country::factory(['name' => 'Do not find this number 39843'])->create();
        $this->assertEquals(2, Country::count());
        $response = $this->actingAs($this->user)->get('/hydrosphere/countries');
        $response->assertSee('3452');
        $response->assertSee('39843');
        $response = $this->actingAs($this->user)->get('/hydrosphere/countries?search=3452');
        $response->assertSee('3452');
        $response->assertDontSee('39843');
    }

    public function test_unath_user_cannot_see_hydrosphere_countries()
    {
        $response = $this->get('/hydrosphere/countries');
        $response->assertStatus(302);
        $response->assertDontSee(__('countries.index'));
        $response->assertRedirect('/hydrosphere/login');
    }

    public function test_unath_user_cannot_see_hydrosphere_create_countries()
    {
        $response = $this->get('/hydrosphere/countries/create');
        $response->assertStatus(302);
        $response->assertDontSee(__('countries.create'));
        $response->assertRedirect('/hydrosphere/login');
    }    

    public function test_admin_user_can_store_new_country()
    {
        
        $last_count = Country::count();
        $response = $this->actingAs($this->user)->post('/hydrosphere/countries', [
                'name' => 'This is one Country 3245',
                'code' => 'ZR'
            ]
        );
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/hydrosphere/countries');
        $this->assertEquals(1, Country::count());
        $this->assertDatabaseHas('countries', [
                                            'name' => 'This is one Country 3245',
                                            'code' => 'ZR'
                                        ]);
    }

    public function test_user_can_see_the_edit_country(){
        $country = Country::factory()->create();
        $response = $this->actingAs($this->user)->get("/hydrosphere/countries/{$country->id}/edit");
        $response->assertStatus(200);
        $response->assertSee($country->name);
    }

    public function test_user_can_update_country(){
        $tot = Country::count();
        $country = Country::factory()->create();
        $this->assertCount(($tot+1), Country::all());
        $response = $this->actingAs($this->user)->put("/hydrosphere/countries/{$country->id}", [
            'name' => 'Change Country 2349',
            'code' => 'RB'
        ]);
        # after the update, the same registration count
        $this->assertCount(($tot+1), Country::all());
        $response->assertSessionHasNoErrors();
        $response->assertRedirect("/hydrosphere/countries/{$country->id}");
        $response->assertStatus(302);
        $this->assertDatabaseHas('countries', [
            'name' => 'Change Country 2349',
            'code' => 'RB'
        ]);
    }

    public function test_user_can_delete_country(){
        $tot = Country::count();
        $country = Country::factory()->create();
        $this->assertCount(($tot+1), Country::all());
        $response = $this->actingAs($this->user)->delete("/hydrosphere/countries/{$country->id}");
        $response->assertStatus(302);
        $this->assertCount($tot, Country::all());
    }

}
