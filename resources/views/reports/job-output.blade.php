@extends('layouts.app')

@section('title', 'Job Output Report')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Job Output Report</h1>
    <div>
        <a href="{{ route('reports.job-output.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <a href="{{ route('reports.job-output.export', request()->query()) }}" class="btn btn-success">
            <i class="bi bi-file-earmark-excel"></i> Export CSV
        </a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stat-card purple">
            <h3>{{ $totalTasks }}</h3>
            <p>Total Tasks</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card green">
            <h3>{{ $completedTasks }}</h3>
            <p>Completed</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card orange">
            <h3>{{ $pendingTasks }}</h3>
            <p>Pending</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card blue">
            <h3>{{ $totalQuantity }}</h3>
            <p>Total Quantity</p>
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
        
        @if($jobOutputs->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Task Name</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Quality Score</th>
                            <th>Status</th>
                            <th>Completed At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobOutputs as $jobOutput)
                            <tr>
                                <td>{{ $jobOutput->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <strong>{{ $jobOutput->employee->full_name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $jobOutput->employee->employee_id }}</small>
                                </td>
                                <td>{{ $jobOutput->employee->department }}</td>
                                <td>{{ $jobOutput->task_name }}</td>
                                <td>{{ $jobOutput->quantity }}</td>
                                <td>{{ $jobOutput->unit }}</td>
                                <td>{{ $jobOutput->quality_score ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $jobOutput->status === 'completed' ? 'success' : ($jobOutput->status === 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($jobOutput->status) }}
                                    </span>
                                </td>
                                <td>{{ $jobOutput->completed_at ? $jobOutput->completed_at->format('Y-m-d H:i') : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> No job output records found for the selected criteria.
            </div>
        @endif
    </div>
</div>
@endsection
