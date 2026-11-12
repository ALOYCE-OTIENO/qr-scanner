@extends('layouts.app')

@section('title', 'Apply for Leave')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Apply for Leave</h1>
    <a href="{{ route('leaves.index') }}" class="btn btn-wecom-outline">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('leaves.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="leave_type" class="form-label">Leave Type</label>
                <select class="form-select" id="leave_type" name="leave_type" required>
                    <option value="">Select leave type...</option>
                    <option value="personal">Personal Leave</option>
                    <option value="sick">Sick Leave</option>
                    <option value="annual">Annual Leave</option>
                    <option value="adjustment">Leave Adjustment</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="days" class="form-label">Number of Days</label>
                <input type="number" class="form-control" id="days" name="days" required min="1" value="1">
            </div>

            <div class="mb-3">
                <label for="reason" class="form-label">Reason</label>
                <textarea class="form-control" id="reason" name="reason" rows="4" required placeholder="Please provide reason for your leave request"></textarea>
            </div>

            <button type="submit" class="btn btn-wecom-primary">
                <i class="bi bi-send me-2"></i>Submit Leave Request
            </button>
        </form>
    </div>
</div>
@endsection
