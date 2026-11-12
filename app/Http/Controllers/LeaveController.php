<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LeaveController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin sees all leaves
            $leaves = Leave::with('user')->orderBy('created_at', 'desc')->get();
        } else {
            // Employee sees only their leaves
            $leaves = Leave::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        }
        
        return view('leaves.index', compact('leaves'));
    }

    public function create()
    {
        return view('leaves.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'leave_type' => 'required|in:personal,sick,annual,adjustment',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:1000',
        ]);

        // Calculate days automatically
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $days = $startDate->diffInDays($endDate) + 1;

        $leave = Leave::create([
            'user_id' => Auth::id(),
            'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'days' => $days,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        // Notify all admins about the new leave request
        $admins = \App\Models\User::where('is_admin', true)->get();
        foreach ($admins as $admin) {
            \App\Models\Notification::create([
                'user_id' => $admin->id,
                'title' => 'New Leave Request',
                'message' => Auth::user()->name . " has applied for " . ucfirst($request->leave_type) . " leave",
                'type' => 'system',
                'related_id' => $leave->id,
                'route' => route('leaves.show', $leave->id),
                'is_read' => false
            ]);
        }

        return redirect()->route('leaves.index')->with('success', 'Leave request submitted successfully');
    }

    public function show($id)
    {
        $leave = Leave::with('user')->findOrFail($id);
        return view('leaves.show', compact('leave'));
    }

    public function approve($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->update([
            'status' => 'approved',
            'admin_comment' => 'Approved by ' . Auth::user()->name
        ]);

        // Notify the employee that their leave was approved
        \App\Models\Notification::create([
            'user_id' => $leave->user_id,
            'title' => 'Leave Approved',
            'message' => "Your " . ucfirst($leave->leave_type) . " leave request has been approved",
            'type' => 'system',
            'related_id' => $leave->id,
            'route' => route('leaves.show', $leave->id),
            'is_read' => false
        ]);

        return redirect()->route('leaves.index')->with('success', 'Leave request approved');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'admin_comment' => 'required|string|max:500'
        ]);

        $leave = Leave::findOrFail($id);
        $leave->update([
            'status' => 'rejected',
            'admin_comment' => $request->admin_comment
        ]);

        // Notify the employee that their leave was rejected
        \App\Models\Notification::create([
            'user_id' => $leave->user_id,
            'title' => 'Leave Rejected',
            'message' => "Your " . ucfirst($leave->leave_type) . " leave request has been rejected: " . $request->admin_comment,
            'type' => 'system',
            'related_id' => $leave->id,
            'route' => route('leaves.show', $leave->id),
            'is_read' => false
        ]);

        return redirect()->route('leaves.index')->with('success', 'Leave request rejected');
    }
}
