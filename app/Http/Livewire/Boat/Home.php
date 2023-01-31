<?php

namespace App\Http\Livewire\Boat;


use Livewire\Component;
use App\Traits\GuardsLimewireAuth;


class Home extends Component
{

    use GuardsLimewireAuth;

    protected $guard = 'fisher';
    
    public function render()
    {
        
        $net = auth()->user()->guest || auth()->user()->net;
        return view('livewire.boat.home', compact('net'));
    }
}
