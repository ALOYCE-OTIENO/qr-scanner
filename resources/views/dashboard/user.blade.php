@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 style="font-weight: 600; color: #333;">My Dashboard</h1>
        <p class="text-muted">Welcome back, {{ auth()->user()->name }}</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- Quick Stats -->
<div class="row mb-4">
    @if(isset($myAttendancesThisMonth))
    <div class="col-6 col-md-3 mb-3">
        <div class="stat-card">
            <i class="bi bi-calendar-check"></i>
            <h3>{{ $myAttendancesThisMonth }}</h3>
            <p>Days This Month</p>
        </div>
    </div>
    @endif
    @if(isset($myLateCountThisMonth))
    <div class="col-6 col-md-3 mb-3">
        <div class="stat-card">
            <i class="bi bi-clock-history"></i>
            <h3>{{ $myLateCountThisMonth }}</h3>
            <p>Late Arrivals</p>
        </div>
    </div>
    @endif
    @if(isset($myJobOutputsThisMonth))
    <div class="col-6 col-md-3 mb-3">
        <div class="stat-card">
            <i class="bi bi-clipboard-data"></i>
            <h3>{{ $myJobOutputsThisMonth }}</h3>
            <p>Job Outputs</p>
        </div>
    </div>
    @endif
    <div class="col-6 col-md-3 mb-3">
        <div class="stat-card">
            <i class="bi bi-list-check"></i>
            <h3>{{ $myPendingTasks ?? 0 }}</h3>
            <p>Pending Tasks</p>
        </div>
    </div>
</div>

<!-- Today's Status -->
@if($employee)
<div class="row mb-4">
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Today's Attendance</h5>
            </div>
            <div class="card-body">
                @if(isset($myAttendanceToday) && $myAttendanceToday)
                    <div class="d-flex align-items-center mb-3">
                        <div style="width: 60px; height: 60px; background: var(--wecom-green); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; margin-right: 1rem;">
                            <i class="bi bi-check-lg"></i>
                        </div>
                        <div>
                            <h6 class="mb-1" style="font-weight: 600;">Checked In</h6>
                            <p class="mb-0" style="color: var(--wecom-green); font-weight: 600; font-size: 1.25rem;">{{ $myAttendanceToday->check_in_time }}</p>
                        </div>
                    </div>
                    @if($myAttendanceToday->check_out_time)
                    <div class="d-flex align-items-center">
                        <div style="width: 60px; height: 60px; background: #667eea; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; margin-right: 1rem;">
                            <i class="bi bi-box-arrow-right"></i>
                        </div>
                        <div>
                            <h6 class="mb-1" style="font-weight: 600;">Checked Out</h6>
                            <p class="mb-0" style="color: #667eea; font-weight: 600; font-size: 1.25rem;">{{ $myAttendanceToday->check_out_time }}</p>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('attendance.index', ['employee_id' => $employee->id]) }}" class="btn btn-wecom-primary w-100 mt-3">
                        <i class="bi bi-box-arrow-right me-2"></i>Check Out
                    </a>
                    @endif
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-calendar-x" style="font-size: 3rem; color: var(--wecom-gray);"></i>
                        <p class="mt-2 mb-3" style="color: var(--wecom-gray);">Not checked in today</p>
                        <a href="{{ route('attendance.index', ['employee_id' => $employee->id]) }}" class="btn btn-wecom-primary">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Check In Now
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('job-output.create') }}" class="btn btn-wecom-outline">
                        <i class="bi bi-plus-lg me-2"></i>Record Job Output
                    </a>
                    <a href="{{ route('tasks.create') }}" class="btn btn-wecom-outline">
                        <i class="bi bi-list-check me-2"></i>View My Tasks
                    </a>
                    <a href="{{ route('approvals.create') }}" class="btn btn-wecom-outline">
                        <i class="bi bi-file-earmark-check me-2"></i>Submit Request
                    </a>
                    <a href="{{ route('meetings.create') }}" class="btn btn-wecom-outline">
                        <i class="bi bi-calendar-event me-2"></i>Schedule Meeting
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<!-- User without employee record -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-person-exclamation" style="font-size: 4rem; color: var(--wecom-gray);"></i>
                <h4 class="mt-3" style="font-weight: 600;">No Employee Record Found</h4>
                <p class="text-muted">Please contact the administrator to set up your employee profile.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-center mt-4">
                    <a href="{{ route('tasks.create') }}" class="btn btn-wecom-outline">
                        <i class="bi bi-list-check me-2"></i>View My Tasks
                    </a>
                    <a href="{{ route('approvals.create') }}" class="btn btn-wecom-outline">
                        <i class="bi bi-file-earmark-check me-2"></i>Submit Request
                    </a>
                    <a href="{{ route('meetings.create') }}" class="btn btn-wecom-outline">
                        <i class="bi bi-calendar-event me-2"></i>Schedule Meeting
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Recent Activity -->
@if(isset($myRecentAttendances) || isset($myRecentJobOutputs))
<div class="row">
    @if(isset($myRecentAttendances))
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Recent Attendance</h5>
            </div>
            <div class="card-body">
                @if($myRecentAttendances->count() > 0)
                    <div class="list-group">
                        @foreach($myRecentAttendances as $attendance)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1" style="font-weight: 600;">{{ $attendance->date->format('M d, Y') }}</h6>
                                        <small class="text-muted">{{ $attendance->check_in_time }} - {{ $attendance->check_out_time ?? 'Active' }}</small>
                                    </div>
                                    <span class="badge {{ $attendance->status === 'present' ? 'badge-success' : 'badge-warning' }}">
                                        {{ ucfirst($attendance->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted text-center">No recent attendance</p>
                @endif
            </div>
        </div>
    </div>
    @endif
    @if(isset($myRecentJobOutputs))
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Recent Job Outputs</h5>
            </div>
            <div class="card-body">
                @if($myRecentJobOutputs->count() > 0)
                    <div class="list-group">
                        @foreach($myRecentJobOutputs as $jobOutput)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1" style="font-weight: 600;">{{ $jobOutput->task_name }}</h6>
                                        <small class="text-muted">{{ $jobOutput->quantity }} {{ $jobOutput->unit }}</small>
                                    </div>
                                    <span class="badge bg-{{ $jobOutput->status === 'completed' ? 'success' : 'warning' }}">
                                        {{ ucfirst($jobOutput->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted text-center">No recent job outputs</p>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>
@endif
@endsection
