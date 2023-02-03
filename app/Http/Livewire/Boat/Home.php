<?php

namespace App\Http\Livewire\Boat;


use Livewire\Component;
use Illuminate\Http\Request;
use App\Traits\GuardsLimewireAuth;


class Home extends Component
{

    use GuardsLimewireAuth;

    protected $guard = 'fisher';
    public $contacts = [ ];

    
    public function render()
    {
        $this->contacts = (auth()->check()) ? auth()->user()->net->toArray('id', 'name', 'nick_image') : [];
        return view('livewire.boat.home');
    }
}
