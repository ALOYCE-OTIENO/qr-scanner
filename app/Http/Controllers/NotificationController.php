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
                if ($notification->is_read) {
                    $otherNotifications['read'][] = $notification;
                } else {
                    $otherNotifications['unread'][] = $notification;
                }
            }
        }

        // Build final lists separated by read status
        $unreadNotifications = collect();
        $readNotifications = collect();

        // Add unread message notifications
        foreach ($groupedNotifications as $group) {
            foreach ($group['unread'] as $unread) {
                if ($unread->route) {
                    $unread->route = str_replace('http://localhost', 'http://127.0.0.1:8000', $unread->route);
                }
                $unreadNotifications->push($unread);
            }
        }

        // Add unread other notifications
        if (isset($otherNotifications['unread'])) {
            foreach ($otherNotifications['unread'] as $unread) {
                if ($unread->route) {
                    $unread->route = str_replace('http://localhost', 'http://127.0.0.1:8000', $unread->route);
                }
                $unreadNotifications->push($unread);
            }
        }

        // Add merged read message notifications
        foreach ($groupedNotifications as $group) {
            if (!empty($group['read'])) {
                $mostRecent = $group['read'][0];
                $mostRecent->is_merged = true;
                $mostRecent->merged_count = count($group['read']);
                if ($mostRecent->route) {
                    $mostRecent->route = str_replace('http://localhost', 'http://127.0.0.1:8000', $mostRecent->route);
                }
                $readNotifications->push($mostRecent);
            }
        }

        // Add read other notifications
        if (isset($otherNotifications['read'])) {
            foreach ($otherNotifications['read'] as $read) {
                if ($read->route) {
                    $read->route = str_replace('http://localhost', 'http://127.0.0.1:8000', $read->route);
                }
                $readNotifications->push($read);
            }
        }

        // Paginate
        $page = request()->get('page', 1);
        $perPage = 20;
        
        $paginatedUnread = new \Illuminate\Pagination\LengthAwarePaginator(
            $unreadNotifications->forPage($page, $perPage),
            $unreadNotifications->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $paginatedRead = new \Illuminate\Pagination\LengthAwarePaginator(
            $readNotifications->forPage($page, $perPage),
            $readNotifications->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('notifications.index', [
            'unreadNotifications' => $paginatedUnread,
            'readNotifications' => $paginatedRead
        ]);
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

    public function destroy($id)
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $notification->delete();

        return back()->with('success', 'Notification deleted successfully');
    }

    public function clearRead()
    {
        Auth::user()->notifications()->where('is_read', true)->delete();

        return back()->with('success', 'All read notifications cleared');
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
