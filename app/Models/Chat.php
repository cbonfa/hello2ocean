<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['fisher_id', 'receiver_id', 'text_sent', 'received_text'];

    public function fisher() 
    { 
        return $this->belongsTo(Fisher::class); 
    } 

    public function received() 
    { 
        return $this->belongsTo(Fisher::class,'receiver_id','id');
    } 


    
}