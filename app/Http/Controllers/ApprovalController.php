<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get approvals requested by user
        $myRequests = $user->requestedApprovals()->with(['requester', 'approver'])->orderBy('created_at', 'desc')->get();
        
        // Get approvals to review (if admin)
        $toReview = [];
        if ($user->isAdmin()) {
            $toReview = Approval::where('status', 'pending')
                ->with(['requester'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('approvals.index', compact('myRequests', 'toReview'));
    }

    public function create()
    {
        $approvers = User::where('is_admin', true)->get();
        
        return view('approvals.create', compact('approvers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:leave,expense,overtime,reimbursement,general',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'approver_id' => 'required|exists:users,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'amount' => 'nullable|numeric|min:0'
        ]);

        $details = [];
        
        if ($request->type === 'leave') {
            $details = [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'reason' => $request->description
            ];
        } elseif ($request->type === 'expense' || $request->type === 'reimbursement') {
            $details = [
                'amount' => $request->amount,
                'description' => $request->description
            ];
        }

        Approval::create([
            'requester_id' => Auth::id(),
            'approver_id' => $request->approver_id,
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'details' => $details,
            'status' => 'pending',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'amount' => $request->amount
        ]);

        return redirect()->route('approvals.index')->with('success', 'Approval request submitted successfully');
    }

    public function show($id)
    {
        $approval = Approval::with(['requester', 'approver'])->findOrFail($id);
        
        // Check if user is requester or approver
        if ($approval->requester_id !== Auth::id() && $approval->approver_id !== Auth::id() && !Auth::user()->isAdmin()) {
            return back()->with('error', 'You are not authorized to view this approval');
        }

        return view('approvals.show', compact('approval'));
    }

    public function approve($id)
    {
        $approval = Approval::findOrFail($id);
        
        if (!Auth::user()->isAdmin() && $approval->approver_id !== Auth::id()) {
            return back()->with('error', 'You are not authorized to approve this request');
        }

        $approval->update([
            'status' => 'approved',
            'approver_id' => Auth::id()
        ]);

        // Create notification for requester
        \App\Models\Notification::create([
            'user_id' => $approval->requester_id,
            'title' => 'Approval Approved',
            'message' => "Your approval request '{$approval->title}' has been approved",
            'type' => 'system',
            'is_read' => false
        ]);

        return back()->with('success', 'Approval approved successfully');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $approval = Approval::findOrFail($id);
        
        if (!Auth::user()->isAdmin() && $approval->approver_id !== Auth::id()) {
            return back()->with('error', 'You are not authorized to reject this request');
        }

        $approval->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'approver_id' => Auth::id()
        ]);

        // Create notification for requester
        \App\Models\Notification::create([
            'user_id' => $approval->requester_id,
            'title' => 'Approval Rejected',
            'message' => "Your approval request '{$approval->title}' has been rejected. Reason: {$request->rejection_reason}",
            'type' => 'system',
            'is_read' => false
        ]);

        return back()->with('success', 'Approval rejected successfully');
    }
}
