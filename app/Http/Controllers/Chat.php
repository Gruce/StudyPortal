<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class Chat extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function fetchMessages()
    {
        return Message::query()->with('User')->get();
    }

    public function sendMessage(Request $request)
    {
        $message = auth()->user()->Message()->create([
            'message' => $request->input('message')
        ]);

        broadcast(new MessageSent(auth()->user(), $message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
