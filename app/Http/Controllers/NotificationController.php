<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()
            ->notifications()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $notification->update(['is_read' => true]);

        return back()->with('success', 'Notification marked as read');
    }

    public function markAllAsRead()
    {
        Auth::user()->notifications()->update(['is_read' => true]);

        return back()->with('success', 'All notifications marked as read');
    }

    public function create()
    {
        if (!Auth::user()->isAdmin()) {
            return back()->with('error', 'Only admins can create announcements');
        }

        $users = \App\Models\User::all();

        return view('notifications.create', compact('users'));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            return back()->with('error', 'Only admins can create announcements');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'recipients' => 'array',
            'recipients.*' => 'exists:users,id'
        ]);

        $recipients = $request->has('recipients') ? $request->recipients : \App\Models\User::pluck('id')->toArray();

        foreach ($recipients as $userId) {
            Notification::create([
                'user_id' => $userId,
                'title' => $request->title,
                'message' => $request->message,
                'type' => 'announcement',
                'is_read' => false
            ]);
        }

        return redirect()->route('notifications.index')->with('success', 'Announcement sent successfully');
    }
}
