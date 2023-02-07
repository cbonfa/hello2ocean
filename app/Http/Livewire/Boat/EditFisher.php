<?php

namespace App\Http\Livewire\Boat;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Fisher;
use App\Traits\GuardsLimewireAuth;

class EditFisher extends Component
{
    use WithFileUploads;
    use GuardsLimewireAuth;

    protected $guard = 'fisher';
    
    public $profile_image, $nick_image;
    public $name, $nick;
    public $updateFisher = false;

    public function __construct()
    {
        $this->edit(auth()->user());
    }

    public function edit($fisher){
        $this->name = $fisher->name;
        $this->nick = $fisher->nick;
    }

    public function update(){
        $data = $this->validate(['name' => 'required',
                                'nick'  => 'required',
                                'nick_image' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
                                'profile_image'  => 'image|mimes:jpg,jpeg,png,gif|max:2048']);
        // try{
            $data['nick_image'] = $this->file->store('nick_image');
            $data['profile_image'] = $this->file->store('profile_image');
            // Update category
            $fisher = auth()->user();
            // $fisher->update([
            //     'name' => $this->name,
            //     'nick' => $this->nick,
            // ]);
            $fisher->update([
                $data
            ]);
            session()->flash('success','Category Updated Successfully!!');
    
            $this->cancel();
        // }catch(\Exception $e){
        //     session()->flash('error','Something goes wrong while updating category!!');
        //     $this->cancel();
        // }
    }

    public function cancel()
    {
        $this->updateFisher = false;
        $this->resetFields();
    }

    private function resetFields(){
        $this->name = '';
        $this->nick = '';
    }

    public function render()
    {
        return view('livewire.boat.edit-fisher');
    }
}
