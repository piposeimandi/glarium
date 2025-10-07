<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\ChatNotification;
use Auth;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        $message = $request->input('message');
        $user = Auth::user();

        if ($message && $user) {
            broadcast(new ChatNotification('sendMessage', [
                'name' => $user->name,
                'message' => $message,
                'time' => now()->format('H:i')
            ]));
        }

        return response('ok');
    }
}
