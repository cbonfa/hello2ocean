<?php

namespace Tests\Feature\Limewire;

use App\Models\Fisher;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\DatabaseTransactions;
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
        Livewire::actingAs($fisher, 'fisher')
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
        Livewire::actingAs($fisher, 'fisher')
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

    public function test_fisher_data_has_changed(){
        $fisher = Fisher::factory()->create();

        $name = 'John Doe';
        $nick = 'Jodo';

        Livewire::actingAs($fisher, 'fisher')
            ->test('boat.edit-fisher')
            ->set('name', $name)
            ->set('nick', $nick)
            ->call('update')
            ->assertHasNoErrors();
        $nameFromDb = auth()->user()->name;
        $nickFromDb = auth()->user()->nick;

        $this->assertEquals($name, $nameFromDb);
        $this->assertEquals($nick, $nickFromDb);
    }

    #Seus dados foram atualizados com sucesso 
    public function test_boat_fisher_success_message()
    {
        $name = 'Floresbelo Filho';
        $nick = 'Flofi';

        $fisher = Fisher::factory()->create();
        Livewire::actingAs($fisher, 'fisher')
            ->test('boat.edit-fisher')
            ->assertDontSee(__('fishers.user.update.success'))
            ->set('name', $name)
            ->set('nick', $nick)
            ->call('update')
            ->assertSee(__('fishers.user.update.success'));
    }

    public function test_it_shows_form_fields(): void
    {
        $fisher = Fisher::factory()->create();
        Livewire::actingAs($fisher, 'fisher')
            ->test('boat.edit-fisher')
            ->assertSee(__('boat.fisher.edit.title'))
            ->assertSee(__('boat.fisher.edit.subtitle'))
            ->assertSee(__('all.name'))
            ->assertSee(__('all.nick'))
            ->assertSee(__('boat.fisher.edit.save'));
    }

    public function boat_fisher_get_cep()
    {
        $fisher = Fisher::factory()->create();
        $retorno = Livewire::actingAs($fisher, 'fisher')
            ->test('boat.edit-fisher')
            ->emit('updatedCep', 'cep', '02072-004');
        dd($retorno);
            // ->assertSee('Travessa Maria Nazaré');
    }

    // public function has_data_passed_correctly()
    // {
    //     Livewire::test(EditFisher::class, ['foo' => 'bar'])
    //         ->assertSet('foo', 'bar')
    //         ->assertSee('bar');
    // }

}