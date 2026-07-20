<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->is_admin) {
            return redirect()->route('admin.chat');
        }

        ChatMessage::where('receiver_id', $request->user()->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = ChatMessage::where('sender_id', $request->user()->id)
            ->orWhere('receiver_id', $request->user()->id)
            ->with('sender', 'receiver')
            ->latest()
            ->get();

        return view('chat.index', compact('messages'));
    }

    public function with(Request $request, User $user)
    {
        abort_if(!$request->user()->is_admin && $user->is_admin, 403);

        $messages = ChatMessage::where(function ($q) use ($request, $user) {
            $q->where('sender_id', $request->user()->id)->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($request, $user) {
            $q->where('sender_id', $user->id)->where('receiver_id', $request->user()->id);
        })->with('sender', 'receiver')->latest()->get();

        return view('chat.index', compact('messages', 'user'));
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
