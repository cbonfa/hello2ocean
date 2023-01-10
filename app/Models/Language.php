<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'country', 'country_code', 'locale', 'active'];

    public function splashs() 
    { 
        return $this->hasMany(Splash::class); 
    } 

    public function drops() 
    { 
        return $this->hasMany(Drop::class); 
    } 

    public function waves() 
    { 
        return $this->hasMany(Wave::class); 
    } 

}
