@extends('layouts.app')

@section('title', 'Leave Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Leave Details</h1>
    <a href="javascript:history.back()" class="btn btn-wecom-outline">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <p class="mb-1"><strong>Employee:</strong> {{ $leave->user->name }}</p>
                <p class="mb-1"><strong>Leave Type:</strong> 
                    <span class="badge badge-info">{{ ucfirst($leave->leave_type) }} Leave</span>
                </p>
                <p class="mb-1"><strong>Duration:</strong> {{ $leave->days }} days</p>
            </div>
            <div class="col-md-6">
                <p class="mb-1"><strong>Start Date:</strong> {{ $leave->start_date->format('M d, Y') }}</p>
                <p class="mb-1"><strong>End Date:</strong> {{ $leave->end_date->format('M d, Y') }}</p>
                <p class="mb-1"><strong>Status:</strong> 
                    <span class="badge {{ $leave->status === 'approved' ? 'badge-success' : ($leave->status === 'rejected' ? 'badge-danger' : 'badge-warning') }}">
                        {{ ucfirst($leave->status) }}
                    </span>
                </p>
            </div>
        </div>

        <hr>

        <div class="mb-4">
            <h5 class="mb-2">Reason</h5>
            <p>{{ $leave->reason }}</p>
        </div>

        @if($leave->admin_comment)
        <hr>
        <div>
            <h5 class="mb-2">Admin Comment</h5>
            <p>{{ $leave->admin_comment }}</p>
        </div>
        @endif

        @if(auth()->user()->isAdmin() && $leave->status === 'pending')
        <hr>
        <div class="d-flex gap-2">
            <form method="POST" action="{{ route('leaves.approve', $leave->id) }}">
                @csrf
                <button type="submit" class="btn btn-wecom-primary">
                    <i class="bi bi-check-circle me-2"></i>Approve
                </button>
            </form>
            <form method="POST" action="{{ route('leaves.reject', $leave->id) }}">
                @csrf
                <input type="text" name="admin_comment" class="form-control" placeholder="Rejection reason" required style="display: inline-block; width: 300px;">
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-x-circle me-2"></i>Reject
                </button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
