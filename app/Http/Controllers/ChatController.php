<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Fisher;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage(Request $request, Fisher $fisher)
    {
        # \Log::debug('entrou ChatController');
        broadcast(new MessageSent($fisher, $request->user(), $request->message));
        # broadcast($request->user(), "teste" . $request->message);
        return $request->message;
    }
}
