@extends('layouts.app')

@section('title', 'Employee Performance Report')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Employee Performance Report</h1>
    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Dashboard
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('reports.employee-performance') }}" method="GET">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $startDate }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="{{ $endDate }}" required>
                </div>
                <div class="col-md-4 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-filter"></i> Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title mb-3">
            Performance Summary ({{ Carbon\Carbon::parse($startDate)->format('M d, Y') }} - {{ Carbon\Carbon::parse($endDate)->format('M d, Y') }})
        </h5>
        
        @if(count($employeeData) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Attendance Days</th>
                            <th>Present</th>
                            <th>Late</th>
                            <th>Total Work Hours</th>
                            <th>Tasks Completed</th>
                            <th>Total Output</th>
                            <th>Avg Quality Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employeeData as $data)
                            <tr>
                                <td>
                                    <strong>{{ $data['employee']->full_name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $data['employee']->employee_id }}</small>
                                </td>
                                <td>{{ $data['employee']->department }}</td>
                                <td>{{ $data['employee']->position }}</td>
                                <td>{{ $data['attendance_count'] }}</td>
                                <td>
                                    <span class="badge bg-success">{{ $data['present_days'] }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-warning">{{ $data['late_days'] }}</span>
                                </td>
                                <td>{{ number_format($data['total_work_hours'], 2) }} hrs</td>
                                <td>{{ $data['completed_tasks'] }}</td>
                                <td>{{ $data['total_quantity'] }}</td>
                                <td>{{ $data['avg_quality_score'] ? number_format($data['avg_quality_score'], 2) : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> No performance data found for the selected period.
            </div>
        @endif
    </div>
</div>
@endsection
