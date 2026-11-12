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
            'days' => 'required|integer|min:1',
            'reason' => 'required|string|max:1000',
        ]);

        $leave = Leave::create([
            'user_id' => Auth::id(),
            'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'days' => $request->days,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

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

        return redirect()->route('leaves.index')->with('success', 'Leave request rejected');
    }
}
