<?php

namespace Tests\Feature;

use App\Enums\RevealableField;
use App\Models\AffinityThreshold;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AffinityThresholdCrudTest extends TestCase
{
    use DatabaseTransactions;

    private $user;

    protected function setup(): void
    {
        parent::setup();
        $this->user = User::factory()->create();
    }

    public function test_hydrosphere_affinity_thresholds_route_return_ok()
    {
        AffinityThreshold::factory(['field' => RevealableField::ProfileImage, 'min_affinity' => 60])->create();
        $response = $this->actingAs($this->user)->get('/hydrosphere/affinity-thresholds');
        $response->assertStatus(200);
        $response->assertSee(__('affinity_thresholds.index'));
        $response->assertSee('60%');
    }

    public function test_unath_user_cannot_see_hydrosphere_affinity_thresholds()
    {
        $response = $this->get('/hydrosphere/affinity-thresholds');
        $response->assertRedirect('/hydrosphere/login');
    }

    public function test_admin_user_can_see_the_create_affinity_threshold()
    {
        $response = $this->actingAs($this->user)->get('/hydrosphere/affinity-thresholds/create');
        $response->assertStatus(200);
        $response->assertSee(__('affinity_thresholds.create'));
    }

    public function test_admin_user_can_store_new_affinity_threshold()
    {
        $response = $this->actingAs($this->user)->post('/hydrosphere/affinity-thresholds', [
            'field' => RevealableField::ProfileImage,
            'min_affinity' => 60,
            'description' => 'Photo after 60%',
            'active' => '1',
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/hydrosphere/affinity-thresholds');
        $this->assertDatabaseHas('affinity_thresholds', [
            'field' => RevealableField::ProfileImage,
            'min_affinity' => 60,
            'active' => true,
        ]);
    }

    public function test_store_rejects_invalid_field_and_affinity_out_of_range()
    {
        $response = $this->actingAs($this->user)->post('/hydrosphere/affinity-thresholds', [
            'field' => 'password',
            'min_affinity' => 101,
        ]);
        $response->assertSessionHasErrors(['field', 'min_affinity']);
        $this->assertDatabaseMissing('affinity_thresholds', ['field' => 'password']);
    }

    public function test_store_rejects_duplicated_field()
    {
        AffinityThreshold::factory(['field' => RevealableField::Email])->create();
        $response = $this->actingAs($this->user)->post('/hydrosphere/affinity-thresholds', [
            'field' => RevealableField::Email,
            'min_affinity' => 80,
        ]);
        $response->assertSessionHasErrors('field');
    }

    public function test_user_can_see_the_edit_affinity_threshold()
    {
        $affinityThreshold = AffinityThreshold::factory(['field' => RevealableField::Name])->create();
        $response = $this->actingAs($this->user)->get("/hydrosphere/affinity-thresholds/{$affinityThreshold->id}/edit");
        $response->assertStatus(200);
        $response->assertSee(__('affinity_thresholds.edit'));
    }

    public function test_user_can_update_affinity_threshold_keeping_the_same_field()
    {
        $affinityThreshold = AffinityThreshold::factory(['field' => RevealableField::Name, 'min_affinity' => 50])->create();
        $response = $this->actingAs($this->user)->put("/hydrosphere/affinity-thresholds/{$affinityThreshold->id}", [
            'field' => RevealableField::Name,
            'min_affinity' => 75,
            'active' => '0',
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect("/hydrosphere/affinity-thresholds/{$affinityThreshold->id}");
        $this->assertDatabaseHas('affinity_thresholds', [
            'id' => $affinityThreshold->id,
            'min_affinity' => 75,
            'active' => false,
        ]);
    }

    public function test_user_can_see_the_affinity_threshold()
    {
        $affinityThreshold = AffinityThreshold::factory(['field' => RevealableField::City, 'min_affinity' => 40])->create();
        $response = $this->actingAs($this->user)->get("/hydrosphere/affinity-thresholds/{$affinityThreshold->id}");
        $response->assertStatus(200);
        $response->assertSee('40%');
    }

    public function test_user_can_delete_affinity_threshold()
    {
        $affinityThreshold = AffinityThreshold::factory()->create();
        $response = $this->actingAs($this->user)->delete("/hydrosphere/affinity-thresholds/{$affinityThreshold->id}");
        $response->assertRedirect('/hydrosphere/affinity-thresholds');
        $this->assertModelMissing($affinityThreshold);
    }

    public function test_hydrosphere_dashboard_shows_affinity_thresholds_card()
    {
        AffinityThreshold::factory(['field' => RevealableField::Email])->create();
        $response = $this->actingAs($this->user)->get('/hydrosphere');
        $response->assertStatus(200);
        $response->assertSee('Affinity Thresholds');
        $response->assertSee(route('hydrosphere.affinity_thresholds.index'));
    }

    public function test_index_lists_thresholds_ordered_by_min_affinity()
    {
        AffinityThreshold::factory(['field' => RevealableField::Email, 'min_affinity' => 80])->create();
        AffinityThreshold::factory(['field' => RevealableField::City, 'min_affinity' => 30])->create();
        $response = $this->actingAs($this->user)->get('/hydrosphere/affinity-thresholds');
        $response->assertSeeInOrder(['30%', '80%']);
    }

    public function test_unath_user_cannot_change_affinity_thresholds()
    {
        $affinityThreshold = AffinityThreshold::factory(['field' => RevealableField::Name, 'min_affinity' => 50])->create();

        $this->post('/hydrosphere/affinity-thresholds', ['field' => RevealableField::Email, 'min_affinity' => 10])
            ->assertRedirect('/hydrosphere/login');
        $this->put("/hydrosphere/affinity-thresholds/{$affinityThreshold->id}", ['field' => RevealableField::Name, 'min_affinity' => 10])
            ->assertRedirect('/hydrosphere/login');
        $this->delete("/hydrosphere/affinity-thresholds/{$affinityThreshold->id}")
            ->assertRedirect('/hydrosphere/login');

        $this->assertDatabaseMissing('affinity_thresholds', ['field' => RevealableField::Email]);
        $this->assertDatabaseHas('affinity_thresholds', ['id' => $affinityThreshold->id, 'min_affinity' => 50]);
    }

    public function test_store_accepts_affinity_limits_zero_and_one_hundred()
    {
        $this->actingAs($this->user)->post('/hydrosphere/affinity-thresholds', [
            'field' => RevealableField::Country,
            'min_affinity' => 0,
        ])->assertSessionHasNoErrors();
        $this->actingAs($this->user)->post('/hydrosphere/affinity-thresholds', [
            'field' => RevealableField::Lat,
            'min_affinity' => 100,
        ])->assertSessionHasNoErrors();

        $this->assertDatabaseHas('affinity_thresholds', ['field' => RevealableField::Country, 'min_affinity' => 0]);
        $this->assertDatabaseHas('affinity_thresholds', ['field' => RevealableField::Lat, 'min_affinity' => 100]);
    }

    public function test_store_rejects_negative_and_non_integer_affinity()
    {
        $this->actingAs($this->user)->post('/hydrosphere/affinity-thresholds', [
            'field' => RevealableField::Email,
            'min_affinity' => -1,
        ])->assertSessionHasErrors('min_affinity');
        $this->actingAs($this->user)->post('/hydrosphere/affinity-thresholds', [
            'field' => RevealableField::Email,
            'min_affinity' => 'sixty',
        ])->assertSessionHasErrors('min_affinity');
        $this->actingAs($this->user)->post('/hydrosphere/affinity-thresholds', [
            'field' => RevealableField::Email,
        ])->assertSessionHasErrors('min_affinity');
    }

    public function test_store_without_active_saves_it_as_inactive()
    {
        $this->actingAs($this->user)->post('/hydrosphere/affinity-thresholds', [
            'field' => RevealableField::Birthdate,
            'min_affinity' => 50,
        ])->assertSessionHasNoErrors();

        $this->assertDatabaseHas('affinity_thresholds', ['field' => RevealableField::Birthdate, 'active' => false]);
    }

    public function test_update_rejects_field_used_by_another_threshold()
    {
        AffinityThreshold::factory(['field' => RevealableField::Email])->create();
        $affinityThreshold = AffinityThreshold::factory(['field' => RevealableField::Name])->create();

        $response = $this->actingAs($this->user)->put("/hydrosphere/affinity-thresholds/{$affinityThreshold->id}", [
            'field' => RevealableField::Email,
            'min_affinity' => 70,
        ]);
        $response->assertSessionHasErrors('field');
        $this->assertDatabaseHas('affinity_thresholds', ['id' => $affinityThreshold->id, 'field' => RevealableField::Name]);
    }

    public function test_create_form_lists_every_revealable_field()
    {
        $response = $this->actingAs($this->user)->get('/hydrosphere/affinity-thresholds/create');
        foreach (RevealableField::getValues() as $field) {
            $response->assertSee('value="'.$field.'"', false);
        }
    }

    public function test_show_returns_not_found_for_missing_threshold()
    {
        $this->actingAs($this->user)->get('/hydrosphere/affinity-thresholds/999999')->assertNotFound();
    }
}
