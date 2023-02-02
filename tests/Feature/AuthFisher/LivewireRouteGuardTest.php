<?php

namespace Tests\Feature\AuthFisher;

use Tests\TestCase;
use App\Http\Livewire\Boat\Home;
use App\Models\Fisher;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LivewireRouteGuardTest  extends TestCase
{
    use RefreshDatabase;

    protected $dropViews = true;

    public function test_livewire_component_guard()
    {
        $livewire = \Livewire::test(Home::class);
        $livewire->assertStatus(401);

        $this->actingAs(Fisher::factory()->create(), 'fisher');   
        $livewire = \Livewire::test(Home::class);
        $livewire->assertOk();
    }
}
