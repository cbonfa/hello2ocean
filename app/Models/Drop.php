<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drop extends Model
{
    use HasFactory;

    public function splash()
    {
        return $this->belongsTo(Splash::class);
    }
    
    public function drop()
    {
        return $this->belongsTo(Drop::class);
    }    
}
