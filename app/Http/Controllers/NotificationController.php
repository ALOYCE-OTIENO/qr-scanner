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

        // Group notifications for display
        $groupedNotifications = [];
        $processedSenders = [];

        foreach ($notifications as $notification) {
            if ($notification->type === 'message') {
                // For message notifications, group by sender (related_id)
                $senderId = $notification->related_id;
                $key = 'message_' . $senderId;

                if (!isset($groupedNotifications[$key])) {
                    $groupedNotifications[$key] = [
                        'type' => 'message',
                        'sender_id' => $senderId,
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
                // Non-message notifications stay separate
                $groupedNotifications[] = $notification;
            }
        }

        // Flatten the grouped notifications for display
        $finalNotifications = collect();

        foreach ($groupedNotifications as $item) {
            if (is_array($item) && isset($item['type']) && $item['type'] === 'message') {
                // Show unread notifications first (if any)
                if (!empty($item['unread'])) {
                    foreach ($item['unread'] as $unread) {
                        $finalNotifications->push($unread);
                    }
                }
                // Then show merged read notification (if any)
                if (!empty($item['read'])) {
                    // Merge read notifications into one
                    $merged = $item['read'][0];
                    $merged->is_merged = true;
                    $merged->count = count($item['read']);
                    $finalNotifications->push($merged);
                }
            } else {
                $finalNotifications->push($item);
            }
        }

        // Paginate the final collection
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

        // If this is a message notification, check if there are other read notifications from the same sender
        // If yes, delete this one to merge with them
        if ($notification->type === 'message') {
            $otherReadNotifications = Notification::where('user_id', Auth::id())
                ->where('type', 'message')
                ->where('related_id', $notification->related_id)
                ->where('is_read', true)
                ->where('id', '!=', $notification->id)
                ->exists();

            if ($otherReadNotifications) {
                $notification->delete();
            }
        }

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
