@extends('layouts.app')

@section('title', 'Approvals')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Approvals</h1>
    <a href="{{ route('approvals.create') }}" class="btn btn-wecom-primary">
        <i class="bi bi-plus-lg me-2"></i>New Request
    </a>
</div>

<ul class="nav nav-tabs mb-4" role="tablist">
    <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#my-requests" type="button">My Requests</button>
    </li>
    @if(auth()->user()->isAdmin())
    <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#to-review" type="button">To Review ({{ $toReview->count() }})</button>
    </li>
    @endif
</ul>

<div class="tab-content">
    <!-- My Requests -->
    <div class="tab-pane fade show active" id="my-requests">
        <div class="card">
            <div class="card-body">
                @if($myRequests->count() > 0)
                    <div class="list-group">
                        @foreach($myRequests as $approval)
                            <a href="{{ route('approvals.show', $approval->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1" style="font-weight: 600;">
                                        <span class="badge {{ $approval->status === 'approved' ? 'badge-success' : ($approval->status === 'rejected' ? 'badge-danger' : 'badge-warning') }}">
                                            {{ ucfirst($approval->status) }}
                                        </span>
                                        {{ $approval->title }}
                                    </h6>
                                    <p class="mb-1 text-muted small">{{ $approval->description }}</p>
                                    <small class="text-muted">{{ $approval->created_at->format('M d, Y') }}</small>
                                </div>
                                <i class="bi bi-chevron-right text-muted"></i>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-file-earmark-check" style="font-size: 4rem; color: var(--wecom-gray);"></i>
                        <p class="mt-3" style="color: var(--wecom-gray);">No approval requests yet</p>
                        <a href="{{ route('approvals.create') }}" class="btn btn-wecom-primary">
                            <i class="bi bi-plus-lg me-2"></i>Create Your First Request
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- To Review (Admin Only) -->
    @if(auth()->user()->isAdmin())
    <div class="tab-pane fade" id="to-review">
        <div class="card">
            <div class="card-body">
                @if($toReview->count() > 0)
                    <div class="list-group">
                        @foreach($toReview as $approval)
                            <a href="{{ route('approvals.show', $approval->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1" style="font-weight: 600;">
                                        <span class="badge badge-warning">Pending</span>
                                        {{ $approval->title }}
                                    </h6>
                                    <p class="mb-1 text-muted small">{{ $approval->description }}</p>
                                    <small class="text-muted">Requested by: {{ $approval->requester->name }}</small>
                                </div>
                                <i class="bi bi-chevron-right text-muted"></i>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-check-circle" style="font-size: 4rem; color: var(--wecom-green);"></i>
                        <p class="mt-3" style="color: var(--wecom-gray);">No pending approvals to review</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
