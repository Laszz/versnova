<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $messages = ChatMessage::where('sender_id', $request->user()->id)
            ->orWhere('receiver_id', $request->user()->id)
            ->with('sender', 'receiver')
            ->latest()
            ->get();

        return view('chat.index', compact('messages'));
    }

    public function send(Request $request, User $user)
    {
        $data = $request->validate(['message' => 'required|string|max:1000']);

        ChatMessage::create([
            'sender_id' => $request->user()->id,
            'receiver_id' => $user->id,
            'message' => $data['message'],
        ]);

        return back();
    }
}
