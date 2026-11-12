<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $groups = $user->groups()->with('creator')->get();
        
        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        
        return view('groups.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'members' => 'nullable|array',
            'members.*' => 'exists:users,id',
            'is_announcement' => 'nullable|boolean'
        ]);

        $group = Group::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => Auth::id(),
            'is_announcement' => $request->is_announcement ?? false
        ]);

        // Add creator as admin
        $group->users()->attach(Auth::id(), ['is_admin' => true]);

        // Add selected members
        if ($request->filled('members') && is_array($request->members)) {
            foreach ($request->members as $memberId) {
                $group->users()->attach($memberId, ['is_admin' => false]);
                
                // Notify member
                \App\Models\Notification::create([
                    'user_id' => $memberId,
                    'title' => 'Added to Group',
                    'message' => "You have been added to the group: {$request->name}",
                    'type' => 'system',
                    'related_id' => $group->id,
                    'route' => route('groups.show', $group->id),
                    'is_read' => false
                ]);
            }
        }

        return redirect()->route('groups.index')->with('success', 'Group created successfully');
    }

    public function show($id)
    {
        $group = Group::with(['users', 'messages' => function ($query) {
            $query->with('sender', 'replyToMessage')->orderBy('created_at', 'asc');
        }])->findOrFail($id);

        // Check if user is a member
        if (!$group->users->contains(Auth::id())) {
            return back()->with('error', 'You are not a member of this group');
        }

        return view('groups.show', compact('group'));
    }

    public function sendMessage(Request $request, $groupId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'reply_to_message_id' => 'nullable|exists:messages,id',
            'is_private_reply' => 'nullable|boolean'
        ]);

        $group = Group::findOrFail($groupId);

        // Check if user is a member
        if (!$group->users->contains(Auth::id())) {
            return back()->with('error', 'You are not a member of this group');
        }

        // Check if it's a private reply
        $isPrivateReply = $request->is_private_reply ?? false;
        $replyToMessageId = $request->reply_to_message_id;

        if ($isPrivateReply && $replyToMessageId) {
            // Private reply - send to the original sender only
            $originalMessage = \App\Models\Message::findOrFail($replyToMessageId);
            
            \App\Models\Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $originalMessage->sender_id,
                'group_id' => $groupId,
                'content' => $request->content,
                'type' => 'text',
                'reply_to_message_id' => $replyToMessageId,
                'is_private_reply' => true,
                'is_read' => false
            ]);

            // Notify the recipient
            \App\Models\Notification::create([
                'user_id' => $originalMessage->sender_id,
                'title' => 'Private Reply',
                'message' => Auth::user()->name . " replied privately to your message in group: {$group->name}",
                'type' => 'message',
                'related_id' => Auth::id(),
                'route' => route('messages.show', Auth::id()),
                'is_read' => false
            ]);
        } else {
            // Regular group message
            \App\Models\Message::create([
                'sender_id' => Auth::id(),
                'group_id' => $groupId,
                'content' => $request->content,
                'type' => 'text',
                'reply_to_message_id' => $replyToMessageId,
                'is_private_reply' => false,
                'is_read' => false
            ]);

            // Notify all group members except sender
            foreach ($group->users as $member) {
                if ($member->id !== Auth::id()) {
                    \App\Models\Notification::create([
                        'user_id' => $member->id,
                        'title' => 'New Group Message',
                        'message' => Auth::user()->name . " sent a message in group: {$group->name}",
                        'type' => 'message',
                        'related_id' => Auth::id(),
                        'route' => route('groups.show', $groupId),
                        'is_read' => false
                    ]);
                }
            }
        }

        return back()->with('success', 'Message sent successfully');
    }

    public function addMember(Request $request, $groupId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $group = Group::findOrFail($groupId);
        
        if (!$group->users->where('id', Auth::id())->where('pivot.is_admin', true)->exists()) {
            return back()->with('error', 'Only group admins can add members');
        }

        $group->users()->attach($request->user_id, ['is_admin' => false]);

        // Notify the new member
        \App\Models\Notification::create([
            'user_id' => $request->user_id,
            'title' => 'Added to Group',
            'message' => "You have been added to the group: {$group->name}",
            'type' => 'system',
            'related_id' => $group->id,
            'route' => route('groups.show', $group->id),
            'is_read' => false
        ]);

        return back()->with('success', 'Member added successfully');
    }
}
