@extends('layouts.app')

@section('title', 'Leaves')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Leaves</h1>
    <a href="{{ route('leaves.create') }}" class="btn btn-wecom-primary">
        <i class="bi bi-plus-lg me-2"></i>Apply for Leave
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        @if($leaves->count() > 0)
            <div class="list-group">
                @foreach($leaves as $leave)
                    <a href="{{ route('leaves.show', $leave->id) }}" class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1" style="font-weight: 600;">
                                    <span class="badge badge-info">{{ ucfirst($leave->leave_type) }} Leave</span>
                                    {{ $leave->user->name }}
                                </h6>
                                <p class="mb-1 text-muted">{{ $leave->reason }}</p>
                                <small class="text-muted">
                                    {{ $leave->start_date->format('M d, Y') }} - {{ $leave->end_date->format('M d, Y') }}
                                    ({{ $leave->days }} days)
                                </small>
                            </div>
                            <span class="badge {{ $leave->status === 'approved' ? 'badge-success' : ($leave->status === 'rejected' ? 'badge-danger' : 'badge-warning') }}">
                                {{ ucfirst($leave->status) }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-calendar-x" style="font-size: 4rem; color: var(--wecom-gray);"></i>
                <p class="mt-3" style="color: var(--wecom-gray);">No leave requests found</p>
                <a href="{{ route('leaves.create') }}" class="btn btn-wecom-primary">
                    <i class="bi bi-plus-lg me-2"></i>Apply for Leave
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
