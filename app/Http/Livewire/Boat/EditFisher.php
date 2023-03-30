<?php

namespace App\Http\Livewire\Boat;

use App\Models\Country;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\GuardsLimewireAuth;
use App\Traits\LoadVarsLimewire;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Carbon;
use BenSampo\Enum\Rules\EnumValue;
use App\Enums\GenderType;
use App\Models\Fisher;
use App\Services\GetCep;
use App\Services\GetGeoLocation;

class EditFisher extends Component
{
    use WithFileUploads;
    use GuardsLimewireAuth;
    use LoadVarsLimewire;

    protected $guard = 'fisher';
    private $fisher;
    
    public $profile_image, $nick_image;
    public $name, $nick, $country_id, $birthdate, $gender;
    public $cep ,$address ,$number ,$complement ,$neighborhood, $city, $uf; 
    public $zipcode, $international_address;
    public $genders;
    # usar em caso de exibir o ZipCode ou não
    public $brasil_address = true;
    public $updateFisher = false;

    # o correto acredito que seja mount()
    public function __construct()
    {
        $this->fisher = auth()->user();
        $this->setGeoIP();
        $this->loadVars();
    }

    public function loadVars(){
        if (empty($this->fisher)) { return; }
        $modelVars = $this->getModelVars($this, Fisher::class, [ 'except' => ['nick_image', 'profile_image'] ]);
        foreach($modelVars as $var){
            $this->$var = $this->fisher->$var;
        }
        $this->genders = GenderType::asSelectArray();
    }

    # LifeCycle Hook
    public function updatedCep(){
        $cep = GetCep::find($this->cep);
        $this->cep = $cep->cep;
        $this->address = $cep->logradouro;
        $this->neighborhood = $cep->bairro;
        $this->complement = $cep->complemento;
        $this->city = $cep->localidade;
        $this->uf = $cep->uf;
    }

    public function update(){
        $fisher = $this->fisher;
        $data = $this->validate(['name' => 'required',
                                'nick'  => 'required',
                                'birthdate' => 'nullable|date_format:d/m/Y',
                                'gender' => ['required', new EnumValue(GenderType::class)],
                                'nick_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
                                'profile_image'  => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
                                'cep' => 'required_if:brasil_address,true','address' => 'required_if:brasil_address,true','number' => '' ,'complement' => '',
                                'neighborhood' => 'required_if:brasil_address,true','city' => 'required_if:brasil_address,true','uf' => 'required_if:brasil_address,true',
                                'zipcode' => 'required_if:brasil_address,false', 'international_address' => 'required_if:brasil_address,false']);
        try{
            if($this->nick_image){
                $data['nick_image'] = $this->uploadAndResize('nick_image');
            } else {
                unset($data['nick_image']);
            }

            if($this->profile_image){
                $data['profile_image'] = $this->uploadAndResize('profile_image');
            } else {
                unset($data['profile_image']);
            }

            // Update category
            $fisher = auth()->user();
            $fisher->update($data);
            session()->flash('success', __('fishers.user.update.success'));
    
            $this->loadVars();
        }catch(\Exception $e){
            session()->flash('error', __('fishers.user.update.error'));
            $this->cancel();
        }
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

    private function setGeoIP(){
        if (!auth()->check()) { return; }
        if((!empty($this->fisher)) || (empty($this->fisher->country_id))){
            $geoIp = GetGeoLocation::byIP();
            if(!empty($geoIp)){
                
                $country = Country::firstOrNew(['code' => $geoIp->countryCode]);
                if (empty($country->name)){
                    $country->name= $geoIp->countryName;
                    $country->save();
                }
                $this->fisher->country_id = $country->id;
                $this->fisher->lat = $geoIp->lat;

                $this->fisher->long = $geoIp->lng;
                $this->fisher->geo_ip_at = Carbon::now();
                $this->fisher->save();
            }

        }
    }

    private function uploadAndResize($field, $width = 300, $height = 300){
        $image = $this->$field;
        $fileName   = time() . '.' . $image->getClientOriginalExtension();
        $path = "{$field}/{$this->fisher->id}/{$fileName}";

        # Original Picture Size
        $img = Image::make($image->getRealPath());
        $img->stream();
        Storage::disk('public')->put("original/{$path}", $img);

        # Resize Picture
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();                 
        });
        $img->stream();
        Storage::disk('public')->put($path, $img);
        return Storage::disk('public', $img)->url($path);
    }


    public function render()
    {
        return view('livewire.boat.edit-fisher', ['genders' => $this->genders]);
    }
}
