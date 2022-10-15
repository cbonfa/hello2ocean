<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'image', 'drop_id', 'splash_id', 
        'blocked', 'splash_needed', 'blocked_reason', 'user_id', 'fisher_id'
    ];

    public function splash()
    {
        return $this->belongsTo(Splash::class);
    }

    public function drop()
    {
        return $this->belongsTo(Drop::class);
    }
}
