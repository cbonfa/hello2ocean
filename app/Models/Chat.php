<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['fisher_id', 'receiver_id', 'text_sent', 'received_text', 'read_in'];

    public function fisher() 
    { 
        return $this->belongsTo(Fisher::class); 
    } 

    public function received() 
    { 
        return $this->belongsTo(Fisher::class,'receiver_id','id');
    } 

    
    public static function create_history_chat($sender_id, $receiver_id, $msg)
    {

        $self = new static;
        $chats = [];
        $chats[] = $self->create(['fisher_id' => $sender_id,
                       'receiver_id' => $receiver_id,
                       'text_sent' => $msg ]);
        $chats[] = $self->create(['receiver_id' => $sender_id,
                       'fisher_id' => $receiver_id,
                       'received_text' => $msg ]);
        return $chats;
    }
    


    
}