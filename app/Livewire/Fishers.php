<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Fisher;

class Fishers extends Component
{
    public $search;

    public function render()
    {
        $fishers = Fisher::where('email', 'like', "%{$this->search}%")->get();
        return view('livewire.fishers')->with([
            'fishers' => $fishers,
        ]);
    }
    public function delete(Fisher $fisher){
        $fisher->delete();
    }
}
