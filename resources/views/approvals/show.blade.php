@extends('layouts.app')

@section('title', 'Approval Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ $approval->title }}</h1>
    <a href="{{ route('approvals.index') }}" class="btn btn-wecom-outline">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <p class="mb-1"><strong>Type:</strong> {{ ucfirst($approval->type) }}</p>
                <p class="mb-1"><strong>Status:</strong> 
                    <span class="badge {{ $approval->status === 'approved' ? 'badge-success' : ($approval->status === 'rejected' ? 'badge-danger' : 'badge-warning') }}">
                        {{ ucfirst($approval->status) }}
                    </span>
                </p>
                <p class="mb-1"><strong>Requested by:</strong> {{ $approval->requester->name }}</p>
                <p class="mb-1"><strong>Requested on:</strong> {{ $approval->created_at->format('M d, Y H:i') }}</p>
            </div>
            <div class="col-md-6">
                @if($approval->approver)
                    <p class="mb-1"><strong>Approver:</strong> {{ $approval->approver->name }}</p>
                @endif
                @if($approval->start_date)
                    <p class="mb-1"><strong>Start Date:</strong> {{ $approval->start_date->format('M d, Y') }}</p>
                @endif
                @if($approval->end_date)
                    <p class="mb-1"><strong>End Date:</strong> {{ $approval->end_date->format('M d, Y') }}</p>
                @endif
                @if($approval->amount)
                    <p class="mb-1"><strong>Amount:</strong> {{ number_format($approval->amount, 2) }}</p>
                @endif
            </div>
        </div>

        <hr>

        <div class="mb-4">
            <h5 class="mb-2">Description</h5>
            <p>{{ $approval->description }}</p>
        </div>

        @if($approval->rejection_reason)
        <div class="alert alert-danger">
            <strong>Rejection Reason:</strong> {{ $approval->rejection_reason }}
        </div>
        @endif

        @if($approval->status === 'pending' && (auth()->user()->isAdmin() || $approval->approver_id === auth()->id()))
        <hr>
        <div class="d-flex gap-2">
            <form action="{{ route('approvals.approve', $approval->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-wecom-primary">
                    <i class="bi bi-check-lg me-2"></i>Approve
                </button>
            </form>
            <button type="button" class="btn btn-wecom-outline" data-bs-toggle="modal" data-bs-target="#rejectModal">
                <i class="bi bi-x-lg me-2"></i>Reject
            </button>
        </div>

        <!-- Reject Modal -->
        <div class="modal fade" id="rejectModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reject Approval</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('approvals.reject', $approval->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="rejection_reason" class="form-label">Rejection Reason</label>
                                <textarea class="form-control" id="rejection_reason" name="rejection_reason" rows="3" required placeholder="Please provide a reason for rejection"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-wecom-outline" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
