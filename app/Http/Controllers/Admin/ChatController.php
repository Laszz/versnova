<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $adminId = request()->user()->id;

        $chatUsers = User::where('id', '!=', $adminId)
            ->where(function ($q) {
                $q->whereHas('sentMessages')->orWhereHas('receivedMessages');
            })->get()->keyBy('id');

        $transactionUsers = User::where('id', '!=', $adminId)
            ->whereHas('transactions', function ($q) {
                $q->whereIn('status', ['waiting_payment', 'waiting_confirmation', 'confirmed', 'completed']);
            })->with(['transactions' => function ($q) {
                $q->whereIn('status', ['waiting_payment', 'waiting_confirmation', 'confirmed', 'completed'])->latest();
            }])->get();

        $users = $transactionUsers->merge($chatUsers)->unique('id')->values();

        foreach ($users as $u) {
            $u->unread = ChatMessage::where('sender_id', $u->id)
                ->where('receiver_id', $adminId)
                ->where('is_read', false)
                ->count();
            $u->lastTransaction = $u->transactions->first();
        }

        return view('admin.chat.index', compact('users'));
    }

    public function show(User $user)
    {
        $messages = ChatMessage::where(function ($q) use ($user) {
            $q->where('sender_id', request()->user()->id)->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($user) {
            $q->where('sender_id', $user->id)->where('receiver_id', request()->user()->id);
        })->with('sender', 'receiver')->latest()->get();

        ChatMessage::where('sender_id', $user->id)
            ->where('receiver_id', request()->user()->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('admin.chat.show', compact('messages', 'user'));
    }
}
