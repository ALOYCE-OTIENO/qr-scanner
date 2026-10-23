@extends('layouts.app')

@section('title', 'Attendance Report')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Attendance Report</h1>
    <div>
        <a href="{{ route('reports.attendance.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <a href="{{ route('reports.attendance.export', request()->query()) }}" class="btn btn-success">
            <i class="bi bi-file-earmark-excel"></i> Export CSV
        </a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stat-card purple">
            <h3>{{ $totalDays }}</h3>
            <p>Total Records</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card green">
            <h3>{{ $presentDays }}</h3>
            <p>Present Days</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card orange">
            <h3>{{ $lateDays }}</h3>
            <p>Late Arrivals</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card blue">
            <h3>{{ number_format($totalWorkHours, 2) }}</h3>
            <p>Total Work Hours</p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title mb-3">
            @if($type === 'daily')
                Daily Report for {{ $startDate }}
            @elseif($type === 'weekly')
                Weekly Report for Week of {{ $startDate }}
            @elseif($type === 'monthly')
                Monthly Report for {{ Carbon\Carbon::parse($startDate)->format('F Y') }}
            @else
                Custom Range: {{ $startDate }} to {{ $endDate }}
            @endif
        </h5>
        
        @if($attendances->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Work Hours</th>
                            <th>Status</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $attendance)
                            <tr>
                                <td>{{ $attendance->date }}</td>
                                <td>
                                    <strong>{{ $attendance->employee->full_name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $attendance->employee->employee_id }}</small>
                                </td>
                                <td>{{ $attendance->employee->department }}</td>
                                <td>{{ $attendance->check_in_time }}</td>
                                <td>{{ $attendance->check_out_time ?? '-' }}</td>
                                <td>{{ $attendance->work_hours ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $attendance->status === 'present' ? 'success' : ($attendance->status === 'late' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($attendance->status) }}
                                    </span>
                                </td>
                                <td>{{ $attendance->notes ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> No attendance records found for the selected criteria.
            </div>
        @endif
    </div>
</div>
@endsection
