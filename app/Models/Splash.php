<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Splash extends Model
{
    use HasFactory;

    public function wave()
    {
        return $this->belongsTo(Wave::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }  
    
    public function drops()
    {
        return $this->hasMany(Drop::class);
    }
}
