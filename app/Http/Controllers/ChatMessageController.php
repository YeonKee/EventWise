<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\Student;

class ChatMessageController extends Controller
{
    public function getChat($id)
    {
        // Fetch staff-specific messages from the database
        $chatSessions = ChatMessage::distinct('chat_session')
            ->orderBy('chat_id')
            ->pluck('chat_session');

        if ($id == "0") {
            $id = $chatSessions->first();
        }

        // Fetch staff-specific messages from the database
        $messages = ChatMessage::where('chat_session', $id)
            ->orderBy('created_at', 'asc') // Adjust the order as needed
            ->get();

        $student = Student::where('stud_id', $id)->first();

        // Pass the staff-specific messages to the view
        return view("staffs.livechat", [
            'chatSessions' => $chatSessions,
            'messages' => $messages,
            'currentChatSession' => $id,
            'student' => $student
        ]);
    }

    public function destroy($id)
    {
        $chats = ChatMessage::where('chat_session', $id)->get();
        $chats->each->delete();

        return redirect()->back()->with('chatSessions', '0');
    }
}
