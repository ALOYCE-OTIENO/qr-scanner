@extends('layouts.app')

@section('title', 'All Employees Attendance')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>All Employees Attendance</h1>
    <div>
        <a href="{{ route('attendance.history') }}" class="btn btn-wecom-outline">
            <i class="bi bi-clock-history me-2"></i>View History
        </a>
        <a href="{{ route('attendance.index', ['employee_id' => '']) }}" class="btn btn-wecom-outline">
            <i class="bi bi-plus me-2"></i>Scan Employee
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">Attendance for {{ $today->format('l, F j, Y') }}</h5>
    </div>
    <div class="card-body">
        @if($employees->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Employee ID</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div style="width: 40px; height: 40px; background: var(--wecom-green); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; margin-right: 0.75rem;">
                                            {{ strtoupper(substr($employee->full_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="font-weight: 600;">{{ $employee->full_name }}</div>
                                            <small class="text-muted">{{ $employee->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $employee->employee_id }}</td>
                                <td>
                                    @if($employee->attendance && $employee->attendance->check_in_time)
                                        <span style="font-weight: 600; color: var(--wecom-green);">{{ $employee->attendance->check_in_time }}</span>
                                    @else
                                        <span class="text-muted">Not checked in</span>
                                    @endif
                                </td>
                                <td>
                                    @if($employee->attendance && $employee->attendance->check_out_time)
                                        <span style="font-weight: 600; color: #333;">{{ $employee->attendance->check_out_time }}</span>
                                    @else
                                        <span class="text-muted">Not checked out</span>
                                    @endif
                                </td>
                                <td>
                                    @if($employee->attendance)
                                        <span class="badge {{ $employee->attendance->status === 'present' ? 'badge-success' : 'badge-warning' }}">
                                            {{ ucfirst($employee->attendance->status) }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">Absent</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('attendance.index', ['employee_id' => $employee->id]) }}" class="btn btn-sm btn-wecom-outline">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-people" style="font-size: 4rem; color: var(--wecom-gray);"></i>
                <p class="mt-3" style="color: var(--wecom-gray);">No employees found</p>
                <a href="{{ route('employees.create') }}" class="btn btn-wecom-primary">
                    <i class="bi bi-person-plus me-2"></i>Add Employee
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
