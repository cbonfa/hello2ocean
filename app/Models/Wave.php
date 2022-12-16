<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wave extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'language_id', 'wave_id_main', 'wave_id_language'];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function splashs() 
    { 
        return $this->hasMany(Splash::class); 
    } 

    public function main_wave(){
        return $this->belongsTo(Wave::class, 'wave_id_main', 'id');
    }

    public function main_wave_language(){
        return $this->belongsTo(Wave::class, 'wave_id_language', 'id');
    }
    
}