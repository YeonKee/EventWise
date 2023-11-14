<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use App\Events\PusherReceive;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PusherController extends Controller
{
    public function index(Request $request)
    {
        $messages = ChatMessage::where('chat_session', $request->session()->get('studID')) // Replace '0' with the actual ID for staff
            ->orderBy('created_at', 'asc') // Adjust the order as needed
            ->get();

        return view("chat", ['messages' => $messages]);
    }

    public function staffIndex()
    {
        // Fetch staff-specific messages from the database
        $messages = ChatMessage::where('chat_session', '22WMR05586') // Replace '0' with the actual ID for staff
            ->orderBy('created_at', 'asc') // Adjust the order as needed
            ->get();

        // Pass the staff-specific messages to the view
        return view("staffChat", ['messages' => $messages]);
    }

    public function getAllChatSession()
    {
        // Fetch staff-specific messages from the database
        $chatSessions = ChatMessage::distinct('chat_session')
            ->orderBy('chat_id')
            ->pluck('chat_session');

        // Pass the staff-specific messages to the view
        return view("staffChat", ['chatSessions' => $chatSessions]);
    }

    public function broadcast(Request $request)
    {
        $message = $request->message;
        $receiver_id = $request->get('receiver_id');
        $chat_session = $request->get('session_id');

        if ($request->session()->has('role')) {
            $userType = $request->session()->get('role');
            $senderId = ($userType == 'student') ? $request->session()->get('studID') : $request->session()->get('staffID');
        } else {
            $senderId = $chat_session;
            $userType = "normal";
        }

        $chatMessage = new ChatMessage();
        $chatMessage->chat_session = $chat_session;
        $chatMessage->sender_id = $senderId;
        $chatMessage->receiver_id = $receiver_id;
        $chatMessage->sender_type = $userType;
        $chatMessage->message = $message;
        $chatMessage->save();

        broadcast(new PusherBroadcast($message, $chat_session))->toOthers();
        return view("broadcast", ['message' => $request->get('message'), 'chat_session' => $chat_session]);
    }

    public function receive(Request $request)
    {
        $message = $request->message;
        $receiver_id = $request->get('receiver_id');
        $chat_session = $request->get('session_id');

        if ($request->session()->has('role')) {
            $userType = $request->session()->get('role');
            $senderId = ($userType == 'student') ? $request->session()->get('studID') : $request->session()->get('staffID');
        } else {
            $senderId = $chat_session;
            $userType = "normal";
        }

        $chatMessage = new ChatMessage();
        $chatMessage->chat_session = $chat_session;
        $chatMessage->sender_id = $senderId;
        $chatMessage->receiver_id = $receiver_id;
        $chatMessage->sender_type = $userType;
        $chatMessage->message = $message;
        $chatMessage->save();

        broadcast(new PusherReceive($message, $chat_session))->toOthers();
        return view("receive", ['message' => $request->get('message'), 'chat_session' => $request->get('session_id')]);
    }
}