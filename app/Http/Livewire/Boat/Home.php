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

    public function add_contact(){
        $this->contacts = (auth()->check()) ? auth()->user()->net->toArray('id', 'name', 'nick_image') : [];
    }
    
    public function render()
    {
        $this->contacts = (auth()->check()) ? auth()->user()->net->toArray('id', 'name', 'nick_image') : [];
        // map(fn ($item) =>
        //     [
        //     'id' => $item->id,
        //     'name' => $item->name,
        //     'nick_image' => $item->nick_image
        //     ]);
        return view('livewire.boat.home');
    }
}
