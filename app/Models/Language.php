<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

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
