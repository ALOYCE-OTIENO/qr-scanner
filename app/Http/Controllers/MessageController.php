<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $conversations = Message::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($message) use ($user) {
                return $message->sender_id === $user->id ? $message->receiver_id : $message->sender_id;
            });

        return view('messages.index', compact('conversations'));
    }

    public function show($userId)
    {
        $user = Auth::user();
        $otherUser = User::findOrFail($userId);
        
        $messages = Message::where(function ($query) use ($user, $userId) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($user, $userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', $user->id);
        })->with(['sender', 'receiver'])
        ->orderBy('created_at', 'asc')
        ->get();

        // Mark messages as read
        Message::where('receiver_id', $user->id)
            ->where('sender_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('messages.show', compact('messages', 'otherUser'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string|max:1000',
            'type' => 'in:text,image,file'
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
            'type' => $request->type ?? 'text',
            'is_read' => false
        ]);

        // Create notification for the receiver
        \App\Models\Notification::create([
            'user_id' => $request->receiver_id,
            'title' => 'New Message',
            'message' => Auth::user()->name . ' sent you a message',
            'type' => 'message',
            'related_id' => $message->id,
            'route' => route('messages.show', $request->receiver_id),
            'is_read' => false
        ]);

        return back()->with('success', 'Message sent successfully');
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        
        // Only allow sender or receiver to delete
        if ($message->sender_id !== Auth::id() && $message->receiver_id !== Auth::id()) {
            return back()->with('error', 'You cannot delete this message');
        }

        $message->delete();
        return back()->with('success', 'Message deleted successfully');
    }

    public function destroySelected(Request $request)
    {
        $request->validate([
            'message_ids' => 'required|array',
            'message_ids.*' => 'exists:messages,id'
        ]);

        $count = 0;
        foreach ($request->message_ids as $messageId) {
            $message = Message::find($messageId);
            if ($message && ($message->sender_id === Auth::id() || $message->receiver_id === Auth::id())) {
                $message->delete();
                $count++;
            }
        }

        return back()->with('success', $count . ' messages deleted successfully');
    }

    public function destroyAll($userId)
    {
        $user = Auth::user();
        
        $count = Message::where(function ($query) use ($user, $userId) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($user, $userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', $user->id);
        })->delete();

        return redirect()->route('messages.index')->with('success', 'All messages deleted successfully');
    }
}
