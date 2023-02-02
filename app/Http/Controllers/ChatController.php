<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Chat;
use App\Models\Fisher;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage(Request $request, Fisher $fisher)
    {
        # \Log::debug('entrou ChatController');
        broadcast(new MessageSent($fisher, $request->user(), $request->message));
        return $request->message;
    }

    public function getMessages(Request $request, Fisher $fisher)
    {
        $limit  = Chat::where(['fisher_id' => $fisher->id])->whereNull('read_in')->update(['read_in' => now()]) + 10;
        return response()->json(Chat::where(['fisher_id' => $fisher->id])
                    ->limit($limit)
                    ->select('received_text as sent', 'text_sent as received')
                    ->orderBy('created_at')
                    ->get());
    }
}
