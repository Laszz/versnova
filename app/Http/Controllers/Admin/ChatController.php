<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::whereHas('sentMessages')->orWhereHas('receivedMessages')->distinct()->get();
        return view('admin.chat.index', compact('users'));
    }
}
