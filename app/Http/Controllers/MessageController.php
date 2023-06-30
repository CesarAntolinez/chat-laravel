<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        return $request->user()->messages()->create([
            'content' => $request->message,
            'chat_id' => $request->chat,
        ])->load('user');
    }
}
