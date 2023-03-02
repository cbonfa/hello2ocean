<?php

namespace App\Http\Livewire\Boat;

use App\Models\Country;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\GuardsLimewireAuth;
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

    protected $guard = 'fisher';
    private $fisher;
    
    public $profile_image, $nick_image;
    public $name, $nick, $country_id, $birthdate, $gender;
    public $cep ,$address ,$number ,$complement ,$neighborhood,$city ,$uf; 
    public $zipcode, $international_address;
    public $genders;
    public $updateFisher = false;

    public function __construct()
    {
        $this->fisher = auth()->user();
        $this->loadVars();
        $this->setGeoIP();
    }

    public function loadVars(){
        if (empty($this->fisher)) { return; }

        // MUDAR PARA SET SERIA MELHOR
        // MUDAR PARA args var seria melho
        // loop dentro do getModels Seria melhor
        // Adicionar o only, seria melhor
        // passar o 'fisher' ou inves de Fisher::class seria melhor
        // Remover key se nullables
        $modelVars = $this->getModelVars($this, Fisher::class, [ 'except' => ['nick_image', 'profile_image'] ]);
        foreach($modelVars as $var){
            $this->$var = $this->fisher->$var;
        }        
        // $this->nick = $this->fisher->nick;
        // $this->birthdate = $this->fisher->birthdate;
        // $this->gender = $this->fisher->gender;
        $this->genders = GenderType::asSelectArray();
    }

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
                                'cep' => '|exists:games,id','address' => '','number' => '' ,'complement' => '',
                                'neighborhood' => '','city' => '','uf' => '']);
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
