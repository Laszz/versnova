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

        $recentStatuses = ['waiting_confirmation', 'confirmed', 'completed'];

        $transactionUsers = User::where('id', '!=', $adminId)
            ->whereHas('transactions', function ($q) use ($recentStatuses) {
                $q->whereIn('status', $recentStatuses);
            })->with(['transactions' => function ($q) use ($recentStatuses) {
                $q->whereIn('status', $recentStatuses)->latest();
            }])->get()->keyBy('id');

        $chatUsers = User::where('id', '!=', $adminId)
            ->where(function ($q) use ($adminId) {
                $q->whereHas('sentMessages', fn($q) => $q->where('receiver_id', $adminId))
                  ->orWhereHas('receivedMessages', fn($q) => $q->where('sender_id', $adminId));
            })->get()->keyBy('id');

        $users = $transactionUsers;

        foreach ($chatUsers as $id => $u) {
            if (!isset($users[$id])) {
                $users[$id] = $u;
            }
        }

        foreach ($users as $u) {
            $u->unread = ChatMessage::where('sender_id', $u->id)
                ->where('receiver_id', $adminId)
                ->where('is_read', false)
                ->count();

            $u->lastTransaction = $u->transactions?->first();
        }

        $users = $users->sortByDesc(function ($u) {
            return $u->unread > 0 ? 1 : 0;
        });

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

        $lastTransaction = $user->transactions()
            ->whereIn('status', ['waiting_confirmation', 'confirmed', 'completed'])
            ->with('account.game')
            ->latest()
            ->first();

        return view('admin.chat.show', compact('messages', 'user', 'lastTransaction'));
    }
}
