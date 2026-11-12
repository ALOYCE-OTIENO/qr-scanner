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
            ->get();

        // Group message notifications by sender
        $groupedNotifications = [];
        $otherNotifications = [];

        foreach ($notifications as $notification) {
            if ($notification->type === 'message') {
                $senderId = $notification->related_id;
                $key = 'message_' . $senderId;

                if (!isset($groupedNotifications[$key])) {
                    $groupedNotifications[$key] = [
                        'unread' => [],
                        'read' => []
                    ];
                }

                if ($notification->is_read) {
                    $groupedNotifications[$key]['read'][] = $notification;
                } else {
                    $groupedNotifications[$key]['unread'][] = $notification;
                }
            } else {
                $otherNotifications[] = $notification;
            }
        }

        // Build final list
        $finalNotifications = collect();

        // Add unread message notifications first
        foreach ($groupedNotifications as $group) {
            foreach ($group['unread'] as $unread) {
                // Fix the route to use the correct URL
                if ($unread->route) {
                    $unread->route = str_replace('http://localhost', 'http://127.0.0.1:8000', $unread->route);
                }
                $finalNotifications->push($unread);
            }
        }

        // Add other notifications (leaves, system, etc.)
        foreach ($otherNotifications as $other) {
            $finalNotifications->push($other);
        }

        // Add merged read message notifications
        foreach ($groupedNotifications as $group) {
            if (!empty($group['read'])) {
                // Use the most recent read notification as the representative
                $mostRecent = $group['read'][0];
                $mostRecent->is_merged = true;
                $mostRecent->merged_count = count($group['read']);
                // Fix the route to use the correct URL
                if ($mostRecent->route) {
                    $mostRecent->route = str_replace('http://localhost', 'http://127.0.0.1:8000', $mostRecent->route);
                }
                $finalNotifications->push($mostRecent);
            }
        }

        // Paginate
        $page = request()->get('page', 1);
        $perPage = 20;
        $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $finalNotifications->forPage($page, $perPage),
            $finalNotifications->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('notifications.index', ['notifications' => $paginated]);
    }

    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $notification->update(['is_read' => true]);

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

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
