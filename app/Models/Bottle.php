<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bottle extends Model
{
    use HasFactory;

    public function fisher()
    {
        return $this->belongsTo(Ficher::class);
    }

    public function splash()
    {
        return $this->belongsTo(Splash::class);
    }

    public function drop()
    {
        return $this->belongsTo(Drop::class);
    }

    # validates :answer, inclusion: [0, 1]
}
