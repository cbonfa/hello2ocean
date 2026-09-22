<?php

namespace Tests\Feature\AuthFisher;

use Tests\TestCase;
use App\Livewire\Boat\EditFisher;
use App\Models\Fisher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class LivewireRouteGuardTest  extends TestCase
{
    use RefreshDatabase;

    protected $dropViews = true;

    public function test_livewire_component_auth_guard()
    {
        $livewire = Livewire::test(EditFisher::class);
        $livewire->assertStatus(401);

        $this->actingAs(Fisher::factory()->create(), 'fisher');   
        $livewire = Livewire::test(EditFisher::class);
        $livewire->assertOk();
    }
}
