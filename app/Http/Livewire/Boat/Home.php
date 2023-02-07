<?php

namespace App\Http\Livewire\Home;


use Livewire\Component;
use Illuminate\Http\Request;
use App\Traits\GuardsLimewireAuth;


class Home extends Component
{

    use GuardsLimewireAuth;

    protected $guard = 'fisher';
    
    public function render()
    {
        return view('livewire.boat.home');
    }
}
