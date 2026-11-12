<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin sees all meetings
            $meetings = Meeting::with(['organizer', 'participants'])->orderBy('start_time', 'desc')->get();
        } else {
            // Employee sees only meetings they're participating in or organized
            $meetings = Meeting::whereHas('participants', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->orWhere('organizer_id', $user->id)
            ->with(['organizer', 'participants'])
            ->orderBy('start_time', 'desc')
            ->get();
        }
        
        return view('meetings.index', compact('meetings'));
    }

    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        
        return view('meetings.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'start_time' => 'required|date_format:Y-m-d\TH:i',
            'end_time' => 'required|date_format:Y-m-d\TH:i|after:start_time',
            'location' => 'nullable|string|max:255',
            'type' => 'required|in:meeting,video_call,training',
            'participants' => 'nullable|array',
            'participants.*' => 'exists:users,id'
        ]);

        $meeting = Meeting::create([
            'organizer_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            'type' => $request->type
        ]);

        // Add participants
        if ($request->filled('participants') && is_array($request->participants)) {
            $meeting->participants()->attach($request->participants);

            // Notify participants
            foreach ($request->participants as $userId) {
                \App\Models\Notification::create([
                    'user_id' => $userId,
                    'title' => 'New Meeting',
                    'message' => "You have been invited to: {$request->title}",
                    'type' => 'system',
                    'related_id' => $meeting->id,
                    'route' => route('meetings.show', $meeting->id),
                    'is_read' => false
                ]);
            }
        }

        return redirect()->route('meetings.index')->with('success', 'Meeting created successfully');
    }

    public function show($id)
    {
        $meeting = Meeting::with(['organizer', 'participants'])->findOrFail($id);
        
        return view('meetings.show', compact('meeting'));
    }
}
