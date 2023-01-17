<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affinitie extends Model
{
    use HasFactory;

    protected $fillable = ['fisher_id', 'fisherman_id', 'join_date', 
                            'last_show', 'hidden_date', 'blocked_date',
                            'affinity', 'points','drops', 'splashs'];    
}
