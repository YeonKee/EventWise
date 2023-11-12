<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PusherController extends Controller
{
    public function index()
    {
        return view("chat");
    }

    public function broadcast(Request $request)
    {
        $message = $request->get('message');
        
        if ($request->session()->has('studID')){
            $studID = $request->session()->get('studID');
        }else{
            // Not authenticated user
            $studID = Str::random(8);
        }

        $chatMessage = new ChatMessage([
            'message' => $message,
            'sender_id' => $studID,
            'receiver_id' => '0',       // All staff can reveive
        ]);

        $chatMessage->save();

        broadcast(new PusherBroadcast($message))->toOthers();
        return view('broadcast', ['message' => $message]);
    }

    public function receive(Request $request)
    {
        $message = $request->get('message');
        
        if ($request->session()->has('studID')){
            $studID = $request->session()->get('studID');
        }else{
            // Not authenticated user
            $studID = Str::random(8);
        }

        $chatMessage = new ChatMessage([
            'message' => $message,
            'sender_id' => $studID,
            'receiver_id' => '0',  // All staff can receive
        ]);

        $chatMessage->save();

        broadcast(new PusherBroadcast($message))->toOthers();
        return view("receive", ['message' => $request->get('message')]);

    }
}
