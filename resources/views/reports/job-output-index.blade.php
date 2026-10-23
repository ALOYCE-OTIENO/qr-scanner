@extends('layouts.app')

@section('title', 'Job Output Reports')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Job Output Reports</h1>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title mb-4">Generate Job Output Report</h5>
        <form action="{{ route('reports.job-output') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Report Type</label>
                    <select name="type" class="form-select" id="reportType" onchange="toggleDateRange()">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                        <option value="custom">Custom Range</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ Carbon\Carbon::today()->format('Y-m-d') }}" required>
                </div>
                <div class="col-md-3 mb-3" id="endDateField" style="display: none;">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="{{ Carbon\Carbon::today()->format('Y-m-d') }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Employee</label>
                    <select name="employee_id" class="form-select">
                        <option value="">All Employees</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->full_name }} ({{ $employee->employee_id }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Department</label>
                    <select name="department" class="form-select">
                        <option value="">All Departments</option>
                        @foreach($departments as $department)
                            <option value="{{ $department }}">{{ $department }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-file-earmark-bar-graph"></i> Generate Report
            </button>
        </form>
    </div>
</div>

<script>
function toggleDateRange() {
    const reportType = document.getElementById('reportType').value;
    const endDateField = document.getElementById('endDateField');
    
    if (reportType === 'custom') {
        endDateField.style.display = 'block';
    } else {
        endDateField.style.display = 'none';
    }
}
</script>
@endsection
