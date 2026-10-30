@extends('layouts.app')

@section('title', 'Create Approval Request')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Create Approval Request</h1>
    <a href="{{ route('approvals.index') }}" class="btn btn-wecom-outline">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('approvals.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="type" class="form-label">Request Type</label>
                <select class="form-select" id="type" name="type" required onchange="toggleFields()">
                    <option value="">Select type...</option>
                    <option value="leave">Leave Request</option>
                    <option value="expense">Expense Approval</option>
                    <option value="overtime">Overtime Request</option>
                    <option value="reimbursement">Reimbursement</option>
                    <option value="general">General Request</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required placeholder="e.g., Annual Leave Request">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required placeholder="Provide details about your request"></textarea>
            </div>

            <div class="mb-3" id="date-fields" style="display: none;">
                <div class="row">
                    <div class="col-md-6">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date">
                    </div>
                    <div class="col-md-6">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date">
                    </div>
                </div>
            </div>

            <div class="mb-3" id="amount-field" style="display: none;">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" step="0.01" placeholder="0.00">
            </div>

            <div class="mb-3">
                <label for="approver_id" class="form-label">Approver</label>
                <select class="form-select" id="approver_id" name="approver_id" required>
                    <option value="">Select approver...</option>
                    @foreach($approvers as $approver)
                        <option value="{{ $approver->id }}">{{ $approver->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-wecom-primary">
                <i class="bi bi-send me-2"></i>Submit Request
            </button>
        </form>
    </div>
</div>

<script>
function toggleFields() {
    const type = document.getElementById('type').value;
    const dateFields = document.getElementById('date-fields');
    const amountField = document.getElementById('amount-field');
    
    dateFields.style.display = 'none';
    amountField.style.display = 'none';
    
    if (type === 'leave' || type === 'overtime') {
        dateFields.style.display = 'block';
    }
    
    if (type === 'expense' || type === 'reimbursement') {
        amountField.style.display = 'block';
    }
}
</script>
@endsection
