<?php

namespace App\Http\Controllers;

use App\Models\Fisher;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage(Request $request, Fisher $fisher)
    {
        return $request->message;
    }
}
