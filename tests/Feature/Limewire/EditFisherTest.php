<?php

namespace Tests\Feature\Limewire;

use App\Models\Fisher;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditFisherTest extends TestCase
{
    use DatabaseTransactions;

    protected $dropViews = true;

    public function test_edit_fisher_login_fail()
    {
        $response = $this->get(route('boat.fisher.edit'));
        $response->assertStatus(302);
        $response->assertRedirect('/fisher/login');
    }
    
    public function test_show_an_edit_fisher_page()
    {
        $fisher = Fisher::factory()->create();
        $response = $this->actingAs($fisher, 'fisher')->get(route('boat.fisher.edit'));
        $response->assertStatus(200);
    }

    public function test_it_renders_a_livewire_component_on_the_edit_fisher_page()
    {
        $fisher = Fisher::factory()->create();
        $response = $this->actingAs($fisher, 'fisher')->get(route('boat.fisher.edit'));
        $response->assertSeeLivewire('boat.edit-fisher');
    }

    public function test_fields_required_on_fisher_update()
    {
        $fisher = Fisher::factory()->create();
        Livewire::actingAs($fisher, 'fisher')
            ->test('boat.edit-fisher')
            ->set('name', null)
            ->set('nick', null)
            ->call('update')
            ->assertHasErrors([ 'name' => 'required',
                                'nick' => 'required',
                              ]);
    }

    public function test_fields_required_on_brasil_cep_address_updated()
    {
        $fisher = Fisher::factory()->create();
        $retorno = Livewire::actingAs($fisher, 'fisher')
            ->test('boat.edit-fisher')
            ->set('cep', null)
            ->set('address', null)
            ->set('neighborhood', null)
            ->set('city', null)
            ->set('uf', null)
            ->call('update')
            ->assertHasErrors([ 
                                'cep' => 'required_if',
                                'address' => 'required_if',
                                'neighborhood' => 'required_if',
                                'city' => 'required_if',
                                'uf' => 'required_if'
                              ]);
    }

    public function test_fields_required_on_international_address_updated()
    {
        $fisher = Fisher::factory()->create();
        $retorno = Livewire::actingAs($fisher, 'fisher')
            ->test('boat.edit-fisher')
            ->set('brasil_address', false)
            ->set('zipcode', null)
            ->set('international_address', null)
            ->call('update')
            ->assertHasErrors([ 
                                'zipcode' => 'required_if',
                                'international_address' => 'required_if'
                              ]);
    }


}
