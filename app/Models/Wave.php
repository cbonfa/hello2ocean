<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wave extends Model
{
    use HasFactory;

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function splashs() 
    { 
        return $this->hasMany(Splash::class); 
    } 
    
}