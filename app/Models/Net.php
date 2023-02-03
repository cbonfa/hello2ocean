<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Net extends Model
{
    use HasFactory;

    protected $table = 'net';

    protected $fillable = ['fisher_id', 'friend_id', 'profile_image', 
                            'display_name', 'blocked', 'affinity', 
                            'points','drops', 'splashs'];
}
