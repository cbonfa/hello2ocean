<?php

namespace App\Events;

use App\Models\Fisher;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    protected $fisher;
    public $user;
    
    public $message;

    public function __construct(Fisher $fisher, Fisher $user,  $message)
    {
        # Quem está enviando
        $this->user = $user;
        # Destinatário (Addressee/Receiver)
        $this->fisher = $fisher;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel("chat.fisher.{$this->fisher->id}", ['guard' => 'fisher']);
    }
}
