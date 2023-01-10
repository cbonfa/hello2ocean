<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Language;

class LanguageCrudTest extends TestCase
{
    use DatabaseTransactions;

    private $user;
    private $language_id;

    public function setup(): void
    {
        parent::setup();
        $this->user = User::factory()->create();
    }

    public function test_hydrosphere_languages_route_return_ok()
    {
        $response = $this->actingAs($this->user)->get('/hydrosphere/languages');
        $response->assertStatus(200);
        $response->assertSee(__('languages.index'));
    }

    public function test_hydrosphere_languages_index_search(){
        $wave1 = Language::factory(['description' => 'Find this number 34564'])->create();
        $wave2 = Language::factory(['description' => 'Do not find this number 53938'])->create();
        $this->assertEquals(2, Language::count());
        $response = $this->actingAs($this->user)->get('/hydrosphere/languages');
        $response->assertSee('34564');
        $response->assertSee('53938');
        $response = $this->actingAs($this->user)->get('/hydrosphere/languages?search=34564');
        $response->assertSee('34564');
        $response->assertDontSee('53938');
    }

    public function test_unath_user_cannot_see_hydrosphere_languages()
    {
        $response = $this->get('/hydrosphere/languages');
        $response->assertStatus(302);
        $response->assertDontSee(__('languages.index'));
        $response->assertRedirect('/login');
    }

    public function test_unath_user_cannot_see_hydrosphere_create_languages()
    {
        $response = $this->get('/hydrosphere/languages/create');
        $response->assertStatus(302);
        $response->assertDontSee(__('languages.create'));
        $response->assertRedirect('/login');
    }    

    public function test_admin_user_can_store_new_language()
    {
        
        $last_count = Language::count();

        $response = $this->actingAs($this->user)->post('/hydrosphere/languages', [
                'description' => 'This is one Language 4355',
                'country' => 'Brasil',
                'country_code' => 'BR',
                'locale' => 'pt_BR',
                'active' => true
            ]
        );
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/hydrosphere/languages');
        $this->assertEquals(($last_count+1), Language::count());
        $this->assertDatabaseHas('languages', [
                                            'description' => 'This is one Language 4355',
                                            'country' => 'Brasil',
                                            'country_code' => 'BR',
                                        ]);
    }

    public function test_user_can_see_the_edit_language(){
        $language = Language::factory()->create();
        $response = $this->actingAs($this->user)->get("/hydrosphere/languages/{$language->id}/edit");
        $response->assertStatus(200);
        $response->assertSee($language->name);
    }

    public function test_user_can_update_language(){
        $tot = Language::count();
        $language = Language::factory()->create();
        $this->assertCount(($tot+1), Language::all());
        $response = $this->actingAs($this->user)->put("/hydrosphere/languages/{$language->id}", [
            'description' => 'Change Language 2349',
            'country' => 'USA',
            'country_code' => 'BR',
            'locale' => 'pt_BR',
            'active' => false
        ]);
        # after the update, the same registration count
        $this->assertCount(($tot+1), Language::all());
        $response->assertSessionHasNoErrors();
        $response->assertRedirect("/hydrosphere/languages/{$language->id}");
        $response->assertStatus(302);
        $this->assertDatabaseHas('languages', [
            'description' => 'Change Language 2349',
            'country' => 'USA',
            'active' => false
        ]);
    }

    public function test_user_can_delete_language(){
        $tot = Language::count();
        $language = Language::factory()->create();
        $this->assertCount(($tot+1), Language::all());
        $response = $this->actingAs($this->user)->delete("/hydrosphere/languages/{$language->id}");
        $response->assertStatus(302);
        $this->assertCount($tot, Language::all());
    }

}
