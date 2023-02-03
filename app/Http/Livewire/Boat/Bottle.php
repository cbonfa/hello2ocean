<?php

namespace App\Http\Livewire\Bottle;


use Livewire\Component;
use Illuminate\Http\Request;
use App\Traits\GuardsLimewireAuth;


class Bottle extends Component
{

    use GuardsLimewireAuth;

    protected $guard = 'fisher';
    public $contacts = [ ];

    
    public function render()
    {
        $this->contacts = (auth()->check()) ? auth()->user()->net->toArray('id', 'name', 'nick_image') : [];
        return view('livewire.boat.bottle');
    }
}
